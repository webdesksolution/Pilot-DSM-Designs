<?php
/**
 * Homepage template (MOD-05A) — delegates content to the Elementor-built
 * "Home" page assigned as the static front page. Sections stay full-bleed
 * here; each Elementor section container applies its own .dsmd-container
 * wrapper for max-width content, matching the approved design.
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" tabindex="-1" class="site-main dsmd-home">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	}
	?>
</main>

<?php get_footer(); ?>
