<?php
/**
 * 404, Seite nicht gefunden.
 *
 * @package EFG_Allendorf
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'title'    => 'Seite nicht gefunden',
	'subtitle' => 'Die aufgerufene Seite existiert leider nicht (mehr).',
	'badge'    => '404',
	'crumbs'   => array( array( 'label' => 'Fehler 404' ) ),
) );
?>

<section class="section">
	<div class="section-inner" style="text-align:center;">
		<p style="color:var(--text-leise);margin-bottom:24px;">Vielleicht hilft dir die Startseite weiter?</p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-blau">Zur Startseite</a>
	</div>
</section>

<?php
get_footer();
