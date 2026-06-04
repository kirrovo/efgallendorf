<?php
/**
 * Einzelne Gruppe (entspricht gruppen/*.html).
 *
 * @package EFG_Allendorf
 */

get_header();

while ( have_posts() ) :
	the_post();

	$emoji    = efga_get( 'efga_emoji', '📌' );
	$badge    = efga_get( 'efga_badge' );
	$from     = efga_get( 'efga_gradient_from', '#1e4b8a' );
	$to       = efga_get( 'efga_gradient_to', '#2d6cc0' );
	$schedule = efga_get( 'efga_schedule' );
	$location = efga_get( 'efga_location', 'Gemeindehaus Allendorf' );
	$audience = efga_get( 'efga_audience' );
	$subtitle = efga_get( 'efga_hero_subtitle' );
	$name     = efga_get( 'efga_leader_name' );
	$initials = efga_get( 'efga_leader_initials' );
	$phone    = efga_get( 'efga_leader_phone' );
	$email    = efga_get( 'efga_leader_email' );
	$archive  = get_post_type_archive_link( 'gruppe' );
	$kal      = ( $p = get_page_by_path( 'kalender' ) ) ? get_permalink( $p ) : home_url( '/#kalender' );

	get_template_part( 'template-parts/page-hero', null, array(
		'title'    => get_the_title(),
		'subtitle' => $subtitle,
		'badge'    => trim( $emoji . ' ' . $badge ),
		'gradient' => "linear-gradient(135deg, {$from} 0%, {$to} 100%)",
		'crumbs'   => array(
			array( 'label' => 'Gruppen & Kreise', 'url' => $archive ),
			array( 'label' => get_the_title() ),
		),
	) );
	?>

	<section class="section">
		<div class="section-inner">
			<a href="<?php echo esc_url( $archive ); ?>" class="back-btn">← Zurück zur Gruppenübersicht</a>

			<div class="detail-grid">
				<div class="detail-content">
					<?php the_content(); ?>
				</div>

				<div class="detail-sidebar">
					<div class="info-karte">
						<div class="info-karte-header">Auf einen Blick</div>
						<div class="info-karte-body">
							<?php if ( $schedule ) : ?>
							<div class="info-zeile">
								<svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm.5 5v5.25l4.5 2.67-.75 1.23L11 13V7h1.5z"/></svg>
								<div><strong>Wann</strong><span><?php echo esc_html( $schedule ); ?></span></div>
							</div>
							<?php endif; ?>
							<?php if ( $location ) : ?>
							<div class="info-zeile">
								<svg width="16" height="16" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
								<div><strong>Wo</strong><span><?php echo esc_html( $location ); ?></span></div>
							</div>
							<?php endif; ?>
							<?php if ( $audience ) : ?>
							<div class="info-zeile">
								<svg width="16" height="16" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
								<div><strong>Für wen</strong><span><?php echo esc_html( $audience ); ?></span></div>
							</div>
							<?php endif; ?>
						</div>
					</div>

					<?php if ( $name ) : ?>
					<div class="kontakt-karte-mini">
						<h4>Ansprechperson</h4>
						<div class="kontakt-person">
							<div class="kontakt-avatar"><?php echo esc_html( $initials ); ?></div>
							<div class="kontakt-person-info">
								<strong><?php echo esc_html( $name ); ?></strong>
								<?php if ( $phone ) : ?><span><?php efga_phone_text( $phone ); ?></span><?php endif; ?>
							</div>
						</div>
						<?php if ( $email ) : ?>
						<?php
						$icon = '<svg width="14" height="14" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>';
						efga_email( $email, $icon, 'kontakt-email' );
						?>
						<?php endif; ?>
					</div>
					<?php endif; ?>

					<a href="<?php echo esc_url( $kal ); ?>" class="btn-blau" style="text-align:center; justify-content:center;">
						Nächster Termin im Kalender
					</a>
				</div>
			</div>
		</div>
	</section>

	<?php
endwhile;

get_footer();
