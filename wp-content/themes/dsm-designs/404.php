<?php
/**
 * 404 template.
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" tabindex="-1" class="site-main">
	<div class="dsmd-container dsmd-404">
		<h1><?php esc_html_e( 'Page not found', 'dsm-designs' ); ?></h1>
		<p><?php esc_html_e( 'The page you are looking for does not exist. It may have been moved or removed.', 'dsm-designs' ); ?></p>
		<a class="dsmd-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to homepage', 'dsm-designs' ); ?></a>
	</div>
</main>

<?php get_footer(); ?>
