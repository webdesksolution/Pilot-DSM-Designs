<?php
/**
 * Fallback template.
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
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content' );
			endwhile;
			?>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing found.', 'dsm-designs' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
