# Rotary Opera Cluj — Site Inventory (28 Sep 2026)

Snapshot of https://rotaryoperacluj.ro/ before the rebuild. Raw export lives in `rotary/site-export/`:
`pages.json`, `posts.json`, `media.json`, `menu-main.json`, `scraped.json` (projects + timeline), `content-pages.md` (readable text), `media/` (276 files + NextGEN galleries, ~175 MB, gitignored).

---

## 🚨 Security findings

| Finding | Severity | Notes |
|---|---|---|
| **SEO spam injected in 6 pages** (pharmacy/Viagra links, CZ/ES/IT/FR) | 🔴 High | Hidden `<div id="mjazndaxmtezna">` positioned off-screen via injected JS/CSS. Pages: Despre noi, Membri activi, Evenimente, Contact, Galerie, Termeni. Google sees it → hurts domain reputation |
| Outdated plugins with known exploits | 🔴 High | Slider Revolution 5.4.8.3, WPBakery 6.0.4, NextGEN 3.59, "One Click Demo Import" still active |
| "Under Construction" plugin active | 🟡 | Not enabled, but unnecessary |
| Admin email = nan.vasile@yahoo.com | 🟡 | Settings → General — change to club Gmail |
| No backdoor files found | ✅ | Scanned `uploads/`, `gallery/`, web root `.php` files; `.htaccess` clean. Plugin/theme dirs NOT audited |

> Conclusion: don't migrate the WordPress install — rebuild clean and copy only content.

---

## Structure (live menu)

```
Acasa (blog feed of posts)
Despre noi
  ├─ Membri activi
  ├─ Fosti presedinti
  └─ Comitet
Evenimente  (= /portfolio/proiectele-noastre/)
Doneaza
Contact
```

- **109 pages**, of which **~11 real**; the other ~98 are demo pages from themes MediCenter/Finance ("Our Doctors", "Pricing Plans", "Home Style 5"…) — all public and indexable.
- **7 posts** (blog), **11 projects** ("portfolios" custom type), **10 timeline entries** (Cool Timeline).
- **279 media** (mostly 2017 demo images + 2019 real), **+20 photos** in NextGEN galleries.

---

## Real content

### Despre noi
- Founded by ex-Rotaract friends → 7th Rotary club in Cluj-Napoca.
- First 12 members met **20 Nov 2017**; official RI registration **Apr 2018**; Charter ceremony **9 Sep 2018** (Governor Cristian Jurj, PDGs Martha Maria Mocanu & Emil Sopoian). Founding president **Cristian Avram**.
- Focus: **cultural education** + community projects.
- ⚠️ Text from 2021, no diacritics — rewrite.

### Projects (portfolios)
| Project | Year | Category | Notes |
|---|---|---|---|
| Duelul Viorilor (Prunaru & Croitoru, Stradivarius vs Guarneri) | Apr 2019 | Artă | Fundraiser for ambulance, with Opera Națională |
| Menajeria de Sticlă (T. Williams) | Jun 2019 | Artă | Fundraiser for ambulance |
| Sogno | Nov 2019 | Artă | |
| Declarație (Țușca Vilmoș) | Nov 2019 | Artă | |
| Concert'n 4-1+2 (Ada Milea) | Dec 2019 | Artă | |
| **Ambulanță A1 — Centrul de Îngrijiri Paliative „Sf. Nectarie"** | May 2020 | Sănătate | Flagship: funds raised via shows, handed over 28 May 2020. 16-photo gallery |
| Bal Mascat | ? | Divertisment | Thin content |
| Battle Cidru vs Bere | ? | Divertisment | Thin content |
| Rota Quiz | ? | Divertisment | Thin content |
| SkirtBike (parade, women's rights + cycling) | May 2023 | Social/Sport | |
| ToyJoy (ed. 2 — personalised bags w/ children's drawings, by Ovidiu Pop) | Nov 2024 | Social | ≥300 lei/bag donation |
| Construim Bucurie (Christmas collection w/ U Cluj, Leroy Merlin, 18Gym…) | Dec 2024 | Comunitate | Partners list = sponsor wall material |

**Missing (known from notes):** EDUCATIO (mini-conferences), Promenada Inimilor, 2025–2026 projects. → need input.

### Members / Board
- **Membri activi** (Feb 2025): 31 names, no photos/roles → outdated.
- **Comitet**: boards 2018-19 → 2024-25 (full history, good for "Istoric").
- **Foști președinți**: Avram (18-19), Gidro (19-20), Niță (20-21), Miron (21-22), Dehelean (22-23), Postescu (23-24) → missing Florian (24-25), Zaharia (25-26?).

**Board 2026–2027** (from my.rotary.org, 28 Sep 2026 — emails private, don't publish):
| Role | Name |
|---|---|
| President | Ovidiu Alexandru Pop |
| Vice President | Lavinia Teodora Florian |
| Secretary | Paula Cristina Seer |
| Treasurer | Sebastian Dan Andro |
| Foundation Chair | Darius Răzvan Popîrțac |
| Public Image Chair | Emilia Maria Haiduc |
| Service Projects Chair | Radu Serfezeu |
| Young Leaders Contact | Cristian Zaharia |

**Board 2025–2026:** Președinte Cristian Zaharia · Past President Lavinia Florian · Vicepreședinte Cătălin Niță · Secretar Lavinia Berinde · Trezorier Sebastian Andro · Sergeant at Arms Darius Popîrțac · PR Chair Alexandra Pintea · Membership Chair Iulia Sandu · Foundation Chair Cosmina Postescu · Service Projects Chair Paula Șeer (funcție creată la o lună după începutul mandatului) · Președinte ales 2026–27 Ovidiu Pop

**Foști președinți (complet):** 2018–19 Cristian Avram (fondator) · 2019–20 Dominic Gidro · 2020–21 Cătălin Niță · 2021–22 Radu Miron · 2022–23 Florin Dehelean · 2023–24 Cosmina Postescu · 2024–25 Lavinia Florian · 2025–26 Cristian Zaharia · **2026–27 Ovidiu Pop (în funcție)**

→ Need: current member list (my.rotary.org), photos, short bios.

### Doneaza
- Only **3.5% redirection** via https://redirectioneaza.ro/rotary-club-cluj-napoca-opera/ — no card/IBAN option. See `rotary/plati-donatii.md`.

### Contact / legal
- **ASOCIAȚIA ROTARY CLUB CLUJ-NAPOCA OPERA**, CUI **39347197**, str. Becaș nr. 11, ap. 3, Cluj-Napoca (verify still current).
- Email: contact@rotaryoperacluj.ro (does the mailbox still work?). Meetings: Wednesday 18:30.
- GDPR policy (Nov 2019) — reusable after update; cookie consent via CookieYes.
- Mailchimp form (MC4WP) — is there an active Mailchimp list?

---

## What needs updating (content)

1. Despre noi — rewrite, diacritics, mission 2026, meeting place/time
2. Membri — current list + photos + role
3. Comitet — add 2025-26, 2026-27
4. Foști președinți — add 2024-25, 2025-26
5. Proiecte — add 2025-26 projects; enrich thin ones (Bal Mascat, Rota Quiz, Cidru vs Bere) or archive
6. Donează — card (Stripe), IBAN, 3.5%, sponsorship for companies
7. Contact — address, email, map, form, socials
8. Delete all ~98 demo pages + spam
