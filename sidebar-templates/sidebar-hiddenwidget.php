<?php
/**
 * Sidebar setup for hidden widget
 *
 * @package BenSemangat
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


?>

<?php if ( is_active_sidebar( 'hiddenwidget' ) ) : ?>

		<?php dynamic_sidebar( 'hiddenwidget' ); ?>

	<?php
endif;
