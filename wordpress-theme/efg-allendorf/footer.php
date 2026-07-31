<?php
/**
 * Footer: abgerundete Karte, vier Spalten, Konturschriftzug.
 *
 * @package EFG_Allendorf
 */

$wer     = get_page_by_path( 'wer-wir-sind' );
$intern  = get_page_by_path( 'intern' );
$impr    = get_page_by_path( 'impressum' );
$daten   = get_page_by_path( 'datenschutz' );
$kal     = get_page_by_path( 'kalender' );

$wer_url     = $wer ? get_permalink( $wer ) : '#';
$intern_url  = $intern ? get_permalink( $intern ) : '#';
$impr_url    = $impr ? get_permalink( $impr ) : '#';
$daten_url   = $daten ? get_permalink( $daten ) : '#';
$kal_url     = $kal ? get_permalink( $kal ) : '#';
$gruppen_url = get_post_type_archive_link( 'gruppe' );
?>

</main>

<footer id="site-footer">
	<div class="footer-karte">
		<div class="footer-inner">
			<div class="footer-grid">
				<div class="footer-brand">
					<div class="footer-brand-kopf">
						<?php efga_ico( 'kirche' ); ?>
						<strong>EFG Allendorf</strong>
					</div>
					<p>Eine Gemeinschaft von Menschen, die Gott suchen und füreinander da sind, in Allendorf und Umgebung.</p>
				</div>

				<div class="footer-col">
					<h4>Gemeinde</h4>
					<a href="<?php echo esc_url( $wer_url ); ?>">Wer wir sind</a>
					<a href="<?php echo esc_url( $wer_url ); ?>#glaube">Glaubensbekenntnis</a>
					<a href="<?php echo esc_url( $wer_url ); ?>#leitbild">Leitbild</a>
					<a href="<?php echo esc_url( $wer_url ); ?>#chronik">Chronik</a>
				</div>

				<div class="footer-col">
					<h4>Angebote</h4>
					<a href="<?php echo esc_url( home_url( '/#veranstaltungen' ) ); ?>">Veranstaltungen</a>
					<a href="<?php echo esc_url( $gruppen_url ); ?>">Gruppen</a>
					<a href="<?php echo esc_url( home_url( '/#predigten' ) ); ?>">Predigten</a>
					<a href="<?php echo esc_url( $kal_url ); ?>">Kalender</a>
				</div>

				<div class="footer-col">
					<h4>Kontakt</h4>
					<ul class="footer-kontakt">
						<li><?php efga_ico( 'ort' ); ?><span>Heimlingstraße 3<br />35753 Greifenstein-Allendorf</span></li>
						<li><?php efga_ico( 'mail' ); ?><?php efga_email( 'info@eg-allendorf.de' ); ?></li>
						<li><?php efga_ico( 'uhr' ); ?><span>Sonntags 10:00 Uhr</span></li>
					</ul>
				</div>
			</div>

			<hr class="footer-trenner" />

			<div class="footer-bottom">
				<div class="footer-social">
					<a href="https://www.youtube.com/@efgallendorf" target="_blank" rel="noopener noreferrer" aria-label="Gemeinde auf YouTube"><?php efga_ico( 'youtube' ); ?></a>
					<a href="#" class="ob-email" data-nur-icon data-em="<?php echo esc_attr( base64_encode( 'info@eg-allendorf.de' ) ); ?>" rel="nofollow" aria-label="E-Mail an die Gemeinde"><?php efga_ico( 'mail' ); ?></a>
				</div>
				<span>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Evangelische Freie Gemeinde Allendorf</span>
				<div class="footer-rechtliches">
					<a href="<?php echo esc_url( $intern_url ); ?>">Interner Bereich</a>
					<a href="<?php echo esc_url( $impr_url ); ?>">Impressum</a>
					<a href="<?php echo esc_url( $daten_url ); ?>">Datenschutzerklärung</a>
				</div>
			</div>
		</div>

		<?php
		/* Konturschriftzug: farbige Linie folgt dem Zeiger, siehe effekte.js */
		?>
		<div class="footer-schriftzug" data-schriftzug aria-hidden="true">
			<svg viewBox="0 0 300 100" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
				<defs>
					<linearGradient id="ft-farbe" gradientUnits="userSpaceOnUse" x1="0" y1="0" x2="300" y2="0">
						<stop offset="0%" stop-color="#1e5aa8" />
						<stop offset="50%" stop-color="#2f76cc" />
						<stop offset="100%" stop-color="#8fb8f5" />
					</linearGradient>
					<radialGradient id="ft-maske-verlauf" gradientUnits="userSpaceOnUse" r="46" cx="150" cy="50">
						<stop offset="0%" stop-color="white" />
						<stop offset="100%" stop-color="black" />
					</radialGradient>
					<mask id="ft-maske">
						<rect x="0" y="0" width="300" height="100" fill="url(#ft-maske-verlauf)" />
					</mask>
				</defs>
				<text class="ft-basis" x="150" y="50" text-anchor="middle" dominant-baseline="middle">EFG ALLENDORF</text>
				<text class="ft-linie" x="150" y="50" text-anchor="middle" dominant-baseline="middle">EFG ALLENDORF</text>
				<text class="ft-spur" x="150" y="50" text-anchor="middle" dominant-baseline="middle" mask="url(#ft-maske)">EFG ALLENDORF</text>
			</svg>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
