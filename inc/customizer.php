<?php
/**
 * BenSemangat Theme Customizer
 *
 * @package BenSemangat
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'bensemangat_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function bensemangat_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'bensemangat_customize_register' );

if ( ! function_exists( 'bensemangat_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function bensemangat_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'bensemangat_theme_layout_options',
			array(
				'title'       => __( 'Theme Layout Settings', 'bensemangat' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'bensemangat' ),
				'priority'    => apply_filters( 'bensemangat_theme_layout_options_priority', 160 ),
			)
		);

		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		function bensemangat_theme_slug_sanitize_select( $input, $setting ) {

			// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
			$input = sanitize_key( $input );

			// Get the list of possible select options.
			$choices = $setting->manager->get_control( $setting->id )->choices;

			// If the input is a valid key, return it; otherwise, return the default.
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

		}

		$wp_customize->add_setting(
			'bensemangat_container_type',
			array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'bensemangat_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'bensemangat_container_type',
				array(
					'label'       => __( 'Container Width', 'bensemangat' ),
					'description' => __( 'Choose between Bootstrap\'s container and container-fluid', 'bensemangat' ),
					'section'     => 'bensemangat_theme_layout_options',
					'settings'    => 'bensemangat_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'bensemangat' ),
						'container-fluid' => __( 'Full width container', 'bensemangat' ),
					),
					'priority'    => apply_filters( 'bensemangat_container_type_priority', 10 ),
				)
			)
		);

		$wp_customize->add_setting(
			'bensemangat_sidebar_position',
			array(
				'default'           => 'right',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'bensemangat_sidebar_position',
				array(
					'label'             => __( 'Sidebar Positioning', 'bensemangat' ),
					'description'       => __(
						'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
						'bensemangat'
					),
					'section'           => 'bensemangat_theme_layout_options',
					'settings'          => 'bensemangat_sidebar_position',
					'type'              => 'select',
					'sanitize_callback' => 'bensemangat_theme_slug_sanitize_select',
					'choices'           => array(
						'right' => __( 'Right sidebar', 'bensemangat' ),
						'left'  => __( 'Left sidebar', 'bensemangat' ),
						'both'  => __( 'Left & Right sidebars', 'bensemangat' ),
						'none'  => __( 'No sidebar', 'bensemangat' ),
					),
					'priority'          => apply_filters( 'bensemangat_sidebar_position_priority', 20 ),
				)
			)
		);
	}
} // End of if function_exists( 'bensemangat_theme_customize_register' ).
add_action( 'customize_register', 'bensemangat_theme_customize_register' );

// Custom
if ( ! function_exists( 'bensemangat_site_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function bensemangat_site_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'bensemangat_site_info_options',
			array(
				'title'       => __( 'Site Info Settings', 'bensemangat' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Info about this site', 'bensemangat' ),
				'priority'    => apply_filters( 'bensemangat_site_info_options_priority', 160 ),
			)
		);

		$wp_customize->add_setting(
			'bensemangat_site_info_phone',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'bensemangat_site_info_phone',
				array(
					'label'             => __( 'Phone Number', 'bensemangat' ),
					'description'       => __(
						'Please enter your phone number to display in the top bar of the navigation menu.'
					),
					'section'           => 'bensemangat_site_info_options',
					'settings'          => 'bensemangat_site_info_phone',
					'type'              => 'text',
					'priority'          => apply_filters( 'bensemangat_site_info_phone_priority', 20 ),
				)
			)
		);
	}
} // End of if function_exists( 'bensemangat_site_customize_register' ).
add_action( 'customize_register', 'bensemangat_site_customize_register' );
// End Custom

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'bensemangat_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function bensemangat_customize_preview_js() {
		wp_enqueue_script(
			'bensemangat_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ),
			'20130508',
			true
		);
	}
}
add_action( 'customize_preview_init', 'bensemangat_customize_preview_js' );
