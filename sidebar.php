<?php
/**
 * File
 *
 * Description
 *
 * @package    Templates
 * @version    1.0
 * @author     Fitness Website Formula
 * @link       http://fitnesswebsiteformula.com
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 */
?>
<!-- Sidebar -->
<?php if ( !in_array( theme_layouts_get_layout(), array( 'layout-1c' ) ) ): ?>

<?php do_atomic( 'before_sidebar_primary' ); // spine_before_sidebar_primary ?>
<?php $sidebar_grid_classes = pdw_spine_fetch_sidebar_grid_classes(); ?>
<aside id="sidebar" class="<?php echo (is_home()) ? 'four columns' : $sidebar_grid_classes; ?>">

	<?php do_atomic( 'open_sidebar_primary' ); // spine_open_sidebar_primary ?>

	<?php
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		if( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) { // Proceed only if on a WooCommerce 

			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'shop-primary' ) ): endif;
		} else {
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'primary' ) ): endif;
		}

	} else {
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'primary' ) ) {
				echo '<div class="widget widget_text"><div class="widget-wrap">';
					echo '<h4 class="widgettitle">';
						_e( 'Primary Sidebar Widget Area', 'picturesque' );
					echo '</h4>';
					echo '<div class="textwidget"><p>';
						printf( __( 'This is the Primary Sidebar Widget Area. You can add content to this area by visiting your <a href="%s">Widgets Panel</a> and adding new widgets to this area.', 'picturesque' ), admin_url( 'widgets.php' ) );
					echo '</p></div>';
				echo '</div></div>';
			}
	}
?>

	<?php do_atomic( 'close_sidebar_primary' ); // spine_close_sidebar_primary ?>

</aside><!-- End Sidebar -->
<?php do_atomic( 'after_sidebar_primary' ); // spine_after_sidebar_primary ?>
<?php endif; ?>