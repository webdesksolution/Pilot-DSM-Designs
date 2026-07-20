<?php
/**
 * Asset enqueueing.
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * filemtime()-based cache-busting for dev — avoids stale CSS/JS after every save.
 */
function dsmd_asset_version( $relative_path ) {
	$path = DSMD_THEME_DIR . $relative_path;
	return file_exists( $path ) ? filemtime( $path ) : DSMD_THEME_VERSION;
}

function dsmd_enqueue_frontend() {
	// Fonts matching the live reference (dsmdesigns.dreamhosters.com):
	// Cormorant Garamond (hero display), Playfair Display (section
	// headings), Roboto (body), Montserrat (nav/buttons/labels).
	wp_enqueue_style(
		'dsmd-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Playfair+Display:wght@400;600;700&family=Roboto:wght@400;500&family=Montserrat:wght@500;600&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'dsmd-main',
		DSMD_THEME_URI . '/assets/css/main.css',
		array( 'dsmd-fonts' ),
		dsmd_asset_version( '/assets/css/main.css' )
	);

	wp_enqueue_script(
		'dsmd-main',
		DSMD_THEME_URI . '/assets/js/main.js',
		array(),
		dsmd_asset_version( '/assets/js/main.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'dsmd_enqueue_frontend' );

/**
 * Load the Google Fonts stylesheet asynchronously so it never blocks first
 * paint (preload + swap-on-load, noscript fallback).
 */
function dsmd_async_google_fonts( $html, $handle ) {
	if ( 'dsmd-fonts' !== $handle ) {
		return $html;
	}
	if ( ! preg_match( "/href=['\"]([^'\"]+)['\"]/", $html, $m ) ) {
		return $html;
	}
	$href = $m[1];
	return '<link rel="preload" as="style" href="' . esc_url( $href ) . '" onload="this.onload=null;this.rel=\'stylesheet\'">'
		. '<noscript><link rel="stylesheet" href="' . esc_url( $href ) . '"></noscript>';
}
add_filter( 'style_loader_tag', 'dsmd_async_google_fonts', 10, 2 );
