<?php
/**
 * Template Name: Homepage Template
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package BenSemangat
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

	get_template_part( 'component-templates/comp', 'slider' );
	get_template_part( 'component-templates/comp', 'featured' );
	get_template_part( 'component-templates/comp', 'product' );

get_footer();
