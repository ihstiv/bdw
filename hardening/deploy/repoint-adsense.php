<?php
/**
 * One-shot, idempotent: repoint the forum's AdSense from the prior owner's publisher
 * to the site owner's own account.
 *   client  ca-pub-1012936630923540  ->  ca-pub-6344324650426589
 *   in-article slot 7290797935       ->  7247482897  (new "BDW Forum - In-Article" unit)
 *
 * RUN FROM CLI ONLY:  php repoint-adsense.php   (safe to re-run)
 * Edits every default-theme template that references the old pub/slot, then clears datastore.
 */
if ( PHP_SAPI !== 'cli' ) { http_response_code(403); exit("CLI only\n"); }

$root=__DIR__; $conf=null;
for($i=0;$i<6;$i++){ if(is_file($root.'/conf_global.php')){$conf=$root.'/conf_global.php';break;} $p=dirname($root); if($p===$root)break; $root=$p; }
if(!$conf){ fwrite(STDERR,"conf_global.php not found\n"); exit(1); }
echo "docroot: $root\n";
$INFO=array(); require $conf;
$port=!empty($INFO['sql_port'])?(int)$INFO['sql_port']:3306;
mysqli_report(MYSQLI_REPORT_OFF);
$m=@new mysqli($INFO['sql_host'],$INFO['sql_user'],$INFO['sql_pass'],$INFO['sql_database'],$port);
if($m->connect_errno){ fwrite(STDERR,"DB connect failed: ".$m->connect_error."\n"); exit(1); }
$px=$INFO['sql_tbl_prefix'];
$set=(int)($m->query("SELECT set_id FROM {$px}core_themes WHERE set_is_default=1")->fetch_assoc()['set_id'] ?? 0);
echo "default theme set = $set\n";

$OLD_CLIENT='ca-pub-1012936630923540'; $NEW_CLIENT='ca-pub-6344324650426589';
$OLD_SLOT='data-ad-slot="7290797935"'; $NEW_SLOT='data-ad-slot="7247482897"';

$T=$px.'core_theme_templates';
$res=$m->query("SELECT template_id,template_content FROM $T WHERE template_set_id=$set AND (template_content LIKE '%$OLD_CLIENT%' OR template_content LIKE '%7290797935%')");
$changed=0;
while($row=$res->fetch_assoc()){
  $c=$row['template_content'];
  $new=str_replace(array($OLD_CLIENT,$OLD_SLOT), array($NEW_CLIENT,$NEW_SLOT), $c);
  if($new!==$c){
    $st=$m->prepare("UPDATE $T SET template_content=? WHERE template_id=?");
    $st->bind_param('si',$new,$row['template_id']); $st->execute();
    echo "template {$row['template_id']}: repointed (".$st->affected_rows.")\n"; $changed++;
  }
}
echo "templates changed: $changed\n";

$ds=$root.'/datastore';
if(is_dir($ds)){ foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($ds,FilesystemIterator::SKIP_DOTS)) as $f){ $b=$f->getFilename(); if($f->isFile()&&$b!=='index.html'&&$b!=='.htaccess') @unlink($f->getPathname()); } echo "datastore cleared\n"; }
echo $changed?"DONE. Clear cache via ACP > Support if serving stale.\n":"No references found (already repointed?).\n";
$m->close();
