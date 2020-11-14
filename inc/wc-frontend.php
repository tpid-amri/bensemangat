<?php 
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

/**
* Add a custom link to the end of a specific menu that uses the wp_nav_menu() function
*/
add_filter('wp_nav_menu_items', 'woo_cart_but_icon', 10, 2);
function woo_cart_but_icon($items, $args){
    if( $args->theme_location == 'secondary' ){
        $items .=  do_shortcode('[woo_cart_but]');
    }
    return $items;
}