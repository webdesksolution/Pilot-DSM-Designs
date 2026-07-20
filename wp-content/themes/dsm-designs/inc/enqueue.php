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
	// Brand fonts matching the approved design direction: Playfair Display
	// (headings), Inter (body), Montserrat (labels). Google Fonts with
	// preconnect; swap to self-hosted before launch if privacy/perf requires.
	wp_enqueue_style(
		'dsmd-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600&family=Montserrat:wght@500;600&display=swap',
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
