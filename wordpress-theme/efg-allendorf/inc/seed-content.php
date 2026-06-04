<?php
/**
 * Beispiel-Inhalte bei Theme-Aktivierung anlegen.
 * Legt Gruppen (CPT), Veranstaltungen (CPT) und die statischen Seiten an,
 * sofern sie noch nicht existieren. Läuft genau einmal pro Aktivierung.
 *
 * @package EFG_Allendorf
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function efga_seed_content() {

	/* ── 1. GRUPPEN ──────────────────────────────────── */
	$gruppen = array(
		array(
			'title'    => 'GLV – Glauben, Leben, Verstehen',
			'slug'     => 'glv',
			'short'    => 'Bibelstunden-Abend mit Vortrag, Fragen und Austausch.',
			'content'  => "GLV steht für <strong>Glauben – Leben – Verstehen</strong>. An diesem Abend beschäftigen wir uns gemeinsam mit Fragen, die den Glauben und das Leben berühren. Ein Vortrag bildet den Einstieg, danach gibt es Raum für Gespräch, Nachfragen und persönlichen Austausch.",
			'emoji'    => '📖', 'badge' => 'Alle Erwachsene',
			'from'     => '#1e4b8a', 'to' => '#2d6cc0',
			'schedule' => 'Mittwochabend', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Alle Erwachsenen',
			'subtitle' => 'Ein Abend, der Fragen stellt und Antworten sucht – gemeinsam aus der Bibel.',
			'name'     => 'Simon Droß', 'initials' => 'SD', 'phone' => '06478 / 911 638', 'email' => 'simon.dross@eg-allendorf.de',
		),
		array(
			'title'    => 'Frauengebetskreis',
			'slug'     => 'frauengebetskreis',
			'short'    => 'Frauen verschiedener Generationen treffen sich zum gemeinsamen Gebet.',
			'content'  => 'Frauen verschiedener Generationen treffen sich zum gemeinsamen Gebet und zur Stärkung im Glauben.',
			'emoji'    => '🙏', 'badge' => 'Frauen',
			'from'     => '#7b3fa0', 'to' => '#a855c8',
			'schedule' => 'Regelmäßige Treffen', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Frauen',
			'subtitle' => 'Gemeinsam beten, einander tragen, im Glauben wachsen.',
			'name'     => 'Heike Prang', 'initials' => 'HP', 'phone' => '06478 / 277 739 9', 'email' => 'heikeprang@outlook.com',
		),
		array(
			'title'    => 'Bibelstunde',
			'slug'     => 'bibelstunde',
			'short'    => 'Alle 14 Tage mittwochs – gemeinsam die Bibel lesen und verstehen.',
			'content'  => 'Alle 14 Tage mittwochs lesen wir gemeinsam in der Bibel, verstehen sie besser und entdecken sie neu für den Alltag.',
			'emoji'    => '📝', 'badge' => 'Alle Erwachsene',
			'from'     => '#1a6b3c', 'to' => '#27a85e',
			'schedule' => 'Mi · alle 14 Tage', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Alle Erwachsenen',
			'subtitle' => 'Gemeinsam die Bibel lesen, verstehen und für den Alltag entdecken.',
			'name'     => 'Friedhelm Genz', 'initials' => 'FG', 'phone' => '06478 / 680', 'email' => 'f.genz@gmx.de',
		),
		array(
			'title'    => 'Hauskreise',
			'slug'     => 'hauskreise',
			'short'    => 'Klein und persönlich – drei Hauskreise treffen sich wöchentlich.',
			'content'  => 'Klein und persönlich: In drei Hauskreisen treffen sich Gemeindemitglieder wöchentlich zum Austausch und Gebet.',
			'emoji'    => '🏠', 'badge' => 'Alle',
			'from'     => '#b35a00', 'to' => '#e07b20',
			'schedule' => 'Wöchentlich', 'location' => 'In Privathäusern', 'audience' => 'Alle',
			'subtitle' => 'Glauben und Leben teilen – in kleiner, persönlicher Runde.',
			'name'     => 'Walter Klaus', 'initials' => 'WK', 'phone' => '06478 / 473 497', 'email' => 'walter.klaus@eg-allendorf.de',
		),
		array(
			'title'    => 'Crossroad',
			'slug'     => 'crossroad',
			'short'    => 'Unser Teenkreis für Jugendliche ab 13 Jahren – jeden Freitag.',
			'content'  => 'Unser Teenkreis für Jugendliche ab 13 Jahren – Glauben, Fragen, Gemeinschaft und jede Menge Spaß.',
			'emoji'    => '🚀', 'badge' => 'Teens ab 13 J.',
			'from'     => '#b0291c', 'to' => '#e0432e',
			'schedule' => 'Jeden Freitag', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Teens ab 13 Jahren',
			'subtitle' => 'Glauben, Fragen, Gemeinschaft und jede Menge Spaß.',
			'name'     => 'Andreas Genz', 'initials' => 'AG', 'phone' => '06478 / 277 533', 'email' => 'andy.genz@eg-allendorf.de',
		),
		array(
			'title'    => 'Kreisjugend',
			'slug'     => 'kreisjugend',
			'short'    => 'Singles und junge Ehepaare – alle 14 Tage zusammen.',
			'content'  => 'Singles und junge Ehepaare treffen sich alle 14 Tage – für Gemeinschaft, Glauben und gemeinsame Erlebnisse.',
			'emoji'    => '🎉', 'badge' => 'Junge Erwachsene',
			'from'     => '#1a5e8a', 'to' => '#2494c4',
			'schedule' => 'Alle 14 Tage', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Junge Erwachsene',
			'subtitle' => 'Gemeinschaft, Glauben und gemeinsame Erlebnisse.',
			'name'     => 'Andreas Genz', 'initials' => 'AG', 'phone' => '06478 / 277 533', 'email' => 'andy.genz@eg-allendorf.de',
		),
		array(
			'title'    => 'Wilde Füchse – Jungschar',
			'slug'     => 'wilde-fuechse',
			'short'    => 'Abenteuer, Spiel und Glauben für Grundschulkinder.',
			'content'  => 'Abenteuer, Spiel und Glauben – die Jungschar für Grundschulkinder mit viel Spaß und Gemeinschaft.',
			'emoji'    => '🦊', 'badge' => 'Kinder 7–12 J.',
			'from'     => '#8a6a00', 'to' => '#c49a00',
			'schedule' => 'Regelmäßige Treffen', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Kinder 7–12 Jahre',
			'subtitle' => 'Abenteuer, Spiel und Glauben für Grundschulkinder.',
			'name'     => 'Miriam Diehl', 'initials' => 'MD', 'phone' => '06478 / 277 200', 'email' => 'mimo81@gmx.de',
		),
		array(
			'title'    => 'Knallerbsen – Jungschar',
			'slug'     => 'knallerbsen',
			'short'    => 'Spielen, Basteln und Bibelgeschichten für die Kleinsten.',
			'content'  => 'Die Jungschar für die Kleinsten – Spiel, Basteln, Lieder und Geschichten aus der Bibel.',
			'emoji'    => '🌱', 'badge' => 'Kinder 5–8 J.',
			'from'     => '#2a7a40', 'to' => '#3daa58',
			'schedule' => 'Regelmäßige Treffen', 'location' => 'Gemeindehaus Allendorf', 'audience' => 'Kinder 5–8 Jahre',
			'subtitle' => 'Spielen, Basteln und Bibelgeschichten für die Kleinsten.',
			'name'     => 'Ulrike Droß', 'initials' => 'UD', 'phone' => '06478 / 911 638', 'email' => 'info@eg-allendorf.de',
		),
	);

	$order = 0;
	foreach ( $gruppen as $g ) {
		if ( get_page_by_path( $g['slug'], OBJECT, 'gruppe' ) ) {
			continue; // existiert bereits.
		}
		$id = wp_insert_post( array(
			'post_type'    => 'gruppe',
			'post_status'  => 'publish',
			'post_title'   => $g['title'],
			'post_name'    => $g['slug'],
			'post_content' => $g['content'],
			'menu_order'   => $order++,
		) );
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, 'efga_emoji', $g['emoji'] );
			update_post_meta( $id, 'efga_badge', $g['badge'] );
			update_post_meta( $id, 'efga_gradient_from', $g['from'] );
			update_post_meta( $id, 'efga_gradient_to', $g['to'] );
			update_post_meta( $id, 'efga_schedule', $g['schedule'] );
			update_post_meta( $id, 'efga_location', $g['location'] );
			update_post_meta( $id, 'efga_audience', $g['audience'] );
			update_post_meta( $id, 'efga_hero_subtitle', $g['subtitle'] );
			update_post_meta( $id, 'efga_short', $g['short'] );
			update_post_meta( $id, 'efga_leader_name', $g['name'] );
			update_post_meta( $id, 'efga_leader_initials', $g['initials'] );
			update_post_meta( $id, 'efga_leader_phone', $g['phone'] );
			update_post_meta( $id, 'efga_leader_email', $g['email'] );
		}
	}

	/* ── 2. VERANSTALTUNGEN ──────────────────────────── */
	$events = array(
		array( 'title' => 'Bibeltage 2026', 'day' => '03', 'month' => 'Mai', 'time' => 'So–Mi · 10:00 / 19:30 Uhr', 'tag' => 'Bibeltage', 'accent' => '#1e4b8a', 'content' => '„Auf und nieder, immer wieder" – vier Abende aus dem Leben Davids. Referent: Markus Wäsch.' ),
		array( 'title' => 'Sonntagsgottesdienst', 'day' => '11', 'month' => 'Mai', 'time' => 'Sonntag · 10:00 Uhr', 'tag' => 'Gottesdienst', 'accent' => '#1e4b8a', 'content' => 'Wöchentlicher Gottesdienst mit Predigt, Lobpreis und Gemeinschaft. Kinder- und Jugendprogramm parallel.' ),
		array( 'title' => 'Gemeindeabend', 'day' => '17', 'month' => 'Mai', 'time' => 'Samstag · 19:00 Uhr', 'tag' => 'Gemeinschaft', 'accent' => '#2d6cc0', 'content' => 'Ein Abend zum Miteinander – Austausch, Gebet und gemeinsames Essen. Alle sind herzlich willkommen.' ),
	);
	$order = 0;
	foreach ( $events as $e ) {
		$existing = get_posts( array( 'post_type' => 'veranstaltung', 'title' => $e['title'], 'numberposts' => 1, 'post_status' => 'any' ) );
		if ( $existing ) { continue; }
		$id = wp_insert_post( array(
			'post_type'    => 'veranstaltung',
			'post_status'  => 'publish',
			'post_title'   => $e['title'],
			'post_content' => $e['content'],
			'menu_order'   => $order++,
		) );
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, 'efga_date_day', $e['day'] );
			update_post_meta( $id, 'efga_date_month', $e['month'] );
			update_post_meta( $id, 'efga_time', $e['time'] );
			update_post_meta( $id, 'efga_tag', $e['tag'] );
			update_post_meta( $id, 'efga_accent', $e['accent'] );
		}
	}

	/* ── 3. SEITEN (mit Templates) ───────────────────── */
	$pages = array(
		array( 'title' => 'Wer wir sind',        'slug' => 'wer-wir-sind',      'template' => 'template-wer-wir-sind.php' ),
		array( 'title' => 'Gottesdienst Live',   'slug' => 'gottesdienst-live', 'template' => 'template-live.php' ),
		array( 'title' => 'Kalender',            'slug' => 'kalender',          'template' => 'template-kalender.php' ),
		array( 'title' => 'Interner Bereich',    'slug' => 'intern',            'template' => 'template-intern.php' ),
		array( 'title' => 'Kontakt & Anfahrt',   'slug' => 'kontakt',           'template' => 'template-kontakt.php' ),
		array( 'title' => 'Impressum',           'slug' => 'impressum',         'template' => 'template-impressum.php' ),
		array( 'title' => 'Datenschutzerklärung','slug' => 'datenschutz',       'template' => 'template-datenschutz.php' ),
	);
	foreach ( $pages as $p ) {
		if ( get_page_by_path( $p['slug'] ) ) { continue; }
		$id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_title'  => $p['title'],
			'post_name'   => $p['slug'],
		) );
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_wp_page_template', $p['template'] );
		}
	}

	/* ── 4. STARTSEITE festlegen ─────────────────────── */
	if ( ! get_page_by_path( 'startseite' ) ) {
		$home_id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_title'  => 'Startseite',
			'post_name'   => 'startseite',
		) );
		if ( $home_id && ! is_wp_error( $home_id ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_id );
		}
	}

	/* ── 5. Hauptmenü anlegen & zuweisen ─────────────── */
	$menu_name = 'Hauptnavigation';
	if ( ! wp_get_nav_menu_object( $menu_name ) ) {
		$menu_id = wp_create_nav_menu( $menu_name );
		if ( ! is_wp_error( $menu_id ) ) {
			wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Home', 'menu-item-url' => home_url( '/' ), 'menu-item-status' => 'publish' ) );
			$wer = get_page_by_path( 'wer-wir-sind' );
			if ( $wer ) { wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Wer wir sind', 'menu-item-object' => 'page', 'menu-item-object-id' => $wer->ID, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) ); }
			wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Gruppen', 'menu-item-url' => get_post_type_archive_link( 'gruppe' ), 'menu-item-status' => 'publish' ) );
			$live = get_page_by_path( 'gottesdienst-live' );
			if ( $live ) { wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => '🔴 Live', 'menu-item-object' => 'page', 'menu-item-object-id' => $live->ID, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) ); }
			$kal = get_page_by_path( 'kalender' );
			if ( $kal ) { wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'Kalender', 'menu-item-object' => 'page', 'menu-item-object-id' => $kal->ID, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) ); }
			$intern = get_page_by_path( 'intern' );
			if ( $intern ) { wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => '🔒 Intern', 'menu-item-object' => 'page', 'menu-item-object-id' => $intern->ID, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) ); }

			$locations            = get_theme_mod( 'nav_menu_locations' );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	/* ── 6. Permalinks neu schreiben ─────────────────── */
	efga_register_cpts();
	flush_rewrite_rules();
}
