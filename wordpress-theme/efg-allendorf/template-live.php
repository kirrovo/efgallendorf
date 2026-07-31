<?php
/**
 * Template Name: Gottesdienst Live
 *
 * @package EFG_Allendorf
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'title'    => 'Gottesdienst Live',
	'subtitle' => 'Jeden Sonntag live auf YouTube, sei dabei, wo immer du bist.',
	'badge'    => 'Livestream',
	'crumbs'   => array( array( 'label' => 'Gottesdienst Live' ) ),
) );
?>

<section class="section">
	<div class="section-inner">

		<a href="https://www.youtube.com/@efgallendorf/live" target="_blank" rel="noopener noreferrer"
		   class="livestream-wrap" style="display:block;">
			<div class="livestream-buehne">
				<span class="livestream-play"><?php efga_ico( 'play' ); ?></span>
				<div>
					<strong>Jetzt live auf YouTube ansehen</strong>
					<span>Öffnet youtube.com/@efgallendorf in einem neuen Tab</span>
				</div>
			</div>
			<div class="livestream-meta">
				<span class="live-dot" aria-hidden="true"></span>
				<span class="live-label">Live</span>
				<span class="live-sublabel">Sonntags, EFG Allendorf</span>
			</div>
		</a>

		<div class="info-grid">
			<div class="info-box">
				<h3>Wann findet der Gottesdienst statt?</h3>
				<p>Jeden <strong>Sonntag</strong> um <strong>10:00 Uhr</strong> beginnt der Gottesdienst im Gemeindehaus Allendorf. Gleichzeitig läuft die Live-Übertragung auf YouTube.</p>
			</div>
			<div class="info-box">
				<h3>Persönlich dabei sein</h3>
				<p>Du bist herzlich eingeladen, auch persönlich zu kommen.<br>
					<strong>Heimlingstraße 3</strong><br>35753 Greifenstein-Allendorf</p>
			</div>
		</div>

		<h2 style="margin-bottom:18px;">Unser YouTube-Kanal</h2>

		<a href="https://www.youtube.com/@efgallendorf" target="_blank" rel="noopener noreferrer" class="yt-link-box">
			<span class="yt-icon"><?php efga_ico( 'youtube' ); ?></span>
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
