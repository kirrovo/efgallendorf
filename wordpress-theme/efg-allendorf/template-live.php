<?php
/**
 * Template Name: Gottesdienst Live
 *
 * @package EFG_Allendorf
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'title'    => 'Gottesdienst Live',
	'subtitle' => 'Jeden Sonntag live auf YouTube – sei dabei, wo immer du bist.',
	'badge'    => '🔴 Livestream',
	'gradient' => 'linear-gradient(135deg, #b71c1c 0%, #e53935 100%)',
	'crumbs'   => array( array( 'label' => 'Gottesdienst Live' ) ),
) );
?>

<section class="section">
	<div class="section-inner">

		<a href="https://www.youtube.com/@efgallendorf/live" target="_blank" rel="noopener noreferrer" class="livestream-wrap" style="display:block; text-decoration:none; cursor:pointer;">
			<div style="position:relative; aspect-ratio:16/9; background:#111; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:20px;">
				<div style="width:80px; height:80px; background:rgba(229,57,53,.9); border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 0 0 0 rgba(229,57,53,.4); animation:pulse-ring 2s ease-out infinite;">
					<svg width="36" height="36" viewBox="0 0 24 24" fill="white"><path d="M8 5v14l11-7z"/></svg>
				</div>
				<div style="text-align:center;">
					<div style="color:#fff; font-size:1.2rem; font-weight:700; margin-bottom:6px;">Jetzt live auf YouTube ansehen</div>
					<div style="color:#aaa; font-size:.88rem;">Klicken zum Öffnen · youtube.com/@efgallendorf</div>
				</div>
			</div>
			<div class="livestream-meta">
				<div class="live-dot"></div>
				<span class="live-label">Live</span>
				<span class="live-sublabel">Sonntags – EFG Allendorf · Öffnet YouTube</span>
			</div>
		</a>

		<div class="info-grid">
			<div class="info-box">
				<h3>🗓 Wann findet der Gottesdienst statt?</h3>
				<p>Jeden <strong>Sonntag</strong> um <strong>10:00 Uhr</strong> beginnt der Gottesdienst im Gemeindehaus Allendorf – und wird gleichzeitig live auf YouTube übertragen.</p>
			</div>
			<div class="info-box">
				<h3>📍 Persönlich dabei sein</h3>
				<p>Du bist herzlich eingeladen, auch persönlich zu kommen!<br>
					<strong>Heimlingstraße 3</strong><br>35753 Greifenstein Allendorf</p>
			</div>
		</div>

		<h2 style="font-size:1.1rem; font-weight:800; color:var(--blau); margin-bottom:16px;">Unser YouTube-Kanal</h2>

		<a href="https://www.youtube.com/@efgallendorf" target="_blank" rel="noopener noreferrer" class="yt-link-box">
			<div class="yt-icon">
				<svg viewBox="0 0 24 24"><path d="M21.58 7.19a2.76 2.76 0 0 0-1.94-1.95C18.01 4.75 12 4.75 12 4.75s-6.01 0-7.64.49A2.76 2.76 0 0 0 2.42 7.19 28.94 28.94 0 0 0 2 12a28.94 28.94 0 0 0 .42 4.81 2.76 2.76 0 0 0 1.94 1.95c1.63.49 7.64.49 7.64.49s6.01 0 7.64-.49a2.76 2.76 0 0 0 1.94-1.95A28.94 28.94 0 0 0 22 12a28.94 28.94 0 0 0-.42-4.81zM10 15.5v-7l6 3.5-6 3.5z"/></svg>
			</div>
			<div class="yt-link-text">
				<strong>youtube.com/@efgallendorf</strong>
				<span>Livestreams, Predigten und alle vergangenen Gottesdienste</span>
			</div>
		</a>

		<div class="archive-hint">
			<strong>Verpasst?</strong> Alle vergangenen Gottesdienste sind nach dem Livestream als Video auf unserem YouTube-Kanal verfügbar und können jederzeit nachgeschaut werden.
		</div>

	</div>
</section>

<?php
get_footer();
