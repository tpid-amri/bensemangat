<?php
/**
 * Add WooCommerce support
 *
 * @package BenSemangat
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'bensemangat_woocommerce_support' );
if ( ! function_exists( 'bensemangat_woocommerce_support' ) ) {
	/**
	 * Declares WooCommerce theme support.
	 */
	function bensemangat_woocommerce_support() {
		add_theme_support( 'woocommerce' );

		// Add Product Gallery support.
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add Bootstrap classes to form fields.
		add_filter( 'woocommerce_form_field_args', 'bensemangat_wc_form_field_args', 10, 3 );
	}
}

// First unhook the WooCommerce content wrappers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Then hook in your own functions to display the wrappers your theme requires.
add_action( 'woocommerce_before_main_content', 'bensemangat_woocommerce_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'bensemangat_woocommerce_wrapper_end', 10 );

if ( ! function_exists( 'bensemangat_woocommerce_wrapper_start' ) ) {
	/**
	 * Display the theme specific start of the page wrapper.
	 */
	function bensemangat_woocommerce_wrapper_start() {
		echo '<div class="wrapper" id="woocommerce-wrapper">';
		echo '<div class="container-fluid" id="content" tabindex="-1">';
		echo '<div class="row">';
		get_template_part( 'global-templates/left-sidebar-check' );
		echo '<main class="site-main" id="main">';
	}
}

if ( ! function_exists( 'bensemangat_woocommerce_wrapper_end' ) ) {
	/**
	 * Display the theme specific end of the page wrapper.
	 */
	function bensemangat_woocommerce_wrapper_end() {
		echo '</main><!-- #main -->';
		get_template_part( 'global-templates/right-sidebar-check' );
		echo '</div><!-- .row -->';
		echo '</div><!-- Container end -->';
		echo '</div><!-- Wrapper end -->';
	}
}

if ( ! function_exists( 'bensemangat_wc_form_field_args' ) ) {
	/**
	 * Filter hook function monkey patching form classes
	 * Author: Adriano Monecchi http://stackoverflow.com/a/36724593/307826
	 *
	 * @param string $args Form attributes.
	 * @param string $key Not in use.
	 * @param null   $value Not in use.
	 *
	 * @return mixed
	 */
	function bensemangat_wc_form_field_args( $args, $key, $value = null ) {
		// Start field type switch case.
		switch ( $args['type'] ) {
			// Targets all select input type elements, except the country and state select input types.
			case 'select':
				/*
				 * Add a class to the field's html element wrapper - woocommerce
				 * input types (fields) are often wrapped within a <p></p> tag.
				 */
				$args['class'][] = 'form-group';
				// Add a class to the form input itself.
				$args['input_class'] = array( 'form-control' );
				// Add custom data attributes to the form input itself.
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;

			/*
			 * By default WooCommerce will populate a select with the country names - $args
			 * defined for this specific input type targets only the country select element.
			 */
			case 'country':
				$args['class'][] = 'form-group single-country';
				break;

			/*
			 * By default WooCommerce will populate a select with state names - $args defined
			 * for this specific input type targets only the country select element.
			 */
			case 'state':
				$args['class'][]           = 'form-group';
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;
			case 'password':
			case 'text':
			case 'email':
			case 'tel':
			case 'number':
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control' );
				break;
			case 'textarea':
				$args['input_class'] = array( 'form-control' );
				break;
			case 'checkbox':
					$args['class'][] = 'form-group';
					// Wrap the label in <span> tag.
					$args['label'] = isset( $args['label'] ) ? '<span class="custom-control-label">' . $args['label'] . '<span>' : '';
					// Add a class to the form input's <label> tag.
					$args['label_class'] = array( 'custom-control custom-checkbox' );
					$args['input_class'] = array( 'custom-control-input' );
				break;
			case 'radio':
				$args['label_class'] = array( 'custom-control custom-radio' );
				$args['input_class'] = array( 'custom-control-input' );
				break;
			default:
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control' );
				break;
		} // End of switch ( $args ).
		return $args;
	}
}

if ( ! is_admin() && ! function_exists( 'wc_review_ratings_enabled' ) ) {
	/**
	 * Check if reviews are enabled.
	 *
	 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
	 *
	 * @return bool
	 */
	function wc_reviews_enabled() {
		return 'yes' === get_option( 'woocommerce_enable_reviews' );
	}

	/**
	 * Check if reviews ratings are enabled.
	 *
	 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
	 *
	 * @return bool
	 */
	function wc_review_ratings_enabled() {
		return wc_reviews_enabled() && 'yes' === get_option( 'woocommerce_enable_review_rating' );
	}

	// Tambahan dewe

	/**
	 * Show cart contents / total Ajax
	 */
	add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		?>
		<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> – <?php echo $woocommerce->cart->get_cart_total(); ?></a>
		<?php
		$fragments['a.cart-customlocation'] = ob_get_clean();
		return $fragments;
	}

	add_shortcode ('woo_cart_but', 'woo_cart_but' );
	/**
	 * Create Shortcode for WooCommerce Cart Menu Item
	 */
	function woo_cart_but() {
		ob_start();
	 
			$cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
			$cart_url = wc_get_cart_url();  // Set Cart URL
	  
			?>
			<li><a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="My Basket">
			<?php
			if ( $cart_count > 0 ) {
		   ?>
				<span class="cart-contents-count"><?php echo $cart_count; ?></span>
			<?php
			}
			?>
			</a></li>
			<?php
				
		return ob_get_clean();
	 
	}
	add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );
	/**
	 * Add AJAX Shortcode when cart contents update
	 */
	function woo_cart_but_count( $fragments ) {
	
		ob_start();
		
		$cart_count = WC()->cart->cart_contents_count;
		$cart_url = wc_get_cart_url();
		
		?>
		<a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">
		<?php
		if ( $cart_count > 0 ) {
			?>
			<span class="cart-contents-count"><?php echo $cart_count; ?></span>
			<?php            
		}
			?></a>
		<?php
	
		$fragments['a.cart-contents'] = ob_get_clean();
		
		return $fragments;
	}
	add_filter( 'wp_nav_menu_secondary-menu_items', 'woo_cart_but_icon', 10, 2 ); // Change menu to suit - example uses 'top-menu'

	/**
	 * Add WooCommerce Cart Menu Item Shortcode to particular menu
	 */
	function woo_cart_but_icon ( $items, $args ) {
		$items .=  '[woo_cart_but]'; // Adding the created Icon via the shortcode already created
		
		return $items;
	}

}
