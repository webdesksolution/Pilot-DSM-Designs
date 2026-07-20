<?php
/**
 * Single post template.
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
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content' );
		endwhile;
		?>
	</div>
</main>

<?php get_footer(); ?>
