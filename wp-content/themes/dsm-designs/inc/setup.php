<?php
/**
 * Theme setup: support flags, menus, image sizes.
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dsmd_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'custom-logo', array(
		'height'      => 96,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	add_image_size( 'dsmd-hero', 1920, 900, true );
	add_image_size( 'dsmd-category-card', 640, 480, true );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'dsm-designs' ),
		'footer'  => __( 'Footer Menu', 'dsm-designs' ),
	) );

	add_editor_style( 'assets/css/editor.css' );
	load_theme_textdomain( 'dsm-designs', DSMD_THEME_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'dsmd_theme_setup' );
