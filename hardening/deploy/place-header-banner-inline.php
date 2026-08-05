<?php
/**
 * Put the actual BDW/WTA leaderboard banner (bdw-wta-banner.png, 728x90) INSIDE the
 * floral header band (right of the logo), matching the footer banner. Edits
 * core/global/globalTemplate. Deactivates the below-nav header ad (#15).
 * Replace-or-insert (safe to re-run; updates the banner if it already exists).
 * RUN FROM CLI ONLY:  php place-header-banner-inline.php
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

$IMG='/cdn/monthly_2026_08/bdw-wta-banner.png.66364e5a1c8375c4880e14c5cc23f102.png';
$banner = "\n<a href=\"https://wrighttravelagency.com/\" target=\"_blank\" rel=\"noopener sponsored\" class=\"bdw-header-banner\" style=\"position:absolute;top:10px;left:50%;transform:translateX(-50%);margin-left:-115px;z-index:3;display:block;width:728px;max-width:100%;\"><img src=\"$IMG\" alt=\"Contact a BDW Travel Agent\" style=\"width:100%;height:auto;display:block;\"></a>\n";

$row=$m->query("SELECT template_id,template_content FROM $T WHERE template_set_id=$set AND template_app='core' AND template_group='global' AND template_name='globalTemplate' LIMIT 1")->fetch_assoc();
if(!$row){ fwrite(STDERR,"globalTemplate not found\n"); exit(1); }
$c=$row['template_content'];
// remove any existing header banner anchor (idempotent update)
$c = preg_replace('#\n?<a[^>]*class="bdw-header-banner"[^>]*>.*?</a>\n?#s', '', $c);
$logoTag='{template="logo" app="core" group="global" params=""}';
if(strpos($c,$logoTag)===false){ fwrite(STDERR,"logo tag not found - NOT changed\n"); exit(1); }
if(strpos($c,'<header style="position:relative;">')===false){ $c = preg_replace('/<header>/', '<header style="position:relative;">', $c, 1); }
$c = str_replace($logoTag, $logoTag.$banner, $c);
$st=$m->prepare("UPDATE $T SET template_content=? WHERE template_id=?"); $st->bind_param('si',$c,$row['template_id']); $st->execute();
echo "globalTemplate: header banner set to bdw-wta-banner (".$st->affected_rows.")\n";

$m->query("UPDATE {$px}core_advertisements SET ad_active=0 WHERE ad_location='ad_global_header' AND ad_html LIKE '%wta-header.png%'");
echo "below-nav header ad (#15): deactivated\n";

$ds=$root.'/datastore';
if(is_dir($ds)){ foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($ds,FilesystemIterator::SKIP_DOTS)) as $f){ $b=$f->getFilename(); if($f->isFile()&&$b!=='index.html'&&$b!=='.htaccess') @unlink($f->getPathname()); } echo "datastore cleared\n"; }
echo "DONE.\n"; $m->close();
