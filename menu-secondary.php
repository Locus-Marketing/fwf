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
require_once 'includes/topbar-walker.php';
if ( has_nav_menu( 'secondary' ) ) : ?>


<?php $title = '<ul><li class="name"><h1><a href="' . home_url('/') . '">' . get_bloginfo( 'name' ) . '</a></h1></li><li class="toggle-topbar"><a href="#"></a></li></ul>'; ?>
<?php wp_nav_menu( array(
		'container' => 'nav',
		'theme_location' => 'secondary',
		'container_class' => 'top-bar',
		'menu_class' => '',
		'menu_id' => 'menu-primary-items',
		'items_wrap' => $title . '<section><ul class="right"><li class="divider"></li>%3$s</ul></section>',
		'walker' => new Foundation_Walker(),
		'fallback_cb' => '' ) );
	?>


<?php endif;