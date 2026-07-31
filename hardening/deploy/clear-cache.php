<?php
/**
 * Flush IPS caches from CLI without redis-cli — uses IPS's own Store + Cache API
 * (same effect as ACP > Support > Clear cache; picks up the real Redis config).
 * RUN:  php clear-cache.php
 */
if ( PHP_SAPI !== 'cli' ) { http_response_code(403); exit("CLI only\n"); }

$root=__DIR__;
for($i=0;$i<6;$i++){ if(is_file($root.'/init.php')){break;} $p=dirname($root); if($p===$root)break; $root=$p; }
if(!is_file($root.'/init.php')){ fwrite(STDERR,"init.php not found\n"); exit(1); }
chdir($root);
require $root.'/init.php';

$done=array();
/* Force theme templates to recompile from the DB (raw-DB edits don't bump the recompile flag) */
try { \IPS\Theme::deleteCompiledTemplate(); $done[]='compiledTemplates'; } catch(\Throwable $e){ echo "tpl: ".$e->getMessage()."\n"; }
try { \IPS\Theme::deleteCompiledCss(); $done[]='compiledCss'; } catch(\Throwable $e){ /* optional */ }
try { \IPS\Theme::deleteCompiledResources(); $done[]='themeResources'; } catch(\Throwable $e){ /* optional */ }
try { \IPS\Data\Store::i()->clearAll(); $done[]='store'; } catch(\Throwable $e){ echo "store: ".$e->getMessage()."\n"; }
try { \IPS\Data\Cache::i()->clearAll(); $done[]='cache'; } catch(\Throwable $e){ echo "cache: ".$e->getMessage()."\n"; }
echo "flushed: ".implode(',', $done)."\nDONE\n";
