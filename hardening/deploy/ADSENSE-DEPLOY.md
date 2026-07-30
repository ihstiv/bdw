# AdSense — Best Destination Wedding (guests-only, LST approach)

Validated on the Local mirror 2026-07-29. Members browse **ad-free**; ads show to
**guests only**. AdSense does not fill on localhost — placement/gating verified on
Local, fills once live. **Running this on prod is a PROD change — gated.**

Publisher: `ca-pub-1012936630923540` (BDW's own; ads.txt line 1, DIRECT).
Reuses the existing in-article unit already in the theme — **slot `7290797935`**. No new
AdSense units needed.

## What the migration does (default theme set, DB-stored templates)
`hardening/deploy/migrate-forum-ads.php` — idempotent, CLI-only, reads prod creds from
`conf_global.php`. Three surgical edits so it's guest-only and clean:
- `core/global/includeJS` → adds a clean async loader (`?client=…` + `crossorigin`), gated
  to **guests + front-end only**.
- `core/global/globalTemplate` → removes the OLD bare all-visitors loader
  (`<script async src="//…/adsbygoogle.js">` with no client param) from `<head>`.
- `forums/topics/post` → gates the existing in-article `<ins>` (slot 7290797935) to
  **guests only**; post content preserved.
Then clears `datastore/` so IPS recompiles.

## Run on prod (after the cron deploy has pulled this file)
```bash
cd /home/bdwforum/public_html/hardening/deploy && php migrate-forum-ads.php
```
Expect: `includeJS: updated (1)` / `globalTemplate: old loader removed (1)` /
`post: guest-gated in-article ad (1)` / `datastore cleared`. Re-running is safe
(prints `already migrated, skip`). Then AdminCP → Support → **Clear cache**.

## Verify (as a logged-OUT guest, on prod)
Open any topic → view source:
- one `adsbygoogle.js?client=ca-pub-1012936630923540` loader in `<head>`
- one `<ins class="adsbygoogle" … data-ad-slot="7290797935">` on the first post
- the old bare `//pagead2…/adsbygoogle.js` loader is gone
Logged-in members: none of the above.

## Notes
- Guests-only keeps the community ad-free for members (BDW's original intent).
- IPS Advertisement rows (Taboola/GPT/AdClerks header/footer/sidebar) are legacy; the
  active ones have empty HTML (no-op). Leave as-is, or say the word to zero them for a
  full clean slate like LST.
- Rollback: re-edit the 3 templates in AdminCP → Customization → Themes, or restore from
  the daily DB backup.
