# Zile de naștere membri — notificări automate

**Status:** 16 Oct 2026 — taburi noi create în sheet (Membri, Calendar aniversări, Setări, Jurnal); script în `rotary/zile-nastere/Cod.gs` ⏳ de lipit în Apps Script de pe contul contact@rotaryoperacluj.ro (proprietarul sheet-ului). Destinatar inițial: adriantaut@gmail.com.
**Sheet:** https://docs.google.com/spreadsheets/d/1GysGbRVsqWc6I2yAXWxs9D9nA4LLkgtpFGMgQ2QnCX4 (taburi azi: `Email`, `Zile nastere alfabetic` — 58 rânduri, zi ca text „23 mai ”, an —, `Zile nastere/luni` — manual)

## Decizii Adrian (16 Oct 2026)
- Cele 3 taburi existente (`Email`, `Zile nastere alfabetic`, `Zile nastere/luni`) **rămân neatinse**; se adaugă taburi noi alături; Adrian le scoate pe cele vechi ulterior
- Scriptul rulează și trimite emailul la **09:00**

## Structură propusă
1. **`Membri`** (singurul editat manual, tab NOU): Nume și prenume · Zi (dropdown 1–31) · Lună (dropdown) · An (opțional) · Email · Email 2 · Activ (☑). Populat inițial din `Email` + `Zile nastere alfabetic`.
2. **`Calendar aniversări`** (calculat, read-only): o formulă SORT/FILTER pe lună+zi, numele lunii pe primul rând al grupului, coloană „Peste X zile”, evidențiere următoarele 7 zile, opțional „Următoarele 30 de zile”.
3. **`Setări`** (citit de script): Distribution List (1–3+ emailuri, câte unul pe rând) · Notifică: azi / cu o zi înainte / ambele · Rezumat săptămânal luni: Da/Nu · Notificări active: Da/Nu · Subiect („🎂 Azi e ziua lui {nume}”).
4. **`Jurnal`** (scris de script): data, despre cine, destinatari — anti-dublură + dovadă.

## Script (Google Apps Script, gratis, limită 100 emailuri/zi)
- Trigger zilnic 09:00 (Europe/Bucharest) → citește Setări + Membri (doar activi) → 1 email către Distribution List (mai mulți în aceeași zi = un singur email) → scrie în Jurnal.
- Opțional luni: „Aniversările săptămânii”. 29 feb → 28 feb în anii nebisecți.

## De decis cu echipa
1. Unim `Email` în `Membri`? (recomandat: da)
2. Vârsta în email? (recomandat: nu; anul poate fi chiar scos)
3. Destinatari: doar PR sau și board-ul?
4. Proprietar sheet + script: **rotaryoperacluj@gmail.com**
5. GDPR: sheet partajat doar cu cine are nevoie (PR, secretar)

## Implementat (16 Oct 2026)
- `Membri`: 53 persoane (35 Activ, 1 Invitat — Balica Roxana, 17 Fost), dropdown Zi/Lună/Status, checkbox Notifică (Fost = nebifat)
- `Calendar aniversări`: o formulă ARRAYFORMULA(LET…) — exclude Fost; galben = azi, ivory = următoarele 7 zile; protejat (avertizare)
- `Setări`: Notificări active Da · În ziua respectivă · Rezumat luni Nu · Destinatar 1 = adriantaut@gmail.com
- De verificat: Horvat Daniel are ca Email 2 laviniateodoraflorian@gmail.com (pare greșit); Nicula Anca — fără dată/email
