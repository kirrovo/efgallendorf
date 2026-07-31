<?php
/**
 * Gruppen-Übersicht (entspricht gruppen.html).
 *
 * @package EFG_Allendorf
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'title'    => 'Gruppen und Kreise',
	'subtitle' => 'Die Gemeinde lebt vom Miteinander. Hier findest du Gemeinschaft für jede Lebensphase, von den Jüngsten bis zu den Ältesten.',
	'badge'    => 'Gemeinschaft',
	'crumbs'   => array( array( 'label' => 'Gruppen und Kreise' ) ),
) );

$kontakt_url = ( $p = get_page_by_path( 'kontakt' ) ) ? get_permalink( $p ) : home_url( '/#kontakt' );
?>

<section class="section">
	<div class="section-inner">
		<div class="gruppen-overview-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/gruppe', 'card' );
			endwhile;
			?>
		</div>

		<div class="woche-fuss" style="margin-top: 40px;">
			<p><strong>Fragen zu einer Gruppe?</strong> Wende dich direkt an die Gruppenleitung oder schreib uns eine Nachricht.</p>
			<a href="<?php echo esc_url( $kontakt_url ); ?>" class="btn btn-blau">Kontakt aufnehmen</a>
		</div>
	</div>
</section>

<?php
get_footer();
