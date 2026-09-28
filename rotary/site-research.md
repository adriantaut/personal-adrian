# Rotary Opera Cluj: competitive site research (2026-09-28)

Redesign research for https://rotaryoperacluj.ro/. Screenshots (desktop full-page + mobile first viewport):
`/private/tmp/claude-502/-Users-ataut-work-zar-personal-adrian/f23be1e6-ef8b-41a1-bc97-3eb71efb5800/scratchpad/research/`

---

## 1. Per-site notes

### Rotary Cetățuie Cluj (rotarycetatuie.org): best local benchmark
- **Stack:** WordPress + Divi + a custom "rotary" child theme. Fonts: Lora / Fraunces (serif headings), Nunito (body).
- **Menu:** Home · Despre noi · (Rotaract, Interact) · Membrii · Proiecte · Evenimente / Calendar · Implică-te · FAQ · Contact · RO/EN. A "Donează" link sits in the blue top bar, with phone, email and social icons.
- **Home order:** full-bleed photo hero with a blue overlay ("Nu doar vorbim despre schimbare. O construim.") and 2 CTAs (Sponsorizează un proiect / Vezi ce am făcut) → **impact stats** (18 years, €500k+, 3 Global Grants, 3000+ people helped) → 3 focus areas → International partnerships band (Global Grants with € amounts) → "Chiar acum, în desfășurare" (current project) → Other ways we help (icon cards) → partner logo wall + "Devino sponsor" → final CTA band (Sponsorizează / Devino membru) → dark footer.
- **Project detail page** (`/project/zambetepentrutoti/`) is the best template seen: hero card with the budget (€144,000), KPI tiles (12 beneficiaries, 0 € cost, 100% free), a pull quote, partner cards, a "who can apply" grid, a **timeline calendar**, 3 "how to apply" steps, an embedded donate widget, then a "Check other projects" carousel.
- **Projects list:** 3-column cards (image + title), paginated. No year or status filter.
- **Members:** one very long grid (~60 people): photo, name, member-since and a "ROLES" list (club president years, district roles). Complete, but the page is a wall of text. Mixed photo quality, and many people have no photo.
- **Implică-te:** split panel "Redirect 3.5% (230)" OR "Sponsor/Donate" → on-page **one-time donation widget** (200 lei preset + custom amount) → 6 partnership cards (volunteer, corporate, cause marketing...).
- **Great:** impact numbers, a narrative project page, one "Implică-te" hub, Donează always visible, partner wall.
- **Avoid:** lazy-loaded blocks render empty (big white gaps on home), the members page is too long, the page intro is mixed EN ("Meet our Amazing Team!") on a RO site, the footer logo sits blue on dark with low contrast.

### District 2241 (rotary2241.org)
- **Stack:** ClubRunner (hosted SaaS, Bootstrap 3 + jQuery). Font: Open Sans.
- **Menu:** Home · Despre (history, clubs, org chart) · Membership (why Rotary, admission, 4-Way Test, code of conduct) · Fundația (TRF, Polio, Paul Harris, Global Grant) · Calendar · Evenimente · Documente · RYE · Contact (Guvernator/Secretar/Trezorier). There is a "Member login" link.
- **Home:** a video embed (broken for us) → the governor's monthly letter as a wall of text → district projects as logo tiles. Right sidebar: RI president + governor, "Info District" links, events, program logos (RYLA, Rotaract, Interact, RYE).
- **Useful for us:** the **Club Directory**, official program names and logos (RYLA, Rotaract, Interact, YE), and the "monthly theme" idea (September = Basic Education & Literacy).
- **Avoid:** the whole look (portal/intranet style, sidebar clutter, text walls, a cookie modal over the content). This is a district admin site, not a public story site.

### Rotaract SAMVS Cluj (rotaractsamvs.ro): structure reference
- **Stack:** WordPress + Astra + Elementor + WooCommerce (cart icon). Font: Montserrat. Palette: Rotaract cranberry-pink on charcoal.
- **Menu (5 items, very clean):** Acasă · Echipa · Proiecte · Help us · Contact.
- **Home order:** project slider → Cine suntem (3 value icons) → Objectives over a photo → **Timeline of projects by year** (2015→2021) → Newsletter → Help us (bank + CUI teaser) → "What do we give sponsors back" → **Past presidents** strip.
- **Echipa:** **Board of the year** (round photo + role) → **Membri** (round photo + name) → **Președinți** (photo + mandate years). This is the clearest team IA of all the sites. Adrian is listed as a member.
- **Help us:** bank details (beneficiary / IBAN / CIF) + a legal deductibility note → **"Donează rapid" one-time vs recurring** preset buttons (50/100/200 · 30/50/100 RON) → fiscal-deduction cards (companies: download the guide; individuals: fill in Form 230 online or download it) → newsletter.
- **Avoid:** the timeline is stale (it stops in 2021), some project pages are broken (the Urban Hero URL shows another page), the slider hero, and heavy card shadows.

### Rotary Club București (rotarybucuresti.ro): best RO build quality
- **Stack:** Webflow (CMS collections). Fonts: Playfair Display (headings) + Roboto. Royal blue + gold used correctly.
- **Menu:** Acasă · Activități ▾ (Evenimente & Proiecte, plus each flagship project with a one-line description in a mega-dropdown) · Despre ▾ (history, yearbook PDF, twinned clubs, TRF, RI) · Membri ▾ (Comitet director, Membri activi, Membri de onoare, Foști președinți) · Donații · EN · **Contact button**.
- **Home order:** centered title + CTA → photo mosaic strip → latest activity cards (date + excerpt, 3×2) → **Yearbook** download → **Recurring flagship projects** (3 cards) → 7 Rotary Areas of Focus (icons) → About band → "Alătură-te eforturilor noastre" (Donate / Redirect 3.5%) → History video → a rich 5-column footer.
- **Recurring project page** ("Ajută un copil să meargă la școală"): an intro, then **one section per edition/year** (2012→2026: location, date, president, coordinator, photos), then News and an Archive. This is the right pattern for Opera's recurring events (SkirtBike, ToyJoy, Construim Bucurie, EDUCATIO).
- **Members:** a 3-column grid with a round photo, NAME in caps, a role line ("PHF · Past President 2020-21 · Sales Force Manager, Orange") and LinkedIn/Facebook icons. Profession plus Rotary honours makes a good, dense card.
- **Avoid:** very long single-page archives, and the EN link is still "coming soon".

### Rotary Club București Atheneum (rotaryatheneum.org)
- **Stack:** WordPress + Virtue Premium. A news-blog layout with a sidebar (Translate widget, currency rates, PayPal button).
- **Useful:** the menu is split into Membri activi / Comitet / Foști președinți / Cluburi înfrățite, and a Donează ▾ submenu (2% / 3.5% from tax, Sponsors).
- **Avoid:** almost everything visually. The header is a club logo next to a "CREATE LASTING IMPACT" banner, it is a blog with a sidebar, it has off-topic widgets, and meeting info (Wed 19:00) is buried in the footer.

### International: Rotary Club of Melbourne (rotaryclubofmelbourne.org.au)
- **Stack:** StreamScape (a Rotary SaaS). Font: Open Sans Light.
- **Menu:** About Us · Our Causes · Get Involved · Events · News & Media · Donations · Contact · Member Login. A gold **"monthly theme" banner** reads "September is Rotary's Education & Literacy Month".
- **Home:** hero slider → "In the spotlight" (3 cards, one of them *Become a member*) → **Upcoming events as cards with date/venue/speaker + "click to book"** → **Where we meet** (weekly lunch + special events, hybrid Zoom) → Partners → blue footer (address, newsletter, get involved).
- **Great:** meeting info is on the home page, and event cards carry booking details. **Avoid:** a dated thin-font look and small CTAs.

### International: Rotary Club of Seattle (seattlerotary.org)
- **Stack:** ClubRunner (same as the district).
- **Menu:** About (history, vision, leadership, committees) · Membership · Meeting Information · Service Foundation (donate, legacy giving, community projects, **apply for a local/international grant**) · News · Contact (**propose a speaker**).
- **Great ideas:** "Apply for a grant" and "Propose a speaker" as inbound funnels, a "New member introduction" feature, and a mini calendar of upcoming events.
- **Avoid:** ClubRunner's template look (tiny hero, sidebar, cookie modal, empty areas).

### Rotary International (rotary.org): the brand done right
- **Stack:** Next.js. Font: Open Sans. Palette: deep navy/royal blue, white, light azure buttons, gold accents.
- **Header:** logo · Who We Are · Our Work · Get Involved · News · **Donate** + **Join a Club** pill buttons. Utility bar: End Polio, My Rotary, language.
- **Home:** "We are People of Action" full-bleed photo hero → news cards → "Find your place in Rotary" (member testimonial quotes with round portraits) → Our causes (a list of focus areas) → Impact numbers → End Polio feature → a dense 4-column footer with Donate / Join repeated.
- **Take:** people-first photography, member testimonials, two persistent CTAs (Donate + Join), generous whitespace, flat design with no shadows.

### Current rotaryoperacluj.ro (baseline, before the redesign)
- **Stack:** WordPress 6.9.9 + the "finance" ThemeForest theme (Bootstrap 3) + WPBakery (js_composer). Font: Poppins. The site went down in Sept 2026 because hosting expired; see `site.md`.
- **Menu:** Despre noi ▾ (Membri activi, Foști președinți, Comitet) · Evenimente (= the projects portfolio) · Donează · Contact.
- **Problems found:**
  - The home page is a raw **blog feed** (long posts, a video embed) topped by a meaningless "Home" page title and breadcrumb.
  - A blocking **cookie modal** covers the content on every page, mobile included.
  - Template leftovers are visible: "Create a Menu", "footer_copyright", "Copyright 2019", and Google+ icons.
  - Members are a photo grid with no roles or professions and ~40% grey placeholder avatars.
  - Projects are labelled "Evenimente": a filterable portfolio (Artă / Comunitate / Divertisment...) with no years, impact or status. The newest item is from 2023.
  - The Donează page is 3 text steps for the 3.5% redirection plus a poster image. There is no online payment and no IBAN.
  - The **logo breaks Rotary brand rules**: a wavy "opera" graphic sits on top of the Masterbrand Signature, and the club name is tiny grey text.
  - The mobile header is ~50% of the first screen, and there is no meeting time/place anywhere.
- **Keep:** the club story (chartered 9 Sep 2018, 12 founders ex-Rotaract, a **cultural/arts** direction), the project archive (Duelul Viorilor, Sogno, Menajeria de Sticlă, Bal Mascat, SkirtBike, ToyJoy, ambulance for Sf. Nectarie palliative care), and the member photos that exist.

---

## 2. Comparison table

| Site | Stack | Menu items | Projects | Team | Donate / involve | Events | Visual grade |
|---|---|---|---|---|---|---|---|
| Cetățuie Cluj | WP + Divi custom | 10 + Donează | Cards + **rich detail page** (KPIs, timeline, donate) | Long grid + roles | **Implică-te hub**, on-page widget, 230, 6 partner types | List + calendar | A- |
| District 2241 | ClubRunner | 9 (deep dropdowns) | Logo tiles | Org chart | – | Sidebar list | D |
| Rotaract SAMVS | WP + Astra/Elementor | **5** | Slider + year timeline | **Board / Membri / Președinți** | **Help us: IBAN + one-time/recurring presets + 230** | – | B- |
| Rotary București | **Webflow** | 5 + Contact btn | **Recurring project = one section per edition** | Grid + profession + PHF + social | Donații + 3.5% | Activity feed | A- |
| RC Atheneum | WP Virtue | 8 (deep) | Blog posts | 3 sub-pages | 2% + PayPal | Blog | D |
| RC Melbourne | StreamScape | 8 | Spotlight cards | – | Get Involved + Donations | **Cards w/ booking**, "Where we meet" | C+ |
| RC Seattle | ClubRunner | 6 (deep) | Community projects | Leadership, committees | Donate, legacy, **grant applications** | Calendar widget | C- |
| rotary.org | Next.js | 4 + Donate/Join | Causes list | Testimonials | **Donate + Join pills** | News | A |
| **Opera (now)** | WP finance + WPBakery | 4 | Portfolio called "Evenimente" | Photos only | 3.5% text only | none | D- |

---

## 3. Rotary brand rules (brandcenter.rotary.org)

**Colours** (use pure, never tinted or screened):

| Role | Name | Hex |
|---|---|---|
| Primary | Royal Blue ("Rotary" wordmark) | `#17458F` |
| Primary | Gold (wheel / Mark of Excellence) | `#F7A81B` |
| Primary | Azure (one-colour logo) | `#0067C8` |
| Secondary accents | Sky Blue `#00A2E0` (Interact) · Cranberry `#D41367` (Rotaract) · Cardinal `#E02927` (End Polio) · Turquoise `#00ADBB` · Orange `#FF7600` · Violet `#901F93` · Grass `#009739` | |
| Neutrals | Powder Blue `#B9D9EB` · Taupe `#D9C89E` · Cloud `#D6D1CA` · Stone `#9BA4B4` · Slate `#657F99` · Charcoal `#54565A` · Silver `#D0CFCD` | |

**Typography**
- **Primary** (headlines, navigation): Frutiger (licensed), or **Open Sans** (free, the web default) or Arial. Main headlines/nav are ALL CAPS condensed in print.
- **Secondary** (body, captions, sub-heads): Sentinel (licensed), or **Georgia** (free).
- A web equivalent that stays on-brand: Open Sans (UI/headings) + a Sentinel-like slab/serif for editorial text.

**Logo / club lockup**
- Always use the **club logo**: Masterbrand Signature ("Rotary" + wheel) + the club name, aligned right under the "y". Generate it from the Brand Center template: font, colour, position and proportions are locked. Retire all older logos.
- Name form: "Rotary" + "Club Cluj-Napoca Opera" (don't repeat "Rotary").
- **Don't** add graphics, mottos, slogans or event themes to the logo, and don't make it part of a bigger design. The current Opera logo with the wave graphic **violates this** and has to be retired. A cultural/opera motif can live elsewhere on the page, away from the logo.
- Clear space = the height of the "R" in "Rotary". Don't crop or obscure it, and don't use only the wheel as the logo.
- The Mark of Excellence (wheel) can sit *near* the club logo but never on its own as the club logo. There is no simplified wheel.
- **Partner lockups:** club logo | vertical line | ONE partner. List other partners elsewhere (logo wall).
- Program/event logos (e.g. EDUCATIO, SkirtBike) follow the "logos for events and projects" template.
- **Website guidance:** club logo in the header and footer; photos of members *doing* service ("People of Action"); signed photo permissions; clear CTAs (donate, volunteer, join); **list when/where the club meets and who to contact**; a calendar; responsive design.

---

## 4. Recommended structure for rotaryoperacluj.ro

### 4.1 Sitemap / menu (RO primary, EN later)
```
Logo (official club lockup)
Proiecte ▾        → Toate proiectele · EDUCATIO · SkirtBike · ToyJoy · Construim Bucurie · Arhivă
Evenimente        → upcoming (cards) + past
Echipa ▾          → Board {an rotarian} · Membri · Foști președinți
Despre            → story, Rotary/District 2241, meetings (Wed 18:30), Rotaract/partner clubs
Implică-te        → hub: Donează · 3.5% (230) · Sponsorizează · Voluntariat · Devino membru
Contact
[Donează] (gold pill button, always visible, also sticky on mobile)
```
- Keep the top level to **6 items + the Donează button** (SAMVS/București clarity, not District depth).
- Footer: club logo · meeting time/place · contact · CUI / legal entity + IBAN · quick links · socials · District 2241 / Rotary International / End Polio links · privacy/cookies (a small bar, never a modal).

### 4.2 Homepage section order
1. **Hero**: full-bleed real photo of members in action (concert/event) with a short manifesto line and 2 CTAs: *Susține un proiect* (gold) / *Vezi proiectele* (outline).
2. **Impact numbers**: years since the 2018 charter, projects run, lei raised, people helped, members.
3. **Current project spotlight** ("Acum în desfășurare"): 1 large card with a progress bar toward the target and a Donate CTA (Cetățuie pattern + Stripe).
4. **Proiectele noastre**: 3-6 cards (image, category tag, year, 1-line impact) → *Toate proiectele*.
5. **Upcoming events**: 2-3 cards with date, venue, "Rezervă / Detalii" (Melbourne pattern).
6. **Echipa teaser**: the president's quote + portrait, a row of board portraits → *Cunoaște echipa*.
7. **Implică-te**: 4 tiles (Donează · 3.5% · Sponsorizează · Devino membru).
8. **Partners**: a logo wall + *Devino partener*.
9. **Where/when we meet** + newsletter signup.
10. Footer.

### 4.3 Project page template
- Hero: cover photo, title, category/area-of-focus tag, status (ongoing / recurring / completed), years.
- **KPI tiles**: budget/raised, beneficiaries, editions, partners.
- "Despre proiect": 2-3 short paragraphs + a pull quote.
- **Editions** (recurring projects, București pattern): one collapsible block per year with date, venue, coordinator, photos and results.
- Timeline / calendar (for ongoing projects).
- Partners (lockups: club | partner).
- Gallery (lightbox) + optional video.
- **Support this project**: an embedded Stripe donation (presets + custom, one-time/monthly) tagged with the project name, plus a 3.5% redirect link.
- Coordinator contact card (a member photo linking to their profile) → "Alte proiecte" (3 cards).
- Data model (CMS): title, slug, category, area_of_focus, status, year_start, editions[], kpis[], partners[], gallery[], coordinator→member, stripe_campaign_id.

### 4.4 Team page template (SAMVS structure + București card density)
- Intro: the club in 2 lines + a group photo.
- **Board {2026-2027}**: larger cards with photo, name, role (Președinte, Secretar, Trezorier, President-elect...).
- **Membri**: a 4-column grid (2 on mobile). Each card has a consistent **square/round photo on a uniform background**, name, profession/company, member since, and an optional PHF badge and LinkedIn. Cards with no photo use a branded monogram instead of a grey silhouette.
- **Foști președinți**: a compact row with photo + mandate year (founding president Cristian Avram 2018-19 first).
- Optional member detail modal: short bio + the projects they coordinated (links back to projects).
- CTA band: "Vrei să ni te alături?" → the membership form.
- Data model: name, photo, role, board_year, profession, member_since, honours, linkedin, projects[].
- Get **photo consent** for every member (brand rule + GDPR), and redo headshots at one club meeting for consistency.

### 4.5 Donate / get-involved pattern (Implică-te hub)
- **Donează online** (Stripe Checkout / Payment Element): a one-time | monthly toggle, presets (50 / 100 / 250 lei) + custom, an optional "choose project" dropdown, Apple/Google Pay, an email receipt. This matches SAMVS presets + Cetățuie widget. See `plati-donatii.md` for the Stripe/legal setup.
- **Redirecționează 3.5% (Formular 230)**: 3 steps + a link to the online signing (redirectioneaza.ro) and a PDF download. Seasonal banner Jan-May.
- **Sponsorizare firme**: deductibility explanation (Legea 32/1994 + RUB), a downloadable sponsorship contract/guide, "what sponsors get back" (logo wall, lockup, event visibility), a contact form.
- **Transfer bancar**: beneficiary, IBAN, CIF with a copy button.
- **Voluntariat / Devino membru**: a short form (name, email, interest) + meeting info + "come as a guest to a Wednesday meeting".
- Put the fiscal facts (CUI, RUB status) in one reusable block used on Donate, Sponsor and the footer.

### 4.6 Visual direction
- **Palette:** Royal Blue `#17458F` (primary: header, footer, headings), Gold `#F7A81B` (CTAs, highlights, progress bars), plus a warm neutral base (white / Cloud `#D6D1CA`-tinted off-white) and Charcoal `#54565A` for text. Use Cranberry only for Rotaract-related content.
- **Opera character (without touching the logo):** an editorial, "concert programme" feel. Use a deep royal-blue "stage" section for the current project, large serif display headings, and gold hairline rules and small caps for labels. It should feel like a playbill, not a bank.
- **Type:** headings in a refined serif (Playfair Display or Fraunces, as București and Cetățuie use, or Georgia for strict brand), UI/body in **Open Sans** (the official web font). Two fonts max.
- **Imagery:** real club photos of people doing service (concerts, SkirtBike, deliveries) rather than stock. Full-bleed, with a subtle blue gradient overlay for text legibility.
- **Layout:** a 12-col grid, generous whitespace, flat cards with a 1px border or soft background, **no heavy shadows**, 8-12px radius, and pill buttons (rotary.org).
- **Motion:** subtle only. Fade/slide-up on scroll (≤300 ms), count-up on the impact numbers, hover lift on cards, smooth image zoom in the gallery. No sliders or carousels in the hero, and respect `prefers-reduced-motion`.
- **Mobile:** a compact header (logo + Donează + burger), a sticky bottom "Donează" bar, 2-col member grid, single-col project cards.
- **Tech:** a static or headless build (Astro/Next + Webflow-like CMS, or plain WP with a custom block theme). Avoid page builders (WPBakery/Divi) and Rotary SaaS templates (ClubRunner/StreamScape). Non-blocking cookie bar, fast images (AVIF/WebP, lazy but with placeholders so sections don't render blank like on Cetățuie).
