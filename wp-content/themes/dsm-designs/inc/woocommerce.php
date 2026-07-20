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
add_filter( 'loop_shop_per_page', fn() => 6 );

/**
 * Category/archive banner — photo + breadcrumb + title, matching the
 * reference's archive header. Hooks only, no template override (WC-001).
 */
function dsmd_wc_archive_banner() {
	if ( ! is_shop() && ! is_product_taxonomy() ) {
		return;
	}
	$title = '';
	if ( is_shop() ) {
		$title = __( 'Shop', 'dsm-designs' );
	} elseif ( is_product_category() || is_product_tag() ) {
		$title = single_term_title( '', false );
	}
	$term        = is_product_taxonomy() ? get_queried_object() : null;
	$thumb_id    = $term ? get_term_meta( $term->term_id, 'thumbnail_id', true ) : '';
	$banner_url  = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'large' ) : '';
	$style       = $banner_url ? ' style="background-image:url(' . esc_url( $banner_url ) . ')"' : '';
	?>
	<div class="dsmd-archive-banner"<?php echo $style; // phpcs:ignore ?>>
		<div class="dsmd-container">
			<?php if ( function_exists( 'woocommerce_breadcrumb' ) ) : ?>
				<div class="dsmd-archive-breadcrumb"><?php woocommerce_breadcrumb( array( 'delimiter' => ' &middot; ', 'wrap_before' => '', 'wrap_after' => '', 'before' => '', 'after' => '' ) ); ?></div>
			<?php endif; ?>
			<h1 class="dsmd-archive-title"><?php echo esc_html( $title ); ?></h1>
			<span class="dsmd-archive-rule"></span>
			<p class="dsmd-archive-sub"><?php echo esc_html( $title ); ?></p>
		</div>
	</div>
	<?php
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'woocommerce_before_main_content', 'dsmd_wc_archive_banner', 5 );

/**
 * Toolbar row + filter sidebar wrapper — the reference splits the archive
 * into a left "Filter" column and a right product grid.
 */
add_action( 'woocommerce_before_shop_loop', 'dsmd_wc_shop_layout_start', 5 );
function dsmd_wc_shop_layout_start() {
	echo '<div class="dsmd-shop-layout"><aside class="dsmd-shop-filter"><h3>' . esc_html__( 'Filter', 'dsm-designs' ) . '</h3></aside><div class="dsmd-shop-main">';
}
add_action( 'woocommerce_after_shop_loop', 'dsmd_wc_shop_layout_end', 30 );
function dsmd_wc_shop_layout_end() {
	echo '</div></div>';
}
