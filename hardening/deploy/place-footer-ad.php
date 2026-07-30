<?php
/**
 * One-shot, idempotent: add a guest-only responsive AdSense unit at the top of the
 * global footer (core/global/footer). Members see nothing.
 *   client ca-pub-6344324650426589, slot 1996291687 ("BDW Footer")
 * RUN FROM CLI ONLY:  php place-footer-ad.php
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
echo "default theme set = $set\n";

$SLOT='1996291687';
$ad = "{{if \\IPS\\Member::loggedIn()->member_id === NULL}}\n"
    . "<!-- BDW guest-only footer ad -->\n"
    . "<div class='ipsType_center' style='margin:16px auto;max-width:970px;'>\n"
    . "<ins class=\"adsbygoogle\" style=\"display:block\" data-ad-client=\"ca-pub-6344324650426589\" data-ad-slot=\"$SLOT\" data-ad-format=\"auto\" data-full-width-responsive=\"true\"></ins>\n"
    . "<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>\n"
    . "</div>\n"
    . "{{endif}}\n";

$row=$m->query("SELECT template_id,template_content FROM $T WHERE template_set_id=$set AND template_app='core' AND template_group='global' AND template_name='footer' LIMIT 1")->fetch_assoc();
if(!$row){ fwrite(STDERR,"footer template not found\n"); exit(1); }
if(strpos($row['template_content'],'data-ad-slot="'.$SLOT.'"')!==false){ echo "footer: already has ad, skip\n"; }
else{
  $new=$ad."\n".$row['template_content'];
  $st=$m->prepare("UPDATE $T SET template_content=? WHERE template_id=?"); $st->bind_param('si',$new,$row['template_id']); $st->execute();
  echo "footer: ad added (".$st->affected_rows.")\n";
}
$ds=$root.'/datastore';
if(is_dir($ds)){ foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($ds,FilesystemIterator::SKIP_DOTS)) as $f){ $b=$f->getFilename(); if($f->isFile()&&$b!=='index.html'&&$b!=='.htaccess') @unlink($f->getPathname()); } echo "datastore cleared\n"; }
echo "DONE.\n"; $m->close();
