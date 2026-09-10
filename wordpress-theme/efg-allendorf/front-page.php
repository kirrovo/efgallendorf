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
?>

<!-- ══════════════════ HERO ══════════════════════════ -->
<?php
$gd_url = ( $p = get_page_by_path( 'gottesdienst', OBJECT, 'gruppe' ) ) ? get_permalink( $p ) : '#kalender';
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
			<a href="#kalender" class="btn btn-blau">Unsere Woche</a>
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
            $photo = get_template_directory_uri() . '/assets/img/gemeinde-aktuell.webp';
            echo '<img src="' . esc_url($photo) . '" width="1672" height="941" fetchpriority="high" decoding="async" alt="Menschen der Gemeinde Allendorf beim gemeinsamen Gruppenfoto"';
            efga_responsive_attrs($photo, '(max-width: 620px) calc(100vw - 56px), (max-width: 1040px) calc(100vw - 72px), 956px');
            echo ' />';
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
					<h3>Glaubensbekenntnis</h3>
					<p>Woran wir glauben und warum. Zwölf Sätze, die unsere Grundlage beschreiben.</p>
					<span class="mehr">Ansehen <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?></span>
				</a>
				<a href="<?php echo esc_url( $wer_url ); ?>#leitbild" class="wer-card" style="--i: 1">
					<div class="wer-card-kopf">
						<?php efga_ico( 'herz' ); ?>
						<span class="nummer" aria-hidden="true">02</span>
					</div>
					<h3>Leitbild und Werte</h3>
					<p>Was wir wollen und wofür wir uns treffen. Unsere Grundsätze im Alltag.</p>
					<span class="mehr">Ansehen <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?></span>
				</a>
				<a href="<?php echo esc_url( $wer_url ); ?>#chronik" class="wer-card" style="--i: 2">
					<div class="wer-card-kopf">
						<?php efga_ico( 'chronik' ); ?>
						<span class="nummer" aria-hidden="true">03</span>
					</div>
					<h3>Chronik</h3>
					<p>Seit 1884 in Allendorf. Aus der Gemeinschaftsbewegung wurde eine Ortsgemeinde.</p>
					<span class="mehr">Ansehen <?php efga_ico( 'pfeil-rechts', 'ico-sm' ); ?></span>
				</a>
				<a href="<?php echo esc_url( $wer_url ); ?>#leitung" class="wer-card" style="--i: 3">
					<div class="wer-card-kopf">
						<?php efga_ico( 'personen' ); ?>
						<span class="nummer" aria-hidden="true">04</span>
					</div>
					<h3>Gemeindeleitung</h3>
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
						: ( file_exists( get_template_directory() . '/assets/img/angebote/' . get_post_field( 'post_name' ) . '.webp' )
							? get_template_directory_uri() . '/assets/img/angebote/' . get_post_field( 'post_name' ) . '.webp'
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
						<img src="<?php echo esc_url( $bild ); ?>"<?php efga_responsive_attrs( $bild, '(max-width: 1240px) calc(100vw - 40px), 1160px' ); ?> width="1400" height="790" loading="lazy" alt="" decoding="async" />
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
<section class="section section-alt" id="predigten" data-predigten-endpoint="https://efgallendorf.vercel.app/api/predigten" data-predigten-updated="2026-09-10T12:48:36.735846+00:00">
  <div class="section-inner">
    <div class="section-header">
      <h2>Predigten</h2>
      <p>Die drei neuesten Videos von unserem YouTube-Kanal, zum Nachhören und Weitergeben.</p>
    </div>
    <div class="predigten-list" aria-label="Die letzten drei Predigten und Videos">
      <a class="predigt-row" href="https://www.youtube.com/watch?v=dQ_TlADxXw0" target="_blank" rel="noopener noreferrer">
        <span class="predigt-play"><svg class="ico" aria-hidden="true"><use href="#i-play"></use></svg></span>
        <div class="predigt-info"><strong>EFGA Gottesdienst mit Hartmut Pöpke am 06.09.2026</strong><span>Auf YouTube ansehen</span></div>
        <div class="predigt-meta"><time datetime="2026-09-06T07:59:42Z">06.09.2026</time></div>
      </a>
      <a class="predigt-row" href="https://www.youtube.com/watch?v=xW2Cr0kpC24" target="_blank" rel="noopener noreferrer">
        <span class="predigt-play"><svg class="ico" aria-hidden="true"><use href="#i-play"></use></svg></span>
        <div class="predigt-info"><strong>GLV mit dem Thema: &quot;Berichte Mission - Teil 2&quot; am 02.09.2026</strong><span>Auf YouTube ansehen</span></div>
        <div class="predigt-meta"><time datetime="2026-09-02T18:02:22Z">02.09.2026</time></div>
      </a>
      <a class="predigt-row" href="https://www.youtube.com/watch?v=SRKFsq0awAg" target="_blank" rel="noopener noreferrer">
        <span class="predigt-play"><svg class="ico" aria-hidden="true"><use href="#i-play"></use></svg></span>
        <div class="predigt-info"><strong>EFGA Gottesdienst mit Simon Droß am 30.08.2026</strong><span>Auf YouTube ansehen</span></div>
        <div class="predigt-meta"><time datetime="2026-08-30T08:01:12Z">30.08.2026</time></div>
      </a>
    </div>
    <p class="predigten-status" data-predigten-status role="status">Aktuelle Videos werden geladen …</p>
    <a class="text-link" href="https://www.youtube.com/@efgallendorf" target="_blank" rel="noopener noreferrer">Alle Videos auf YouTube ansehen</a>
    <noscript><p>Automatische Aktualisierung benötigt JavaScript. Die neuesten Videos findest du direkt auf unserem YouTube-Kanal.</p></noscript>
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
		  <article class="woche-karte" data-wochentag="0">
		    <div class="woche-karte-kopf">
		      <span class="tag">Sonntag</span>
		      <img class="woche-karte-bild" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/angebote/gottesdienst.webp' ); ?>"<?php efga_responsive_attrs( get_template_directory_uri() . '/assets/img/angebote/gottesdienst.webp', '(max-width: 620px) 180px, 280px' ); ?> width="1400" height="790" alt="" loading="lazy" decoding="async" />
		    </div>
		    <div class="woche-karte-koerper">
		      <h3><a class="woche-hauptlink" href="<?php echo esc_url( $gruppen_url ); ?>/gottesdienst/">Gottesdienst</a> und <a class="woche-zweitlink" href="<?php echo esc_url( $gruppen_url ); ?>/kindergottesdienst/">Kindergottesdienst</a></h3>
		      <p>10:00 Uhr, Kinder ab 10:30 Uhr</p>
		    </div>
		    <div class="woche-karte-fuss">
		      <div class="woche-links">
		        <a href="<?php echo esc_url( $gruppen_url ); ?>/gottesdienst/" aria-label="Gottesdienst"><svg class="ico ico-sm" aria-hidden="true"><use href="#i-kirche"></use></svg></a>
		        <a href="<?php echo esc_url( $gruppen_url ); ?>/kindergottesdienst/" aria-label="Kindergottesdienst"><svg class="ico ico-sm" aria-hidden="true"><use href="#i-note"></use></svg></a>
		      </div>
		      <span class="woche-restzeit" data-restzeit>&nbsp;</span>
		    </div>
		  </article>

		  <article class="woche-karte" data-wochentag="1">
		    <div class="woche-karte-kopf">
		      <span class="tag">Montag</span>
		      <img class="woche-karte-bild" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/angebote/frauengebetskreis.webp' ); ?>"<?php efga_responsive_attrs( get_template_directory_uri() . '/assets/img/angebote/frauengebetskreis.webp', '(max-width: 620px) 180px, 280px' ); ?> width="1400" height="790" alt="" loading="lazy" decoding="async" />
		    </div>
		    <div class="woche-karte-koerper">
		      <h3><a class="woche-hauptlink" href="<?php echo esc_url( $gruppen_url ); ?>/frauengebetskreis/">Frauengebetskreis</a></h3>
		      <p>Alle 14 Tage, abends</p>
		    </div>
		    <div class="woche-karte-fuss">
		      <div class="woche-links">
		        <a href="<?php echo esc_url( $gruppen_url ); ?>/frauengebetskreis/" aria-label="Frauengebetskreis"><svg class="ico ico-sm" aria-hidden="true"><use href="#i-herz"></use></svg></a>
		      </div>
		      <span class="woche-restzeit" data-restzeit>&nbsp;</span>
		    </div>
		  </article>

		  <article class="woche-karte" data-wochentag="2">
		    <div class="woche-karte-kopf">
		      <span class="tag">Dienstag</span>
		      <img class="woche-karte-bild" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/angebote/wilde-fuechse.webp' ); ?>"<?php efga_responsive_attrs( get_template_directory_uri() . '/assets/img/angebote/wilde-fuechse.webp', '(max-width: 620px) 180px, 280px' ); ?> width="1400" height="790" alt="" loading="lazy" decoding="async" />
		    </div>
		    <div class="woche-karte-koerper">
		      <h3><a class="woche-hauptlink" href="<?php echo esc_url( $gruppen_url ); ?>/wilde-fuechse/">Wilde Füchse</a></h3>
		      <p>17:00 bis 18:30 Uhr</p>
		    </div>
		    <div class="woche-karte-fuss">
		      <div class="woche-links">
		        <a href="<?php echo esc_url( $gruppen_url ); ?>/wilde-fuechse/" aria-label="Wilde Füchse"><svg class="ico ico-sm" aria-hidden="true"><use href="#i-stern"></use></svg></a>
		      </div>
		      <span class="woche-restzeit" data-restzeit>&nbsp;</span>
		    </div>
		  </article>

		  <article class="woche-karte" data-wochentag="3">
		    <div class="woche-karte-kopf">
		      <span class="tag">Mittwoch</span>
		      <img class="woche-karte-bild" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/angebote/bibelstunde.webp' ); ?>"<?php efga_responsive_attrs( get_template_directory_uri() . '/assets/img/angebote/bibelstunde.webp', '(max-width: 620px) 180px, 280px' ); ?> width="1400" height="790" alt="" loading="lazy" decoding="async" />
		    </div>
		    <div class="woche-karte-koerper">
		      <h3><a class="woche-hauptlink" href="<?php echo esc_url( $gruppen_url ); ?>/glv/">GLV</a> und <a class="woche-zweitlink" href="<?php echo esc_url( $gruppen_url ); ?>/bibelstunde/">Bibelstunde</a></h3>
		      <p>Alle 14 Tage im Wechsel, abends</p>
		    </div>
		    <div class="woche-karte-fuss">
		      <div class="woche-links">
		        <a href="<?php echo esc_url( $gruppen_url ); ?>/glv/" aria-label="GLV"><svg class="ico ico-sm" aria-hidden="true"><use href="#i-buch"></use></svg></a>
		        <a href="<?php echo esc_url( $gruppen_url ); ?>/bibelstunde/" aria-label="Bibelstunde"><svg class="ico ico-sm" aria-hidden="true"><use href="#i-notiz"></use></svg></a>
		      </div>
		      <span class="woche-restzeit" data-restzeit>&nbsp;</span>
		    </div>
		  </article>

		  <article class="woche-karte" data-wochentag="4">
		    <div class="woche-karte-kopf">
		      <span class="tag">Donnerstag</span>
		      <img class="woche-karte-bild" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/angebote/knallerbsen.webp' ); ?>"<?php efga_responsive_attrs( get_template_directory_uri() . '/assets/img/angebote/knallerbsen.webp', '(max-width: 620px) 180px, 280px' ); ?> width="1400" height="790" alt="" loading="lazy" decoding="async" />
		    </div>
		    <div class="woche-karte-koerper">
		      <h3><a class="woche-hauptlink" href="<?php echo esc_url( $gruppen_url ); ?>/knallerbsen/">Knallerbsen</a></h3>
		      <p>16:15 bis 17:45 Uhr</p>
		    </div>
		    <div class="woche-karte-fuss">
		      <div class="woche-links">
		        <a href="<?php echo esc_url( $gruppen_url ); ?>/knallerbsen/" aria-label="Knallerbsen"><svg class="ico ico-sm" aria-hidden="true"><use href="#i-pflanze"></use></svg></a>
		      </div>
		      <span class="woche-restzeit" data-restzeit>&nbsp;</span>
		    </div>
		  </article>

		  <article class="woche-karte" data-wochentag="5">
		    <div class="woche-karte-kopf">
		      <span class="tag">Freitag</span>
		      <img class="woche-karte-bild" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/angebote/crossroad.webp' ); ?>"<?php efga_responsive_attrs( get_template_directory_uri() . '/assets/img/angebote/crossroad.webp', '(max-width: 620px) 180px, 280px' ); ?> width="1400" height="790" alt="" loading="lazy" decoding="async" />
		    </div>
		    <div class="woche-karte-koerper">
		      <h3><a class="woche-hauptlink" href="<?php echo esc_url( $gruppen_url ); ?>/crossroad/">Crossroad</a> und <a class="woche-zweitlink" href="<?php echo esc_url( $gruppen_url ); ?>/biblischer-unterricht/">Biblischer Unterricht</a></h3>
		      <p>Crossroad ab 19:00 Uhr</p>
		    </div>
		    <div class="woche-karte-fuss">
		      <div class="woche-links">
		        <a href="<?php echo esc_url( $gruppen_url ); ?>/crossroad/" aria-label="Crossroad"><svg class="ico ico-sm" aria-hidden="true"><use href="#i-kompass"></use></svg></a>
		        <a href="<?php echo esc_url( $gruppen_url ); ?>/biblischer-unterricht/" aria-label="Biblischer Unterricht"><svg class="ico ico-sm" aria-hidden="true"><use href="#i-lupe"></use></svg></a>
		      </div>
		      <span class="woche-restzeit" data-restzeit>&nbsp;</span>
		    </div>
		  </article>
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
