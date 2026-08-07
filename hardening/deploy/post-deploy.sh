#!/bin/bash
# Runs AFTER bdw-deploy.sh pulls a NEW commit (called only on change, so the Redis
# flush cost stays rare). Applies the DB-side changes that git can't, then flushes cache.
#
# Scope B (safe): only the header banner + cache flush. Ad *content* is left to the ACP
# so this never clobbers manual ad edits. Add more idempotent scripts here if you want
# them auto-applied on deploy.
D="$(cd "$(dirname "$0")" && pwd)"
php "$D/place-header-banner-inline.php"
php "$D/clear-cache.php"
