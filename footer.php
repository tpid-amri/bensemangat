<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package BenSemangat
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'bensemangat_container_type' );
?>

<footer class="site-footer" id="colophon">
<div class="text-center my-4">
<?php 
	$lsitBank = [
		'bca',
		'bni',
		'mandiri',
		'permata',
		'ovo',
		'dana',
		'alfamart',
		'indomaret',
		'bri',
		'linkaja',
		'cc',
	];
	$domain = site_url();
	echo '<div class="container">';
	echo '<div class="row">';
	foreach ($lsitBank as $key => $value ) {
		echo '<div class="col">';
		echo '<img src="'.$domain.'/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/'.$value.'.png" style="max-width:60px;margin-bottom:20px;">';
		echo '</div>';
	}
	echo '</div>';
	echo '</div>';

?>
</div>
<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>
<?php get_template_part( 'sidebar-templates/sidebar', 'hiddenwidget' ); ?>

	<div class="wrapper" id="wrapper-footer">

		<div class="<?php echo esc_attr( $container ); ?>">
				
			<div class="row">

				<div class="col-md-12">
					<div class="copyright">
						Copyright 2020 by DCC. All Rights Reserved.
					</div>

				</div><!--col end -->
			

			</div><!-- row end -->

		</div><!-- container end -->

	</div><!-- wrapper end -->
</footer><!-- #colophon -->

</div><!-- #page we need this extra closing tag here -->
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<?php wp_footer(); ?>
<script>
	jQuery(document).ready(function(){
		jQuery(".preloader").fadeOut();
	})
</script>
</body>

</html>

