<?php
/**
 * One-shot, idempotent: show the Wright Travel Agency banner in the header
 * (the theme renders {advertisement="ad_global_header"} but nothing was assigned there).
 * Uses a light-background WTA logo (dark text) suited to the light header, linking to WTA.
 * RUN FROM CLI ONLY:  php add-header-banner.php   (safe to re-run)
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
$T=$INFO['sql_tbl_prefix'].'core_advertisements';

$html = '<a href="https://wrighttravelagency.com/" target="_blank" rel="noopener sponsored"><img src="/img/sponsors/wta-header.png" alt="Wright Travel Agency" style="display:block;max-width:100%;height:auto;margin:8px auto;"></a>';

$row=$m->query("SELECT ad_id FROM $T WHERE ad_location='ad_global_header' AND ad_html LIKE '%wta-header.png%' LIMIT 1")->fetch_assoc();
if($row){
	$st=$m->prepare("UPDATE $T SET ad_html=?, ad_html_https=?, ad_html_https_set=1, ad_type=1, ad_active=1 WHERE ad_id=?");
	$st->bind_param('ssi',$html,$html,$row['ad_id']); $st->execute();
	echo "header ad #{$row['ad_id']}: updated\n";
} else {
	// copy structural columns from an existing ad, override location/html/type/active
	$st=$m->prepare("INSERT INTO $T (ad_location, ad_html, ad_html_https, ad_html_https_set, ad_images, ad_link, ad_impressions, ad_clicks, ad_exempt, ad_active, ad_start, ad_end, ad_maximum_value, ad_maximum_unit, ad_additional_settings, ad_member, ad_new_window, ad_type, ad_email_views, ad_image_alt, ad_nocontent_page_output) SELECT 'ad_global_header', ?, ?, 1, '[]', 'https://wrighttravelagency.com/', 0, 0, ad_exempt, 1, ad_start, ad_end, ad_maximum_value, ad_maximum_unit, ad_additional_settings, ad_member, ad_new_window, 1, 0, 'Wright Travel Agency', ad_nocontent_page_output FROM $T WHERE ad_id=12");
	$st->bind_param('ss',$html,$html); $st->execute();
	echo "header ad: created (id ".$m->insert_id.")\n";
}
$ds=$root.'/datastore';
if(is_dir($ds)){ foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($ds,FilesystemIterator::SKIP_DOTS)) as $f){ $b=$f->getFilename(); if($f->isFile()&&$b!=='index.html'&&$b!=='.htaccess') @unlink($f->getPathname()); } echo "datastore cleared\n"; }
echo "DONE.\n"; $m->close();
