<?php
/**
 * Template Name: Kalender
 *
 * @package EFG_Allendorf
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'title'    => 'Gemeinde-Kalender',
	'subtitle' => 'Alle Termine der Gemeinde übersichtlich im Kalender.',
	'badge'    => 'Termine',
	'crumbs'   => array( array( 'label' => 'Kalender' ) ),
) );
?>

<section class="section">
	<div class="section-inner">
		<?php
		// Tipp: Hier kann ein Google-Kalender-Embed eingefügt werden.
		// Inhalt der WP-Seite (falls vorhanden) wird über dem Kalender angezeigt.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				if ( trim( get_the_content() ) ) {
					echo '<div class="legal-body" style="margin-bottom:32px;">' . apply_filters( 'the_content', get_the_content() ) . '</div>'; // phpcs:ignore
				}
			endwhile;
		endif;

		get_template_part( 'template-parts/kalender' );
		?>
	</div>
</section>

<?php
get_footer();
