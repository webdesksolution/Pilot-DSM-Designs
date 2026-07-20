<?php
/**
 * Homepage template — reference-aligned sections (MOD-06).
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

get_header();
?>

<main id="primary" tabindex="-1" class="site-main dsmd-home">

	<section class="dsmd-hero">
		<div class="dsmd-container dsmd-hero-grid">
			<div class="dsmd-hero-copy">
				<p class="dsmd-eyebrow"><?php esc_html_e( 'Designed for Luxury &amp; Function', 'dsm-designs' ); ?></p>
				<h1><?php echo wp_kses_post( __( 'Bespoke Salon &amp;<br>Spa <em>Furniture</em>', 'dsm-designs' ) ); ?></h1>
				<p class="dsmd-hero-sub"><?php esc_html_e( 'Custom-built styling stations, reception desks, and spa furnishings — made to order and made to define modern beauty interiors.', 'dsm-designs' ); ?></p>
				<div class="dsmd-hero-actions">
					<a class="dsmd-btn dsmd-btn-primary" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>"><?php esc_html_e( 'Shop the Collection', 'dsm-designs' ); ?></a>
					<a class="dsmd-btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start a Custom Build', 'dsm-designs' ); ?></a>
				</div>
			</div>
			<div class="dsmd-hero-media">
				<?php
				$dsmd_hero_products = function_exists( 'wc_get_products' ) ? wc_get_products( array( 'limit' => 1, 'status' => 'publish', 'orderby' => 'date', 'order' => 'DESC' ) ) : array();
				if ( $dsmd_hero_products ) {
					echo wp_kses_post( $dsmd_hero_products[0]->get_image( 'dsmd-hero' ) );
				}
				?>
				<span class="dsmd-hero-badge"><b>14+</b> <?php esc_html_e( 'years of bespoke work', 'dsm-designs' ); ?></span>
			</div>
		</div>
	</section>

	<?php if ( function_exists( 'wc_get_products' ) ) : ?>
		<section class="dsmd-section" aria-labelledby="dsmd-featured-h">
			<div class="dsmd-container">
				<div class="dsmd-sec-head">
					<p class="dsmd-eyebrow"><?php esc_html_e( 'Featured', 'dsm-designs' ); ?></p>
					<h2 id="dsmd-featured-h" class="dsmd-section-title"><?php esc_html_e( 'Best-selling pieces', 'dsm-designs' ); ?></h2>
					<span class="dsmd-rule"></span>
				</div>
				<div class="dsmd-product-grid">
					<?php
					$dsmd_products = wc_get_products( array( 'status' => 'publish', 'limit' => 4, 'orderby' => 'date', 'order' => 'DESC' ) );
					foreach ( $dsmd_products as $dsmd_product ) :
						?>
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
			</div>
		</section>
	<?php endif; ?>

	<section class="dsmd-stats" aria-label="<?php esc_attr_e( 'By the numbers', 'dsm-designs' ); ?>">
		<div class="dsmd-container dsmd-stats-row">
			<div class="dsmd-stat"><span class="dsmd-stat-n">14+</span><span class="dsmd-stat-l"><?php esc_html_e( 'Years in Business', 'dsm-designs' ); ?></span></div>
			<div class="dsmd-stat"><span class="dsmd-stat-n">25+</span><span class="dsmd-stat-l"><?php esc_html_e( 'States Served', 'dsm-designs' ); ?></span></div>
			<div class="dsmd-stat"><span class="dsmd-stat-n">300+</span><span class="dsmd-stat-l"><?php esc_html_e( 'Installations', 'dsm-designs' ); ?></span></div>
		</div>
	</section>

	<?php
	if ( taxonomy_exists( 'product_cat' ) ) :
		$dsmd_cats = get_terms( array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'exclude'    => array( (int) get_option( 'default_product_cat' ) ),
			'number'     => 6,
			'orderby'    => 'count',
			'order'      => 'DESC',
		) );
		if ( ! is_wp_error( $dsmd_cats ) && $dsmd_cats ) :
			?>
			<section class="dsmd-section dsmd-section--alt" aria-labelledby="dsmd-cats-h">
				<div class="dsmd-container">
					<div class="dsmd-sec-head">
						<p class="dsmd-eyebrow"><?php esc_html_e( 'Shop by category', 'dsm-designs' ); ?></p>
						<h2 id="dsmd-cats-h" class="dsmd-section-title"><?php esc_html_e( 'Signature collections', 'dsm-designs' ); ?></h2>
						<span class="dsmd-rule"></span>
					</div>
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
				</div>
			</section>
			<?php
		endif;
	endif;
	?>

	<section class="dsmd-section" aria-labelledby="dsmd-why-h">
		<div class="dsmd-container">
			<div class="dsmd-sec-head">
				<p class="dsmd-eyebrow"><?php esc_html_e( 'Why DSM', 'dsm-designs' ); ?></p>
				<h2 id="dsmd-why-h" class="dsmd-section-title"><?php esc_html_e( 'Built right, backed fully', 'dsm-designs' ); ?></h2>
				<span class="dsmd-rule"></span>
			</div>
			<div class="dsmd-why-grid">
				<div class="dsmd-why"><span class="dsmd-why-mark">I</span><h3><?php esc_html_e( 'Top-Quality Materials', 'dsm-designs' ); ?></h3><p><?php esc_html_e( 'Commercial-grade laminates and hardware built for daily salon use.', 'dsm-designs' ); ?></p></div>
				<div class="dsmd-why"><span class="dsmd-why-mark">II</span><h3><?php esc_html_e( 'Fair Pricing', 'dsm-designs' ); ?></h3><p><?php esc_html_e( 'Made-to-order furniture without the designer markup.', 'dsm-designs' ); ?></p></div>
				<div class="dsmd-why"><span class="dsmd-why-mark">III</span><h3><?php esc_html_e( 'Free USA Shipping', 'dsm-designs' ); ?></h3><p><?php esc_html_e( 'Complimentary shipping on qualifying orders nationwide.', 'dsm-designs' ); ?></p></div>
				<div class="dsmd-why"><span class="dsmd-why-mark">IV</span><h3><?php esc_html_e( 'Ongoing Support', 'dsm-designs' ); ?></h3><p><?php esc_html_e( 'Guidance from design through delivery and beyond.', 'dsm-designs' ); ?></p></div>
			</div>
		</div>
	</section>

	<?php
	if ( taxonomy_exists( 'product_cat' ) ) :
		$dsmd_proj = get_terms( array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'slug'       => array( 'styling-stations', 'retail', 'spa' ),
		) );
		if ( ! is_wp_error( $dsmd_proj ) && $dsmd_proj ) :
			?>
			<section class="dsmd-section dsmd-section--tight" aria-labelledby="dsmd-proj-h">
				<div class="dsmd-container">
					<div class="dsmd-sec-head">
						<p class="dsmd-eyebrow"><?php esc_html_e( 'Our salon projects', 'dsm-designs' ); ?></p>
						<h2 id="dsmd-proj-h" class="dsmd-section-title"><?php esc_html_e( 'Designed for real spaces', 'dsm-designs' ); ?></h2>
						<span class="dsmd-rule"></span>
					</div>
					<div class="dsmd-projects">
						<?php foreach ( $dsmd_proj as $dsmd_pcat ) : ?>
							<a class="dsmd-project" href="<?php echo esc_url( get_term_link( $dsmd_pcat ) ); ?>">
								<span class="dsmd-project-thumb"><?php echo wp_kses_post( dsmd_category_image( $dsmd_pcat ) ); ?></span>
								<span class="dsmd-project-label"><?php echo esc_html( $dsmd_pcat->name ); ?><span class="dsmd-project-view"><?php esc_html_e( 'View project', 'dsm-designs' ); ?></span></span>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<?php
		endif;
	endif;
	?>

	<section class="dsmd-financing" aria-labelledby="dsmd-fin-h">
		<div class="dsmd-container dsmd-financing-grid">
			<div>
				<p class="dsmd-eyebrow"><?php esc_html_e( 'Financing', 'dsm-designs' ); ?></p>
				<h2 id="dsmd-fin-h"><?php esc_html_e( 'Outfit your space now, pay over time', 'dsm-designs' ); ?></h2>
				<p class="dsmd-financing-text"><?php esc_html_e( 'Flexible financing for salon and spa professionals, with fast approvals. Bring your vision to life without the upfront cost.', 'dsm-designs' ); ?></p>
				<a class="dsmd-btn dsmd-btn-primary" href="<?php echo esc_url( home_url( '/financing/' ) ); ?>"><?php esc_html_e( 'Apply for Financing', 'dsm-designs' ); ?></a>
			</div>
			<div class="dsmd-financing-panel"><span><?php esc_html_e( 'Financing partner', 'dsm-designs' ); ?></span></div>
		</div>
	</section>

	<section class="dsmd-section dsmd-section--alt" aria-labelledby="dsmd-tst-h">
		<div class="dsmd-container">
			<div class="dsmd-sec-head">
				<p class="dsmd-eyebrow"><?php esc_html_e( 'Loved by professionals', 'dsm-designs' ); ?></p>
				<h2 id="dsmd-tst-h" class="dsmd-section-title"><?php esc_html_e( 'What our clients say', 'dsm-designs' ); ?></h2>
				<span class="dsmd-rule"></span>
			</div>
			<div class="dsmd-testimonials">
				<figure class="dsmd-quote"><div class="dsmd-stars">★★★★★</div><blockquote><?php esc_html_e( 'The custom styling stations transformed our salon. Quality and finish are outstanding.', 'dsm-designs' ); ?></blockquote><figcaption><b>Marissa L.</b><?php esc_html_e( 'Salon Owner, Austin TX', 'dsm-designs' ); ?></figcaption></figure>
				<figure class="dsmd-quote"><div class="dsmd-stars">★★★★★</div><blockquote><?php esc_html_e( 'Fair pricing and the team guided every step. Delivery was smooth across state lines.', 'dsm-designs' ); ?></blockquote><figcaption><b>Devon R.</b><?php esc_html_e( 'Spa Director, Denver CO', 'dsm-designs' ); ?></figcaption></figure>
				<figure class="dsmd-quote"><div class="dsmd-stars">★★★★★</div><blockquote><?php esc_html_e( 'Bespoke work that fit our exact layout. Clients always comment on the furniture.', 'dsm-designs' ); ?></blockquote><figcaption><b>Priya S.</b><?php esc_html_e( 'Studio Owner, Chicago IL', 'dsm-designs' ); ?></figcaption></figure>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
