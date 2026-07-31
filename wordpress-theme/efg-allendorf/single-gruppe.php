<?php
/**
 * Einzelne Gruppe (entspricht gruppen/*.html).
 *
 * @package EFG_Allendorf
 */

get_header();

while ( have_posts() ) :
	the_post();

	$icon     = efga_get( 'efga_icon', 'personen' );
	$badge    = efga_get( 'efga_badge' );
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

	/*
	 * Bildquelle: Beitragsbild der Gruppe hat Vorrang. Ist keins gesetzt,
	 * greift das mitgelieferte Stockfoto aus assets/img/angebote/<slug>.jpg.
	 * Die Bilder liegen lokal im Theme, es wird nichts von Pexels nachgeladen.
	 */
	$bild_alt     = efga_get( 'efga_bild_alt', get_the_title() );
	$fallback     = get_template_directory() . '/assets/img/angebote/' . get_post_field( 'post_name' ) . '.jpg';
	$fallback_url = get_template_directory_uri() . '/assets/img/angebote/' . get_post_field( 'post_name' ) . '.jpg';

	/*
	 * Angebots-Hero: Bildkarte mit Rasterstruktur. Ohne Bild bleibt der
	 * schlichte Seitenkopf, damit keine leere dunkle Fläche entsteht.
	 */
	if ( has_post_thumbnail() || file_exists( $fallback ) ) {
		$hero_bild = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'full' ) : $fallback_url;
		?>
		<div class="breadcrumb">
			<div class="breadcrumb-inner">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Startseite</a>
				<span aria-hidden="true">&rsaquo;</span>
				<a href="<?php echo esc_url( $archive ); ?>">Gruppen und Kreise</a>
				<span aria-hidden="true">&rsaquo;</span>
				<span><?php the_title(); ?></span>
			</div>
		</div>
		<div class="angebot-hero">
			<div class="angebot-hero-karte">
				<img src="<?php echo esc_url( $hero_bild ); ?>" width="1400" height="790" fetchpriority="high" alt="<?php echo esc_attr( $bild_alt ); ?>" />
				<div class="angebot-hero-inhalt">
					<?php if ( $badge ) : ?>
					<span class="angebot-hero-pille">
						<?php efga_ico( 'personen' ); ?>
						<?php echo esc_html( $badge ); ?>
					</span>
					<?php endif; ?>
					<h1><?php the_title(); ?></h1>
					<?php if ( $subtitle ) : ?><p><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
					<a href="<?php echo esc_url( home_url( '/#kontakt' ) ); ?>" class="btn">
						Kontakt aufnehmen
						<?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?>
					</a>
				</div>
			</div>
		</div>
		<?php
	} else {
		get_template_part( 'template-parts/page-hero', null, array(
			'title'    => get_the_title(),
			'subtitle' => $subtitle,
			'badge'    => $badge,
			'crumbs'   => array(
				array( 'label' => 'Gruppen und Kreise', 'url' => $archive ),
				array( 'label' => get_the_title() ),
			),
		) );
	}

	?>


	<section class="section">
		<div class="section-inner">
			<a href="<?php echo esc_url( $archive ); ?>" class="back-btn">Zurück zur Gruppenübersicht</a>

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
								<?php efga_ico( 'uhr' ); ?>
								<div><strong>Wann</strong><span><?php echo esc_html( $schedule ); ?></span></div>
							</div>
							<?php endif; ?>
							<?php if ( $location ) : ?>
							<div class="info-zeile">
								<?php efga_ico( 'ort' ); ?>
								<div><strong>Wo</strong><span><?php echo esc_html( $location ); ?></span></div>
							</div>
							<?php endif; ?>
							<?php if ( $audience ) : ?>
							<div class="info-zeile">
								<?php efga_ico( 'personen' ); ?>
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
						$icon_mail = efga_ico( 'mail', 'ico-sm', false );
						efga_email( $email, $icon_mail, 'kontakt-email' );
						?>
						<?php endif; ?>
					</div>
					<?php endif; ?>

					<a href="<?php echo esc_url( $kal ); ?>" class="btn btn-blau" style="text-align:center; justify-content:center;">
						Nächster Termin im Kalender
					</a>
				</div>
			</div>
		</div>
	</section>

	<?php
endwhile;

get_footer();
