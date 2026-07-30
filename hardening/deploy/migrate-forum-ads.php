<?php
/**
 * One-shot, environment-independent migration: make BDW's forum AdSense tasteful
 * and GUEST-ONLY (same approach as Last Sparrow Tattoo).
 *
 * RUN FROM CLI ONLY:  php migrate-forum-ads.php
 * Safe to re-run (idempotent, marker-based). Reads DB creds from ../../conf_global.php.
 *
 * BDW already had AdSense wired for EVERYONE (loader in globalTemplate <head>, an
 * in-article <ins> in the first post). This does three surgical edits on the default
 * theme set so logged-in members browse ad-free:
 *   core/global/includeJS     -> add a clean async loader (client param + crossorigin),
 *                                gated to guests + front-end only.
 *   core/global/globalTemplate-> remove the old bare (all-visitors, no-client) loader.
 *   forums/topics/post        -> gate the existing in-article unit (slot 7290797935)
 *                                to guests only; post content is preserved.
 * Then clears datastore/ so IPS recompiles.
 */

if ( PHP_SAPI !== 'cli' ) { http_response_code(403); exit("CLI only\n"); }

/* locate docroot by walking up to conf_global.php */
$root = __DIR__; $confFile = null;
for ($i = 0; $i < 6; $i++) {
	if ( is_file($root . '/conf_global.php') ) { $confFile = $root . '/conf_global.php'; break; }
	$parent = dirname($root); if ($parent === $root) break; $root = $parent;
}
if ( ! $confFile ) { fwrite(STDERR, "conf_global.php not found from ".__DIR__."\n"); exit(1); }
echo "docroot: $root\n";
$INFO = array(); require $confFile;
$host=$INFO['sql_host']; $user=$INFO['sql_user']; $pass=$INFO['sql_pass'];
$db=$INFO['sql_database']; $prefix=$INFO['sql_tbl_prefix']; $port=!empty($INFO['sql_port'])?(int)$INFO['sql_port']:3306;

mysqli_report(MYSQLI_REPORT_OFF);
$m = @new mysqli($host,$user,$pass,$db,$port);
if ($m->connect_errno) { fwrite(STDERR,"DB connect failed: ".$m->connect_error."\n"); exit(1); }
$T = $prefix.'core_theme_templates';

$setRow = $m->query("SELECT set_id FROM {$prefix}core_themes WHERE set_is_default=1")->fetch_assoc();
$setId = $setRow ? (int)$setRow['set_id'] : 0;
echo "default theme set = $setId\n";

function loadTpl($m,$T,$setId,$app,$group,$name){
  $st=$m->prepare("SELECT template_id,template_content FROM $T WHERE template_set_id=? AND template_app=? AND template_group=? AND template_name=? LIMIT 1");
  $st->bind_param('isss',$setId,$app,$group,$name); $st->execute();
  return $st->get_result()->fetch_assoc();
}
function saveTpl($m,$T,$id,$c){ $st=$m->prepare("UPDATE $T SET template_content=? WHERE template_id=?"); $st->bind_param('si',$c,$id); $st->execute(); return $st->affected_rows; }

$client = 'ca-pub-1012936630923540';   // BDW's own pub ID (ads.txt, DIRECT)
$slot   = '7290797935';                 // existing in-article slot
$changed = 0;

/* ---- 1) includeJS: add guests-only loader ---- */
$js = loadTpl($m,$T,$setId,'core','global','includeJS');
if (!$js) { fwrite(STDERR,"includeJS not found\n"); }
elseif (strpos($js['template_content'],'adsbygoogle.js?client='.$client)!==false) { echo "includeJS: already migrated, skip\n"; }
else {
  $loader = "{{if \\IPS\\Member::loggedIn()->member_id === NULL and \\IPS\\Dispatcher::hasInstance() and \\IPS\\Dispatcher::i()->controllerLocation == 'front'}}\n"
          . "<!-- BDW AdSense loader (guests only) -->\n"
          . "<script async src=\"https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=$client\" crossorigin=\"anonymous\"></script>\n"
          . "{{endif}}\n";
  $c = $js['template_content']; $n = 0;
  if (strpos($c,'<!-- Taboola start -->')!==false) { $c = str_replace('<!-- Taboola start -->', $loader."<!-- Taboola start -->", $c, $n); }
  if ($n>0) { echo "includeJS: updated (".saveTpl($m,$T,$js['template_id'],$c).")\n"; $changed++; }
  else { fwrite(STDERR,"includeJS: Taboola anchor not found - NOT changed\n"); }
}

/* ---- 2) globalTemplate: remove old bare (all-visitors) loader ---- */
$gt = loadTpl($m,$T,$setId,'core','global','globalTemplate');
if (!$gt) { fwrite(STDERR,"globalTemplate not found\n"); }
else {
  $c = $gt['template_content'];
  $new = preg_replace('~\s*<!-- adsense -->\s*<script async src="//pagead2\.googlesyndication\.com/pagead/js/adsbygoogle\.js"></script>\s*~', "\n", $c, 1, $n);
  if ($n===1) { echo "globalTemplate: old loader removed (".saveTpl($m,$T,$gt['template_id'],$new).")\n"; $changed++; }
  elseif (strpos($c,'adsbygoogle.js"></script>')===false) { echo "globalTemplate: already clean, skip\n"; }
  else { fwrite(STDERR,"globalTemplate: bare-loader pattern not matched - NOT changed\n"); }
}

/* ---- 3) post: gate existing in-article ad to guests only ---- */
$post = loadTpl($m,$T,$setId,'forums','topics','post');
if (!$post) { fwrite(STDERR,"post not found\n"); }
else {
  $c = $post['template_content'];
  $needle = '{{if (($comment->position - 1) % \\IPS\\Settings::i()->forums_posts_per_page === 0)}}';
  $guest  = '{{if \\IPS\\Member::loggedIn()->member_id === NULL and (($comment->position - 1) % \\IPS\\Settings::i()->forums_posts_per_page === 0)}}';
  if (strpos($c,'member_id === NULL and (($comment->position')!==false) { echo "post: already guest-gated, skip\n"; }
  elseif (strpos($c,$needle)!==false && strpos($c,'data-ad-slot="'.$slot.'"')!==false) {
    $n=0; $c = str_replace($needle,$guest,$c,$n);
    if ($n>=1) { echo "post: guest-gated in-article ad (".saveTpl($m,$T,$post['template_id'],$c).")\n"; $changed++; }
  } else { fwrite(STDERR,"post: ad condition/slot not found as expected - NOT changed\n"); }
}

/* ---- clear datastore so IPS recompiles ---- */
$ds = $root.'/datastore';
if (is_dir($ds)) {
  foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($ds, FilesystemIterator::SKIP_DOTS)) as $f) {
    $bn=$f->getFilename();
    if ($f->isFile() && $bn!=='index.html' && $bn!=='.htaccess') @unlink($f->getPathname());
  }
  echo "datastore cleared\n";
}
echo $changed ? "DONE ($changed template(s) changed). Belt-and-suspenders: ACP > Support > Clear cache.\n" : "No changes applied.\n";
$m->close();
