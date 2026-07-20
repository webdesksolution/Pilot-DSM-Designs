<?php
/**
 * Archive template (blog/category/tag archives — not WooCommerce, which uses its own).
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" tabindex="-1" class="site-main">
	<div class="dsmd-container">
		<header class="archive-header">
			<h1 class="archive-title"><?php the_archive_title(); ?></h1>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="dsmd-archive-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content' );
				endwhile;
				?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing found.', 'dsm-designs' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
