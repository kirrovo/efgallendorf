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
	$accent = efga_get( 'efga_accent', '#1e4b8a' );

	get_template_part( 'template-parts/page-hero', null, array(
		'title'    => get_the_title(),
		'subtitle' => trim( $time ),
		'badge'    => $tag ? '📅 ' . $tag : '📅 Veranstaltung',
		'crumbs'   => array(
			array( 'label' => 'Veranstaltungen', 'url' => get_post_type_archive_link( 'veranstaltung' ) ),
			array( 'label' => get_the_title() ),
		),
	) );
	?>

	<section class="section">
		<div class="section-inner">
			<a href="<?php echo esc_url( home_url( '/#veranstaltungen' ) ); ?>" class="back-btn">← Zurück zur Startseite</a>

			<div class="detail-grid">
				<div class="detail-content">
					<?php the_content(); ?>
				</div>
				<div class="detail-sidebar">
					<div class="info-karte">
						<div class="info-karte-header" style="background:<?php echo esc_attr( $accent ); ?>;">Termin-Infos</div>
						<div class="info-karte-body">
							<?php if ( $day || $month ) : ?>
							<div class="info-zeile">
								<svg width="16" height="16" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V9h14v10z"/></svg>
								<div><strong>Datum</strong><span><?php echo esc_html( trim( $day . '. ' . $month ) ); ?></span></div>
							</div>
							<?php endif; ?>
							<?php if ( $time ) : ?>
							<div class="info-zeile">
								<svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm.5 5v5.25l4.5 2.67-.75 1.23L11 13V7h1.5z"/></svg>
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
