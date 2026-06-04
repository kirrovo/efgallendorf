<?php
/**
 * Gruppen-Übersicht (entspricht gruppen.html).
 *
 * @package EFG_Allendorf
 */

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'title'    => 'Gruppen & Kreise',
	'subtitle' => 'Bei uns findest du Gemeinschaft für jede Lebensphase – von den Jüngsten bis zu den Ältesten.',
	'badge'    => '👥 Gemeinschaft',
	'gradient' => 'linear-gradient(135deg, #1e4b8a 0%, #2d6cc0 60%, #4a90d9 100%)',
	'crumbs'   => array( array( 'label' => 'Gruppen & Kreise' ) ),
) );

$kontakt_url = ( $p = get_page_by_path( 'kontakt' ) ) ? get_permalink( $p ) : home_url( '/#kontakt' );
?>

<section class="section">
	<div class="section-inner">
		<div style="max-width: 720px; margin: 0 auto 56px; text-align: center;">
			<p style="font-size: 1rem; color: var(--text); line-height: 1.8;">
				Die Gemeinde lebt vom Miteinander. In unseren Gruppen und Kreisen wachsen Menschen im Glauben, begleiten sich gegenseitig und erleben Gemeinschaft im Alltag. Egal ob Kinder, Teens, junge Erwachsene oder Senioren – hier ist Platz für dich.
			</p>
		</div>

		<div class="gruppen-overview-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/gruppe', 'card' );
			endwhile;
			?>
		</div>

		<div style="margin-top: 56px; background: var(--blau-sehr-hell); border-radius: var(--radius); padding: 28px 32px; text-align: center; border: 1px solid #d0ddf0;">
			<p style="font-size: .95rem; color: var(--text); margin-bottom: 14px;">
				<strong style="color: var(--blau);">Fragen zu einer Gruppe?</strong><br>
				Wende dich gerne direkt an die Gruppenleitung oder schreib uns eine Nachricht.
			</p>
			<a href="<?php echo esc_url( $kontakt_url ); ?>" class="btn-blau">Kontakt aufnehmen →</a>
		</div>
	</div>
</section>

<?php
get_footer();
