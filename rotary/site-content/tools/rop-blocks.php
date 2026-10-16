<?php
/**
 * Plugin Name: Rotary Opera — elemente site
 * Description: Shortcode-uri pentru câmpurile SCF (impact, galerie, parteneri, echipă). Designul se editează din Aspect → Editor.
 */
defined('ABSPATH') || exit;

add_shortcode('rop_impact', function () {
	$rows = get_field('impact');
	if (!$rows) return '';
	$h = '<div class="rop-impact">';
	foreach ($rows as $r) $h .= '<div class="rop-impact__item"><strong>' . esc_html($r['valoare']) . '</strong><span>' . esc_html($r['eticheta']) . '</span></div>';
	return $h . '</div>';
});

add_shortcode('rop_galerie', function () {
	$ids = get_field('galerie');
	if (!$ids) return '';
	$h = '<h2 class="wp-block-heading">Galerie</h2><div class="rop-gallery">';
	foreach ($ids as $id) $h .= '<a href="' . esc_url(wp_get_attachment_image_url($id, 'full')) . '" target="_blank">' . wp_get_attachment_image($id, 'medium_large', false, ['loading' => 'lazy']) . '</a>';
	return $h . '</div>';
});

add_shortcode('rop_parteneri', function () {
	$p = trim((string) get_field('parteneri'));
	if (!$p) return '';
	$h = '<div class="rop-partners"><div class="rop-eyebrow">Parteneri</div><ul>';
	foreach (preg_split('/\R/', $p) as $l) if (trim($l)) $h .= '<li>' . esc_html(trim($l)) . '</li>';
	return $h . '</ul></div>';
});

add_shortcode('rop_meta', function () {
	$an = get_field('an'); $st = get_field_object('status');
	$cats = get_the_term_list(get_the_ID(), 'categorie-proiect', '', ' · ');
	$bits = array_filter([$an ? esc_html($an) : '', $st && $st['value'] ? esc_html($st['choices'][$st['value']]) : '', $cats ? wp_strip_all_tags($cats) : '']);
	return '<div class="rop-eyebrow">' . implode(' · ', $bits) . '</div>';
});


// [rop_editii] — recurring projects: one section per edition, newest first
add_shortcode('rop_editii', function () {
	$rows = get_field('editii');
	if (!$rows) return '';
	usort($rows, fn($a, $b) => strcmp((string) $b['an'], (string) $a['an']));
	$h = '<div class="rop-editions">';
	foreach ($rows as $r) {
		$an = (string) $r['an']; // "2025" or an ISO date "2025-11-26" (shown as "nov. 2025")
		$label = preg_match('/^\d{4}-\d{2}(-\d{2})?$/', $an) ? date_i18n('M Y', strtotime(strlen($an) === 7 ? $an . '-01' : $an)) : $an;
		$h .= '<section class="rop-edition"><header><meta charset="utf-8"><span class="rop-edition__year' . ($label !== $an ? ' rop-edition__year--date' : '') . '">' . esc_html($label) . '</span><div><h2 class="wp-block-heading">' . esc_html($r['titlu'] ?: 'Ediția ' . $r['an']) . '</h2>'
			. ($r['detalii'] ? '<p class="rop-edition__meta">' . esc_html($r['detalii']) . '</p>' : '') . '</div></header>'
			. '<div class="rop-edition__text">' . wp_kses_post(wpautop($r['text'])) . '</div>';
		$r['galerie'] = array_filter((array) $r['galerie']);
		if ($r['galerie']) {
			$h .= '<div class="rop-gallery">';
			foreach ($r['galerie'] as $id) $h .= '<a href="' . esc_url(wp_get_attachment_image_url($id, 'full')) . '" target="_blank">' . wp_get_attachment_image($id, 'medium_large', false, ['loading' => 'lazy']) . '</a>';
			$h .= '</div>';
		}
		$h .= '</section>';
	}
	return $h . '</div>';
});

add_shortcode('rop_doneaza', function () {
	$link = get_field('link_donatie') ?: home_url('/doneaza/');
	return '<div class="rop-cta"><h3>Susține proiectele noastre</h3><p>Fiecare leu ajunge într-un proiect concret pentru comunitatea din Cluj.</p><a class="wp-element-button" href="' . esc_url($link) . '">Donează</a></div>';
});

// [rop_echipa tip="comitet|membri"]
add_shortcode('rop_echipa', function ($a) {
	$a = shortcode_atts(['tip' => 'membri'], $a);
	$q = get_posts(['post_type' => 'membru', 'numberposts' => -1, 'orderby' => ['menu_order' => 'ASC', 'title' => 'ASC'],
		'meta_query' => [['key' => 'activ', 'value' => '1']]]);
	$q = array_filter($q, function ($m) use ($a) {
		$on = (bool) get_field('onoare', $m->ID); $rol = (bool) get_field('rol', $m->ID);
		if ($a['tip'] === 'onoare') return $on;
		return !$on && ($a['tip'] === 'comitet' ? $rol : true);
	});
	if (!$q) return '';
	if ($a['tip'] !== 'comitet') usort($q, fn($x, $y) => strcasecmp(remove_accents($x->post_title), remove_accents($y->post_title)));
	$h = '<div class="rop-team rop-team--' . esc_attr($a['tip']) . '">';
	foreach ($q as $m) {
		$rol = get_field('rol', $m->ID); $prof = get_field('profesie', $m->ID);
		$init = implode('', array_map(fn($w) => mb_substr($w, 0, 1), array_slice(explode(' ', $m->post_title), 0, 2)));
		$img = has_post_thumbnail($m) ? get_the_post_thumbnail($m, 'medium', ['loading' => 'lazy']) : '<span class="rop-monogram">' . esc_html($init) . '</span>';
		$h .= '<div class="rop-member">' . $img . '<strong>' . esc_html($m->post_title) . '</strong>'
			. ($rol && $a['tip'] === 'comitet' ? '<span class="rop-member__role">' . esc_html($rol) . '</span>' : '')
			. ($prof ? '<span class="rop-member__prof">' . esc_html($prof) . '</span>' : '')
			. (($din = get_field('membru_din', $m->ID)) && $a['tip'] !== 'onoare' ? '<span class="rop-member__prof">membru din ' . esc_html($din) . '</span>' : '')
			. '</div>';
	}
	return $h . '</div>';
});


// Hardening + SEO housekeeping
add_filter('xmlrpc_enabled', '__return_false');
add_filter('register_post_type_args', function ($args, $type) {
	// member cards live only on /echipa/ — no standalone public pages
	if ($type === 'membru') { $args['public'] = false; $args['publicly_queryable'] = false; $args['has_archive'] = false; $args['show_ui'] = true; $args['show_in_rest'] = true; $args['show_in_menu'] = true; $args['exclude_from_search'] = true; }
	return $args;
}, 20, 2);
add_filter('wp_sitemaps_add_provider', fn($p, $name) => $name === 'users' ? false : $p, 10, 2);


// "Alte proiecte" loop on a project page: never list the project you are on
add_filter('query_loop_block_query_vars', function ($q) {
	if (is_singular('proiect') && ($q['post_type'] ?? '') === 'proiect') $q['post__not_in'] = array_merge($q['post__not_in'] ?? [], [get_queried_object_id()]);
	return $q;
});


// show every project on /proiecte/ and category pages (no pagination)
add_action('pre_get_posts', function ($q) {
	if (!is_admin() && $q->is_main_query() && ($q->is_post_type_archive('proiect') || $q->is_tax('categorie-proiect'))) $q->set('posts_per_page', 100);
});

add_action('wp_head', function () { ?>
<style>
.rop-eyebrow{text-transform:uppercase;letter-spacing:.18em;font-size:.78rem;font-weight:700;color:var(--wp--preset--color--accent-2)}
.rop-impact{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:1rem;margin:2rem 0}
.rop-impact__item{background:var(--wp--preset--color--accent-5);border-top:3px solid var(--wp--preset--color--accent-2);padding:1.25rem;border-radius:4px}
.rop-impact__item strong{display:block;font-family:var(--wp--preset--font-family--literata);font-size:2rem;color:var(--wp--preset--color--accent-1);line-height:1.1}
.rop-impact__item span{color:var(--wp--preset--color--muted);font-size:.95rem}
.rop-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:.5rem}
.rop-gallery img{width:100%;height:180px;object-fit:cover;border-radius:4px;transition:transform .3s}
.rop-gallery a:hover img{transform:scale(1.03)}
.rop-partners ul{list-style:none;padding:0;display:flex;flex-wrap:wrap;gap:.5rem;margin-top:.75rem}
.rop-partners li{border:1px solid var(--wp--preset--color--accent-6);padding:.35em .9em;border-radius:999px;font-size:.9rem}
.rop-cta{background:var(--wp--preset--color--accent-4);color:#fff;padding:2rem;border-radius:6px;margin:2.5rem 0}
.rop-cta h3{color:#fff;margin:0 0 .5rem}.rop-cta p{color:#d9e2f2}
.rop-team{display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:1.75rem 1.25rem}
.rop-member{text-align:center;display:flex;flex-direction:column;align-items:center;gap:.2rem}
.rop-member img,.rop-monogram{width:128px;height:128px;border-radius:50%;object-fit:cover;margin-bottom:.6rem;box-shadow:0 0 0 3px var(--wp--preset--color--base),0 0 0 4px var(--wp--preset--color--accent-2)}
.rop-monogram{display:grid;place-items:center;background:var(--wp--preset--color--accent-1);color:var(--wp--preset--color--accent-2);font-family:var(--wp--preset--font-family--literata);font-size:2.4rem}
.rop-member__role{color:var(--wp--preset--color--accent-1);font-weight:700;font-size:.9rem}
.rop-team--onoare{grid-template-columns:repeat(auto-fill,minmax(140px,1fr))}.rop-team--onoare img,.rop-team--onoare .rop-monogram{width:88px;height:88px;font-size:1.6rem}
.rop-member__prof{color:var(--wp--preset--color--muted);font-size:.85rem}
.rop-badge{font-size:.7rem;text-transform:uppercase;letter-spacing:.08em;color:var(--wp--preset--color--accent-4);background:var(--wp--preset--color--accent-5);padding:.15em .6em;border-radius:999px;margin-top:.2rem}
.rop-header{background:#fff!important;border-bottom:1px solid var(--wp--preset--color--accent-6)}
.rop-wordmark a{text-decoration:none;color:var(--wp--preset--color--accent-1);line-height:1.1;display:inline-block}
.rop-wordmark b{font-size:1.45rem;font-weight:800;letter-spacing:-.01em}
.rop-wordmark span{display:block;font-size:.72rem;letter-spacing:.14em;text-transform:uppercase;color:var(--wp--preset--color--accent-4)}
.wp-block-post-template .wp-block-post-featured-image img{transition:transform .5s ease}
.wp-block-post-template .wp-block-post:hover .wp-block-post-featured-image img{transform:scale(1.04)}
.wp-block-post-featured-image{overflow:hidden;border-radius:6px}
@media (max-width:781px){.rop-donate-mobile{position:fixed;left:12px;right:12px;bottom:12px;z-index:60;text-align:center}.rop-donate-mobile a{display:block}}
@media (min-width:782px){.rop-donate-mobile{display:none}}
.rop-main{margin-top:0!important}
.rop-main > .wp-block-post-content > *{margin-block-start:0}
.rop-section{padding:clamp(3rem,7vw,6rem) var(--wp--preset--spacing--50)}
.rop-section--tight{padding-block:2.5rem}
.rop-section--cream{background:var(--wp--preset--color--accent-5)}
.rop-section--navy{background:var(--wp--preset--color--accent-4);color:#fff}
.rop-section--navy :where(h1,h2,h3,h4){color:#fff}
.rop-section--navy p{color:#d9e2f2}
.rop-section > *{max-width:1200px;margin-inline:auto}
.rop-section > .wp-block-heading,.rop-section > p,.rop-section > .rop-hairline{max-width:1200px}
.rop-hairline{border:0!important;border-top:2px solid var(--wp--preset--color--accent-2)!important;width:64px!important;margin:1rem 0 2rem!important;opacity:1}
.rop-section > .rop-hairline{margin-inline:max(0px,calc((100% - 1200px)/2))!important}
.rop-hero{padding-inline:var(--wp--preset--spacing--50)}
.rop-hero .wp-block-cover__inner-container{max-width:1200px;margin-inline:auto;width:100%}
.rop-hero-title{font-size:clamp(2.4rem,6vw,4.6rem)!important;max-width:14ch;color:#fff!important;margin:.4rem 0 1rem}
.rop-lead{font-size:clamp(1.1rem,2vw,1.35rem);max-width:46ch;opacity:.92}
.rop-hero .is-style-outline .wp-block-button__link{color:#fff;border-color:#fff;background:transparent}
.rop-hero .wp-block-post-excerpt__more-link{display:none}
.rop-pagehero{background:var(--wp--preset--color--accent-4);color:#fff;padding:clamp(3.5rem,8vw,6.5rem) var(--wp--preset--spacing--50) clamp(2.5rem,5vw,4rem)}
.rop-pagehero > *{max-width:1200px;margin-inline:auto}
.rop-pagehero h1{color:#fff;font-size:clamp(2.2rem,5vw,3.8rem);margin:.4rem auto 1rem;text-wrap:balance}
.rop-pagehero .rop-lead{color:#d9e2f2}
.rop-stats{gap:1rem!important}
.rop-stat strong{display:block;font-family:var(--wp--preset--font-family--literata);font-size:clamp(2.2rem,4vw,3.2rem);color:var(--wp--preset--color--accent-1);line-height:1}
.rop-stat span{color:var(--wp--preset--color--muted)}
.rop-stat{border-left:2px solid var(--wp--preset--color--accent-2);padding-left:1rem}
.rop-feature-img{width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:6px;box-shadow:0 20px 50px -20px rgba(11,37,82,.35)}
.rop-tile{background:var(--wp--preset--color--base);border:1px solid var(--wp--preset--color--accent-6);border-top:3px solid var(--wp--preset--color--accent-2);border-radius:6px;padding:1.75rem!important;display:flex;flex-direction:column}
.rop-tile .wp-block-buttons{margin-top:auto;padding-top:1rem}
.rop-section--navy .rop-tile{background:rgba(255,255,255,.06);border-color:rgba(255,255,255,.14);border-top-color:var(--wp--preset--color--accent-2)}
.rop-card-title a{text-decoration:none;color:var(--wp--preset--color--accent-4)}
.rop-card-title{font-size:1.3rem!important;margin-top:.8rem!important}
.wp-block-post-terms.rop-eyebrow a{text-decoration:none;color:var(--wp--preset--color--accent-2)}
.wp-block-post-template.is-layout-grid{gap:2.5rem 2rem}
.rop-logos{list-style:none;padding:0;display:flex;flex-wrap:wrap;gap:.6rem 2rem;margin-top:1rem;font-family:var(--wp--preset--font-family--literata);font-size:1.1rem;color:var(--wp--preset--color--accent-4)}
.rop-logos a{color:inherit;text-decoration:none;border-bottom:1px solid transparent;transition:border-color .2s,color .2s}.rop-logos a:hover{color:var(--wp--preset--color--accent-1);border-bottom-color:var(--wp--preset--color--accent-2)}

.rop-logo img{height:auto;width:190px;max-width:100%}@media (max-width:781px){.rop-logo img{width:150px}}
.rop-footer-logo{margin:0 0 1rem}
.rop-social{display:flex;gap:1rem;margin-top:.5rem}.rop-social a{color:#fff;font-weight:600}
.rop-iban{background:var(--wp--preset--color--accent-5);border-radius:6px;padding:1.1rem 1.2rem;display:grid;gap:.15rem;margin:.5rem 0 1rem}
.rop-iban span{font-size:.75rem;text-transform:uppercase;letter-spacing:.12em;color:var(--wp--preset--color--muted);margin-top:.4rem}
.rop-iban strong{color:var(--wp--preset--color--accent-4)}
.rop-iban__nr{font-family:ui-monospace,Menlo,monospace;font-size:1.1rem;letter-spacing:.04em}
.rop-iban button{justify-self:start;margin-top:.6rem;border:1px solid var(--wp--preset--color--accent-1);background:transparent;color:var(--wp--preset--color--accent-1);border-radius:999px;padding:.4em 1em;font-weight:700;cursor:pointer}
.rop-iban button:hover{background:var(--wp--preset--color--accent-1);color:#fff}
.rop-note{font-size:.85rem;color:var(--wp--preset--color--muted)}
.rop-prose > *{max-width:760px!important}
.rop-prose > .rop-hairline{margin-inline:max(0px,calc((100% - 760px)/2))!important}
.rop-topbar{height:48px;box-sizing:border-box}
header.wp-block-template-part{position:sticky;top:-48px;z-index:50}
body.admin-bar header.wp-block-template-part{top:-16px}
.rop-topbar{background:var(--wp--preset--color--accent-4);color:#fff;font-size:.85rem;padding:.45rem var(--wp--preset--spacing--50)}
.rop-topbar__in{max-width:1200px;margin:0 auto;display:flex;justify-content:flex-end;align-items:center;gap:1rem}
.rop-topbar a{color:#fff;text-decoration:none}.rop-topbar b{font-weight:600;opacity:.75;font-size:.75rem;letter-spacing:.06em}
.rop-topbar__right{display:flex;align-items:center;gap:.6rem}.rop-topbar__mail{margin-right:.6rem}
.rop-ico{width:34px;height:34px;border:2px solid var(--wp--preset--color--accent-2);border-radius:50%;display:inline-grid;place-items:center;color:#fff;transition:background .2s,color .2s}
.rop-ico svg{width:17px;height:17px}.rop-ico:hover{background:var(--wp--preset--color--accent-2);color:var(--wp--preset--color--accent-4)}
@media (max-width:781px){.rop-topbar__mail,.rop-topbar__meet{display:none}.rop-topbar__in{justify-content:flex-end}.rop-ico{width:30px;height:30px}}
.rop-social{gap:.6rem!important;margin-top:.9rem!important}
.rop-partners-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:1.25rem;margin-top:1.25rem;align-items:center}
.rop-partners-grid a{display:grid;place-items:center;height:140px;padding:18px 22px;background:#fff;border:1px solid var(--wp--preset--color--accent-6);border-radius:8px;text-decoration:none;transition:border-color .2s,box-shadow .2s,transform .2s}
.rop-partners-grid img{max-height:96px;max-width:100%;width:auto;object-fit:contain}
.rop-partners-grid span{font-family:var(--wp--preset--font-family--literata);font-weight:600;font-size:1.35rem;color:var(--wp--preset--color--accent-4);text-align:center;line-height:1.2}
.rop-partners-grid a:hover{border-color:var(--wp--preset--color--accent-2);box-shadow:0 8px 24px -12px rgba(11,37,82,.3);transform:translateY(-2px)}
.rop-partners-grid a:hover span{color:var(--wp--preset--color--accent-1)}
.rop-editions{max-width:720px;margin:3rem auto 0;display:grid;gap:3rem}
.rop-edition header{display:flex;gap:1.25rem;align-items:baseline;border-top:2px solid var(--wp--preset--color--accent-2);padding-top:1.25rem;margin-bottom:1rem}
.rop-edition__year{font-family:var(--wp--preset--font-family--literata);font-size:clamp(2rem,4vw,3rem);color:var(--wp--preset--color--accent-2);line-height:1}
.rop-edition__year--date{font-size:clamp(1.3rem,2.4vw,1.7rem)!important;white-space:nowrap;min-width:5.5em}
.rop-edition h2{margin:0;font-size:clamp(1.4rem,2.4vw,1.9rem)}
.rop-edition__meta{margin:.35rem 0 0;color:var(--wp--preset--color--muted);font-weight:600}
.rop-edition__text{max-width:720px}
.rop-edition .rop-gallery{margin-top:1.25rem;grid-template-columns:repeat(auto-fill,minmax(150px,1fr))}.rop-edition .rop-gallery img{height:140px}
.rop-steps{list-style:none;counter-reset:s;padding:0;display:grid;gap:1.25rem;max-width:760px}
.rop-steps li{counter-increment:s;display:grid;grid-template-columns:3rem 1fr;column-gap:1rem;align-items:start}
.rop-steps li:before{content:counter(s);grid-row:span 2;width:2.6rem;height:2.6rem;border-radius:50%;background:var(--wp--preset--color--accent-1);color:var(--wp--preset--color--accent-2);display:grid;place-items:center;font-family:var(--wp--preset--font-family--literata);font-size:1.3rem}
.rop-steps b{font-family:var(--wp--preset--font-family--literata);font-size:1.2rem;color:var(--wp--preset--color--accent-4)}
.rop-steps span{color:var(--wp--preset--color--contrast)}
/* project pages: justified text with Romanian hyphenation (desktop only) */
@media (min-width:782px){body.single-proiect .wp-block-post-content p,body.single-proiect .rop-edition__text p{text-align:justify;hyphens:auto;-webkit-hyphens:auto;hyphenate-limit-chars:7 3 3}}
.rop-donate-box{background:var(--wp--preset--color--base);border:1px solid var(--wp--preset--color--accent-6);border-top:3px solid var(--wp--preset--color--accent-2);border-radius:8px;padding:1.5rem}
.rop-donate-box input{position:absolute;opacity:0;pointer-events:none}
.rop-freq{display:grid;grid-template-columns:1fr 1fr;background:var(--wp--preset--color--accent-5);border-radius:999px;padding:4px;margin-bottom:1.25rem}
.rop-freq label{text-align:center;padding:.6em;border-radius:999px;font-weight:700;cursor:pointer;color:var(--wp--preset--color--accent-4)}
#rop-once:checked~.rop-freq label[for=rop-once],#rop-monthly:checked~.rop-freq label[for=rop-monthly]{background:var(--wp--preset--color--accent-1);color:#fff}
#rop-once:focus-visible~.rop-freq label[for=rop-once],#rop-monthly:focus-visible~.rop-freq label[for=rop-monthly]{outline:2px solid var(--wp--preset--color--accent-2)}
.rop-amts{display:grid;grid-template-columns:repeat(auto-fill,minmax(110px,1fr));gap:.6rem}
#rop-once:checked~.rop-amts--monthly,#rop-monthly:checked~.rop-amts--once{display:none}
.rop-amt{display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:64px;border:2px solid var(--wp--preset--color--accent-2);border-radius:10px;font-family:var(--wp--preset--font-family--literata);font-size:1.35rem;color:var(--wp--preset--color--accent-4);text-decoration:none;transition:background .15s,transform .15s}
.rop-amt small{font-family:var(--wp--preset--font-family--manrope);font-size:.75rem;color:var(--wp--preset--color--muted)}
.rop-amt:hover{background:var(--wp--preset--color--accent-2);transform:translateY(-2px)}
.rop-amt--other{font-size:1rem;font-family:var(--wp--preset--font-family--manrope);font-weight:700}
.rop-donate-note{font-size:.85rem;color:var(--wp--preset--color--muted);margin-top:1rem}
.rop-pcards{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:1.25rem}
.rop-pcard{display:flex;flex-direction:column;gap:.3rem;text-decoration:none;color:inherit}
.rop-pcard img{width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:6px;margin-bottom:.5rem}
.rop-pcard b{font-family:var(--wp--preset--font-family--literata);font-size:1.15rem;color:var(--wp--preset--color--accent-4)}
.rop-pcard span{color:var(--wp--preset--color--muted);font-size:.95rem}
.rop-options{display:grid;gap:.75rem;margin:.5rem 0 1rem}
.rop-options div{background:var(--wp--preset--color--accent-5);border-left:3px solid var(--wp--preset--color--accent-2);border-radius:4px;padding:.85rem 1rem;display:grid;gap:.25rem}
.rop-options b{font-family:var(--wp--preset--font-family--literata);color:var(--wp--preset--color--accent-4);font-size:1.05rem}
/* Donează: tighter, continuous sections */
body.page-id-286 .wp-block-post-content > .rop-section{padding-block:clamp(1.75rem,3.5vw,2.75rem)}
body.page-id-286 .wp-block-post-content > .rop-section:first-of-type{padding-top:clamp(2.5rem,5vw,3.5rem)}
body.page-id-286 .wp-block-post-content > .rop-section--cream{background:transparent}
body.page-id-286 .wp-block-post-content > .rop-section + .rop-section{border-top:1px solid var(--wp--preset--color--accent-6)}
@media (max-width:781px){.rop-edition header{flex-direction:column;gap:.35rem}.rop-edition__year--date{min-width:0!important}.rop-edition header>div{min-width:0}}
.rop-timeline{list-style:none;padding:0;border-left:2px solid var(--wp--preset--color--accent-6);margin-left:.4rem}
.rop-timeline li{position:relative;padding:0 0 1.4rem 1.6rem}
.rop-timeline li:before{content:"";position:absolute;left:-7px;top:.45em;width:12px;height:12px;border-radius:50%;background:var(--wp--preset--color--accent-2)}
.rop-timeline b{display:block;font-family:var(--wp--preset--font-family--literata);color:var(--wp--preset--color--accent-1);font-size:1.1rem}
.rop-timeline--compact li{padding-bottom:.9rem}
.wp-block-details{border-bottom:1px solid var(--wp--preset--color--accent-6);padding:.7rem 0}
.wp-block-details summary{font-family:var(--wp--preset--font-family--literata);font-size:1.15rem;color:var(--wp--preset--color--accent-1);cursor:pointer}
.rop-header__inner{justify-content:space-between;flex-wrap:nowrap}
.rop-header{padding:.8rem var(--wp--preset--spacing--50)}
.rop-header__right{gap:1.5rem;flex-wrap:nowrap}
.rop-nav{font-weight:600;font-size:.95rem}
.rop-nav a{color:var(--wp--preset--color--accent-4)}
.rop-nav .wp-block-navigation__responsive-container.is-menu-open{padding:2rem 1.5rem;background:#fff}
.rop-nav .is-menu-open .wp-block-navigation__container{gap:1.25rem;font-size:1.35rem;font-family:var(--wp--preset--font-family--literata)}
.rop-donate .wp-block-button__link{padding:.55em 1.3em;font-size:.95rem}
@media (max-width:781px){.rop-header .rop-donate{display:none}}
.rop-footer{background:var(--wp--preset--color--accent-4);color:#c9d4ea;padding:4rem var(--wp--preset--spacing--50) 2rem;margin-top:0!important}
.rop-footer > *{max-width:1200px;margin-inline:auto}
.rop-footer h4{color:var(--wp--preset--color--accent-2);font-family:var(--wp--preset--font-family--manrope);text-transform:uppercase;letter-spacing:.14em;font-size:.8rem}
.rop-footer a{color:#fff}
.rop-footer-links{list-style:none;padding:0;line-height:2}
.rop-footer-links a{text-decoration:none}
.rop-footer .is-style-outline .wp-block-button__link{color:#fff;border-color:rgba(255,255,255,.5)}
.rop-footer-legal{border-top:1px solid rgba(255,255,255,.12);padding-top:1.5rem;margin-top:2.5rem!important;font-size:.85rem}
.rop-wordmark--light a{color:#fff}.rop-wordmark--light span{color:var(--wp--preset--color--accent-2)}
body{overflow-x:hidden}

</style>
<?php });
