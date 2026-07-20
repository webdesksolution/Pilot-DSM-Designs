<?php
/**
 * WooCommerce integration — hooks only, no template overrides (WC-001).
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dsmd_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'dsmd_woocommerce_setup' );

/**
 * WooCommerce's default templates expect the theme to wrap output in
 * #primary/.site-main — standard classic-theme integration pattern.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'dsmd_wc_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'dsmd_wc_wrapper_end', 10 );

function dsmd_wc_wrapper_start() {
	echo '<main id="primary" tabindex="-1" class="site-main woocommerce-main"><div class="dsmd-container">';
}

function dsmd_wc_wrapper_end() {
	echo '</div></main>';
}

/**
 * Reduce default shop columns/per-page to fit the card layout better on a small catalog.
 */
add_filter( 'loop_shop_columns', fn() => 3 );
add_filter( 'loop_shop_per_page', fn() => 12 );
