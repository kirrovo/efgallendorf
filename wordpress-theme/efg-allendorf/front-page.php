<?php
/**
 * Startseite (entspricht index.html).
 *
 * @package EFG_Allendorf
 */

get_header();

$wer_url     = ( $p = get_page_by_path( 'wer-wir-sind' ) ) ? get_permalink( $p ) : '#wer-wir-sind';
$gruppen_url = get_post_type_archive_link( 'gruppe' );
$intern_url  = ( $p = get_page_by_path( 'intern' ) ) ? get_permalink( $p ) : '#intern';
?>

<!-- ══════════════════ HERO ══════════════════════════ -->
<section class="hero">
	<div class="hero-inner">
		<div class="hero-badge">Willkommen in unserer Gemeinde</div>
		<h1>Evangelische Freie Gemeinde Allendorf</h1>
		<p>Wir sind eine christliche Gemeinschaft in Allendorf – Menschen verschiedener Generationen, verbunden durch den Glauben.</p>
		<div class="hero-ctas">
			<a href="#veranstaltungen" class="btn btn-white">Nächste Veranstaltungen</a>
			<a href="<?php echo esc_url( $wer_url ); ?>" class="btn btn-outline">Wer wir sind</a>
		</div>
	</div>
</section>

<!-- ══════════════════ INFO-BAR ══════════════════════ -->
<div class="info-bar">
	<div class="info-bar-inner">
		<div class="info-item">
			<div class="info-icon"><svg width="18" height="18" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg></div>
			<div><strong>Gottesdienst</strong><span>Sonntag · 10:00 Uhr</span></div>
		</div>
		<div class="info-item">
			<div class="info-icon"><svg width="18" height="18" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>
			<div><strong>Adresse</strong><span>Heimlingstraße 3, Greifenstein</span></div>
		</div>
		<div class="info-item">
			<div class="info-icon"><svg width="18" height="18" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></div>
			<div><strong>Kontakt</strong><span><?php efga_email_text( 'info@eg-allendorf.de' ); ?></span></div>
		</div>
	</div>
</div>

<!-- ══════════════════ VERANSTALTUNGEN ═══════════════ -->
<section class="section" id="veranstaltungen">
	<div class="section-inner">
		<div class="section-header">
			<div class="section-kicker">Aktuell &amp; Bald</div>
			<h2>Veranstaltungen</h2>
			<p>Was bei uns gerade los ist – Gottesdienste, Bibeltage, Gemeindeabende und mehr.</p>
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
					$day    = efga_get( 'efga_date_day' );
					$month  = efga_get( 'efga_date_month' );
					$time   = efga_get( 'efga_time' );
					$tag    = efga_get( 'efga_tag' );
					$accent = efga_get( 'efga_accent', '#1e4b8a' );
					$link   = efga_get( 'efga_link' );
					$link   = $link ? $link : get_permalink();
					?>
					<div class="event-card">
						<div class="event-date-bar" style="background:<?php echo esc_attr( $accent ); ?>;">
							<div class="event-date-box"><div class="day"><?php echo esc_html( $day ); ?></div><div class="month"><?php echo esc_html( $month ); ?></div></div>
							<div class="event-title-bar"><strong><?php the_title(); ?></strong><span><?php echo esc_html( $time ); ?></span></div>
						</div>
						<div class="event-body">
							<?php if ( $tag ) : ?><span class="event-tag"><?php echo esc_html( $tag ); ?></span><?php endif; ?>
							<p><?php echo wp_kses_post( get_the_content() ); ?></p>
							<a href="<?php echo esc_url( $link ); ?>" class="event-link">Mehr erfahren →</a>
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				echo '<p style="text-align:center;color:var(--grau-mittel);">Aktuell sind keine Veranstaltungen eingetragen. Lege im WordPress-Admin unter <strong>Veranstaltungen</strong> welche an.</p>';
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
				<div class="section-kicker">Unsere Gemeinde</div>
				<h2>Wer wir sind</h2>
				<p>Die Evangelische Freie Gemeinde Allendorf ist eine christliche Gemeinschaft, die sich seit vielen Jahrzehnten in Allendorf und Umgebung verankert hat.</p>
				<p>Wir glauben an die Bibel als Gottes Wort und leben Gemeinschaft über alle Altersgruppen hinweg – von den Kleinsten bis zu den Ältesten.</p>
				<a href="<?php echo esc_url( $wer_url ); ?>" class="btn-blau" style="margin-top:8px;">Mehr erfahren →</a>
			</div>
			<div class="wer-cards">
				<a href="<?php echo esc_url( $wer_url ); ?>" class="wer-card"><div class="wer-card-icon">📖</div><h4>Glaubensbekenntnis</h4><p>Was wir glauben und warum</p></a>
				<a href="<?php echo esc_url( $wer_url ); ?>" class="wer-card"><div class="wer-card-icon">🕊</div><h4>Leitbild &amp; Werte</h4><p>Unsere Grundsätze und Vision</p></a>
				<a href="<?php echo esc_url( $wer_url ); ?>" class="wer-card"><div class="wer-card-icon">📅</div><h4>Chronik</h4><p>Unsere Geschichte als Zeitstrahl</p></a>
				<a href="<?php echo esc_url( $wer_url ); ?>" class="wer-card"><div class="wer-card-icon">👥</div><h4>Gemeindeleitung</h4><p>Menschen, die Verantwortung tragen</p></a>
			</div>
		</div>
	</div>
</section>

<!-- ══════════════════ GRUPPEN ═══════════════════════ -->
<section class="section" id="gruppen">
	<div class="section-inner">
		<div class="section-header">
			<div class="section-kicker">Gemeinschaft &amp; Gruppen</div>
			<h2>Für jede Lebensphase</h2>
			<p>Bei uns findest du Gruppen und Kreise für alle Altersgruppen und Interessen.</p>
		</div>

		<div class="gruppen-overview-grid">
			<?php
			$gruppen = new WP_Query( array(
				'post_type'      => 'gruppe',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order title',
				'order'          => 'ASC',
			) );
			if ( $gruppen->have_posts() ) :
				while ( $gruppen->have_posts() ) : $gruppen->the_post();
					get_template_part( 'template-parts/gruppe', 'card' );
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>

		<div style="text-align:center; margin-top:36px;">
			<a href="<?php echo esc_url( $gruppen_url ); ?>" class="btn-blau">Alle Gruppen im Überblick →</a>
		</div>
	</div>
</section>

<!-- ══════════════════ PREDIGTEN ═════════════════════ -->
<section class="section section-alt" id="predigten">
	<div class="section-inner">
		<div class="section-header">
			<div class="section-kicker">Hören &amp; Nachdenken</div>
			<h2>Predigten</h2>
			<p>Die neuesten Predigten aus unseren Gottesdiensten – zum Nachhören und Weitergeben.</p>
		</div>
		<div class="predigten-list">
			<div class="predigt-row">
				<div class="predigt-play"><svg width="16" height="16" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></div>
				<div class="predigt-info"><strong>Erwählung: Aus „Niemand" wird „Jemand"</strong><span>1. Samuel 16 · Markus Wäsch</span></div>
				<div class="predigt-meta"><strong>03.05.2026</strong>Bibeltage</div>
			</div>
			<div class="predigt-row">
				<div class="predigt-play"><svg width="16" height="16" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></div>
				<div class="predigt-info"><strong>Freundschaft durch dick und dünn</strong><span>1. Samuel 18–23 · Markus Wäsch</span></div>
				<div class="predigt-meta"><strong>04.05.2026</strong>Bibeltage</div>
			</div>
			<div class="predigt-row">
				<div class="predigt-play"><svg width="16" height="16" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></div>
				<div class="predigt-info"><strong>Ausruhen – Neue Kraft für Müde</strong><span>1. Samuel 30 · Markus Wäsch</span></div>
				<div class="predigt-meta"><strong>06.05.2026</strong>Bibeltage</div>
			</div>
			<div class="predigt-row" style="background:var(--grau-hell);">
				<div class="predigt-play" style="background:var(--grau-mittel);">
					<svg width="16" height="16" viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
				</div>
				<div class="predigt-info"><strong>Ältere Predigten im internen Bereich</strong><span>Vollständiges Archiv mit Suchfunktion</span></div>
				<div class="predigt-meta"><span class="predigt-lock">🔒 Login erforderlich</span></div>
			</div>
		</div>
	</div>
</section>

<!-- ══════════════════ KALENDER ══════════════════════ -->
<section class="section" id="kalender">
	<div class="section-inner">
		<div class="section-header">
			<div class="section-kicker">Termine auf einen Blick</div>
			<h2>Gemeinde-Kalender</h2>
			<p>Alle Termine der Gemeinde übersichtlich im Kalender.</p>
		</div>
		<?php get_template_part( 'template-parts/kalender' ); ?>
	</div>
</section>

<!-- ══════════════════ INTERN ════════════════════════ -->
<section class="section section-alt" id="intern">
	<div class="section-inner">
		<div class="section-header">
			<div class="section-kicker">Für Gemeindeglieder</div>
			<h2>Interner Bereich</h2>
			<p>Formulare, Protokolle, Predigten-Archiv und mehr – nur für angemeldete Mitglieder.</p>
		</div>
		<div class="intern-banner">
			<div class="intern-icon-big">🔒</div>
			<div class="intern-text">
				<h3>Mitglieder-Login</h3>
				<p>Im internen Bereich findest du Predigten-Archiv, Gemeindeformulare, Protokolle und passwortgeschützte Inhalte.</p>
				<a href="<?php echo esc_url( $intern_url ); ?>" class="btn btn-white" style="width:fit-content;">Zum Login →</a>
			</div>
		</div>
	</div>
</section>

<!-- ══════════════════ KONTAKT ═══════════════════════ -->
<section class="section" id="kontakt">
	<div class="section-inner">
		<div class="section-header">
			<div class="section-kicker">Wir freuen uns von dir zu hören</div>
			<h2>Kontakt &amp; Anfahrt</h2>
		</div>
		<?php get_template_part( 'template-parts/kontakt' ); ?>
	</div>
</section>

<?php
get_footer();
