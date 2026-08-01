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

		<?php
		/*
		 * Schaufenster: gefächerte Karten aus den Gruppen mit Bild.
		 * Die eigentliche Navigation bleibt das beschriftete Raster darunter,
		 * damit alle Angebote ohne Blättern erreichbar sind.
		 */
		$fan = new WP_Query( array(
			'post_type'      => 'gruppe',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
		) );
		$fan_karten = array();
		if ( $fan->have_posts() ) {
			while ( $fan->have_posts() ) {
				$fan->the_post();
				$slug = get_post_field( 'post_name' );
				$datei = get_template_directory() . '/assets/img/angebote/' . $slug . '.jpg';
				if ( has_post_thumbnail() ) {
					$bild = get_the_post_thumbnail_url( null, 'medium_large' );
				} elseif ( file_exists( $datei ) ) {
					$bild = get_template_directory_uri() . '/assets/img/angebote/' . $slug . '.jpg';
				} else {
					continue; // ohne Bild keine Fächerkarte
				}
				$fan_karten[] = array( 'titel' => get_the_title(), 'url' => get_permalink(), 'bild' => $bild );
			}
			wp_reset_postdata();
		}
		?>
		<?php if ( count( $fan_karten ) > 2 ) : ?>
		<div class="faecher" data-faecher role="group" aria-label="Bilder unserer Angebote">
			<div class="faecher-buehne">
				<?php foreach ( $fan_karten as $k ) : ?>
					<a class="faecher-karte" href="<?php echo esc_url( $k['url'] ); ?>">
						<img src="<?php echo esc_url( $k['bild'] ); ?>" width="400" height="533" loading="lazy" alt="" />
						<span class="faecher-titel"><?php echo esc_html( $k['titel'] ); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
			<div class="faecher-steuerung">
				<button class="faecher-pfeil" type="button" data-richtung="links" aria-label="Vorheriges Angebot"><?php efga_ico( 'pfeil-links' ); ?></button>
				<div class="faecher-punkte">
					<?php foreach ( $fan_karten as $k ) : ?>
						<button class="faecher-punkt" type="button" aria-label="<?php echo esc_attr( $k['titel'] ); ?>"></button>
					<?php endforeach; ?>
				</div>
				<button class="faecher-pfeil" type="button" data-richtung="rechts" aria-label="Nächstes Angebot"><?php efga_ico( 'pfeil-rechts' ); ?></button>
			</div>
		</div>
		<?php endif; ?>

		<?php
		// Nach Bereich gruppieren, damit die Karten der Startseite auf
		// einen echten Anker zeigen koennen.
		$nach_bereich = array_fill_keys( array_keys( efga_bereiche() ), array() );
		$standard     = array_key_first( $nach_bereich );
		while ( have_posts() ) {
			the_post();
			$b = efga_get( 'efga_bereich' );
			if ( ! isset( $nach_bereich[ $b ] ) ) { $b = $standard; }
			$nach_bereich[ $b ][] = get_the_ID();
		}
		foreach ( $nach_bereich as $bereich => $ids ) :
			if ( empty( $ids ) ) { continue; }
			?>
			<h2 class="bereich-titel" id="bereich-<?php echo esc_attr( sanitize_title( $bereich ) ); ?>"><?php echo esc_html( $bereich ); ?></h2>
			<div class="gruppen-overview-grid">
				<?php
				foreach ( $ids as $id ) {
					$post = get_post( $id );
					setup_postdata( $post );
					get_template_part( 'template-parts/gruppe', 'card' );
				}
				wp_reset_postdata();
				?>
			</div>
			<?php
		endforeach;
		?>

		<div class="woche-fuss" style="margin-top: 40px;">
			<p><strong>Fragen zu einer Gruppe?</strong> Wende dich direkt an die Gruppenleitung oder schreib uns eine Nachricht.</p>
			<a href="<?php echo esc_url( $kontakt_url ); ?>" class="btn btn-blau">Kontakt aufnehmen</a>
		</div>
	</div>
</section>

<?php
get_footer();
