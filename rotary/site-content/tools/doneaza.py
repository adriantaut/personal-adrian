from b import *
import json
L=json.load(open('../stripe-links.json'))
R='https://redirectioneaza.ro/rotary-club-cluj-napoca-opera/'
M='contact@rotaryoperacluj.ro'
once=''.join(f'<a class="rop-amt" href="{L[f"o_data_{a}"]}">{a} lei</a>' for a in (50,100,250,500))+f'<a class="rop-amt rop-amt--other" href="{L["o_data_alta_suma"]}">Altă sumă</a>'
monthly=''.join(f'<a class="rop-amt" href="{L[f"lunar_{a}"]}">{a} lei<small>/lună</small></a>' for a in (30,50,100,250))
widget=f'''<div class="rop-donate-box">
<input type="radio" name="rop-freq" id="rop-once" checked><input type="radio" name="rop-freq" id="rop-monthly">
<div class="rop-freq"><label for="rop-once">O singură dată</label><label for="rop-monthly">Lunar</label></div>
<div class="rop-amts rop-amts--once">{once}</div>
<div class="rop-amts rop-amts--monthly">{monthly}</div>
<p class="rop-donate-note">Plătești securizat prin Stripe, cu cardul, Apple Pay sau Google Pay. Primești chitanța pe e-mail. Donația lunară o poți anula oricând.</p>
</div>'''
iban='<div class="rop-iban"><span>Beneficiar</span><strong>ROTARY CLUB CLUJ-NAPOCA OPERA</strong><span>IBAN (Banca Transilvania)</span><strong class="rop-iban__nr">RO40 BTRL RONC RT04 4038 0101</strong><span>CUI</span><strong>39347197</strong><button type="button" onclick="navigator.clipboard.writeText(\'RO40BTRLRONCRT0440380101\');this.textContent=\'Copiat ✓\'">Copiază IBAN</button></div>'
x = pagehero('Donează','Susține proiectele noastre','Fiecare leu ajunge într-un proiect concret pentru comunitatea din Cluj: cadouri de Crăciun pentru copii, pachete pentru familii, cursuri de prim ajutor, dialoguri educative.')
x += group(cols(
  col(p('Online','rop-eyebrow')+h('Donează cu cardul')+html(widget)),
  col(p('Transfer bancar','rop-eyebrow')+h('Donează prin bancă')+p('Poți dona direct în contul asociației. Dacă vrei să susții un anumit proiect, scrie-i numele în detaliile plății.')+html(iban))),c='rop-section',align='full')
x += group(p('Fără niciun cost pentru tine','rop-eyebrow')+h('Alte moduri de a ne susține')+sep()+cols(
  col(h('Persoane fizice: redirecționează 3,5%',3)+p('Dacă ai venituri din salariu sau pensie, poți direcționa către noi 3,5% din impozitul pe venit. Nu te costă nimic: banii ar merge oricum la stat.')+
      '<!-- wp:list {"ordered":true} -->\n<ol class="wp-block-list"><!-- wp:list-item -->\n<li>Intră pe formularul online</li>\n<!-- /wp:list-item -->\n<!-- wp:list-item -->\n<li>Completează-l și semnează-l</li>\n<!-- /wp:list-item -->\n<!-- wp:list-item -->\n<li>Trimite-l până pe 25 mai</li>\n<!-- /wp:list-item -->\n</ol>\n<!-- /wp:list -->\n'+
      btns(btn('Completează Formularul 230',R)),'rop-tile'),
  col(h('Companii: sponsorizare',3)+p('Firmele plătitoare de impozit pe profit pot sponsoriza proiectele noastre <strong>fără cost real</strong>: suma sponsorizată se scade din impozitul pe profit, ca credit fiscal, până la <strong>20% din impozit</strong>, dar nu mai mult de <strong>0,75% din cifra de afaceri</strong>. Ce nu se folosește într-un an se reportează 7 ani.')+
      p('<strong>Cum procedăm:</strong> ne scrii, îți trimitem contractul de sponsorizare (Legea 32/1994), faci transferul în contul asociației, iar noi îți confirmăm primirea și îți trimitem documentele.')+
      p('<strong>Redirecționare din impozitul de anul trecut:</strong> dacă firma nu și-a folosit plafonul de sponsorizare anul trecut, poate redirecționa suma prin <strong>Formularul 177</strong>, depus în SPV până pe <strong>25 iunie</strong>, pe baza unui contract de sponsorizare.')+
      p('Asociația este înscrisă în Registrul entităților pentru care se acordă deduceri fiscale (RUB), condiție pentru credit fiscal. Microîntreprinderile nu mai beneficiază de facilitatea fiscală din 2024, dar ne pot susține în continuare.','rop-note')+
      btns(btn('Scrie-ne pentru contract','mailto:'+M+'?subject=Sponsorizare')),'rop-tile')),c='rop-section rop-section--cream',align='full')
x += group(cols(
  col(h('Ce primesc sponsorii',3)+'<!-- wp:list -->\n<ul class="wp-block-list"><!-- wp:list-item -->\n<li>Logo pe site, în secțiunea Parteneri și pe pagina proiectului susținut</li>\n<!-- /wp:list-item -->\n<!-- wp:list-item -->\n<li>Mulțumiri publice pe Facebook și Instagram</li>\n<!-- /wp:list-item -->\n<!-- wp:list-item -->\n<li>Mențiune la evenimentele proiectului</li>\n<!-- /wp:list-item -->\n<!-- wp:list-item -->\n<li>Un scurt raport despre ce s-a realizat cu sprijinul vostru</li>\n<!-- /wp:list-item -->\n</ul>\n<!-- /wp:list -->\n'),
  col(h('Donații în natură',3)+p('Pentru campanii precum Construim Bucurie sau ToyJoy strângem și alimente neperisabile, haine noi, jucării și rechizite. Scrie-ne și îți spunem ce e nevoie acum.')+p('Vrei să te implici mai mult? Află <a href="/devino-membru/">cum devii membru</a>.'))),c='rop-section',align='full')
cards=''.join(f'<a class="rop-pcard" href="/proiecte/{s}/"><img src="{{{{IMG:{s}}}}}" alt="{t}" loading="lazy"><b>{t}</b><span>{d}</span></a>' for s,t,d in [
 ('ambulanta-sfantul-nectarie','O ambulanță pentru „Sfântul Nectarie”','strânsă prin 6 evenimente culturale'),
 ('construim-bucurie','Construim Bucurie','115 familii ajutate'),
 ('toyjoy','ToyJoy','105 copii cu cadouri în 2024–2025'),
 ('educatio','EDUCATIO','5 dialoguri educative gratuite')])
x += group(p('Transparență','rop-eyebrow')+h('Unde ajung banii')+sep()+html(f'<div class="rop-pcards">{cards}</div>'),c='rop-section rop-section--cream',align='full')
x += group(h('Întrebări frecvente')+sep()+
  details('Este sigur să donez online?',p('Da. Plățile sunt procesate de Stripe, certificat PCI-DSS. Datele cardului tău nu ajung la noi.'))+
  details('Primesc o confirmare?',p('Da, primești automat pe e-mail chitanța plății. Dacă ai nevoie de un document pentru contabilitate, scrie-ne la '+M+'.'))+
  details('Cum anulez donația lunară?',p(f'Oricând, din linkul din e-mailul de confirmare sau din <a href="{L["portal_login"]}">pagina donațiilor tale</a>, unde te autentifici cu adresa de e-mail folosită la donație.'))+
  details('Pot dona pentru un anumit proiect?',p('Da. La plata online poți alege proiectul din listă, iar la transfer bancar îl poți scrie în detaliile plății.'))+
  p('Detalii în <a href="/termeni-donatii/">Termenii și condițiile pentru donații</a>.','rop-note'),c='rop-section rop-prose',align='full')
json.dump(x,open('doneaza.json','w'),ensure_ascii=False)
y = pagehero('Mulțumim','Îți mulțumim din suflet!','Donația ta a fost primită. Fiecare leu ajunge într-un proiect concret pentru comunitatea din Cluj.')
y += group(p('Vei primi în câteva minute chitanța pe e-mail. Dacă ai ales o donație lunară, o poți gestiona sau anula oricând din <a href="'+L['portal_login']+'">pagina donațiilor tale</a>.')+
  p('Vrei să ne ajuți și mai mult? Spune-le prietenilor despre noi sau vino la o ședință, miercuri, la 18:30, la Hotel Victoria.')+
  btns(btn('Vezi proiectele noastre','/proiecte/'),btn('Devino membru','/devino-membru/','is-style-outline')),c='rop-section rop-prose',align='full')
json.dump(y,open('multumim.json','w'),ensure_ascii=False); print(len(x),len(y))
