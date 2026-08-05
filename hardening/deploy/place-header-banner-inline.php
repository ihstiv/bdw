<?php
/**
 * Put the Wright Travel Agency banner INSIDE the floral header band (right of the logo),
 * instead of the ad_global_header slot below the nav. Edits core/global/globalTemplate.
 * Also deactivates the below-nav header ad (#15) so it isn't shown twice.
 * RUN FROM CLI ONLY:  php place-header-banner-inline.php   (safe to re-run)
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
$px=$INFO['sql_tbl_prefix']; $T=$px.'core_theme_templates';
$set=(int)($m->query("SELECT set_id FROM {$px}core_themes WHERE set_is_default=1")->fetch_assoc()['set_id'] ?? 0);

$MARK = 'bdw-header-banner';
$banner = "\n<a href=\"https://wrighttravelagency.com/\" target=\"_blank\" rel=\"noopener sponsored\" class=\"$MARK\" style=\"position:absolute;top:14px;left:50%;margin-left:-130px;z-index:3;display:block;\"><img src=\"/img/sponsors/wta-header.png\" alt=\"Wright Travel Agency\" style=\"max-width:260px;height:auto;display:block;\"></a>\n";

$row=$m->query("SELECT template_id,template_content FROM $T WHERE template_set_id=$set AND template_app='core' AND template_group='global' AND template_name='globalTemplate' LIMIT 1")->fetch_assoc();
if(!$row){ fwrite(STDERR,"globalTemplate not found\n"); exit(1); }
$c=$row['template_content'];
if(strpos($c,$MARK)!==false){ echo "globalTemplate: header banner already present, skip\n"; }
else{
	$logoTag='{template="logo" app="core" group="global" params=""}';
	if(strpos($c,$logoTag)===false){ fwrite(STDERR,"logo template tag not found - NOT changed\n"); exit(1); }
	// make the <header> a positioning context (first occurrence only)
	$c = preg_replace('/<header>/', '<header style="position:relative;">', $c, 1);
	// insert the banner right after the logo
	$c = str_replace($logoTag, $logoTag.$banner, $c);
	$st=$m->prepare("UPDATE $T SET template_content=? WHERE template_id=?");
	$st->bind_param('si',$c,$row['template_id']); $st->execute();
	echo "globalTemplate: header banner inserted (".$st->affected_rows.")\n";
}

/* deactivate the below-nav header ad so it isn't duplicated */
$m->query("UPDATE $T SET template_content=template_content WHERE 1=0"); // no-op guard
$m->query("UPDATE {$px}core_advertisements SET ad_active=0 WHERE ad_location='ad_global_header' AND ad_html LIKE '%wta-header.png%'");
echo "below-nav header ad (#15): deactivated\n";

$ds=$root.'/datastore';
if(is_dir($ds)){ foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($ds,FilesystemIterator::SKIP_DOTS)) as $f){ $b=$f->getFilename(); if($f->isFile()&&$b!=='index.html'&&$b!=='.htaccess') @unlink($f->getPathname()); } echo "datastore cleared\n"; }
echo "DONE.\n"; $m->close();
