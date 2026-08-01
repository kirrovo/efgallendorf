<?php
/**
 * Startseite (entspricht index.html).
 *
 * @package EFG_Allendorf
 */

get_header();

$wer_url     = ( $p = get_page_by_path( 'wer-wir-sind' ) ) ? get_permalink( $p ) : '#wer-wir-sind';
$gruppen_url = get_post_type_archive_link( 'gruppe' );
$live_url    = ( $p = get_page_by_path( 'gottesdienst-live' ) ) ? get_permalink( $p ) : '#';
$kal_url     = ( $p = get_page_by_path( 'kalender' ) ) ? get_permalink( $p ) : '#kalender';
?>

<!-- ══════════════════ HERO ══════════════════════════ -->
<?php
$gd_url = ( $p = get_page_by_path( 'gottesdienst', OBJECT, 'gruppe' ) ) ? get_permalink( $p ) : '#veranstaltungen';
?>
<section class="hero">
	<div class="hero-inner hero-auftritt">
		<a href="<?php echo esc_url( $gd_url ); ?>" class="hero-pille">
			<span>Gottesdienst sonntags um 10:00 Uhr</span>
			<span class="hero-pille-trenner" aria-hidden="true"></span>
			<span class="hero-pille-kreis" aria-hidden="true">
				<span class="hero-pille-spur">
					<span><?php efga_ico( 'pfeil-rechts' ); ?></span>
					<span><?php efga_ico( 'pfeil-rechts' ); ?></span>
				</span>
			</span>
		</a>

		<h1><?php echo esc_html( get_bloginfo( 'name' ) ?: 'Evangelische Freie Gemeinde Allendorf' ); ?></h1>

		<p class="lead">Eine christliche Gemeinschaft in Allendorf. Menschen verschiedener Generationen, verbunden durch den Glauben.</p>

		<div class="hero-ctas">
			<a href="#veranstaltungen" class="btn btn-blau">Nächste Veranstaltungen</a>
			<a href="<?php echo esc_url( $wer_url ); ?>" class="btn btn-sekundaer">Wer wir sind</a>
		</div>
	</div>

	<div class="hero-rahmen">
		<?php
		// Beitragsbild der Startseite nutzen, sonst das mitgelieferte Gemeindefoto.
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'full', array(
				'fetchpriority' => 'high',
				'alt'           => 'Menschen der Gemeinde Allendorf beim gemeinsamen Gruppenfoto',
			) );
		} else {
			printf(
				'<img src="%s" width="1572" height="1001" fetchpriority="high" alt="%s" />',
				esc_url( get_template_directory_uri() . '/assets/img/gemeinde.jpg' ),
				esc_attr( 'Menschen der Gemeinde Allendorf beim gemeinsamen Gruppenfoto' )
			);
		}
		?>
	</div>
</section>

<!-- ══════════════════ INFO-BAR ══════════════════════ -->
<div class="info-bar">
	<div class="info-bar-inner">
		<div class="info-item">
			<?php efga_ico( 'uhr' ); ?>
			<div><strong>Gottesdienst</strong><span>Sonntag, 10:00 Uhr</span></div>
		</div>
		<div class="info-item">
			<?php efga_ico( 'ort' ); ?>
			<div><strong>Adresse</strong><span>Heimlingstraße 3, Greifenstein</span></div>
		</div>
		<div class="info-item">
			<?php efga_ico( 'mail' ); ?>
			<div><strong>Kontakt</strong><span><?php efga_email_text( 'info@eg-allendorf.de' ); ?></span></div>
		</div>
	</div>
</div>

<!-- ══════════════════ VERANSTALTUNGEN ═══════════════ -->
<section class="section" id="veranstaltungen">
	<div class="section-inner">
		<div class="section-kopf-reihe">
			<div>
				<h2>Veranstaltungen</h2>
				<p>Was bei uns gerade ansteht: Gottesdienste, Bibeltage und Gemeindeabende.</p>
			</div>
			<a href="<?php echo esc_url( $kal_url ); ?>" class="text-link">Alle Termine <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?></a>
		</div>

		<div class="events-grid">
			<?php
			$events = new WP_Query( array(
				'post_type'      => 'veranstaltung',
				'posts_per_page' => 6,
				'orderby'        => 'menu_order date',
				'order'          => 'ASC',
			) );
			if ( $events->have_posts() ) :
				while ( $events->have_posts() ) : $events->the_post();
					$day   = efga_get( 'efga_date_day' );
					$month = efga_get( 'efga_date_month' );
					$time  = efga_get( 'efga_time' );
					$tag   = efga_get( 'efga_tag' );
					$link  = efga_get( 'efga_link' );
					$link  = $link ? $link : get_permalink();
					?>
					<article class="event-card" data-spot>
						<span class="event-glanz" aria-hidden="true"></span>
						<span class="event-koernung" aria-hidden="true"></span>
						<span class="event-saum" aria-hidden="true"></span>
						<div class="event-date-bar">
							<div class="event-date-box">
								<span class="day"><?php echo esc_html( $day ); ?></span>
								<span class="month"><?php echo esc_html( $month ); ?></span>
							</div>
							<div class="event-title-bar">
								<strong><?php the_title(); ?></strong>
								<span><?php echo esc_html( $time ); ?></span>
							</div>
						</div>
						<div class="event-body">
							<?php if ( $tag ) : ?><span class="event-tag"><?php echo esc_html( $tag ); ?></span><?php endif; ?>
							<p><?php echo wp_kses_post( get_the_content() ); ?></p>
							<a href="<?php echo esc_url( $link ); ?>" class="event-link">Mehr erfahren <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?></a>
						</div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				echo '<p class="leise">Aktuell sind keine Veranstaltungen eingetragen. Lege im WordPress-Admin unter <strong>Veranstaltungen</strong> welche an.</p>';
			endif;
			?>
		</div>
	</div>
</section>

<!-- ══════════════════ WER WIR SIND ══════════════════ -->
<section class="section section-alt" id="wer-wir-sind">
	<div class="section-inner">
		<div class="wer-grid">
			<div class="wer-text">
				<h2>Wer wir sind</h2>
				<p>Die Evangelische Freie Gemeinde Allendorf ist eine christliche Gemeinschaft, die seit vielen Jahrzehnten in Allendorf und Umgebung verwurzelt ist.</p>
				<p>Wir glauben an die Bibel als Gottes Wort und leben Gemeinschaft über alle Altersgruppen hinweg, von den Kleinsten bis zu den Ältesten.</p>
				<a href="<?php echo esc_url( $wer_url ); ?>" class="btn btn-blau">Mehr über uns</a>
			</div>
			<div class="wer-cards">
				<a href="<?php echo esc_url( $wer_url ); ?>#glaube" class="wer-card" style="--i: 0">
					<div class="wer-card-kopf">
						<?php efga_ico( 'buch' ); ?>
						<span class="nummer" aria-hidden="true">01</span>
					</div>
					<h4>Glaubensbekenntnis</h4>
					<p>Woran wir glauben und warum. Zwölf Sätze, die unsere Grundlage beschreiben.</p>
					<span class="mehr">Ansehen <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?></span>
				</a>
				<a href="<?php echo esc_url( $wer_url ); ?>#leitbild" class="wer-card" style="--i: 1">
					<div class="wer-card-kopf">
						<?php efga_ico( 'herz' ); ?>
						<span class="nummer" aria-hidden="true">02</span>
					</div>
					<h4>Leitbild und Werte</h4>
					<p>Was wir wollen und wofür wir uns treffen. Unsere Grundsätze im Alltag.</p>
					<span class="mehr">Ansehen <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?></span>
				</a>
				<a href="<?php echo esc_url( $wer_url ); ?>#chronik" class="wer-card" style="--i: 2">
					<div class="wer-card-kopf">
						<?php efga_ico( 'chronik' ); ?>
						<span class="nummer" aria-hidden="true">03</span>
					</div>
					<h4>Chronik</h4>
					<p>Seit 1884 in Allendorf. Aus der Gemeinschaftsbewegung wurde eine Ortsgemeinde.</p>
					<span class="mehr">Ansehen <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?></span>
				</a>
				<a href="<?php echo esc_url( $wer_url ); ?>#leitung" class="wer-card" style="--i: 3">
					<div class="wer-card-kopf">
						<?php efga_ico( 'personen' ); ?>
						<span class="nummer" aria-hidden="true">04</span>
					</div>
					<h4>Gemeindeleitung</h4>
					<p>Die Menschen, die Verantwortung tragen, mit Namen und Kontakt.</p>
					<span class="mehr">Ansehen <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?></span>
				</a>
			</div>
		</div>
	</div>
</section>

<!-- ══════════════════ GRUPPEN ═══════════════════════ -->
<section class="section" id="gruppen">
	<div class="section-inner">
		<?php
		$gruppen = new WP_Query( array(
			'post_type'      => 'gruppe',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
		) );

		// Angebote nach Bereich bündeln, damit die Übersicht nicht zur Kachelwand wird.
		// Der Bereich wird pro Gruppe im Backend gesetzt (Feld "Bereich").
		$cluster = array_fill_keys( array_keys( efga_bereiche() ), array() );
		$standard = array_key_first( $cluster );
		if ( $gruppen->have_posts() ) {
			while ( $gruppen->have_posts() ) {
				$gruppen->the_post();
				$badge = efga_get( 'efga_badge' );
				$key   = efga_get( 'efga_bereich' );
				if ( ! isset( $cluster[ $key ] ) ) {
					// Fallback für Gruppen ohne gesetzten Bereich.
					if ( preg_match( '/kind|jungschar|teen|jugend|schuljahr/i', $badge . ' ' . get_the_title() ) ) {
						$key = 'Kinder und Jugend';
					} elseif ( preg_match( '/frau|männer|senior|ruhestand/i', $badge . ' ' . get_the_title() ) ) {
						$key = 'Frauen, Männer, Senioren';
					} else {
						$key = $standard;
					}
				}
				$cluster[ $key ][] = array(
					'titel' => get_the_title(),
					'url'   => get_permalink(),
					'icon'  => efga_get( 'efga_icon', 'personen' ),
					'zeit'  => efga_get( 'efga_schedule', $badge ),
					'bild'  => has_post_thumbnail()
						? get_the_post_thumbnail_url( null, 'large' )
						: ( file_exists( get_template_directory() . '/assets/img/angebote/' . get_post_field( 'post_name' ) . '.jpg' )
							? get_template_directory_uri() . '/assets/img/angebote/' . get_post_field( 'post_name' ) . '.jpg'
							: '' ),
				);
			}
			wp_reset_postdata();
		}
		$anzahl = array_sum( array_map( 'count', $cluster ) );
		?>

		<div class="section-kopf-reihe">
			<div>
				<h2>Für jede Lebensphase</h2>
				<p><?php echo esc_html( $anzahl ); ?> Angebote, vom Kindergottesdienst bis zur Seniorenrunde.</p>
			</div>
			<a href="<?php echo esc_url( $gruppen_url ); ?>" class="text-link">Alle Gruppen <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?></a>
		</div>

		<div class="bereich-karten">
			<?php
			// Ein Bild je Bereich: das erste Angebot des Bereichs, das eins hat.
			foreach ( $cluster as $bereich => $eintraege ) :
				if ( empty( $eintraege ) ) { continue; }
				$anker = 'bereich-' . sanitize_title( $bereich );
				$bild  = '';
				foreach ( $eintraege as $e ) {
					if ( ! empty( $e['bild'] ) ) { $bild = $e['bild']; break; }
				}
				$namen = array_slice( wp_list_pluck( $eintraege, 'titel' ), 0, 4 );
				?>
				<a href="<?php echo esc_url( $gruppen_url . '#' . $anker ); ?>" class="bereich-karte">
					<?php if ( $bild ) : ?>
					<div class="bereich-karte-bild">
						<img src="<?php echo esc_url( $bild ); ?>" width="1400" height="790" loading="lazy" alt="" />
					</div>
					<?php endif; ?>
					<div class="bereich-karte-inhalt">
						<h3><?php echo esc_html( $bereich ); ?></h3>
						<p><?php echo esc_html( implode( ', ', $namen ) ); ?><?php echo count( $eintraege ) > 4 ? ' und weitere' : ''; ?>.</p>
						<span class="bereich-karte-link">Angebote ansehen <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?></span>
					</div>
				</a>
				<?php
			endforeach;
			?>
		</div>
	</div>
</section>

<!-- ══════════════════ PREDIGTEN ═════════════════════ -->
<section class="section section-alt" id="predigten">
	<div class="section-inner">
		<div class="section-header">
			<h2>Predigten</h2>
			<p>Die neuesten Predigten aus unseren Gottesdiensten, zum Nachhören und Weitergeben.</p>
		</div>

		<div class="predigten-list">
			<div class="predigt-row">
				<span class="predigt-play"><?php efga_ico( 'play' ); ?></span>
				<div class="predigt-info">
					<strong>Erwählung: Aus „Niemand“ wird „Jemand“</strong>
					<span>1. Samuel 16, Markus Wäsch</span>
				</div>
				<div class="predigt-meta"><strong>03.05.2026</strong>Bibeltage</div>
			</div>
			<div class="predigt-row">
				<span class="predigt-play"><?php efga_ico( 'play' ); ?></span>
				<div class="predigt-info">
					<strong>Freundschaft durch dick und dünn</strong>
					<span>1. Samuel 18 bis 23, Markus Wäsch</span>
				</div>
				<div class="predigt-meta"><strong>04.05.2026</strong>Bibeltage</div>
			</div>
			<div class="predigt-row">
				<span class="predigt-play"><?php efga_ico( 'play' ); ?></span>
				<div class="predigt-info">
					<strong>Ausruhen: Neue Kraft für Müde</strong>
					<span>1. Samuel 30, Markus Wäsch</span>
				</div>
				<div class="predigt-meta"><strong>06.05.2026</strong>Bibeltage</div>
			</div>
			<div class="predigt-row predigt-row-gesperrt">
				<span class="predigt-play"><?php efga_ico( 'schloss' ); ?></span>
				<div class="predigt-info">
					<strong>Ältere Predigten im internen Bereich</strong>
					<span>Vollständiges Archiv mit Suchfunktion</span>
				</div>
				<div class="predigt-meta"><span class="predigt-lock">Login erforderlich</span></div>
			</div>
		</div>
	</div>
</section>

<!-- ══════════════════ WOCHE & KALENDER ══════════════ -->
<section class="section" id="kalender">
	<div class="section-inner">
		<div class="section-header">
			<h2>Unsere Woche</h2>
			<p>Der feste Rhythmus der Gemeinde. Einzeltermine und Sondertage stehen im Gemeindekalender.</p>
		</div>

		<div class="woche-grid">
		  <div class="woche-zelle betont">
		    <span class="tag">Sonntag</span>
		    <strong>Gottesdienst und Kindergottesdienst</strong>
		    <span>10:00 Uhr, Kinder ab 10:30 Uhr</span>
		  </div>
		  <div class="woche-zelle">
		    <span class="tag">Montag</span>
		    <strong>Frauengebetskreis</strong>
		    <span>Alle 14 Tage, abends</span>
		  </div>
		  <div class="woche-zelle">
		    <span class="tag">Dienstag</span>
		    <strong>Wilde Füchse</strong>
		    <span>17:00 bis 18:30 Uhr</span>
		  </div>
		  <div class="woche-zelle">
		    <span class="tag">Mittwoch</span>
		    <strong>GLV und Bibelstunde</strong>
		    <span>Alle 14 Tage im Wechsel, abends</span>
		  </div>
		  <div class="woche-zelle">
		    <span class="tag">Donnerstag</span>
		    <strong>Knallerbsen</strong>
		    <span>16:15 bis 17:45 Uhr</span>
		  </div>
		  <div class="woche-zelle">
		    <span class="tag">Freitag</span>
		    <strong>Crossroad und Biblischer Unterricht</strong>
		    <span>Crossroad ab 19:00 Uhr</span>
		  </div>
		</div>

		<div class="woche-fuss">
			<p>Hauskreise, Männertreffen und Seniorenkaffee laufen nach Absprache. Einzeltermine und Sondertage stehen im Gemeindekalender.</p>
			<a href="<?php echo esc_url( $kal_url ); ?>" class="btn btn-sekundaer">
				<?php efga_ico( 'kalender', 'ico-sm' ); ?>
				Zum Gemeindekalender
			</a>
		</div>
	</div>
</section>


<!-- ══════════════════ KONTAKT ═══════════════════════ -->
<section class="section section-alt" id="kontakt">
	<div class="section-inner">
		<?php get_template_part( 'template-parts/kontakt' ); ?>
	</div>
</section>

<?php
get_footer();
