<?php
/**
 * EFG Allendorf, Theme Functions
 *
 * @package EFG_Allendorf
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direktaufruf verhindern.
}

define( 'EFGA_VERSION', '1.0.0' );

/* ════════════════════════════════════════════════════════
   1. THEME-SETUP
   ════════════════════════════════════════════════════════ */
function efga_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 88,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
		'primary' => __( 'Hauptnavigation', 'efg-allendorf' ),
		'footer'  => __( 'Footer-Navigation', 'efg-allendorf' ),
	) );

	load_theme_textdomain( 'efg-allendorf', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'efga_setup' );

/* ════════════════════════════════════════════════════════
   2. STYLES & SCRIPTS
   ════════════════════════════════════════════════════════ */
function efga_assets() {
	wp_enqueue_style( 'efga-style', get_stylesheet_uri(), array(), EFGA_VERSION );
	wp_enqueue_script( 'efga-contacts', get_template_directory_uri() . '/assets/js/contacts.js', array(), EFGA_VERSION, true );
	wp_enqueue_script( 'efga-nav', get_template_directory_uri() . '/assets/js/nav.js', array(), EFGA_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'efga_assets' );

/* ════════════════════════════════════════════════════════
   2b. ICONS (SVG-Sprite statt Emojis)
   ════════════════════════════════════════════════════════
   Ein Strich-Icon-Set im 24er-Raster. Das Sprite wird einmal pro Seite
   im Header ausgegeben, danach referenzieren alle Templates nur noch:
     efga_ico( 'uhr' )  ->  <svg class="ico"><use href="#i-uhr"></use></svg>
*/

/** Liste der verfügbaren Icon-Namen (für Auswahlfelder im Backend). */
function efga_icon_namen() {
	return array(
		'buch'      => 'Buch (Bibel, Glaube)',
		'notiz'     => 'Notiz (Bibelstunde)',
		'haus'      => 'Haus (Hauskreise)',
		'herz'      => 'Herz (Gebet, Leitbild)',
		'personen'  => 'Personen (Gruppen, Leitung)',
		'kompass'   => 'Kompass (Jugend)',
		'stern'     => 'Stern (Jungschar)',
		'pflanze'   => 'Pflanze (Kinder)',
		'uhr'       => 'Uhr (Zeit)',
		'ort'       => 'Ort (Adresse)',
		'kalender'  => 'Kalender (Termine)',
		'mail'      => 'Briefumschlag',
		'telefon'   => 'Telefon',
		'schloss'   => 'Schloss (intern)',
		'video'     => 'Video (Live)',
		'play'      => 'Play (Predigt)',
		'chronik'   => 'Chronik (Geschichte)',
	);
}

/** Gibt ein Icon aus dem Sprite aus. */
function efga_ico( $name, $extra = '', $echo = true ) {
	$html = sprintf(
		'<svg class="%s" aria-hidden="true"><use href="#i-%s"></use></svg>',
		esc_attr( trim( 'ico ' . $extra ) ),
		esc_attr( $name )
	);
	if ( $echo ) { echo $html; } // phpcs:ignore WordPress.Security.EscapeOutput
	return $html;
}

/** Gibt das Sprite einmalig aus (wird in header.php aufgerufen). */
function efga_icon_sprite() {
	$datei = get_template_directory() . '/assets/icons.svg';
	if ( file_exists( $datei ) ) {
		echo file_get_contents( $datei ); // phpcs:ignore
	}
}

/* ════════════════════════════════════════════════════════
   3. KONTAKTDATEN, WEBCRAWLER-SCHUTZ (base64-Obfuskation)
   ════════════════════════════════════════════════════════
   Gibt ein <span>/<a> mit base64-kodiertem data-Attribut zurück.
   Die contacts.js dekodiert es erst im Browser.
*/

/** E-Mail als geschützten Link (mit Icon-Inhalt optional). */
function efga_email( $email, $inner_html = '', $class = '', $echo = true ) {
	$enc   = base64_encode( $email );
	$class = trim( 'ob-email ' . $class );
	$html  = sprintf(
		'<a href="#" class="%s" data-em="%s" rel="nofollow">%s</a>',
		esc_attr( $class ),
		esc_attr( $enc ),
		$inner_html // bewusst nicht escaped, darf SVG-Icon enthalten.
	);
	if ( $echo ) { echo $html; } // phpcs:ignore WordPress.Security.EscapeOutput
	return $html;
}

/** E-Mail als geschützten Text (kein Link). */
function efga_email_text( $email, $echo = true ) {
	$html = sprintf( '<span class="ob-email" data-em="%s"></span>', esc_attr( base64_encode( $email ) ) );
	if ( $echo ) { echo $html; } // phpcs:ignore WordPress.Security.EscapeOutput
	return $html;
}

/** Telefonnummer als geschützten Text (kein Link). */
function efga_phone_text( $phone, $echo = true ) {
	$html = sprintf( '<span class="ob-tel" data-tel="%s"></span>', esc_attr( base64_encode( $phone ) ) );
	if ( $echo ) { echo $html; } // phpcs:ignore WordPress.Security.EscapeOutput
	return $html;
}

/** Telefonnummer als geschützten Link. */
function efga_phone_link( $phone, $echo = true ) {
	$html = sprintf( '<a href="#" class="ob-tel" data-tel="%s" rel="nofollow"></a>', esc_attr( base64_encode( $phone ) ) );
	if ( $echo ) { echo $html; } // phpcs:ignore WordPress.Security.EscapeOutput
	return $html;
}

/* ════════════════════════════════════════════════════════
   4. CUSTOM POST TYPES
   ════════════════════════════════════════════════════════ */
function efga_register_cpts() {

	// ── Gruppen und Kreise ──────────────────────────────
	register_post_type( 'gruppe', array(
		'labels' => array(
			'name'               => __( 'Gruppen', 'efg-allendorf' ),
			'singular_name'      => __( 'Gruppe', 'efg-allendorf' ),
			'add_new'            => __( 'Neue Gruppe', 'efg-allendorf' ),
			'add_new_item'       => __( 'Neue Gruppe hinzufügen', 'efg-allendorf' ),
			'edit_item'          => __( 'Gruppe bearbeiten', 'efg-allendorf' ),
			'new_item'           => __( 'Neue Gruppe', 'efg-allendorf' ),
			'view_item'          => __( 'Gruppe ansehen', 'efg-allendorf' ),
			'search_items'       => __( 'Gruppen suchen', 'efg-allendorf' ),
			'menu_name'          => __( 'Gruppen', 'efg-allendorf' ),
		),
		'public'       => true,
		'has_archive'  => 'gruppen',
		'menu_icon'    => 'dashicons-groups',
		'menu_position'=> 21,
		'rewrite'      => array( 'slug' => 'gruppen', 'with_front' => false ),
		'supports'     => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' ),
		'show_in_rest' => true,
	) );

	// ── Veranstaltungen ───────────────────────────────
	register_post_type( 'veranstaltung', array(
		'labels' => array(
			'name'               => __( 'Veranstaltungen', 'efg-allendorf' ),
			'singular_name'      => __( 'Veranstaltung', 'efg-allendorf' ),
			'add_new'            => __( 'Neue Veranstaltung', 'efg-allendorf' ),
			'add_new_item'       => __( 'Neue Veranstaltung hinzufügen', 'efg-allendorf' ),
			'edit_item'          => __( 'Veranstaltung bearbeiten', 'efg-allendorf' ),
			'new_item'           => __( 'Neue Veranstaltung', 'efg-allendorf' ),
			'view_item'          => __( 'Veranstaltung ansehen', 'efg-allendorf' ),
			'search_items'       => __( 'Veranstaltungen suchen', 'efg-allendorf' ),
			'menu_name'          => __( 'Veranstaltungen', 'efg-allendorf' ),
		),
		'public'       => true,
		'has_archive'  => 'veranstaltungen',
		'menu_icon'    => 'dashicons-calendar-alt',
		'menu_position'=> 22,
		'rewrite'      => array( 'slug' => 'veranstaltungen', 'with_front' => false ),
		'supports'     => array( 'title', 'editor', 'thumbnail' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'efga_register_cpts' );

/* ════════════════════════════════════════════════════════
   5. META-FELDER (Custom Fields)
   ════════════════════════════════════════════════════════ */
function efga_meta_boxes() {
	add_meta_box( 'efga_gruppe_meta', __( 'Gruppen-Details', 'efg-allendorf' ), 'efga_gruppe_meta_cb', 'gruppe', 'normal', 'high' );
	add_meta_box( 'efga_veranstaltung_meta', __( 'Veranstaltungs-Details', 'efg-allendorf' ), 'efga_veranstaltung_meta_cb', 'veranstaltung', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'efga_meta_boxes' );

/** Hilfsfunktion: ein Text-Feld rendern. */
function efga_field( $post_id, $key, $label, $placeholder = '', $help = '' ) {
	$val = esc_attr( get_post_meta( $post_id, $key, true ) );
	echo '<p style="margin:0 0 14px;"><label style="display:block;font-weight:600;margin-bottom:4px;">' . esc_html( $label ) . '</label>';
	echo '<input type="text" name="' . esc_attr( $key ) . '" value="' . $val . '" placeholder="' . esc_attr( $placeholder ) . '" style="width:100%;" />';
	if ( $help ) {
		echo '<span style="color:#777;font-size:12px;">' . esc_html( $help ) . '</span>';
	}
	echo '</p>';
}

/** Hilfsfunktion: ein Auswahlfeld rendern. */
function efga_select( $post_id, $key, $label, $optionen, $help = '' ) {
	$val = get_post_meta( $post_id, $key, true );
	echo '<p style="margin:0 0 14px;"><label style="display:block;font-weight:600;margin-bottom:4px;">' . esc_html( $label ) . '</label>';
	echo '<select name="' . esc_attr( $key ) . '" style="width:100%;">';
	foreach ( $optionen as $wert => $text ) {
		printf(
			'<option value="%s"%s>%s</option>',
			esc_attr( $wert ),
			selected( $val, $wert, false ),
			esc_html( $text )
		);
	}
	echo '</select>';
	if ( $help ) {
		echo '<span style="color:#777;font-size:12px;">' . esc_html( $help ) . '</span>';
	}
	echo '</p>';
}

function efga_gruppe_meta_cb( $post ) {
	wp_nonce_field( 'efga_gruppe_meta', 'efga_gruppe_nonce' );
	echo '<div style="display:grid;grid-template-columns:1fr 1fr;gap:0 24px;">';
	efga_select( $post->ID, 'efga_icon', 'Icon', efga_icon_namen(), 'Ersetzt die früheren Emojis. Alle Gruppen nutzen dieselbe Akzentfarbe.' );
	efga_field( $post->ID, 'efga_badge', 'Zielgruppe (Badge)', 'Alle Erwachsenen' );
	efga_field( $post->ID, 'efga_schedule', 'Wann (Treffen)', 'Mittwochabend' );
	efga_field( $post->ID, 'efga_location', 'Wo', 'Gemeindehaus Allendorf' );
	efga_field( $post->ID, 'efga_audience', 'Für wen', 'Alle Erwachsenen' );
	efga_field( $post->ID, 'efga_hero_subtitle', 'Hero-Untertitel', 'Kurzbeschreibung im Seitenkopf' );
	efga_field( $post->ID, 'efga_short', 'Kurztext (für Karte)', 'Eine Zeile für die Übersicht' );
	echo '</div><hr><strong>Ansprechperson</strong>';
	echo '<div style="display:grid;grid-template-columns:1fr 1fr;gap:0 24px;margin-top:8px;">';
	efga_field( $post->ID, 'efga_leader_name', 'Name', 'Simon Droß' );
	efga_field( $post->ID, 'efga_leader_initials', 'Initialen (Avatar)', 'SD' );
	efga_field( $post->ID, 'efga_leader_phone', 'Telefon', '06478 / 911 638' );
	efga_field( $post->ID, 'efga_leader_email', 'E-Mail', 'name@eg-allendorf.de' );
	echo '</div>';
	echo '<p style="color:#777;font-size:12px;">Telefon & E-Mail werden auf der Website automatisch vor Webcrawlern geschützt.</p>';
}

function efga_veranstaltung_meta_cb( $post ) {
	wp_nonce_field( 'efga_veranstaltung_meta', 'efga_veranstaltung_nonce' );
	echo '<div style="display:grid;grid-template-columns:1fr 1fr;gap:0 24px;">';
	efga_field( $post->ID, 'efga_date_day', 'Tag (Zahl)', '03' );
	efga_field( $post->ID, 'efga_date_month', 'Monat (kurz)', 'Mai' );
	efga_field( $post->ID, 'efga_time', 'Zeit', 'Sonntag, 10:00 Uhr' );
	efga_field( $post->ID, 'efga_tag', 'Kategorie (Tag)', 'Gottesdienst' );
	efga_field( $post->ID, 'efga_link', 'Link (optional)', '#kalender' );
	echo '</div>';
}

function efga_save_meta( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	$gruppe_keys = array( 'efga_icon', 'efga_badge', 'efga_schedule', 'efga_location', 'efga_audience', 'efga_hero_subtitle', 'efga_short', 'efga_leader_name', 'efga_leader_initials', 'efga_leader_phone', 'efga_leader_email' );
	if ( isset( $_POST['efga_gruppe_nonce'] ) && wp_verify_nonce( $_POST['efga_gruppe_nonce'], 'efga_gruppe_meta' ) ) {
		foreach ( $gruppe_keys as $k ) {
			if ( isset( $_POST[ $k ] ) ) {
				update_post_meta( $post_id, $k, sanitize_text_field( wp_unslash( $_POST[ $k ] ) ) );
			}
		}
	}

	$va_keys = array( 'efga_date_day', 'efga_date_month', 'efga_time', 'efga_tag', 'efga_link' );
	if ( isset( $_POST['efga_veranstaltung_nonce'] ) && wp_verify_nonce( $_POST['efga_veranstaltung_nonce'], 'efga_veranstaltung_meta' ) ) {
		foreach ( $va_keys as $k ) {
			if ( isset( $_POST[ $k ] ) ) {
				update_post_meta( $post_id, $k, sanitize_text_field( wp_unslash( $_POST[ $k ] ) ) );
			}
		}
	}
}
add_action( 'save_post', 'efga_save_meta' );

/* ════════════════════════════════════════════════════════
   6. HILFSFUNKTION: Meta auslesen mit Fallback
   ════════════════════════════════════════════════════════ */
function efga_get( $key, $default = '', $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$val     = get_post_meta( $post_id, $key, true );
	return ( '' === $val || false === $val ) ? $default : $val;
}

/* ════════════════════════════════════════════════════════
   6b. ARCHIV-SORTIERUNG (Gruppen & Veranstaltungen nach menu_order)
   ════════════════════════════════════════════════════════ */
function efga_archive_order( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_post_type_archive( array( 'gruppe', 'veranstaltung' ) ) ) {
		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
		$query->set( 'posts_per_page', -1 );
	}
}
add_action( 'pre_get_posts', 'efga_archive_order' );

/* ════════════════════════════════════════════════════════
   7. FALLBACK-NAVIGATION (wenn kein Menü zugewiesen ist)
   ════════════════════════════════════════════════════════ */
function efga_default_menu() {
	echo '<nav id="hauptnavigation" aria-label="' . esc_attr__( 'Hauptnavigation', 'efg-allendorf' ) . '">';
	echo '<a href="' . esc_url( home_url( '/' ) ) . '"' . ( is_front_page() ? ' class="active" aria-current="page"' : '' ) . '>Home</a>';
	echo '<a href="' . esc_url( get_permalink( get_page_by_path( 'wer-wir-sind' ) ) ) . '">Wer wir sind</a>';
	echo '<a href="' . esc_url( get_post_type_archive_link( 'gruppe' ) ) . '">Gruppen</a>';
	echo '<a href="' . esc_url( get_permalink( get_page_by_path( 'gottesdienst-live' ) ) ) . '" class="nav-live">' . efga_ico( 'video', 'ico-sm', false ) . 'Live</a>';
	echo '<a href="' . esc_url( get_permalink( get_page_by_path( 'kalender' ) ) ) . '">Kalender</a>';
	echo '<a href="' . esc_url( get_permalink( get_page_by_path( 'intern' ) ) ) . '" class="nav-intern">' . efga_ico( 'schloss', 'ico-sm', false ) . 'Intern</a>';
	echo '</nav>';
}

/* ════════════════════════════════════════════════════════
   8. SEEDING: Beispiel-Inhalte bei Theme-Aktivierung anlegen
   ════════════════════════════════════════════════════════ */
require get_template_directory() . '/inc/seed-content.php';
add_action( 'after_switch_theme', 'efga_seed_content' );
