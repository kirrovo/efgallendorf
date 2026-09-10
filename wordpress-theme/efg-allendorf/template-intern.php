<?php
/**
 * Kompatibilität für bestehende Seitenzuweisungen: ausschließlich 404 ausgeben.
 * Kein auswählbares Seitentemplate mehr; gespeicherte Inhalte nie rendern.
 *
 * @package EFG_Allendorf
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;
$wp_query->set_404();
status_header( 404 );
nocache_headers();
require get_template_directory() . '/404.php';
