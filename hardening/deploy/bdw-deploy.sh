#!/bin/bash
# BDW forum deploy — server-side PULL from github.com/ihstiv/bdw (branch main).
# Runs on the InMotion cPanel box as user `bdwforum` via cron. Pulls out over
# SSH-443 using the read-only deploy key (~/.ssh/bdw_deploy, host alias gh-bdw).
#
# SAFE BY DESIGN: `git reset --hard` only touches TRACKED files. Everything the
# forum needs per-server is .gitignored and therefore left untouched:
#   conf_global.php, constants.php, .htaccess, uploads/, datastore/, *.log
# So a deploy overwrites CODE only; it never clobbers prod config, the SEO
# redirect .htaccess, user uploads, or the cache. It also never deletes the
# legacy dirs still on prod (they are untracked) — clean those once, by hand.

export HOME=/home/bdwforum
export PATH=/usr/local/cpanel/3rdparty/lib/path-bin:/usr/local/bin:/usr/bin:/bin
ROOT=/home/bdwforum/public_html
LOG=/home/bdwforum/deploy/bdw-deploy.log

{
  echo "----- $(date) -----"
  cd "$ROOT" || { echo "ERROR: $ROOT missing"; exit 1; }
  B=$(git rev-parse HEAD 2>/dev/null)
  git fetch origin main --quiet && git reset --hard origin/main
  A=$(git rev-parse HEAD 2>/dev/null)
  if [ "$B" != "$A" ]; then
    echo "deployed $B -> $A; running post-deploy"
    [ -f "$ROOT/hardening/deploy/post-deploy.sh" ] && bash "$ROOT/hardening/deploy/post-deploy.sh"
  else
    echo "no change ($A)"
  fi
} >> "$LOG" 2>&1
