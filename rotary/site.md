# Site Rotary Opera — Preluare & Refacere

**Început:** 16 Sep 2026
**Status:** ⏳ În pregătire

---

## Scop

Preluarea site-ului clubului și refacerea lui pe o platformă nouă.

## 🔍 Situația actuală (verificat 16 Sep 2026)

**Site vechi:** http://rotaryoperacluj.ro/ — **nu se încarcă**

| Verificare | Rezultat |
|---|---|
| Domeniu în registrul .RO | **ACTIV** ✅ — înregistrat 22 mai 2018, status OK |
| Registrar | ICI - Registrar (ROTLD) |
| Nameservere delegate | `dns1.host-vision.com`, `dns2.host-vision.com` |
| Interogare directă NS | **REFUSED** → zona DNS nu mai există la Host-Vision |
| Rezolvare publică (8.8.8.8) | **SERVFAIL** |

### Concluzie
**Domeniul NU e expirat. Hostingul de la Host-Vision e expirat/anulat** — au șters zona DNS, dar delegarea din registru încă arată spre ei. Foarte probabil și fișierele + baza de date au fost șterse.

### Hostingul: Host-Vision → CyberFolks

`host-vision.com` și `hostvision.ro` redirecționează 301 către **cyberfolks.ro** — brandul a fost preluat de grupul cyber_Folks.

**Discuție cu suportul CyberFolks (Paul N), 17 Sep 2026:**
- Contul de client **există** ✅
- Pachetul de găzduire **nu a fost prelungit, a expirat și a fost ȘTERS de pe server la finalul lunii august 2026**
- Restaurarea din backup e posibilă, dar solicitarea trebuie făcută din contul de client
- Adresa autorizată era `contact@rotaryoperacluj.ro` (nefuncțională odată cu expirarea serviciilor)
- GDPR — nu pot dezvălui cine e titularul contului

### ✅ Progres (17 Sep 2026)
- [x] **Găsită parola** de la contul CyberFolks — acces recăpătat
- [x] **Schimbată adresa autorizată** → `rotaryoperacluj@gmail.com`
- [x] **Trimisă solicitarea de restaurare** a pachetului de găzduire
- [ ] ⏳ Aștept răspuns CyberFolks pe restaurare
- [ ] Verifică dacă e nevoie de reactivare/plată a pachetului ca să aibă unde restaura

### ✅ REZOLVAT — site-ul e funcțional (21 Sep 2026)

**Cronologie:**
1. CyberFolks a restaurat contul din backup (taxă 40 EUR + TVA + plata pachetului) — Lavinia Florian a gestionat plata
2. NS-uri schimbate la registrar → `rc01.octosquid.com` / `rc02.octosquid.com`
3. Site-ul răspundea **HTTP 500** pe toate rutele

**Cauza reală (diagnosticată prin cPanel API):**
```
PHP Parse error: syntax error, unexpected '?', expecting variable (T_VARIABLE)
in /home/rotaryop/public_html/wp-includes/compat-utf8.php on line 47
```
- Fișierul e **core WordPress 6.9** (legitim), folosește nullable type hints (`?int`, `?bool`) → necesită **PHP 7.1+**
- Serverul rula **`ea-php70`** (PHP 7.0)
- WordPress s-a auto-actualizat la 6.9 pe un PHP prea vechi → **probabil asta a omorât site-ul inițial**, nu expirarea

**Fix aplicat:** MultiPHP `ea-php70` → **`ea-php82`** (PHP 8.2), via cPanel UAPI.

**Rezultat:** `/`, `/wp-login.php`, `/robots.txt` → **200** ✅
Titlu: *Rotary Opera Cluj – Service above self* · WordPress 6.9.6 · WPBakery Page Builder

**Rămas cosmetic:** warning de la plugin-ul `facebook-pagelike-widget` (`implode(): Invalid arguments`) — nu blochează nimic.

**Acces tehnic:**
- cPanel: https://hv115.c-f.ro:2083 · user `rotaryop`
- SSH: **nu e expus** (doar 2083/2087 deschise) — de cerut la suport dacă e nevoie
- API token cPanel: `~/.rotary_cpanel_token` (local, de revocat când nu mai e nevoie)

### ✅ Domeniul — securizat (21 Sep 2026)

| | |
|---|---|
| Registrar | ROTLD — administrare online la rotld.ro |
| Cont / email autorizat | **`rotaryoperacluj@gmail.com`** ✅ (email controlat, nu unul mort) |
| Nameservere | `rc01.octosquid.com` / `rc02.octosquid.com` — propagate ✅ |
| **Expiră** | **2028** ✅ — fără presiune |

### 🔓 Workstream 1 (Credențiale) — ÎNCHIS

| Acces | Status |
|---|---|
| cPanel hosting | ✅ user `rotaryop` @ hv115.c-f.ro:2083 |
| Domeniu ROTLD | ✅ pe rotaryoperacluj@gmail.com |
| Site funcțional | ✅ HTTP 200 |

### Rămas de făcut (nu urgent)
- [ ] **Backup pe Drive** — descarcă ultimul backup Softaculous (`softaculous_backups/wp.26_90965.2026-09-24_*.tar.gz`, ~425 MB) pe Drive-ul clubului
- [x] **WP admin** (28 Sep 2026) — creat `adrian.taut` (ID 5, administrator, adriantaut@gmail.com); parola în `~/.rotary_wp_admin`. Useri existenți: ID 1 `YvYNAlHqPv` (Vasile, nan.vasile@yahoo.com), ID 2 `sonia.luca`, ID 4 `iulia.magdas`
- [ ] WP Toolkit „Log in”/WP-CLI crapă: pluginul `themesflat` cheamă `themesflat_map_icons()` din tema `finance` (WP-CLI rulează fără temă). Site-ul live nu e afectat
- [x] **Cotă disc** (28 Sep 2026) — 5 GB, era plină de backup-uri Softaculous automate (~425 MB fiecare). Șterse cele vechi, păstrate 22/23/24 Sep → 2.2 GB folosiți. ⚠️ Backup-urile automate umplu din nou cota — limitează retenția în Softaculous
- [ ] Credențialele la **minim 2 persoane** din club (password manager / doc în Drive-ul organizației)
- [ ] Revocă API tokenul cPanel + șterge `~/.rotary_cpanel_token` când nu mai e nevoie

> Situația a apărut pentru că accesul era legat de un email care a murit odată cu serviciul. Acum e pe un Gmail al clubului — bucla e ruptă.

---

## Workstream-uri

### 1. 🔑 Credențiale (blocant — primul pas)
- [ ] Vorbește cu **Vasile** și **Iulia**
- De obținut:
  - [ ] Acces hosting / cPanel
  - [ ] Acces FTP / SSH
  - [ ] Admin CMS (WordPress?)
  - [ ] **Domeniu** — registrar + contul pe care e înregistrat
  - [ ] DNS (Cloudflare?)
  - [ ] Email-uri asociate domeniului
  - [ ] Google Analytics / Search Console (dacă există)

### 2. 🔄 Platformă — de schimbat
- [ ] Inventar ce e acum (CMS, versiune, plugin-uri)
- [ ] Decide platforma nouă
- [ ] Plan de migrare conținut
- [ ] Redirect-uri 301 pentru URL-urile vechi (SEO)

### 3. 🎨 Design
- [ ] Brand Rotary — respectă ghidul de identitate vizuală Rotary International
- [ ] Structura paginilor / sitemap
- [ ] Mobile-first

### 4. 📸 Poze membri
- [ ] Inventar membri + poze existente
- [ ] Sesiune foto pentru cei fără poză?
- [ ] Format/dimensiuni consistente
- [ ] Acord GDPR pentru publicare

### 5. 🛒 Magazin online
- [ ] Ce se vinde? (merch club, bilete evenimente)
- [ ] Platformă/plugin (WooCommerce, Shopify, altceva)
- [ ] Aspecte fiscale — activitate economică ONG, plafon, TVA?

### 6. 💳 Stripe / Donații
- [ ] Cont **Stripe** pe entitatea juridică a clubului (nu personal)
- [ ] Documente pentru onboarding Stripe: CUI ONG, statut, act constitutiv, IBAN club, ID reprezentant legal
- [ ] Flux donații pe site (one-off + recurent lunar?)
- [ ] Sume predefinite + sumă liberă
- [ ] Pagină de mulțumire + email de confirmare automat
- [ ] Integrare cu redirecționarea 3,5% (vezi `rotary/redirectioneaza.md`)
- [ ] Evidență donatori — export pentru trezorierul clubului
- [ ] Comisioane Stripe (~1,5% + 1 RON pt carduri EU) — cine le suportă, se afișează?
- [ ] GDPR — stocarea datelor donatorilor

**De clarificat fiscal:** regimul donațiilor primite de ONG (neimpozabile) vs. vânzări din magazin (activitate economică).

---

## Întrebări deschise

- Cine decide final pe design/platformă — tu, board-ul clubului?
- Buget disponibil?
- Deadline / eveniment țintă?
- Cine mai lucrează la asta în afară de tine?


---

## 🧭 Decizie platformă (28 Sep 2026): **WordPress, refăcut curat**

- Motiv: club de voluntari cu echipă care se schimbă anual → oricine/orice freelancer îl poate prelua.
- Instalare **nouă** (nu upgrade la cea hack-uită — spam SEO în DB, vezi `site-inventory.md`); importăm doar conținutul curat.
- Twenty Twenty-Five + Site Editor (fără cod), Gutenberg, fără WPBakery/Slider Revolution. Max 5-6 pluginuri, auto-update, backup pe Drive.
- Rămânem pe **CyberFolks** (plătit 1 an). Email: `contact@rotaryoperacluj.ro` (260 MB) → forward la dominicgidro@gmail.com.
- Plăți: Stripe (vezi `plati-donatii.md`), de verificat RUB la ANAF.

### Staging (28 Sep 2026)
- **https://nou.rotaryoperacluj.ro** — WP curat, PHP 8.3, DB `rotaryop_nou` (prefix `rop_`), noindex, SSL wildcard LE
- Admin `adrian.taut` (email rotaryoperacluj@gmail.com); parola `~/.rotary_nou_admin`, app password `~/.rotary_nou_app`, DB `~/.rotary_nou_db`
- **Fără repo/GitHub** — totul configurat din WordPress (Site Editor + Secure Custom Fields), ca oricine să-l poată prelua. Backup design: export periodic cu Create Block Theme
- Email: `contact@` → forward la dominicgidro@gmail.com **și** rotaryoperacluj@gmail.com

### 🔒 Site vechi oprit (28 Sep 2026)
- `public_html/.htaccess` are blocul `rop-maintenance` → toate URL-urile dau **503** + `Retry-After: 172800` cu pagina `maintenance.html` (email + link 3,5%). WordPress-ul vechi e intact dar inaccesibil.
- Restaurare: șterge blocul din `.htaccess` (copie originală: `.htaccess.bak-rop`).
- Email neafectat. Țintă: site nou live în 1-2 zile.

### 🏗️ Site nou — v1 pe staging (28 Sep 2026)
- Conținut: 12 proiecte (cu poze, impact, galerii), 33 membri (25 cu poză), comitet 2026-27, istoric comitete 2018-2026, pagini Acasă/Despre/Echipa/Implică-te/Contact
- Structură: CPT `proiect`/`membru`/`eveniment` (SCF), taxonomie `categorie-proiect`; mu-plugin `wp-content/mu-plugins/rop-blocks.php` (shortcode-uri impact/galerie/parteneri/echipă + CSS)
- Design: global styles (Royal Blue/Gold, Literata + Manrope), header sticky + buton Donează, bară Donează pe mobil, view transitions
- Conținut sursă curat: `rotary/site-content/proiecte.json`
- **De primit înainte de lansare:** logo oficial club · IBAN asociație · locația întâlnirilor · validare listă membri (my.rotary.org) · proiecte 2025-26 (EDUCATIO, Promenada Inimilor…) · link-uri Facebook/Instagram · decizie Stripe (RUB check)
