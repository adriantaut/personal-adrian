from b import *
MAIL='mailto:contact@rotaryoperacluj.ro?subject=Vreau%20s%C4%83%20vin%20la%20o%20%C8%99edin%C8%9B%C4%83'
x = pagehero('Devino membru','Vino alături de noi','Căutăm oameni care vor să facă bine în Cluj și să construiască prietenii în jurul unor proiecte concrete. Nu contează profesia — contează dorința de a te implica.')
x += group(p('De ce Rotary','rop-eyebrow')+h('Ce înseamnă să fii rotarian')+sep()+cols(
  col(h('Proiecte cu impact',3)+p('Organizezi, alături de colegi, proiecte care chiar schimbă ceva: dialogurile EDUCATIO, cadourile ToyJoy, campaniile Construim Bucurie, cursurile de prim ajutor pentru copii.'),'rop-tile'),
  col(h('Prieteni',3)+p('Ne vedem în fiecare miercuri, dar și la teambuilding-uri, petreceri caritabile și întâlniri cu clubul nostru înfrățit, Rotary Club București Nord.'),'rop-tile'),
  col(h('O rețea internațională',3)+p('Faci parte din Rotary International, o comunitate de oameni din toate profesiile, din întreaga lume, uniți de motto-ul „Service Above Self”.'),'rop-tile')),c='rop-section',align='full')
steps=[('Vii la o ședință','Ne întâlnim în fiecare miercuri, la 18:30, la Hotel Victoria din Cluj-Napoca. Scrie-ne înainte, ca să te așteptăm și să-ți facem cunoștință cu clubul.'),
 ('Devii membru aspirant','Dacă simți că ți se potrivește, intri în perioada de probă. Primești un mentor din club, care te ajută să cunoști oamenii, proiectele și felul în care funcționăm.'),
 ('Te implici','Timp de aproximativ șase luni vii la ședințe, participi la evenimentele clubului și te alături proiectelor care te pasionează. Perioada poate fi prelungită, dacă e nevoie.'),
 ('Votul clubului','La final, mentorul tău prezintă un scurt raport despre activitatea ta, iar membrii clubului votează primirea ta.'),
 ('Bun venit în Rotary!','Devii membru cu drepturi depline al Rotary Club Cluj-Napoca Opera și al Rotary International.')]
ol='<ol class="rop-steps">'+''.join(f'<li><b>{t}</b><span>{d}</span></li>' for t,d in steps)+'</ol>'
x += group(p('Pas cu pas','rop-eyebrow')+h('Cum devii membru')+sep()+html(ol),c='rop-section rop-section--cream',align='full')
x += group(cols(
  col(h('Ce așteptăm de la tine')+sep()+'<!-- wp:list -->\n<ul class="wp-block-list"><!-- wp:list-item -->\n<li>Prezență la ședințele de miercuri</li>\n<!-- /wp:list-item -->\n<!-- wp:list-item -->\n<li>Implicare în proiectele clubului, după timpul și pasiunile tale</li>\n<!-- /wp:list-item -->\n<!-- wp:list-item -->\n<li>O cotizație lunară — îți spunem toate detaliile la prima întâlnire</li>\n<!-- /wp:list-item -->\n</ul>\n<!-- /wp:list -->\n'),
  col(h('Întrebări frecvente')+sep()+
   details('Trebuie să am o anumită profesie?',p('Nu. Clubul nostru reunește medici, artiști, antreprenori, profesori universitari, oameni din IT și din multe alte domenii. Tocmai diversitatea ne face puternici.'))+
   details('Am sub 30 de ani. E clubul potrivit pentru mine?',p('Ești binevenit la noi! Pentru tinerii între 18 și 30 de ani există și clubul Rotaract Cluj-Napoca Opera, pe care îl susținem ca club sponsor.'))+
   details('Cât timp îmi ia?',p('Ședința săptămânală, plus proiectele la care alegi să participi. Fiecare se implică atât cât poate — important e să fii prezent.')))),c='rop-section',align='full')
x += group(cols(col(h('Hai să ne cunoaștem',3)+p('Scrie-ne la <strong>contact@rotaryoperacluj.ro</strong> și te invităm la o ședință.')),col(btns(btn('Vreau să vin la o ședință',MAIL)))),c='rop-section rop-section--navy',align='full')
import json; json.dump(x,open('devino-membru.json','w'),ensure_ascii=False); print(len(x))
