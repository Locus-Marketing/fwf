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
if ( has_nav_menu( 'bottom' ) ) : ?>

<?php do_atomic( 'before_menu_bottom' ); // spine_before_menu_bottom ?>

<nav id="menu-bottom" class="menu-container">

    <div class="wrap">

			<?php do_atomic( 'open_menu_bottom' ); // spine_open_menu_bottom ?>

			<?php wp_nav_menu( array( 'theme_location' => 'bottom', 'container_class' => 'menu', 'menu_class' => 'inline-list', 'menu_id' => 'menu-bottom-items', 'depth' => 1, 'fallback_cb' => '' ) ); ?>

			<?php do_atomic( 'close_menu_bottom' ); // spine_close_menu_bottom ?>

    </div>

</nav><!-- #menu-bottom .menu-container -->

<?php do_atomic( 'after_menu_bottom' ); // spine_after_menu_bottom ?>

<?php endif;