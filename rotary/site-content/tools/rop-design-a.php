<?php
/**
 * Plugin Name: Rotary Opera — design A (preview)
 * Description: Designul „A dark” (live din 16 Oct 2026). Pornit din wp-config: ROP_DESIGN_A_LIVE + ROP_DESIGN_A_DARK.
 */
defined('ABSPATH') || exit;

const ROP_A_LOGO_WHITE = 301;
const ROP_A_HERO = [246, 271, 243, 48];   // hero slider photos (attachment IDs)
const ROP_A_FEATURED = ['educatio' => 'Educație', 'toyjoy' => 'Social', 'construim-bucurie' => 'Comunitate', 'ambulanta-sfantul-nectarie' => 'Sănătate · proiect-fanion'];
const ROP_A_STRIPE = [
	'once'    => [50 => 'https://donate.stripe.com/00w9AV3PY4Eacxl9m8gjC01', 100 => 'https://donate.stripe.com/7sY6oJ5Y61rY2WL69WgjC02', 250 => 'https://donate.stripe.com/3cI00lbiqeeK40PbuggjC03', 500 => 'https://donate.stripe.com/dRm4gB4U2daG7d1gOAgjC04'],
	'other'   => 'https://donate.stripe.com/8x24gBbiqfiO54T41OgjC00',
	'monthly' => [30 => 'https://buy.stripe.com/4gM14p2LUdaG7d1dCogjC09', 50 => 'https://buy.stripe.com/9B65kF0DM9Yu9l98i4gjC05', 100 => 'https://buy.stripe.com/9B65kFaem9YucxlcykgjC06', 250 => 'https://buy.stripe.com/28E3cx5Y67Qm7d1buggjC07'],
];

function rop_a_on(): bool { return defined('ROP_DESIGN_A_LIVE') && ROP_DESIGN_A_LIVE; }
function rop_a_dark(): bool { return defined('ROP_DESIGN_A_DARK') && ROP_DESIGN_A_DARK; }


add_filter('body_class', function ($c) {
	if (!rop_a_on()) return $c;
	$c[] = 'rop-a';
	if (rop_a_dark()) $c[] = 'rop-a-dark';
	if (is_page()) $c[] = 'pg-' . get_post_field('post_name', get_queried_object_id());
	return $c;
});

add_action('wp_enqueue_scripts', function () {
	if (!rop_a_on()) return;
	wp_enqueue_style('rop-a-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;1,500&family=Karla:wght@400;500;600;700&display=swap', [], null);
});

/* ---------- header & footer ---------- */
function rop_a_icons(): string {
	$fb = '<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M13.5 21v-7.5h2.5l.4-3h-2.9V8.6c0-.9.3-1.5 1.5-1.5h1.6V4.4c-.3 0-1.2-.1-2.3-.1-2.3 0-3.8 1.4-3.8 3.9v2.3H8v3h2.5V21h3z"/></svg>';
	$ig = '<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 7.3A4.7 4.7 0 1 0 12 16.7 4.7 4.7 0 0 0 12 7.3zm0 7.7a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm6-7.9a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0zM21 8.1c-.1-1.5-.4-2.8-1.5-3.9S17.1 2.8 15.6 2.7c-1.5-.1-6-.1-7.5 0-1.5.1-2.8.4-3.9 1.5S2.8 6.6 2.7 8.1c-.1 1.5-.1 6 0 7.5.1 1.5.4 2.8 1.5 3.9s2.4 1.4 3.9 1.5c1.5.1 6 .1 7.5 0 1.5-.1 2.8-.4 3.9-1.5s1.4-2.4 1.5-3.9c.1-1.5.1-6 0-7.5zm-2 9.1a3 3 0 0 1-1.7 1.7c-1.2.5-4 .4-5.3.4s-4.1.1-5.3-.4a3 3 0 0 1-1.7-1.7c-.5-1.2-.4-4-.4-5.3s-.1-4.1.4-5.3a3 3 0 0 1 1.7-1.7c1.2-.5 4-.4 5.3-.4s4.1-.1 5.3.4a3 3 0 0 1 1.7 1.7c.5 1.2.4 4 .4 5.3s.1 4.1-.4 5.3z"/></svg>';
	return '<span class="a-icons"><a class="a-ico" href="https://www.facebook.com/share/1JSok3zohs/" target="_blank" rel="noopener" aria-label="Facebook">' . $fb . '</a><a class="a-ico" href="https://www.instagram.com/rotaryclujnapocaopera" target="_blank" rel="noopener" aria-label="Instagram">' . $ig . '</a></span>';
}

function rop_a_header(): string {
	$logo = wp_get_attachment_image_url(ROP_A_LOGO_WHITE, 'medium');
	$cur = trailingslashit(wp_parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
	$links = ['/despre/' => 'Despre', '/proiecte/' => 'Proiecte', '/echipa/' => 'Echipa', '/contact/' => 'Contact'];
	$nav = '';
	foreach ($links as $u => $t) $nav .= '<a href="' . esc_url(home_url($u)) . '"' . (str_starts_with($cur, $u) ? ' aria-current="page"' : '') . '>' . esc_html($t) . '</a>';
	return '<header class="a-nav' . (is_front_page() ? ' a-nav--over' : '') . '"><div class="a-wrap">'
		. '<a class="a-logo" href="' . esc_url(home_url('/')) . '"><img src="' . esc_url($logo) . '" alt="Rotary Club Cluj-Napoca Opera"></a>'
		. '<input type="checkbox" id="a-menu" class="a-menu-toggle"><label for="a-menu" class="a-burger" aria-label="Meniu"><span></span></label>'
		. '<nav class="a-menu">' . $nav . rop_a_icons() . '<a class="a-btn a-btn--gold" href="' . esc_url(home_url('/doneaza/')) . '">Donează</a></nav>'
		. '</div></header>';
}

function rop_a_footer(): string {
	$logo = wp_get_attachment_image_url(ROP_A_LOGO_WHITE, 'medium');
	return '<footer class="a-footer"><div class="a-wrap a-footer__grid">'
		. '<div><img class="a-footer__logo" src="' . esc_url($logo) . '" alt="Rotary Club Cluj-Napoca Opera"><p>Service Above Self. Un club Rotary din Districtul 2241 România și Republica Moldova.</p></div>'
		. '<div><span class="a-eyebrow">Explorează</span><ul><li><a href="/despre/">Despre noi</a></li><li><a href="/echipa/">Echipa</a></li><li><a href="/proiecte/">Proiecte</a></li><li><a href="/devino-membru/">Devino membru</a></li><li><a href="/contact/">Contact</a></li></ul><a class="a-btn a-btn--gold a-footer__donate" href="/doneaza/">Donează</a></div>'
		. '<div><span class="a-eyebrow">Contact</span><p><a href="mailto:contact@rotaryoperacluj.ro">contact@rotaryoperacluj.ro</a><br>Ședințe: miercuri, 18:30<br>Hotel Victoria, Cluj-Napoca</p>'
		. '<p class="a-social">' . rop_a_icons() . '</p></div>'
		. '</div><div class="a-wrap a-footer__legal">© ' . date('Y') . ' Asociația Rotary Club Cluj-Napoca Opera · CUI 39347197 · <a href="/politica-de-confidentialitate/">Confidențialitate</a> · <a href="/termeni-donatii/">Termeni donații</a></div></footer>';
}

add_filter('render_block', function ($html, $block) {
	if (!rop_a_on() || ($block['blockName'] ?? '') !== 'core/template-part') return $html;
	$slug = $block['attrs']['slug'] ?? '';
	if ($slug === 'header') return rop_a_header();
	if ($slug === 'footer') return rop_a_footer();
	return $html;
}, 10, 2);


/* ---------- project logos: hero (h1) + list badge ---------- */
add_filter('render_block', function ($html, $block, $inst) {
	if (!rop_a_on()) return $html;
	$name = $block['blockName'] ?? '';
	if ($name === 'core/post-title' && is_singular('proiect') && (int) ($block['attrs']['level'] ?? 2) === 1) {
		$logo = (int) get_field('logo', get_queried_object_id());
		if (!$logo) return $html;
		return '<div class="a-plogo">' . wp_get_attachment_image($logo, 'large', false, ['alt' => esc_attr(get_the_title(get_queried_object_id())), 'fetchpriority' => 'high']) . '</div>' . str_replace('wp-block-post-title', 'wp-block-post-title a-ptitle--small', $html);
	}
	if ($name === 'core/post-featured-image' && !empty($inst->context['postId']) && get_post_type($inst->context['postId']) === 'proiect' && !is_singular('proiect') || ($name === 'core/post-featured-image' && !empty($inst->context['queryId']))) {
		$pid = (int) ($inst->context['postId'] ?? 0);
		$logo = $pid ? (int) get_field('logo', $pid) : 0;
		if (!$logo) return $html;
		$badge = '<span class="a-pbadge">' . wp_get_attachment_image($logo, 'medium', false, ['alt' => '', 'loading' => 'lazy']) . '</span>';
		return preg_replace('#</figure>\s*$#', $badge . '</figure>', $html, 1);
	}
	return $html;
}, 20, 3);

/* ---------- homepage ---------- */
function rop_a_years(WP_Post $p): string {
	$ys = array_filter(array_map(fn($r) => (int) substr((string) $r['an'], 0, 4), (array) get_field('editii', $p->ID)));
	if (!$ys) return (string) get_field('an', $p->ID);
	return min($ys) === max($ys) ? (string) min($ys) : min($ys) . '–' . max($ys);
}

function rop_a_home(): string {
	$slides = '';
	foreach (ROP_A_HERO as $i => $id) $slides .= '<img class="a-hero__img" src="' . esc_url(wp_get_attachment_image_url($id, 'full')) . '" alt="" style="--i:' . $i . '"' . ($i ? ' loading="lazy"' : ' fetchpriority="high"') . '>';
	$active = get_posts(['post_type' => 'proiect', 'numberposts' => 1, 'meta_key' => 'status', 'meta_value' => 'activ']);
	$card = $active ? '<a class="a-ticket" href="' . esc_url(get_permalink($active[0])) . '"><span class="a-eyebrow">În desfășurare</span><b>' . esc_html($active[0]->post_title) . '</b><span>Află mai mult →</span></a>' : '';
	$h = '<section class="a-hero" style="--n:' . count(ROP_A_HERO) . '">' . $slides . '<div class="a-wrap a-hero__in">'
		. '<span class="a-eyebrow">Service Above Self · din 2017</span>'
		. '<h1>Facem bine <em>împreună</em> cu Clujul.</h1>'
		. '<p>Un club de oameni implicați care transformă concerte, dialoguri și campanii în ajutor concret: cadouri pentru copii, pachete pentru familii, cursuri de prim ajutor.</p>'
		. '<div class="a-ctas"><a class="a-btn a-btn--gold" href="/proiecte/">Descoperă proiectele</a><a class="a-btn a-btn--line" href="/devino-membru/">Vino la o ședință</a></div></div>' . $card . '</section>';

	$members = count(array_filter(get_posts(['post_type' => 'membru', 'numberposts' => -1, 'fields' => 'ids']), fn($id) => !get_field('onoare', $id)));
	$stats = [['2017', 'anul înființării'], [wp_count_posts('proiect')->publish, 'proiecte și campanii'], ['115', 'familii ajutate prin Construim Bucurie'], [$members, 'membri activi']];
	$h .= '<div class="a-stats"><div class="a-wrap">' . implode('', array_map(fn($s) => '<div><b>' . esc_html($s[0]) . '</b><span>' . esc_html($s[1]) . '</span></div>', $stats)) . '</div></div>';

	$rows = '';
	foreach (ROP_A_FEATURED as $slug => $label) {
		$p = get_page_by_path($slug, OBJECT, 'proiect'); if (!$p) continue;
		$eds = count((array) get_field('editii', $p->ID));
		$tag = implode(' · ', array_filter([$label, $eds > 1 ? $eds . ' ediții' : '']));
		$rows .= '<a class="a-row" href="' . esc_url(get_permalink($p)) . '"><time>' . esc_html(rop_a_years($p)) . '</time><div><span class="a-tag">' . esc_html($tag) . '</span><h3>' . esc_html($p->post_title) . '</h3><p>' . esc_html(get_the_excerpt($p)) . '</p></div>'
			. get_the_post_thumbnail($p, 'medium_large', ['loading' => 'lazy']) . '</a>';
	}
	$h .= '<section class="a-section"><div class="a-wrap"><div class="a-head"><div><span class="a-eyebrow">Proiecte</span><h2>Ce am făcut împreună</h2></div><a class="a-btn a-btn--line" href="/proiecte/">Toate proiectele →</a></div><div class="a-rows">' . $rows . '</div></div></section>';

	$board = array_filter(get_posts(['post_type' => 'membru', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC']), fn($m) => get_field('rol', $m->ID) && !get_field('onoare', $m->ID));
	$cast = '';
	foreach ($board as $m) {
		$ini = implode('', array_map(fn($w) => mb_substr($w, 0, 1), array_slice(explode(' ', $m->post_title), 0, 2)));
		$img = has_post_thumbnail($m) ? get_the_post_thumbnail($m, 'thumbnail', ['loading' => 'lazy']) : '<span class="a-mono">' . esc_html($ini) . '</span>';
		$cast .= '<div class="a-member">' . $img . '<div><i>' . esc_html(get_field('rol', $m->ID)) . '</i><b>' . esc_html($m->post_title) . '</b></div></div>';
	}
	$h .= '<section class="a-section a-ivory"><div class="a-wrap"><div class="a-head"><div><span class="a-eyebrow">Comitetul ' . esc_html(rop_a_rotary_year()) . '</span><h2>Oamenii din spatele proiectelor</h2></div><a class="a-btn a-btn--dark" href="/echipa/">Toată echipa →</a></div><div class="a-cast">' . $cast . '</div></div></section>';

	$h .= '<section class="a-section a-support"><div class="a-wrap a-support__grid"><div><span class="a-eyebrow">Susține-ne</span><h2>Fiecare leu ajunge <em>într-un proiect</em> real.</h2><p>Donează online sau prin transfer bancar, ori redirecționează 3,5% din impozit. Pentru firme: sponsorizare cu credit fiscal sau Formularul 177.</p><a class="a-link" href="/doneaza/">Toate modurile de a ne susține →</a></div>' . rop_a_donate_box() . '</div></section>';

	$logos = '';
	foreach (get_posts(['post_type' => 'attachment', 'post_status' => 'inherit', 'numberposts' => 20, 's' => 'partener-']) as $a)
		if (str_contains(get_attached_file($a->ID), '/partener-')) $logos .= '<span>' . wp_get_attachment_image($a->ID, 'medium', false, ['loading' => 'lazy']) . '</span>';
	if ($logos) $h .= '<section class="a-partners"><div class="a-wrap"><span class="a-eyebrow">Cu sprijinul</span><div class="a-logos">' . $logos . '</div></div></section>';
	return $h;
}

function rop_a_rotary_year(): string { $y = (int) date('Y'); if ((int) date('n') < 7) $y--; return $y . '–' . ($y + 1); }

function rop_a_donate_box(): string {
	$once = ''; foreach (ROP_A_STRIPE['once'] as $a => $u) $once .= '<a href="' . esc_url($u) . '">' . $a . ' lei</a>';
	$once .= '<a class="a-amt--txt" href="' . esc_url(ROP_A_STRIPE['other']) . '">Altă sumă</a>';
	$mon = ''; foreach (ROP_A_STRIPE['monthly'] as $a => $u) $mon .= '<a href="' . esc_url($u) . '">' . $a . ' lei<small>/lună</small></a>';
	return '<div class="a-donate"><input type="radio" name="a-freq" id="a-mon" checked><input type="radio" name="a-freq" id="a-once">'
		. '<div class="a-seg"><label for="a-mon">Lunar</label><label for="a-once">O singură dată</label></div>'
		. '<div class="a-amts a-amts--once">' . $once . '</div><div class="a-amts a-amts--mon">' . $mon . '</div>'
		. '<small>Card, Apple Pay, Google Pay · securizat prin Stripe</small></div>';
}

add_filter('render_block', function ($html, $block) {
	if (!rop_a_on() || !is_front_page() || ($block['blockName'] ?? '') !== 'core/post-content') return $html;
	return rop_a_home();
}, 10, 2);

/* ---------- styles ---------- */
add_action('wp_head', function () {
	if (!rop_a_on()) return; ?>
<style id="rop-design-a">
body.rop-a{--a-night:#0A1A36;--a-deep:#10264D;--a-gold:#F7A81B;--a-gold2:#E8C36A;--a-ivory:#F4EFE6;--a-ink:#E9ECF3;--a-mute:#9DAAC4;--a-blue:#17458F;
 --wp--preset--font-family--literata:'Playfair Display',Georgia,serif;--wp--preset--font-family--manrope:Karla,system-ui,sans-serif;font-family:Karla,system-ui,sans-serif}
.rop-a [class^="a-"],.rop-a [class^="a-"] *{box-sizing:border-box}
.rop-a .a-wrap{max-width:1240px;margin:0 auto;padding:0 32px}
.rop-a .a-eyebrow{display:block;font-size:.75rem;letter-spacing:.3em;text-transform:uppercase;color:var(--a-gold);font-weight:700}
.rop-a .a-btn{display:inline-flex;align-items:center;gap:.5rem;padding:.85em 1.6em;border-radius:999px;font-weight:700;font-size:.95rem;text-decoration:none;transition:transform .2s,background .2s,color .2s}
.rop-a .a-btn:hover{transform:translateY(-2px)}
.rop-a .a-btn--gold{background:var(--a-gold);color:var(--a-night)}.rop-a .a-btn--line{border:1.5px solid rgba(255,255,255,.45);color:#fff}.rop-a .a-btn--dark{border:1.5px solid #0A1A3655;color:var(--a-night)}
.rop-a .a-link{color:var(--a-gold);font-weight:700;text-decoration:none}
/* nav */
.rop-a .a-nav{position:sticky;top:0;z-index:50;background:var(--a-night);padding:12px 0}
.rop-a .a-nav--over{position:absolute;inset:0 0 auto;background:linear-gradient(180deg,rgba(10,26,54,.75),transparent)}
.rop-a .a-nav .a-wrap{display:flex;align-items:center;justify-content:space-between;gap:20px}
.rop-a .a-logo img{height:96px;width:auto;display:block}
.rop-a .a-menu{display:flex;gap:30px;align-items:center}.rop-a .a-menu a{color:#fff;text-decoration:none;font-weight:600;font-size:.95rem}
.rop-a .a-menu a:not(.a-btn):hover,.rop-a .a-menu a[aria-current]{color:var(--a-gold)}
.rop-a .a-menu-toggle,.rop-a .a-burger{display:none}
.rop-a .a-icons{display:inline-flex;gap:8px}
.rop-a .a-ico{width:36px;height:36px;border:1.5px solid var(--a-gold);border-radius:50%;display:inline-grid;place-items:center;color:#fff!important;transition:background .2s,color .2s}
.rop-a .a-ico svg{width:17px;height:17px}.rop-a .a-ico:hover{background:var(--a-gold);color:var(--a-night)!important}
.rop-a .a-follow{display:flex;gap:12px;flex-wrap:wrap;margin-top:1.2rem}
.rop-a .a-follow a{display:inline-flex;align-items:center;gap:.6rem;padding:.8em 1.5em;border:1.5px solid var(--a-gold);border-radius:999px;color:#fff;font-weight:700;text-decoration:none;transition:background .2s,color .2s}
.rop-a .a-follow svg{width:18px;height:18px}.rop-a .a-follow a:hover{background:var(--a-gold);color:var(--a-night)}
.rop-a .rop-timeline a{color:inherit;text-decoration:none;border-bottom:1px solid #F7A81B66}.rop-a .rop-timeline a:hover{color:var(--a-gold)}
.rop-a .a-plogo{margin:.4rem 0 1rem}.rop-a .a-plogo img{max-height:130px;max-width:min(560px,100%);width:auto;height:auto;display:block;filter:drop-shadow(0 4px 18px rgba(0,0,0,.45))}
.rop-a .a-ptitle--small{font-size:clamp(1.4rem,2.4vw,2rem)!important;opacity:.9}
.rop-a .wp-block-post-featured-image{position:relative}
.rop-a .a-pbadge{position:absolute;left:0;right:0;bottom:0;padding:28px 14px 12px;background:linear-gradient(180deg,transparent,rgba(10,26,54,.85));display:flex;pointer-events:none}
.rop-a .a-pbadge img{max-height:38px;max-width:62%;width:auto;height:auto;object-fit:contain;transform:none!important}
@media (max-width:860px){.rop-a .a-plogo img{max-height:96px}}
/* hero */
.rop-a .a-hero{position:relative;min-height:92vh;display:flex;align-items:flex-end;overflow:hidden;background:var(--a-night);color:#fff}
.rop-a .a-hero__img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0;animation:a-fade calc(var(--n)*6s) infinite;animation-delay:calc(var(--i)*6s)}
.rop-a .a-hero__img:first-child{opacity:1}
@keyframes a-fade{0%{opacity:0;transform:scale(1.04)}4%{opacity:1}25%{opacity:1}29%{opacity:0;transform:scale(1)}100%{opacity:0}}
.rop-a .a-hero:before{content:"";position:absolute;inset:0;z-index:1;background:radial-gradient(ellipse at 50% 30%,rgba(10,26,54,.15),rgba(10,26,54,.9) 70%),linear-gradient(180deg,rgba(10,26,54,.55),transparent 30%,var(--a-night) 98%)}
.rop-a .a-hero__in{position:relative;z-index:2;padding-top:190px;padding-bottom:90px;width:100%}
.rop-a .a-hero h1{font-family:'Playfair Display',Georgia,serif;font-weight:500;font-size:clamp(3rem,7vw,6.2rem);line-height:1.02;letter-spacing:-.02em;max-width:12ch;margin:18px 0 26px;color:#fff}
.rop-a .a-hero h1 em{color:var(--a-gold)}.rop-a .a-hero p{max-width:46ch;font-size:1.2rem;color:#D3DAE8;margin:0}
.rop-a .a-ctas{display:flex;gap:14px;margin-top:34px;flex-wrap:wrap}
.rop-a .a-ticket{position:absolute;right:32px;bottom:90px;z-index:2;width:280px;background:var(--a-ivory);color:var(--a-night);border-radius:6px;padding:22px 24px;transform:rotate(2deg);box-shadow:0 30px 60px -20px #000;text-decoration:none;transition:transform .3s}
.rop-a .a-ticket:hover{transform:rotate(0)}
.rop-a .a-ticket:before,.rop-a .a-ticket:after{content:"";position:absolute;top:50%;width:22px;height:22px;border-radius:50%;background:var(--a-night);transform:translateY(-50%)}.rop-a .a-ticket:before{left:-11px}.rop-a .a-ticket:after{right:-11px}
.rop-a .a-ticket .a-eyebrow{color:var(--a-blue)}.rop-a .a-ticket b{display:block;font-family:'Playfair Display',Georgia,serif;font-size:1.4rem;line-height:1.15;margin:6px 0 8px;font-weight:600}.rop-a .a-ticket span:last-child{font-size:.9rem;font-weight:600}
/* stats */
.rop-a .a-stats{background:var(--a-night);border-block:1px solid #ffffff1f;color:#fff}.rop-a .a-stats .a-wrap{display:grid;grid-template-columns:repeat(4,1fr)}
.rop-a .a-stats div>div{padding:34px 0 34px 28px;border-left:1px solid #ffffff1f}.rop-a .a-stats div>div:first-child{border:0;padding-left:0}
.rop-a .a-stats b{font-family:'Playfair Display',Georgia,serif;font-size:3rem;color:var(--a-gold2);line-height:1;display:block;font-weight:500}.rop-a .a-stats span{color:var(--a-mute);font-size:.95rem}
/* sections */
.rop-a .a-section{padding:110px 0;background:var(--a-night);color:var(--a-ink)}
.rop-a .a-head{display:flex;justify-content:space-between;align-items:end;gap:20px;margin-bottom:50px}
.rop-a .a-head h2,.rop-a .a-support h2{text-wrap:balance;hyphens:none;font-family:'Playfair Display',Georgia,serif;font-weight:500;font-size:clamp(2.2rem,4vw,3.6rem);margin:10px 0 0;color:inherit;line-height:1.08}
.rop-a .a-rows{border-top:1px solid #ffffff26}
.rop-a .a-row{display:grid;grid-template-columns:150px 1fr 340px;gap:40px;align-items:center;padding:32px 0;border-bottom:1px solid #ffffff26;color:inherit;text-decoration:none;transition:background .3s}
.rop-a .a-row:hover{background:linear-gradient(90deg,transparent,#ffffff08,transparent)}
.rop-a .a-row time{font-family:'Playfair Display',Georgia,serif;font-style:italic;color:var(--a-gold2);font-size:1.3rem}
.rop-a .a-row h3{font-family:'Playfair Display',Georgia,serif;font-weight:500;font-size:2rem;line-height:1.12;margin:4px 0 0;color:#fff}
.rop-a .a-row p{color:var(--a-mute);margin:8px 0 0;max-width:52ch}
.rop-a .a-tag{font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;color:var(--a-gold);font-weight:700}
.rop-a .a-row img{width:100%;height:auto;aspect-ratio:16/10;object-fit:cover;border-radius:4px;transition:filter .3s}
.rop-a .a-row:hover img{filter:brightness(1.08)}
/* team */
.rop-a .a-ivory{background:var(--a-ivory);color:var(--a-night)}.rop-a .a-ivory .a-eyebrow{color:var(--a-blue)}
.rop-a .a-cast{display:grid;grid-template-columns:repeat(4,1fr);gap:30px 28px}
.rop-a .a-member{display:grid;grid-template-columns:72px 1fr;gap:16px;align-items:center;border-top:1px solid #0A1A3622;padding-top:18px}
.rop-a .a-member img,.rop-a .a-mono{width:72px;height:72px;border-radius:50%;object-fit:cover}
.rop-a .a-mono{display:grid;place-items:center;background:var(--a-blue);color:var(--a-gold);font-family:'Playfair Display',Georgia,serif;font-size:1.5rem}
.rop-a .a-member i{display:block;font-style:normal;font-size:.72rem;letter-spacing:.18em;text-transform:uppercase;color:#7b6a40;font-weight:700}
.rop-a .a-member b{font-family:'Playfair Display',Georgia,serif;font-size:1.25rem;font-weight:500}
/* support */
.rop-a .a-support__grid{display:grid;grid-template-columns:1.1fr 1fr;gap:70px;align-items:center}
.rop-a .a-support h2 em{color:var(--a-gold)}.rop-a .a-support p{color:var(--a-mute);max-width:46ch;margin:22px 0}
.rop-a .a-donate{background:var(--a-deep);border:1px solid #ffffff1f;border-radius:14px;padding:30px;color:#fff}
.rop-a .a-donate input{position:absolute;opacity:0;pointer-events:none}
.rop-a .a-seg{display:grid;grid-template-columns:1fr 1fr;background:#ffffff10;border-radius:999px;padding:4px;margin-bottom:22px}
.rop-a .a-seg label{text-align:center;padding:.6em;border-radius:999px;font-weight:700;cursor:pointer}
.rop-a #a-once:checked~.a-seg label[for=a-once],.rop-a #a-mon:checked~.a-seg label[for=a-mon]{background:var(--a-gold);color:var(--a-night)}
.rop-a #a-once:checked~.a-amts--mon,.rop-a #a-mon:checked~.a-amts--once{display:none}
.rop-a .a-amts{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
.rop-a .a-amts a{border:1px solid #ffffff38;border-radius:10px;padding:16px 0;text-align:center;font-family:'Playfair Display',Georgia,serif;font-size:1.4rem;color:#fff;text-decoration:none;display:flex;flex-direction:column;align-items:center;justify-content:center;transition:border-color .2s,color .2s}
.rop-a .a-amts a:hover{border-color:var(--a-gold);color:var(--a-gold)}.rop-a .a-amts small{font-family:Karla,sans-serif;font-size:.75rem;color:var(--a-mute)}
.rop-a .a-amts .a-amt--txt{font-family:Karla,sans-serif;font-weight:700;font-size:1rem}
.rop-a .a-donate>small{display:block;color:var(--a-mute);margin-top:16px}
/* partners */
.rop-a .a-partners{background:var(--a-night);padding:70px 0;border-top:1px solid #ffffff1f}
.rop-a .a-logos{display:flex;flex-wrap:wrap;gap:14px;margin-top:22px}
.rop-a .a-logos span{background:#fff;border-radius:10px;height:84px;padding:12px 20px;display:grid;place-items:center}.rop-a .a-logos img{max-height:58px;width:auto}
/* footer */
.rop-a .a-footer{background:#06112A;color:var(--a-mute);padding:70px 0 34px;font-size:.95rem}
.rop-a .a-footer__grid{display:grid;grid-template-columns:1.3fr 1fr 1fr;gap:40px}
.rop-a .a-footer__logo{height:150px;width:auto;margin-bottom:14px}
@media (max-width:860px){.rop-a .a-footer__logo{height:120px}}
.rop-a .a-footer ul{list-style:none;padding:0;margin:14px 0 0;line-height:2}.rop-a .a-footer a{color:#fff;text-decoration:none}
.rop-a .a-footer .a-eyebrow{margin-bottom:14px}.rop-a .a-social{display:flex;gap:16px}.rop-a .a-social a{color:var(--a-gold);font-weight:700}
.rop-a .a-footer .a-footer__donate{margin-top:14px;color:var(--a-night);padding:.5em 1.15em;font-size:.88rem}
.rop-a .a-footer__legal{border-top:1px solid #ffffff1a;margin-top:40px;padding-top:22px;font-size:.85rem}
.rop-a .rop-donate-mobile{display:none!important}
/* front page canvas */
.rop-a.home .wp-site-blocks{background:var(--a-night)}.rop-a.home .wp-block-post-content{margin:0}

/* ===== inner pages (existing blocks restyled) ===== */
body.rop-a{--wp--preset--color--base:#FBF8F2;--wp--preset--color--contrast:#16213A;--wp--preset--color--accent-1:#17458F;--wp--preset--color--accent-2:#F7A81B;
 --wp--preset--color--accent-4:#0A1A36;--wp--preset--color--accent-5:#F4EFE6;--wp--preset--color--accent-6:#E6DCC6;background:#FBF8F2;color:#16213A}
.rop-a:not(.home) .wp-site-blocks{background:#FBF8F2}
.rop-a .wp-site-blocks>header.wp-block-template-part{position:sticky;top:0;z-index:50}
.rop-a h1,.rop-a h2,.rop-a h3,.rop-a h4,.rop-a .wp-block-heading{font-family:'Playfair Display',Georgia,serif;font-weight:500;letter-spacing:-.01em}
.rop-a .rop-eyebrow{font-family:Karla,sans-serif;letter-spacing:.3em;font-size:.72rem;color:#B07A12}
.rop-a .rop-pagehero .rop-eyebrow,.rop-a .rop-section--navy .rop-eyebrow,.rop-a .rop-hero .rop-eyebrow{color:var(--a-gold)}
.rop-a .rop-hairline{border-top-color:var(--a-gold)!important;width:56px!important}
/* page header band */
.rop-a .rop-pagehero{background:radial-gradient(ellipse at 80% 0%,#17458F55,transparent 60%),var(--a-night);padding:clamp(4rem,9vw,7rem) var(--wp--preset--spacing--50) clamp(3rem,6vw,4.5rem);position:relative;overflow:hidden}
.rop-a .rop-pagehero:after{content:"";position:absolute;right:-60px;bottom:-60px;width:320px;height:320px;border-radius:50%;border:1px dashed #F7A81B33}
.rop-a .rop-pagehero h1{font-size:clamp(2.4rem,5.4vw,4.4rem);line-height:1.05;color:#fff}
.rop-a .rop-pagehero .rop-lead{color:#C9D3E6;font-size:1.15rem}
/* sections */
.rop-a .rop-section{background:#FBF8F2}
.rop-a .rop-section--cream{background:var(--a-ivory)}
.rop-a .rop-section--navy{background:var(--a-night);color:var(--a-ink)}
.rop-a .rop-section--navy p{color:var(--a-mute)}
.rop-a .rop-section h2{font-size:clamp(1.9rem,3.4vw,2.8rem)}
/* buttons */
.rop-a .wp-element-button,.rop-a .wp-block-button__link{border-radius:999px;font-family:Karla,sans-serif;font-weight:700;background:var(--a-gold);color:var(--a-night)}
.rop-a .wp-element-button:hover,.rop-a .wp-block-button__link:hover{background:var(--a-night);color:#fff}
.rop-a .is-style-outline .wp-block-button__link{background:transparent;border:1.5px solid currentColor;color:var(--a-night)}
.rop-a .rop-section--navy .is-style-outline .wp-block-button__link,.rop-a .rop-hero .is-style-outline .wp-block-button__link{color:#fff}
/* cards & tiles */
.rop-a .rop-tile{background:#fff;border:1px solid var(--wp--preset--color--accent-6);border-top:3px solid var(--a-gold);border-radius:6px}
.rop-a .rop-section--navy .rop-tile{background:#ffffff0a;border-color:#ffffff1f;border-top-color:var(--a-gold)}
.rop-a .rop-impact__item{background:#fff;border:1px solid var(--wp--preset--color--accent-6);border-top:3px solid var(--a-gold)}
.rop-a .rop-impact__item strong{font-family:'Playfair Display',Georgia,serif;font-weight:500;color:var(--a-night)}
/* project hero (single) */
.rop-a .rop-hero .wp-block-cover__background{background:linear-gradient(180deg,rgba(10,26,54,.55),rgba(10,26,54,.92))!important;opacity:1!important}
.rop-a .rop-hero-title{font-family:'Playfair Display',Georgia,serif!important;font-weight:500!important}
/* archive / query cards */
.rop-a .wp-block-post-template .wp-block-post{background:#fff;border:1px solid var(--wp--preset--color--accent-6);border-radius:8px;overflow:hidden;padding-bottom:1.2rem;transition:transform .25s,box-shadow .25s}
.rop-a .wp-block-post-template .wp-block-post:hover{transform:translateY(-3px);box-shadow:0 18px 40px -22px rgba(10,26,54,.45)}
.rop-a .wp-block-post-template .wp-block-post>*:not(.wp-block-post-featured-image){padding-inline:1.2rem}
.rop-a .wp-block-post-featured-image{border-radius:0;margin:0}
.rop-a .rop-card-title a{color:var(--a-night)}
.rop-a .wp-block-post-terms.rop-eyebrow{margin-top:1rem}
/* editions */
.rop-a .rop-edition header{border-top-color:var(--a-gold)}
.rop-a .rop-edition__year{font-family:'Playfair Display',Georgia,serif;font-style:italic;color:#B07A12}
/* team */
.rop-a .rop-member strong{font-family:'Playfair Display',Georgia,serif;font-weight:500;font-size:1.05rem}
.rop-a .rop-monogram{background:var(--a-blue);color:var(--a-gold);font-family:'Playfair Display',Georgia,serif}
.rop-a .rop-timeline b{font-family:'Playfair Display',Georgia,serif;font-weight:500;color:var(--a-blue)}
.rop-a .wp-block-details summary{font-family:'Playfair Display',Georgia,serif;color:var(--a-blue)}
/* donate page */
.rop-a .rop-donate-box{border-top-color:var(--a-gold)}
.rop-a #rop-once:checked~.rop-freq label[for=rop-once],.rop-a #rop-monthly:checked~.rop-freq label[for=rop-monthly]{background:var(--a-night);color:#fff}
.rop-a .rop-amt{font-family:'Playfair Display',Georgia,serif;border-color:#E3C78A}
.rop-a .rop-amt:hover{background:var(--a-night);color:#fff;border-color:var(--a-night)}
.rop-a .rop-iban{background:var(--a-ivory)}
.rop-a .rop-options div{background:var(--a-ivory)}
.rop-a .rop-steps li:before{background:var(--a-night);font-family:'Playfair Display',Georgia,serif}
.rop-a .rop-cta{background:var(--a-night);border-radius:8px}
.rop-a .rop-partners-grid a{border-radius:10px}
.rop-a .rop-partners li{background:#fff}

/* ===== variant „a-dark”: visual pages on night blue, long reading stays ivory ===== */
.rop-a-dark{--dk1:#0A1A36;--dk2:#10264D;--dkline:#ffffff1f}
/* home: committee on deep blue */
.rop-a-dark .a-ivory{background:var(--dk2);color:var(--a-ink)}.rop-a-dark .a-ivory .a-eyebrow{color:var(--a-gold)}
.rop-a-dark .a-ivory .a-member{border-top-color:var(--dkline)}.rop-a-dark .a-ivory .a-member i{color:var(--a-gold2)}.rop-a-dark .a-ivory .a-member b{color:#fff}
.rop-a-dark .a-btn--dark{border-color:#ffffff55;color:#fff}
/* project list + categories */
.rop-a-dark.post-type-archive-proiect .wp-site-blocks,.rop-a-dark.tax-categorie-proiect .wp-site-blocks,
.rop-a-dark.post-type-archive-proiect .rop-section,.rop-a-dark.tax-categorie-proiect .rop-section{background:var(--dk1)}
.rop-a-dark .wp-block-post-template .wp-block-post{background:var(--dk2);border-color:var(--dkline)}
.rop-a-dark .wp-block-post-template .wp-block-post:hover{box-shadow:0 18px 40px -18px #000;border-color:#F7A81B66}
.rop-a-dark .rop-card-title a{color:#fff}.rop-a-dark .wp-block-post-excerpt{color:var(--a-mute)}
.rop-a-dark .wp-block-post-terms.rop-eyebrow a{color:var(--a-gold)}
/* single project: impact, partners, "alte proiecte" dark; story stays ivory */
.rop-a-dark.single-proiect .rop-section--cream{background:var(--dk1);color:var(--a-ink)}
.rop-a-dark.single-proiect .rop-section--cream h2{color:#fff}.rop-a-dark.single-proiect .rop-section--cream .rop-eyebrow{color:var(--a-gold)}
.rop-a-dark .rop-impact__item{background:var(--dk1);border-color:var(--dk1);border-top-color:var(--a-gold)}
.rop-a-dark .rop-impact__item strong{color:var(--a-gold2)}.rop-a-dark .rop-impact__item span{color:var(--a-mute)}
/* team page fully dark */
.rop-a-dark.pg-echipa .wp-site-blocks,.rop-a-dark.pg-echipa .rop-section{background:var(--dk1);color:var(--a-ink)}
.rop-a-dark.pg-echipa .rop-section--cream{background:var(--dk2)}
.rop-a-dark.pg-echipa h2{color:#fff}.rop-a-dark.pg-echipa .rop-eyebrow{color:var(--a-gold)}.rop-a-dark.pg-echipa p{color:var(--a-mute)}
.rop-a-dark.pg-echipa .rop-member strong{color:#fff}.rop-a-dark.pg-echipa .rop-member__role{color:var(--a-gold)}.rop-a-dark.pg-echipa .rop-member__prof{color:var(--a-mute)}
.rop-a-dark.pg-echipa .rop-member img,.rop-a-dark.pg-echipa .rop-monogram{box-shadow:0 0 0 3px var(--dk1),0 0 0 4px var(--a-gold)}
.rop-a-dark.pg-echipa .rop-section--cream .rop-member img,.rop-a-dark.pg-echipa .rop-section--cream .rop-monogram{box-shadow:0 0 0 3px var(--dk2),0 0 0 4px var(--a-gold)}
.rop-a-dark.pg-echipa .rop-timeline{border-left-color:var(--dkline)}.rop-a-dark.pg-echipa .rop-timeline b{color:var(--a-gold2)}.rop-a-dark.pg-echipa .rop-timeline li{color:var(--a-ink)}
.rop-a-dark.pg-echipa .wp-block-details{border-bottom-color:var(--dkline)}.rop-a-dark.pg-echipa .wp-block-details summary{color:var(--a-gold2)}
.rop-a-dark.pg-echipa .wp-block-details p{color:var(--a-ink)}.rop-a-dark.pg-echipa .wp-block-details strong{color:#fff}
/* despre: milestones band dark */
.rop-a-dark.pg-despre .rop-section--cream{background:var(--dk1);color:var(--a-ink)}
.rop-a-dark.pg-despre .rop-section--cream h2{color:#fff}.rop-a-dark.pg-despre .rop-timeline{border-left-color:var(--dkline)}
.rop-a-dark.pg-despre .rop-timeline b{color:var(--a-gold2)}.rop-a-dark.pg-despre .rop-timeline li{color:var(--a-ink)}
/* devino membru: steps band dark */
.rop-a-dark.pg-devino-membru .rop-section--cream{background:var(--dk1);color:var(--a-ink)}
.rop-a-dark.pg-devino-membru .rop-section--cream h2{color:#fff}.rop-a-dark.pg-devino-membru .rop-section--cream .rop-eyebrow{color:var(--a-gold)}
.rop-a-dark.pg-devino-membru .rop-steps b{color:#fff}.rop-a-dark.pg-devino-membru .rop-steps span{color:var(--a-mute)}
.rop-a-dark.pg-devino-membru .rop-steps li:before{background:var(--a-gold);color:var(--dk1)}
.rop-a-dark.pg-devino-membru .rop-section:not(.rop-section--cream):not(.rop-section--navy) .rop-tile{background:#fff}
/* contact: dark */
.rop-a-dark.pg-contact .wp-site-blocks,.rop-a-dark.pg-contact .rop-section{background:var(--dk1)}
.rop-a-dark.pg-contact .rop-tile{background:var(--dk2);border-color:var(--dkline);border-top-color:var(--a-gold);color:var(--a-ink)}
.rop-a-dark.pg-contact .rop-tile h3{color:#fff}.rop-a-dark.pg-contact .rop-tile a{color:var(--a-gold)}

@media (prefers-reduced-motion:reduce){.rop-a .a-hero__img{animation:none}.rop-a .a-hero__img:not(:first-child){display:none}}
@media (max-width:860px){
 .rop-a .a-wrap{padding:0 18px}.rop-a .a-logo img{height:72px}
 .rop-a .a-burger{display:block;width:44px;height:44px;position:relative;cursor:pointer;z-index:3}
 .rop-a .a-burger span,.rop-a .a-burger span:before,.rop-a .a-burger span:after{content:"";position:absolute;left:10px;right:10px;height:2px;background:#fff;top:50%}
 .rop-a .a-burger span:before{top:-8px;left:0;right:0}.rop-a .a-burger span:after{top:8px;left:0;right:0}
 .rop-a .a-menu{position:fixed;inset:0;background:var(--a-night);flex-direction:column;justify-content:center;gap:26px;font-size:1.5rem;transform:translateY(-100%);transition:transform .35s;z-index:2}
 .rop-a .a-menu a:not(.a-ico):not(.a-btn){font-size:1.5rem;font-family:'Playfair Display',Georgia,serif}
 .rop-a .a-menu .a-ico{width:46px;height:46px}.rop-a .a-menu .a-btn{font-family:Karla,sans-serif;font-size:1.1rem}
 .rop-a .a-menu-toggle:checked~.a-menu{transform:none}
 .rop-a .a-menu-toggle:checked~.a-burger{position:fixed;right:18px;top:24px}
 .rop-a .a-menu-toggle:checked~.a-burger span{background:transparent}
 .rop-a .a-menu-toggle:checked~.a-burger span:before{top:0;transform:rotate(45deg)}
 .rop-a .a-menu-toggle:checked~.a-burger span:after{top:0;transform:rotate(-45deg)}
 .rop-a .a-burger span:before,.rop-a .a-burger span:after{transition:transform .25s,top .25s}
 .rop-a .a-hero{min-height:auto;flex-direction:column;align-items:stretch}.rop-a .a-hero__in{padding-top:150px;padding-bottom:40px}
 .rop-a .a-ticket{position:relative;right:auto;bottom:auto;margin:0 18px 34px;transform:none;width:auto}
 .rop-a .a-stats .a-wrap{grid-template-columns:1fr 1fr}.rop-a .a-stats div>div{padding:22px 0 22px 18px}.rop-a .a-stats div>div:nth-child(3){border-left:0;padding-left:0}.rop-a .a-stats b{font-size:2.3rem}
 .rop-a .a-section{padding:64px 0}.rop-a .a-head{flex-direction:column;align-items:flex-start;gap:16px;margin-bottom:32px}
 .rop-a .a-row{grid-template-columns:1fr;gap:12px}.rop-a .a-row img{order:-1}.rop-a .a-row h3{font-size:1.6rem}
 .rop-a .a-cast{grid-template-columns:1fr 1fr;gap:20px 14px}.rop-a .a-member{grid-template-columns:52px 1fr;gap:10px}.rop-a .a-member img,.rop-a .a-mono{width:52px;height:52px}.rop-a .a-member b{font-size:1rem}
 .rop-a .a-support__grid,.rop-a .a-footer__grid{grid-template-columns:1fr;gap:30px}
}
</style>
<?php }, 20);
