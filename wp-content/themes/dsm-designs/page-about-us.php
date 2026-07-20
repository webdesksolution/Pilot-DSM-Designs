<?php
/**
 * "About Us" page override — per theme-structure-patterns page-{slug}.php convention.
 * Placeholder copy pending real client content (see sow-spec.md Brand & Design Discovery).
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" tabindex="-1" class="site-main dsmd-about">
	<section class="dsmd-hero dsmd-hero-compact">
		<div class="dsmd-container dsmd-hero-inner">
			<p class="dsmd-eyebrow"><?php esc_html_e( 'About DSM Designs', 'dsm-designs' ); ?></p>
			<h1><?php esc_html_e( 'Design. Build. Install.', 'dsm-designs' ); ?></h1>
		</div>
	</section>

	<div class="dsmd-container dsmd-about-body">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>

		<div class="dsmd-about-cta">
			<a class="dsmd-btn dsmd-btn-primary" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>">
				<?php esc_html_e( 'Shop the Collection', 'dsm-designs' ); ?>
			</a>
		</div>
	</div>
</main>

<?php get_footer(); ?>
