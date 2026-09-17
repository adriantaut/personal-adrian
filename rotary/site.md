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

### 🚨 Urgent de aflat
- [ ] **Când expiră domeniul?** (WHOIS public .ro nu arată data — doar contul de la registrar)
- [ ] **Pe ce email/cont e înregistrat domeniul la ICI/ROTLD?** ← activul cel mai valoros
- [ ] Contul Host-Vision mai există? **Există backup al site-ului vechi?**

> Dacă se pierde accesul la contul de registrar, se pierde domeniul la următoarea reînnoire — și îl poate cumpăra oricine.

### Vestea bună
Oricum se reface site-ul pe altă platformă → pierderea hostingului vechi nu e critică. Trebuie doar: recuperat accesul la domeniu, schimbate nameserverele, eventual recuperat conținutul vechi din Wayback Machine.

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
