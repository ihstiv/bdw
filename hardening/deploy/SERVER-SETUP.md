# BDW forum — server-side deploy (GitHub → InMotion cPanel, cron PULL)

Account `bdwforum`, repo `ihstiv/bdw`, branch `main`, docroot `/home/bdwforum/public_html`.
Pull model (server fetches out over SSH-443); GitHub-Actions rsync-push does NOT work on
these firewalled hosts. All steps run in **cPanel → Terminal** as user `bdwforum`.

## 1. Deploy key + GitHub-over-443 (host alias avoids clashes with other repos on the account)
```bash
ssh-keygen -t ed25519 -C "bdw-deploy" -f ~/.ssh/bdw_deploy -N ""
cat >> ~/.ssh/config <<'CFG'
Host gh-bdw
  HostName ssh.github.com
  Port 443
  User git
  IdentityFile ~/.ssh/bdw_deploy
  IdentitiesOnly yes
CFG
ssh-keyscan -t rsa,ecdsa,ed25519 -p 443 ssh.github.com >> ~/.ssh/known_hosts 2>/dev/null
chmod 700 ~/.ssh; chmod 600 ~/.ssh/config ~/.ssh/bdw_deploy
echo; echo "=== ADD THIS as a READ-ONLY Deploy key at github.com/ihstiv/bdw → Settings → Deploy keys ==="
cat ~/.ssh/bdw_deploy.pub; echo
```
Paste the printed public key at **github.com/ihstiv/bdw → Settings → Deploy keys → Add** (leave
"Allow write access" UNCHECKED). Then verify:
```bash
ssh -T git@gh-bdw    # expect: "Hi ihstiv/bdw! You've successfully authenticated, but GitHub does not provide shell access."
```

## 2. First-time checkout INTO the existing docroot (non-destructive to config/uploads)
```bash
cd /home/bdwforum/public_html
git init
git remote add origin git@gh-bdw:ihstiv/bdw.git
git fetch origin main
git reset --hard origin/main
# protect the .git dir from the web
grep -q 'RedirectMatch 404 /\.git' .htaccess 2>/dev/null || printf '\nRedirectMatch 404 /\\.git\n' >> .htaccess
# sanity: per-server files must still be present (they are .gitignored, never touched)
ls -1 conf_global.php constants.php .htaccess && echo "OK: prod config + .htaccess preserved"
```

## 3. Deploy script + cron
`bdw-deploy.sh` (in this folder) → copy to `~/deploy/`:
```bash
mkdir -p ~/deploy
cp /home/bdwforum/public_html/hardening/deploy/bdw-deploy.sh ~/deploy/bdw-deploy.sh
chmod +x ~/deploy/bdw-deploy.sh
bash ~/deploy/bdw-deploy.sh && tail -3 ~/deploy/bdw-deploy.log
```
cPanel → **Cron Jobs** → Every 5 Minutes (`*/5 * * * *`):
```
bash /home/bdwforum/deploy/bdw-deploy.sh
```

## Why this is safe
`git reset --hard origin/main` only resets TRACKED files. These are `.gitignore`d, so prod keeps
its own and a deploy never overwrites them: **conf_global.php, constants.php, .htaccess (the full
SEO redirect set), uploads/, datastore/, *.log**. Never hand-edit tracked code on the server — it
is overwritten every pull.

## One-time prod cleanup (OPTIONAL — do NOT skip the DB step)
The deploy runs the hardened CODE but does NOT remove the legacy trees still on prod (they are
untracked, so reset --hard leaves them) and does NOT change the database.
- Dead IPB3/Huddler dirs + stray scripts can be `rm`'d by hand (same list as the local pass:
  ips_kernel, cache, hooks, root, blog, downloads, lofiversion, interface, ccs_files, fcontent,
  public, screenshots, cgi-bin, js, ips_8fcf3, admin/convertutf8, admin/install, admin/upgrade;
  keep `img/`). Removing these is code-only and safe.
- **Tapatalk must go through the ACP**, not a raw `rm`. On prod it is ENABLED with 7 live hooks;
  deleting `applications/tapatalk` without first removing its DB hooks will fatal every page. Use
  **ACP → Applications → Tapatalk → Uninstall** (handles files + DB together). Do this before/instead
  of deleting the files by hand.
Because none of the deleted paths are in the repo, the cron deploy will neither restore nor
re-remove them — a one-time manual cleanup sticks.
