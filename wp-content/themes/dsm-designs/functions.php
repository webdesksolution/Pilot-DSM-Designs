<?php
/**
 * Theme functions
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DSMD_THEME_VERSION', '0.1.0' );
define( 'DSMD_THEME_DIR', get_template_directory() );
define( 'DSMD_THEME_URI', get_template_directory_uri() );

require_once DSMD_THEME_DIR . '/inc/setup.php';
require_once DSMD_THEME_DIR . '/inc/enqueue.php';
require_once DSMD_THEME_DIR . '/inc/woocommerce.php';
require_once DSMD_THEME_DIR . '/inc/customizer.php';
require_once DSMD_THEME_DIR . '/inc/mega-menu.php';
require_once DSMD_THEME_DIR . '/inc/emails.php';
require_once DSMD_THEME_DIR . '/inc/swatches.php';
