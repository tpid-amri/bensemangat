<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package BenSemangat
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'bensemangat_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php bensemangat_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">
	<div class="topbar-wrapp color-scheme-light">
		<div class="container">
			<div class="topbar-content">
				<div class="row">
					<div class="col-md-6">
						<div class="topbar-left">
							<?php if( get_theme_mod( 'bensemangat_site_info_phone') != "" ): ?>
							<span>OUR PHONE NUMBER:</span> <?php echo get_theme_mod( 'bensemangat_site_info_phone'); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-6 d-none d-sm-block">
						<div class="topbar-right text-right">
							<?php
							wp_nav_menu(
								array(
									'theme_location'  => 'topbar',
									'container_class' => '',
									'container_id'    => 'navbar-nav',
									'menu_class'      => '',
									'fallback_cb'     => '',
									'menu_id'         => 'topbar-menu',
									'depth'           => 2,
									'walker'          => new Bensemangat_WP_Bootstrap_Navwalker(),
								)
							);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'bensemangat' ); ?></a>

		<nav id="main-nav" class="navbar navbar-expand-lg navbar-light" aria-labelledby="main-nav-label">

			<!--  Show this only on mobile to medium screens  -->
					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand d-lg-none"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand d-lg-none" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>

					<?php
					
					} else {
						echo '<div class="logo-center d-lg-none">';
						the_custom_logo();
						echo '</div>';
					}
					?>
					<!-- end custom logo -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				
			</button>

			<div class="collapse navbar-collapse justify-content-between" id="navbarToggle">
				<?php if ( 'container' === $container ) : ?>
					<div class="container">
				<?php endif; ?>
					<!-- The WordPress Menu goes here -->
					<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'navbar-nav',
								'fallback_cb'     => '',
								'menu_id'         => 'primary-menu',
								'depth'           => 2,
								'walker'          => new Bensemangat_WP_Bootstrap_Navwalker(),
							)
						);
					?>
					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand d-none d-lg-block"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand d-none d-lg-block" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>

						<?php
					} else {
						echo '<div class="d-none d-lg-block">';
							the_custom_logo();
						echo '</div>';
					}
					?>
					<!-- end custom logo -->
					<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'secondary',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'navbar-nav',
								'fallback_cb'     => '',
								'menu_id'         => 'secondary-menu',
								'depth'           => 2,
								'walker'          => new Bensemangat_WP_Bootstrap_Navwalker(),
							)
						);
						?>
					
		
				<?php if ( 'container' === $container ) : ?>
				</div><!-- .container -->
				<?php endif; ?>
			</div>
		</nav>
		<!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->
