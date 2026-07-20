<?php
/**
 * Search results template.
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
			<h1 class="archive-title">
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'Search results for: %s', 'dsm-designs' ),
					'<span>' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
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
			<p><?php esc_html_e( 'Nothing found. Try a different search.', 'dsm-designs' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
