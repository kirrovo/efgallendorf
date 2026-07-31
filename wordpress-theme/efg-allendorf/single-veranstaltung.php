<?php
/**
 * Einzelne Veranstaltung.
 *
 * @package EFG_Allendorf
 */

get_header();

while ( have_posts() ) :
	the_post();

	$day    = efga_get( 'efga_date_day' );
	$month  = efga_get( 'efga_date_month' );
	$time   = efga_get( 'efga_time' );
	$tag    = efga_get( 'efga_tag' );

	get_template_part( 'template-parts/page-hero', null, array(
		'title'    => get_the_title(),
		'subtitle' => trim( $time ),
		'badge'    => $tag ? $tag : 'Veranstaltung',
		'crumbs'   => array(
			array( 'label' => 'Veranstaltungen', 'url' => get_post_type_archive_link( 'veranstaltung' ) ),
			array( 'label' => get_the_title() ),
		),
	) );
	?>

	<section class="section">
		<div class="section-inner">
			<a href="<?php echo esc_url( home_url( '/#veranstaltungen' ) ); ?>" class="back-btn">Zurück zur Startseite</a>

			<div class="detail-grid">
				<div class="detail-content">
					<?php the_content(); ?>
				</div>
				<div class="detail-sidebar">
					<div class="info-karte">
						<div class="info-karte-header">Termin-Infos</div>
						<div class="info-karte-body">
							<?php if ( $day || $month ) : ?>
							<div class="info-zeile">
								<?php efga_ico( 'kalender' ); ?>
								<div><strong>Datum</strong><span><?php echo esc_html( trim( $day . '. ' . $month ) ); ?></span></div>
							</div>
							<?php endif; ?>
							<?php if ( $time ) : ?>
							<div class="info-zeile">
								<?php efga_ico( 'uhr' ); ?>
								<div><strong>Zeit</strong><span><?php echo esc_html( $time ); ?></span></div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
endwhile;

get_footer();
