<?php
/**
 * Dynamic homepage blocks (MOD-05A DYN classification).
 *
 * These render WooCommerce-sourced data that Elementor Free cannot manage
 * natively. Inserted into the Elementor-built homepage via the core
 * Shortcode widget. Authoritative data stays in WooCommerce; nothing here
 * is client-editable through the Elementor canvas.
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Representative image for a product category = its first product's image.
 *
 * @param WP_Term $cat Category term.
 * @return string HTML img or empty string.
 */
function dsmd_category_image( $cat ) {
	if ( ! function_exists( 'wc_get_products' ) ) {
		return '';
	}
	$products = wc_get_products( array(
		'category' => array( $cat->slug ),
		'limit'    => 1,
		'status'   => 'publish',
		'orderby'  => 'date',
		'order'    => 'DESC',
	) );
	if ( $products ) {
		$image_id = $products[0]->get_image_id();
		if ( $image_id ) {
			return wp_get_attachment_image( $image_id, 'dsmd-category-card', false, array( 'alt' => $cat->name ) );
		}
	}
	return '';
}

/**
 * Find an image attachment by its exact title (avoids the deprecated
 * get_page_by_title()).
 *
 * @param string $title Attachment title.
 * @return int Attachment ID, or 0 if not found.
 */
function dsmd_attachment_id_by_title( $title ) {
	$query = new WP_Query( array(
		'post_type'      => 'attachment',
		'post_status'    => 'inherit',
		'title'          => $title,
		'posts_per_page' => 1,
		'fields'         => 'ids',
	) );
	return $query->have_posts() ? (int) $query->posts[0] : 0;
}

/**
 * [dsmd_hero_media] — latest product image + years-in-business badge.
 */
function dsmd_shortcode_hero_media() {
	if ( ! function_exists( 'wc_get_products' ) ) {
		return '';
	}
	ob_start();
	$dsmd_hero_products = wc_get_products( array( 'limit' => 1, 'status' => 'publish', 'orderby' => 'date', 'order' => 'DESC' ) );
	?>
	<div class="dsmd-hero-media">
		<?php
		if ( $dsmd_hero_products ) {
			echo wp_kses_post( $dsmd_hero_products[0]->get_image( 'dsmd-hero' ) );
		}
		?>
		<span class="dsmd-hero-badge"><b>14+</b> <?php esc_html_e( 'years of bespoke work', 'dsm-designs' ); ?></span>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'dsmd_hero_media', 'dsmd_shortcode_hero_media' );

/**
 * [dsmd_featured_products] — latest 4 published products.
 */
function dsmd_shortcode_featured_products() {
	if ( ! function_exists( 'wc_get_products' ) ) {
		return '';
	}
	ob_start();
	$dsmd_products = wc_get_products( array( 'status' => 'publish', 'limit' => 4, 'orderby' => 'date', 'order' => 'DESC' ) );
	?>
	<div class="dsmd-product-grid">
		<?php foreach ( $dsmd_products as $dsmd_product ) : ?>
			<a class="dsmd-product-card" href="<?php echo esc_url( $dsmd_product->get_permalink() ); ?>">
				<span class="dsmd-product-thumb"><?php echo wp_kses_post( $dsmd_product->get_image( 'dsmd-category-card' ) ); ?></span>
				<span class="dsmd-product-body">
					<span class="dsmd-product-name"><?php echo esc_html( $dsmd_product->get_name() ); ?></span>
					<span class="dsmd-product-price"><?php echo wp_kses_post( $dsmd_product->get_price_html() ); ?></span>
					<span class="dsmd-select"><?php esc_html_e( 'Select options', 'dsm-designs' ); ?></span>
				</span>
			</a>
		<?php endforeach; ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'dsmd_featured_products', 'dsmd_shortcode_featured_products' );

/**
 * [dsmd_category_grid] — top 6 product categories by product count.
 */
function dsmd_shortcode_category_grid() {
	if ( ! taxonomy_exists( 'product_cat' ) ) {
		return '';
	}
	$dsmd_cats = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'exclude'    => array( (int) get_option( 'default_product_cat' ) ),
		'number'     => 6,
		'orderby'    => 'count',
		'order'      => 'DESC',
	) );
	if ( is_wp_error( $dsmd_cats ) || ! $dsmd_cats ) {
		return '';
	}
	ob_start();
	?>
	<div class="dsmd-category-grid">
		<?php foreach ( $dsmd_cats as $dsmd_cat ) : ?>
			<a class="dsmd-category-card" href="<?php echo esc_url( get_term_link( $dsmd_cat ) ); ?>">
				<span class="dsmd-category-thumb"><?php echo wp_kses_post( dsmd_category_image( $dsmd_cat ) ); ?></span>
				<span class="dsmd-category-name"><?php echo esc_html( $dsmd_cat->name ); ?>
					<span class="dsmd-category-count"><?php echo esc_html( sprintf( _n( '%d piece', '%d pieces', $dsmd_cat->count, 'dsm-designs' ), $dsmd_cat->count ) ); ?></span>
				</span>
			</a>
		<?php endforeach; ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'dsmd_category_grid', 'dsmd_shortcode_category_grid' );

/**
 * [dsmd_projects] — styling-stations / retail / spa category showcase.
 * Uses the client-approved curated images (not category product thumbs).
 */
function dsmd_shortcode_projects() {
	if ( ! taxonomy_exists( 'product_cat' ) ) {
		return '';
	}
	$dsmd_proj_map = array(
		'styling-stations' => 'Styling-Station.webp',
		'retail'           => 'Retail.webp',
		'spa'              => 'spa.webp',
	);
	ob_start();
	?>
	<div class="dsmd-projects">
		<?php foreach ( $dsmd_proj_map as $dsmd_slug => $dsmd_file ) :
			$dsmd_term = get_term_by( 'slug', $dsmd_slug, 'product_cat' );
			if ( ! $dsmd_term || is_wp_error( $dsmd_term ) ) {
				continue;
			}
			$dsmd_attachment_id = dsmd_attachment_id_by_title( pathinfo( $dsmd_file, PATHINFO_FILENAME ) );
			$dsmd_img_url       = $dsmd_attachment_id ? wp_get_attachment_image_url( $dsmd_attachment_id, 'large' ) : '';
			?>
			<a class="dsmd-project" href="<?php echo esc_url( get_term_link( $dsmd_term ) ); ?>">
				<span class="dsmd-project-thumb">
					<?php if ( $dsmd_img_url ) : ?>
						<img src="<?php echo esc_url( $dsmd_img_url ); ?>" alt="<?php echo esc_attr( $dsmd_term->name ); ?>">
					<?php endif; ?>
				</span>
				<span class="dsmd-project-label"><?php echo esc_html( $dsmd_term->name ); ?><span class="dsmd-project-view"><?php esc_html_e( 'View project', 'dsm-designs' ); ?></span></span>
			</a>
		<?php endforeach; ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'dsmd_projects', 'dsmd_shortcode_projects' );

/**
 * [dsmd_project_gallery] — six curated project photos, "View Project" overlay.
 * Client-approved reference assets (g1–g6); no category linkage.
 */
function dsmd_shortcode_project_gallery() {
	ob_start();
	?>
	<div class="dsmd-gallery-grid">
		<?php for ( $i = 1; $i <= 6; $i++ ) :
			$dsmd_attachment_id = dsmd_attachment_id_by_title( 'g' . $i );
			$dsmd_img_url       = $dsmd_attachment_id ? wp_get_attachment_image_url( $dsmd_attachment_id, 'large' ) : '';
			if ( ! $dsmd_img_url ) {
				continue;
			}
			?>
			<span class="dsmd-gallery-card">
				<img src="<?php echo esc_url( $dsmd_img_url ); ?>" alt="<?php esc_attr_e( 'View project', 'dsm-designs' ); ?>">
				<span class="dsmd-gallery-cta"><?php esc_html_e( 'View project', 'dsm-designs' ); ?></span>
			</span>
		<?php endfor; ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'dsmd_project_gallery', 'dsmd_shortcode_project_gallery' );
