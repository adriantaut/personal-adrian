---
name: rotary-site
description: Work on the Rotary Club Cluj-Napoca Opera website (rotaryoperacluj.ro, WordPress on cPanel) — content edits, member photos, projects, homepage/design tweaks, donations/Stripe, SEO/security. Use whenever the user mentions the Rotary site, rotaryoperacluj.ro, a page/project/member on it, or Stripe donations for the club.
---

# Rotary Opera website — how we work

Adrian is the club's volunteer web dev. Goal: a beautiful site focused on **projects and team**, maintainable by non-technical members (no GitHub repo — everything lives in WordPress). Full history & decisions: `rotary/site.md` (read it first for anything non-trivial; append dated notes there after changes).

## Stack
- **WordPress** (Twenty Twenty-Five block theme + Site Editor) on **CyberFolks cPanel** (`hv115.c-f.ro:2083`, user `rotaryop`, LiteSpeed). `public_html` = live site. DB `rotaryop_nou`, prefix `rop_`.
- **Secure Custom Fields**: CPTs `proiect` / `membru` / `eveniment`, taxonomy `categorie-proiect`. Project fields: `logo`, `logo_mic`, `impact`, `galerie`, `parteneri`, `status`, `an`, repeater `editii`.
- **mu-plugins** (the only "code"; local copies are the source of truth, keep them in sync):
  - `rop-blocks.php` — shortcodes `rop_impact`, `rop_galerie`, `rop_parteneri`, `rop_meta`, `rop_editii`, `rop_doneaza`, `rop_echipa tip=comitet|membri|onoare` + base CSS
  - `rop-design-a.php` — live design **„A dark”**: header/footer/homepage via `render_block` filters + inner-page CSS. Config constants at top: `ROP_A_HERO` (slider attachment IDs), `ROP_A_CURRENT` (hero card „În desfășurare”), `ROP_A_PARTNERS` (slug→URL), `ROP_A_FEATURED`, `ROP_A_STRIPE`.
  - Enabled by `ROP_DESIGN_A_LIVE` + `ROP_DESIGN_A_DARK` in `wp-config.php` (rollback = remove both lines + purge cache).
- Plugins: LiteSpeed Cache, Wordfence, The SEO Framework, Independent Analytics, Smash Balloon (Instagram, not connected yet).

## Tools — `rotary/site-content/tools/`
Run from that directory. Token lives in `~/.rotary_cpanel_token` (never print it, never commit it).
- `cp.py` — `uapi(mod, fn, **p)`, `api2(...)`, `save(dir, filename, content)` (cPanel Fileman).
- `oneshot.py` — `run(php)` executes PHP **inside WordPress as admin `adrian.taut`** via a self-deleting, secret-guarded file. This is THE way to change content (Wordfence blocks app passwords; there is no SSH/WP-CLI).
  ```python
  from oneshot import run
  print(run("echo get_page_by_path('toyjoy', OBJECT, 'proiect')->ID;"))
  ```
- Deploy a mu-plugin: `from cp import save; save('/home/rotaryop/public_html/wp-content/mu-plugins', 'rop-design-a.php', open('rop-design-a.php').read())`
- `set-photo.sh "Nume Membru" photo.png` — upload + set member photo (deletes the old one).
- `../badge.sh in.jpg out.png` — 800px circle crop with the Rotary badge (matches older member photos).
- `b.py` — helpers emitting core block markup (`p, h, btn, btns, group, cols, col, sep, html, details, pagehero`); page generators `doneaza.py`, `devino-membru.py` → JSON → `wp_update_post` via `run()`.

## Procedures
- **After every change: purge cache** → `run("do_action('litespeed_purge_all'); echo 'ok';")`, then **verify visually** with the `/browse` skill (headless browser, desktop + mobile width). Don't claim it looks right without a screenshot.
- **Images**: re-upload under a **new filename** when replacing (browsers/CDN cache the old one). Local ImageMagick lacks JPEG decode/fonts → use `sips` for JPEGs, pass `-font "/System/Library/Fonts/Supplemental/Arial Bold.ttf"` to `magick`; `pdftocairo` for PDFs.
- **Saving post content / global styles**: wrap with `wp_slash()` (otherwise JSON/backslashes get stripped). Send UTF-8 through Python, never via shell variables (diacritics get corrupted).
- **Redirects / security headers**: `public_html/.htaccess`, blocks `rop-security` and `rop-redirects`. Read the file before editing; keep a backup.
- **Recurring project editions**: add a row to the `editii` repeater (newest shown first by `[rop_editii]`).
- **New project**: CPT `proiect` + category + fields; text style = see `rotary/site-content/proiecte-2024-2026.json` (short, warm, concrete numbers, Romanian with correct diacritics ș/ț).
- **Wordfence lockout** of a user: remove via `wfBlock::removeBlockIDs` inside `run()`.
- Disk quota is 5 GB — never leave big backups in the home dir.

## Content rules (decided by Adrian / the club)
- **Never publish the meeting day/time/place** (Wednesday, Hotel Victoria) anywhere on the site.
- **Never publish members' emails, phones or birth dates.** Members have no individual public pages (only on /echipa/).
- Roles appear **only** in the committee section; „Membrii clubului” lists ALL members alphabetically (accent-insensitive), no roles. Honorary members stay. No PHF badges.
- **Our logo is the one with the wave — never alter it.** Partner logos: full colour, clickable, not greyed.
- Children's names/drawings: no blurring needed (Adrian's call), but beneficiaries are described **generically** (e.g. „~60 copii din două case de tip familial”), no institution names unless approved.
- Homepage order: hero slider („Facem bine împreună.”) → Susține-ne (donate box, **Lunar default**) → stats → 4 projects → committee → partners.
- Menu: Despre · Echipa · Proiecte · Devino membru · Contact + gold „Donează”. /implica-te/ → 301 /doneaza/.
- Donations: one-off 50/100/250/500 + custom (min 10); monthly 30/50/100/250. No „what your money buys” equivalents. Links: `rotary/site-content/stripe-links.json`.
- ⚠️ `doneaza.py` still contains the meeting-place sentence for /multumim/ — remove it before regenerating that page.

## Stripe
- Account `acct_1UKfg7QZeDLt2UqF` (non-profit RO, owner email rotaryoperacluj@gmail.com, legal rep Cristian Zaharia). Payment Links only; no API key needed for the site.
- **Never ask for or use a full `sk_live` key.** For automation use a **restricted, read-only** key, kept outside the repo.
- Nonprofit pricing: pending (see `notes/reminders.md`). Standard RO rate 1.5% + 1 RON (EEA standard cards). Nonprofit rate only applies to tax-deductible donations (>80% of volume); tickets/merch don't count.

## Guardrails
- The site is **production** — state what you'll change before writes that are hard to undo (deleting content/media, `.htaccess`, `wp-config.php`, DB, users/roles) and get Adrian's OK. Small content/CSS tweaks he asked for: just do them and verify.
- Don't implement while Adrian is only asking/discussing.
- Pending/open items live in `rotary/site.md` (TODOs) and `rotary/sedinta-agenda.md` (asks for colleagues). Update them when something changes.
- Cleanup still to do at the end: revoke cPanel token + SSH key, delete local secret files (`~/.rotary_*`), move creds to a shared password manager.
