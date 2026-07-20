<?php
/**
 * Customizer — fields for content a client will plausibly want to edit
 * without a developer (per theme-structure-patterns dynamic-vs-hardcoded rule).
 *
 * @package DsmDesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dsmd_customizer( $wp_customize ) {
	$wp_customize->add_section( 'dsmd_footer', array(
		'title'    => __( 'Footer Settings', 'dsm-designs' ),
		'priority' => 120,
	) );

	$wp_customize->add_setting( 'dsmd_footer_text', array(
		'default'           => sprintf( '&copy; %s %s. All rights reserved.', gmdate( 'Y' ), get_bloginfo( 'name' ) ),
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'dsmd_footer_text', array(
		'label'   => __( 'Footer copyright text', 'dsm-designs' ),
		'section' => 'dsmd_footer',
		'type'    => 'text',
	) );
}
add_action( 'customize_register', 'dsmd_customizer' );
