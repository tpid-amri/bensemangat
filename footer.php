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
<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

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
</body>

</html>

