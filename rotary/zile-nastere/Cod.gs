/**
 * Zile de naștere — Rotary Club Cluj-Napoca Opera
 * Citește taburile „Membri” și „Setări”, trimite un email zilnic la 09:00 și scrie în „Jurnal”.
 * Instalare: rulează o singură dată funcția `instaleaza`.
 */

const LUNI = ['Ianuarie', 'Februarie', 'Martie', 'Aprilie', 'Mai', 'Iunie', 'Iulie', 'August', 'Septembrie', 'Octombrie', 'Noiembrie', 'Decembrie'];
const TZ = 'Europe/Bucharest';

/** Rulează o dată: creează declanșatorul zilnic de la 09:00. */
function instaleaza() {
  ScriptApp.getProjectTriggers()
    .filter(t => t.getHandlerFunction() === 'verificaAniversari')
    .forEach(t => ScriptApp.deleteTrigger(t));
  ScriptApp.newTrigger('verificaAniversari').timeBased().everyDays(1).atHour(9).inTimezone(TZ).create();
  SpreadsheetApp.getActive().toast('Gata: emailul pleacă zilnic la 09:00.', 'Zile de naștere', 8);
}

/** Trimite acum un email de test către destinatari (nu scrie în Jurnal). */
function testEmail() {
  const s = citesteSetari();
  const urm = urmatoareleAniversari(30).slice(0, 5).map(a => `• ${a.nume} — ${a.zi} ${a.luna} (peste ${a.peste} zile)`).join('\n');
  MailApp.sendEmail({
    to: s.destinatari.join(','),
    subject: '✅ Test — notificări zile de naștere Rotary Opera',
    body: 'Notificările funcționează. Următoarele aniversări:\n\n' + (urm || '(niciuna în următoarele 30 de zile)'),
  });
}

/** Rulată zilnic de declanșator. */
function verificaAniversari() {
  const s = citesteSetari();
  if (!s.active || !s.destinatari.length) return;
  const azi = new Date();

  if (s.cand === 'În ziua respectivă' || s.cand === 'Ambele') trimite_(s, aniversariLa(azi), 'azi');
  if (s.cand === 'Cu o zi înainte' || s.cand === 'Ambele') trimite_(s, aniversariLa(adaugaZile(azi, 1)), 'mâine');

  if (s.rezumat && Utilities.formatDate(azi, TZ, 'u') === '1') {
    const sapt = urmatoareleAniversari(6);
    if (sapt.length && !dejaTrimis_('rezumat')) {
      const corp = sapt.map(a => `• ${a.nume} — ${a.zi} ${a.luna}${a.peste === 0 ? ' (azi)' : ''}`).join('\n');
      MailApp.sendEmail({ to: s.destinatari.join(','), subject: '🎂 Aniversările săptămânii — Rotary Opera', body: 'Săptămâna aceasta:\n\n' + corp });
      jurnal_(sapt.map(a => a.nume).join(', '), 'rezumat', s.destinatari);
    }
  }
}

function trimite_(s, lista, cand) {
  if (!lista.length || dejaTrimis_(cand)) return;
  const nume = lista.map(a => a.nume).join(', ');
  const subiect = cand === 'azi'
    ? s.subiect.replace('{nume}', nume)
    : '🎂 Mâine e ziua lui ' + nume;
  const corp = (cand === 'azi' ? 'Azi' : 'Mâine') + ' sărbătorim:\n\n'
    + lista.map(a => `• ${a.nume} — ${a.zi} ${a.luna}`).join('\n')
    + '\n\nNu uitați de mesaj / postare! 🎉\n\n— notificare automată din sheet-ul „Zile nastere membrii”';
  MailApp.sendEmail({ to: s.destinatari.join(','), subject: subiect, body: corp });
  jurnal_(nume, cand, s.destinatari);
}

/* ---------- date ---------- */

function membri_() {
  const v = SpreadsheetApp.getActive().getSheetByName('Membri').getDataRange().getValues().slice(1);
  return v
    .filter(r => r[0] && r[1] && r[2] && ['Activ', 'Invitat'].includes(r[4]))   // Status: Activ/Invitat = notifică, Fost = nu
    .map(r => ({ nume: String(r[0]).trim(), zi: Number(r[1]), luna: r[2], lunaNr: LUNI.indexOf(r[2]) + 1 }))
    .filter(m => m.lunaNr > 0);
}

function aniversariLa(d) {
  const zi = Number(Utilities.formatDate(d, TZ, 'd'));
  const luna = Number(Utilities.formatDate(d, TZ, 'M'));
  const an = Number(Utilities.formatDate(d, TZ, 'yyyy'));
  const bisect = (an % 4 === 0 && an % 100 !== 0) || an % 400 === 0;
  return membri_().filter(m => (m.zi === zi && m.lunaNr === luna) || (!bisect && m.zi === 29 && m.lunaNr === 2 && zi === 28 && luna === 2));
}

function urmatoareleAniversari(zile) {
  const out = [];
  for (let i = 0; i <= zile; i++) aniversariLa(adaugaZile(new Date(), i)).forEach(a => out.push(Object.assign({ peste: i }, a)));
  return out;
}

function citesteSetari() {
  const v = SpreadsheetApp.getActive().getSheetByName('Setări').getDataRange().getValues();
  const get = k => { const r = v.find(x => String(x[0]).trim() === k); return r ? String(r[1]).trim() : ''; };
  return {
    active: get('Notificări active') !== 'Nu',
    cand: get('Când anunță') || 'În ziua respectivă',
    rezumat: get('Rezumat săptămânal (luni)') === 'Da',
    subiect: get('Subiect email') || '🎂 Azi e ziua lui {nume}',
    destinatari: v.filter(x => /^Destinatar/.test(String(x[0])) && /@/.test(String(x[1]))).map(x => String(x[1]).trim()),
  };
}

/* ---------- jurnal ---------- */

function jurnal_(despre, tip, dest) {
  SpreadsheetApp.getActive().getSheetByName('Jurnal')
    .appendRow([Utilities.formatDate(new Date(), TZ, 'yyyy-MM-dd HH:mm'), despre, tip, dest.join(', ')]);
}

function dejaTrimis_(tip) {
  const azi = Utilities.formatDate(new Date(), TZ, 'yyyy-MM-dd');
  return SpreadsheetApp.getActive().getSheetByName('Jurnal').getDataRange().getValues()
    .some(r => (r[0] instanceof Date ? Utilities.formatDate(r[0], TZ, 'yyyy-MM-dd') : String(r[0]).slice(0, 10)) === azi && r[2] === tip);
}

function adaugaZile(d, n) { const x = new Date(d); x.setDate(x.getDate() + n); return x; }
