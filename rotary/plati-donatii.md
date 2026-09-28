# Online donations & shop payments: Rotary Club Cluj-Napoca Opera

Research date: 2026-09-28. For: the rebuilt rotaryoperacluj.ro (static site or WordPress).

## 0. Club facts (from the ANAF public API, 2026-09-28)

| Field | Value |
|---|---|
| Legal name | ASOCIATIA ROTARY CLUB CLUJ - NAPOCA OPERA |
| CIF | **39347197** (no "RO", **not VAT-registered**) |
| Registered | Încheiere civilă nr. 3796/CC/2018 din 05.04.2018; fiscal registration 15.05.2018 |
| Seat | Str. Constantin Dobrogeanu Gherea nr. 21, ap. 1, Cluj-Napoca |
| Status | Active (not inactive). Not in the e-Factura register |
| Revenue (totalfirme) | 2021: 85k, 2022: 29k, 2023: 113k, 2024: 138k RON. 2025 shows **0**, so check that the 2025 financial statements were filed (this matters for the RUB) |
| RUB (sponsorship registry) | ✅ **Înscris** (confirmat de Adrian, 28 Sep 2026) — CIF 39347197 |
| 3.5% page | Already on [redirectioneaza.ro/rotary-club-cluj-napoca-opera](https://redirectioneaza.ro/rotary-club-cluj-napoca-opera/) (see `redirectioneaza.md`) |

Sources: ANAF `PlatitorTvaRest/v9` API; [totalfirme.ro](https://www.totalfirme.ro/asociatia-rotary-club-cluj-napoca-opera-39347197).

---

## 1. Stripe for a Romanian asociație

| Topic | Finding |
|---|---|
| Eligibility | Yes. Romanian non-profits can open a Stripe account ([Stripe SSA Romania](https://stripe.com/legal/ssa/ro)). Business type: **Non-profit organisation**. Another Romanian club, Rotary Club București Nord, already takes donations through Stripe ([rotarynord.ro T&C](https://www.rotarynord.ro/termeni-si-conditii/)) |
| KYC | Legal representative (the president): ID, date of birth, home address, phone. Entity: CIF and registration document (încheiere / certificat de înscriere in the Registrul asociațiilor și fundațiilor), statut / act constitutiv if Stripe asks, and an IBAN **in the club's name**. Non-profits **do not have to declare 25% beneficial owners** ([Stripe](https://support.stripe.com/questions/beneficial-ownership-requirements-for-nonprofit-organizations), [docs for non-profits](https://support.stripe.com/questions/documents-for-business-verification-of-unincorporated-entities-partnerships-or-non-profits)) |
| Card fees (RO account) | Standard EEA cards **1.5% + 1 RON**. Premium EEA cards 2.8% + 1 RON. UK cards 2.5% + 1 RON. International cards 3.15% + 1 RON. +2% if a currency conversion is needed ([stripe.com/ro/pricing](https://stripe.com/ro/pricing)) |
| Recurring (Billing) | Pay-as-you-go **+0.7%** of subscription volume (on top of the card fee) |
| Payment Links / Checkout | No extra fee. Hosted page with **Apple Pay / Google Pay** included |
| Other fees | Standard payouts are free. Dispute fee 100 RON. Invoicing 0.4% per paid invoice |
| Payouts in RON | Yes. RON is a supported settlement currency and payouts go to a RON IBAN ([Stripe docs](https://docs.stripe.com/payouts/multicurrency-settlement)) |
| Nonprofit discount | **Romania is on the eligible list.** Conditions: you are a registered non-profit with tax documents, and **80% or more of Stripe volume comes from tax-deductible donations**. Tickets, memberships and merch **count against** that 80%. The EU rate is not published. Apply through Stripe support / nonprofit@stripe.com, giving your account ID ([Stripe](https://support.stripe.com/questions/fee-discount-for-nonprofit-organizations), [checkoutpage](https://checkoutpage.com/blog/stripe-for-nonprofits)) |
| Donation rules | A donation must be tied to a **specific charitable purpose**, and the money must be used as described. There are no extra EEA restrictions (the country bans are for AU, HK, IN, JP, SG, TH) ([Stripe](https://support.stripe.com/questions/requirements-for-accepting-tips-or-donations), [restricted list](https://stripe.com/legal/restricted-businesses)) |
| Receipts | Stripe sends automatic email receipts (turn on in Settings > Emails, with the club's name and CIF). These are **not fiscal invoices** |

**Gotchas**
- A Payment Link with **"customer chooses what to pay"** does **not** support recurring payments. For monthly giving, create fixed tiers (e.g. 50 / 100 / 250 RON/month), one Payment Link per tier ([Stripe docs](https://docs.stripe.com/payment-links/create)).
- Turn on the **customer portal** so donors can cancel recurring donations themselves. This helps with GDPR and reduces chargebacks.
- Stripe checks the website at onboarding. It needs visible legal name, CIF, address, contact, Terms & Conditions, refund policy and privacy policy.
- Open the account **in the club's name, run by the president**, never on a member's personal account. Give the treasurer access too. Stripe supports team roles.

---

## 2. Alternatives

| Option | Fees | Recurring | Setup effort | Notes |
|---|---|---|---|---|
| **Stripe** (Payment Links) | 1.5% + 1 RON (EEA). +0.7% recurring | Yes (fixed tiers) | Low: online, 1-3 days | Best no-code fit for a static site |
| **Netopia Payments** | ~**0.99% + 0.30 RON**, no setup or monthly fee. A monthly plan gives 0.65-0.8% ([wall-street.ro](https://www.wall-street.ro/articol/eCommerce/192226/netopia-mobilpay-reduce-comisionul-la-plata-cu-cardul-pentru-comercianti-la-sub-1.html), [noda.live](https://noda.live/ro/articles/recenzie-netopia-payments)) | Yes (tokenisation) | Medium: contract, site review, integration | Refuses NGOs **younger than 2 years**. The club (2018) passes ([Netopia](https://netopia-payments.com/netopia-payments-nu-mai-accepta-in-platforma-de-plati-ong-uri-mai-noi-de-2-ani-si-comercianti-noi-care-vand-produse-de-protectie-impotriva-covid-19/)). Cheapest per transaction. Needs a plugin or API |
| **EuPlătesc** | "From 1.2%", price quoted only after a meeting ([euplatesc.ro](https://www.euplatesc.ro/en/homepage/pricing/)) | Yes | Medium to high | Processes Bursa Binelui donations commission-free |
| **PayU Romania** | Negotiated | Yes | High | Built for e-commerce, too heavy for this use |
| **PayPal** | Standard commercial rates. Charity rate (1.99% + fixed) is **US-centric** ([Zeffy](https://www.zeffy.com/blog/paypal-donation-fees-for-nonprofits)) | Yes | Low | **PayPal does not support RON**, so there is FX loss. PayPal Giving Fund is not available in RO. Only worth it for diaspora donors |
| **Revolut Business** | 1% + €0.20 (EEA consumer cards) ([Revolut](https://www.revolut.com/en-RO/business/accept-payments-pricing/)) | Limited | n/a | Revolut says it **does not support charities / foundations** ([Revolut help](https://help.revolut.com/business/help/setting-up-an-account/is-my-business-eligible/what-types-of-business-entities-are-supported/)). Treat as not an option |
| **Donorbox** | **2.95% platform fee** + Stripe fees ([donorbox.org/pricing](https://donorbox.org/pricing)) | Yes (any amount) | Low | Nice forms, but it doubles the cost |
| **GiveWP** (WordPress) | Free plugin adds **+2% on Stripe** unless you buy a license (add-ons from $149/yr) ([GiveWP](https://givewp.com/documentation/resources/understanding-donation-transaction-fees-in-givewp/)) | Paid add-on | Medium | Only if the site is WordPress |
| **Bursa Binelui** (BCR) | **0%** for donors and NGOs. 5-1,000 RON per donation ([bursabinelui.ro](https://www.bursabinelui.ro/about)) | No | Low: NGO approval in about 48h | Good for **campaigns** (e.g. EDUCATIO), not for the site's main checkout |
| **Galantom** | **0%**, peer-to-peer fundraising ([galantom.ro](https://www.galantom.ro/despre/)) | No | Low | Good for runs/challenges where members fundraise for a cause |
| **Bank transfer (IBAN)** | ~0 | Donor sets up a standing order | None | Always show it. This is what companies use |
| **Formular 230 (3.5%)** | 0 | Yes (2-year option) | Already live on redirectioneaza.ro (free, Code for Romania) | **Requires the RUB**, see §3 |

### Formular 230 / 3.5% redirection
- Employees and other individuals can redirect up to **3.5% of their income tax** to an NGO. The deadline is **25 May** each year (25.05.2026 for 2025 income). Donors can tick a **2-year** option ([NN](https://www.nn.ro/blog/newsroom/redirectionarea-impozitului-pe-venit-totul-despre-formularul-230), [ANAF guide 2025](https://static.anaf.ro/static/10/Anaf/AsistentaContribuabili_r/Ghid_3_5_2025.pdf)).
- The NGO **must be in the RUB**. ANAF refuses payment to entities that are not registered ([ANAF D230 material](https://static.anaf.ro/static/10/Brasov/Brasov/Material_D230_D212.pdf)). The form needs the club's CIF and IBAN.
- Ways to file: the donor files it through SPV or e-guvernare, or the **NGO collects signed forms and files them electronically with a borderou**. Redirectioneaza.ro does this automatically.
- On the website: a "Redirecționează 3,5%" button linking to redirectioneaza.ro, plus a PDF 230 form pre-filled with the CIF and IBAN.

---

## 3. Romanian legal and fiscal points (confirm with the club's accountant)

| Question | Answer |
|---|---|
| Is a contract needed for small donations? | **No.** Cash or bank donations are a "dar manual", valid up to **25,000 RON** without a notarial deed (Cod civil art. 1011). Above that, or for property, you need an authentic deed ([lege5](https://lege5.ro/Gratuit/gi2tsmbqhe/art-1011-forma-donatiei-codul-civil?dp=gu3dmnjqgy3tc)). For accounting, the bank or Stripe statement plus a donor list is enough. Cash needs a **chitanță** |
| Tax on donations | Donations, sponsorships and membership dues (cotizații) are **non-taxable income** for an asociație (Cod fiscal art. 15). Individuals get **no personal tax deduction** for donations. Their only tax lever is the 3.5% |
| Shop and tickets = economic activity? | **Yes.** Merch and paid event tickets count as economic activity. They are **exempt from profit tax up to the lower of €15,000 per year and 10% of non-taxable income**. Profit above that is taxed at **16%** (Cod fiscal art. 15(3)) ([lege5](https://lege5.ro/Gratuit/gq3tinrq/art-15-scutiri-codul-fiscal?dp=gi2demjqheztc), [capital.ro](https://www.capital.ro/impozite-pentru-asociax163ii-x15fi-fundax163ii-105471.html)). The statut must allow economic activities (OG 26/2000 art. 47) |
| VAT | Not VAT-registered. The registration threshold is **395,000 RON** in economic turnover (since 09.2025), so no VAT is needed at this scale |
| Cash register / invoices | Online card payments for e-commerce are generally outside the AMEF (cash register) obligation. **Cash sales at the door do need an AMEF or tipizate tickets** (OUG 28/1999). Ask the accountant whether B2C sales need an invoice or e-Factura ([SmartBill](https://blog.smartbill.ro/casa-de-marcat-pos-obligatii-2025/)) |
| Nonprofit discount interplay | If merch and tickets go above 20% of Stripe volume, the club loses Stripe's nonprofit discount. You could keep a separate Stripe account for the shop |

### Company sponsorship (the "Sponsor us" path)
- **Legea 32/1994** requires a **written sponsorship contract** stating the purpose, amount, duration, and the rights and obligations of both sides. Sponsors cannot be related parties ([FRMR guide](https://www.frmr.ro/ghid-fiscal-si-contabil/)).
- The **fiscal credit** for profit-tax payers: the sponsorship reduces profit tax by up to the **lower of 0.75% of turnover and 20% of profit tax**. Unused amounts carry forward 7 years. The rule is unchanged in 2026 ([Contopia 2026](https://contopia.ro/material/view/sponsorizarea-in-2026-reguli-fiscale-pentru-firme), [zandomeni 2026](https://zandomeni.eu/blog/regimul-fiscal-sponsorizarilor-2026-credit-fiscal-conformitate)).
- **Microenterprises cannot deduct sponsorships since 01.01.2024.** Most small Cluj SRLs are micros, so the pitch to them is goodwill, not a tax benefit.
- **Formular 177**: a company can redirect up to 20% of its profit tax **through ANAF**, with no cash outflow, until **25 June** (the D101 deadline) ([contzilla](https://www.contzilla.ro/redirectionare-impozit-pe-profit-formular-177/), [HotNews](https://hotnews.ro/25-iunie-termenul-limita-pentru-firmele-platitoare-de-impozit-pe-profit-sa-doneze-catre-ong-uri-prin-formularul-177-917427)).
- **The RUB is required for all of this.** ANAF checks it **on the date the contract is signed**, and for D177 also when the funds are transferred. Without the RUB, sponsors lose the tax credit, so the "Sponsor us" path is largely pointless ([portalcodulfiscal](https://www.portalcodulfiscal.ro/tratamentul-fiscal-al-sponsorizarii-acordate-unei-entitati-neinscrise-in-registrul-entitatilor-unitatilor-de-cult-76527.htm)).

### RUB: how to get or stay in it
- Conditions: active in its statutory field; all tax declarations filed; **no tax debts older than 90 days**; **annual financial statements filed**; not declared inactive.
- File **Formular 163** online (e-guvernare.ro) together with a **certificat de atestare fiscală** from the local tax office (DITL Cluj). ANAF decides in **10 days** ([CECCAR](https://www.ceccarbusinessmagazine.ro/anaf-inscrierea-in-registrul-entitatilor-unitatilor-de-cult-pentru-care-se-acorda-deduceri-fiscale-a4684/)).
- An entity that misses a filing is removed, so put the annual financial statements deadline in the calendar.

---

## 4. Recommendation

### Stack
| Need | Solution | Why |
|---|---|---|
| One-off card donations | **Stripe Payment Link**, "customer chooses amount" in RON (suggested 50 / 100 / 250, minimum 10), plus a custom field for the donation purpose | No code, works on a static site, Apple/Google Pay |
| Monthly donations | **3-4 Stripe Payment Links with fixed subscription tiers** + customer portal | Stripe can't do variable recurring amounts without code |
| Tickets and merch | Stripe Payment Links per product/event (adjustable quantity, custom field for name / T-shirt size) | Same account, same dashboard. Move to WooCommerce only if the catalog grows |
| Bank transfer | IBAN + "Donație – [cauza]" on the Donate page | Zero fees. Used by companies and large donors |
| 3.5% | Existing **redirectioneaza.ro** page + pre-filled PDF | Free and already set up |
| Companies | "Sponsor us" page: contract template (DOCX), RUB proof link, D177 explainer, contact form | Only works once the club is in the RUB |
| Campaigns (optional) | Bursa Binelui / Galantom | 0% fees, extra visibility |
| Cheaper later? | Netopia (0.99% + 0.30 RON) if card volume reaches roughly 50k RON per year or more | Saves ~1 RON per donation, but needs an integration |

Cost example for a 100 RON donation: Stripe EEA card **2.50 RON**, monthly Stripe **3.20 RON**, Netopia ~1.29 RON, Donorbox + Stripe ~5.5 RON, bank transfer ~0.

### Setup checklist
1. [ ] **Check the RUB status** for CIF 39347197 on ANAF. If the club is missing, the treasurer/accountant files F163 + certificat de atestare fiscală. Also confirm the 2025 financial statements were filed.
2. [ ] Board decision (hotărâre Consiliu Director): approve online collections, name who administers the Stripe account (the president as legal rep, the treasurer as admin), and approve the shop/tickets as an economic activity. Check that the statut allows it.
3. [ ] Collect the documents: încheiere civilă 3796/CC/2018 / certificat de înscriere, certificat de înregistrare fiscală, current statut, the decision naming the current president, the **president's ID + proof of address**, and a bank statement or letter with the club's **RON IBAN**.
4. [ ] Website legal pages: identification (name, CIF, seat, email/phone), Terms & Conditions, refund policy (donations are non-refundable except by mistake; tickets per event), GDPR/privacy policy (Stripe as processor), cookies.
5. [ ] Open the Stripe account (non-profit) with a club email address such as `plati@rotaryoperacluj.ro`, not a personal one. Turn on 2FA, add the treasurer, and add the RON payout IBAN.
6. [ ] Create in Stripe: a donation Payment Link (variable amount), 3-4 monthly subscription tiers, customer portal, email receipts with club branding and CIF, and a thank-you redirect page on the site.
7. [ ] Decide whether to apply for the nonprofit discount. Only apply if donations will stay above 80% of volume; otherwise keep a second Stripe account for the shop.
8. [ ] Build the site pages: **/doneaza** (card + monthly + IBAN + 3.5%), **/sponsorizare** (contract template + D177 guide + RUB proof), **/shop** or **/evenimente** (Payment Links).
9. [ ] Accounting flow: a monthly Stripe export (CSV) for the treasurer and CEDEXPERT-style accountant, **tagged donation vs. economic activity**, so the €15k / 10% ceiling can be tracked.
10. [ ] Sponsorship contract template (Legea 32/1994): parties, CIF, purpose ("sprijinirea proiectului EDUCATIO…"), amount, payment IBAN, duration, visibility obligations, and a clause confirming the RUB status on the signing date. Have the accountant review it.
11. [ ] Calendar reminders: **Feb-25 May** for the 230 campaign, **Apr-25 June** for the D177 pitch to companies, **December** for year-end CSR budgets, plus the annual financial statements deadline.

## Stripe — reprezentant (28 Sep 2026)
- Varianta B: contul creat de Adrian pe rotaryoperacluj@gmail.com; **reprezentant KYC = Cristian Zaharia** (președinte/director în actele asociației; Ovidiu Pop e președinte în anul rotarian 2026-27, dar nu e încă în acte).
- Dacă actele se actualizează cu Ovidiu → se schimbă reprezentantul în Stripe (Settings → Business → Persons).
