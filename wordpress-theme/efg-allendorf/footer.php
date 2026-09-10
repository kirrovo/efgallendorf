<?php
/**
 * Footer: abgerundete Karte mit vier Spalten.
 *
 * @package EFG_Allendorf
 */

$wer     = get_page_by_path( 'wer-wir-sind' );
$impr    = get_page_by_path( 'impressum' );
$daten   = get_page_by_path( 'datenschutz' );
$kal     = get_page_by_path( 'kalender' );

$wer_url     = $wer ? get_permalink( $wer ) : '#';
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
					<h2>Gemeinde</h2>
					<a href="<?php echo esc_url( $wer_url ); ?>">Wer wir sind</a>
					<a href="<?php echo esc_url( $wer_url ); ?>#glaube">Glaubensbekenntnis</a>
					<a href="<?php echo esc_url( $wer_url ); ?>#leitbild">Leitbild</a>
					<a href="<?php echo esc_url( $wer_url ); ?>#chronik">Chronik</a>
				</div>

				<div class="footer-col">
					<h2>Angebote</h2>
					<a href="<?php echo esc_url( $gruppen_url ); ?>">Gruppen</a>
					<a href="<?php echo esc_url( home_url( '/#predigten' ) ); ?>">Predigten</a>
					<a href="<?php echo esc_url( $kal_url ); ?>">Kalender</a>
				</div>

				<div class="footer-col">
					<h2>Kontakt</h2>
					<ul class="footer-kontakt">
						<li><?php efga_ico( 'ort' ); ?><span>Heimlingstraße 3<br />35753 Greifenstein-Allendorf</span></li>
						<li><?php efga_ico( 'mail' ); ?><?php efga_email( 'info@eg-allendorf.de' ); ?></li>
					</ul>
				</div>
			</div>

			<hr class="footer-trenner" />

			<div class="footer-bottom">
				<div class="footer-social">
					<a href="https://www.youtube.com/@efgallendorf" target="_blank" rel="noopener noreferrer" aria-label="Gemeinde auf YouTube"><?php efga_ico( 'youtube' ); ?></a>
					<a href="mailto:info@eg-allendorf.de" rel="nofollow" aria-label="E-Mail an die Gemeinde" title="E-Mail an info@eg-allendorf.de"><?php efga_ico( 'mail' ); ?></a>
				</div>
				<span>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Evangelische Freie Gemeinde Allendorf</span>
				<div class="footer-rechtliches">
					<a href="<?php echo esc_url( $impr_url ); ?>">Impressum</a>
					<a href="<?php echo esc_url( $daten_url ); ?>">Datenschutzerklärung</a>
				</div>
				<div class="footer-credit-row">
				  <a class="footer-credit" href="mailto:info@kirrovo.marketing?body=Hallo%2C%0D%0AIch%20habe%20die%20Website%20von%20EFG%20Allendorf%20gesehen%20und%20w%C3%A4re%20auch%20an%20einer%20Zusammenarbeit%20interessiert%21%0D%0AIch%20bitte%20um%20R%C3%BCckmeldung.">Erstellt von kirrovo</a>
				</div>
			</div>
		</div>

	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
