<?php
/**
 * Footer (entspricht nav.js renderFooter()).
 *
 * @package EFG_Allendorf
 */

$wer    = get_page_by_path( 'wer-wir-sind' );
$intern = get_page_by_path( 'intern' );
$kontakt= get_page_by_path( 'kontakt' );
$impr   = get_page_by_path( 'impressum' );
$daten  = get_page_by_path( 'datenschutz' );
$kal    = get_page_by_path( 'kalender' );

$wer_url     = $wer ? get_permalink( $wer ) : '#';
$intern_url  = $intern ? get_permalink( $intern ) : '#';
$kontakt_url = $kontakt ? get_permalink( $kontakt ) : '#';
$impr_url    = $impr ? get_permalink( $impr ) : '#';
$daten_url   = $daten ? get_permalink( $daten ) : '#';
$kal_url     = $kal ? get_permalink( $kal ) : '#';
$gruppen_url = get_post_type_archive_link( 'gruppe' );
?>

<footer id="site-footer">
	<div class="footer-inner">
		<div class="footer-grid">
			<div class="footer-brand">
				<strong><?php echo esc_html( get_bloginfo( 'name' ) ?: 'Evangelische Freie Gemeinde Allendorf' ); ?></strong>
				<p>Eine Gemeinschaft von Menschen, die Gott suchen und füreinander da sind – in Allendorf und Umgebung.</p>
			</div>
			<div class="footer-col">
				<h4>Gemeinde</h4>
				<a href="<?php echo esc_url( $wer_url ); ?>">Wer wir sind</a>
				<a href="<?php echo esc_url( $wer_url ); ?>">Glaubensbekenntnis</a>
				<a href="<?php echo esc_url( $wer_url ); ?>">Leitbild</a>
				<a href="<?php echo esc_url( $wer_url ); ?>">Chronik</a>
			</div>
			<div class="footer-col">
				<h4>Angebote</h4>
				<a href="<?php echo esc_url( $gruppen_url ); ?>">Gruppen</a>
				<a href="<?php echo esc_url( $kal_url ); ?>">Kalender</a>
				<a href="<?php echo esc_url( home_url( '/#predigten' ) ); ?>">Predigten</a>
				<a href="<?php echo esc_url( home_url( '/#veranstaltungen' ) ); ?>">Veranstaltungen</a>
			</div>
			<div class="footer-col">
				<h4>Mehr</h4>
				<a href="<?php echo esc_url( $kontakt_url ); ?>">Kontakt</a>
				<a href="<?php echo esc_url( $intern_url ); ?>">Interner Bereich</a>
				<a href="<?php echo esc_url( $impr_url ); ?>">Impressum</a>
				<a href="<?php echo esc_url( $daten_url ); ?>">Datenschutz</a>
			</div>
		</div>
		<div class="footer-bottom">
			<span>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Evangelische Freie Gemeinde Allendorf</span>
			<div style="display:flex;gap:16px;">
				<a href="<?php echo esc_url( $impr_url ); ?>">Impressum</a>
				<a href="<?php echo esc_url( $daten_url ); ?>">Datenschutzerklärung</a>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
