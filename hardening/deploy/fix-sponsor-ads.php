<?php
/**
 * One-shot, idempotent: repair the two broken Wright Travel Agency sponsor ads
 * (IPS advertisements #6 sidebar, #12 footer). Their image files were lost (empty
 * ad_images, dead /cdn/ proxy). Convert them to self-contained HTML ads pointing at
 * git-deployed logo files under /img/sponsors/. Link + alt were already correct.
 *
 * RUN FROM CLI ONLY:  php fix-sponsor-ads.php   (safe to re-run)
 */
if ( PHP_SAPI !== 'cli' ) { http_response_code(403); exit("CLI only\n"); }
$root=__DIR__; $conf=null;
for($i=0;$i<6;$i++){ if(is_file($root.'/conf_global.php')){$conf=$root.'/conf_global.php';break;} $p=dirname($root); if($p===$root)break; $root=$p; }
if(!$conf){ fwrite(STDERR,"conf_global.php not found\n"); exit(1); }
$INFO=array(); require $conf;
$port=!empty($INFO['sql_port'])?(int)$INFO['sql_port']:3306;
mysqli_report(MYSQLI_REPORT_OFF);
$m=@new mysqli($INFO['sql_host'],$INFO['sql_user'],$INFO['sql_pass'],$INFO['sql_database'],$port);
if($m->connect_errno){ fwrite(STDERR,"DB connect failed: ".$m->connect_error."\n"); exit(1); }
$px=$INFO['sql_tbl_prefix']; $T=$px.'core_advertisements';

$ads = array(
	6  => '<a href="https://wrighttravelagency.com/" target="_blank" rel="noopener sponsored"><img src="/img/sponsors/wta-sidebar.png" alt="Wright Travel Agency" style="display:block;max-width:100%;height:auto;margin:6px auto;"></a>',
	12 => '<a href="https://wrighttravelagency.com/" target="_blank" rel="noopener sponsored"><img src="/img/sponsors/wta-footer.png" alt="Wright Travel Agency | Destination Wedding Specialists" style="display:block;max-width:100%;height:auto;margin:6px auto;"></a>',
);
$changed=0;
foreach($ads as $id=>$html){
	// ad_type 1 = HTML ad; clear ad_images; keep active/location/link/alt
	$st=$m->prepare("UPDATE $T SET ad_type=1, ad_html=?, ad_html_https=?, ad_html_https_set=1, ad_images='[]', ad_active=1 WHERE ad_id=?");
	$st->bind_param('ssi',$html,$html,$id); $st->execute();
	echo "ad #$id: ".($st->affected_rows>0?'updated':'no change (already set)')."\n"; if($st->affected_rows>0)$changed++;
}

/* clear datastore so the ad cache rebuilds */
$ds=$root.'/datastore';
if(is_dir($ds)){ foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($ds,FilesystemIterator::SKIP_DOTS)) as $f){ $b=$f->getFilename(); if($f->isFile()&&$b!=='index.html'&&$b!=='.htaccess') @unlink($f->getPathname()); } echo "datastore cleared\n"; }
echo "DONE ($changed changed). On prod also run clear-cache.php to flush Redis.\n";
$m->close();
