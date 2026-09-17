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

### 🚨 Rămâne urgent
- [ ] **Domeniul `rotaryoperacluj.ro` e în contul CyberFolks? Când expiră?** ← activul ireversibil
  - WHOIS arată registrar `ICI - Registrar` — de verificat dacă e gestionat prin CyberFolks sau direct la ROTLD
  - Dacă expiră curând → **reînnoiește imediat**
- [ ] După restaurare: **descarcă backup complet** (fișiere + bază de date) local + pe Drive-ul clubului
- [ ] Credențialele la **minim 2 persoane** din club (password manager / doc în Drive-ul organizației)

> Situația a apărut pentru că accesul era legat de un email care a murit odată cu serviciul. Bucla se repetă dacă nu e ruptă acum.

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
