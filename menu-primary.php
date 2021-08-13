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

global $current_user;
	
if( is_user_logged_in() && in_array( 'subscriber', $current_user->roles )) {
	//Member end users
	if ( has_nav_menu( 'members' ) ) :
		
		wp_nav_menu( array(
			'theme_location' => 'members',
			'container' => false,
			'menu_class' => 'menu slimmenu members',
			'menu_id' => 'primary-nav',
			'fallback_cb' => '',
			'walker' => new NavBar_Walker('left'),
			'depth' => 3
		) );
	else:
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container' => false,
			'menu_class' => 'menu slimmenu',
			'menu_id' => 'primary-nav',
			'fallback_cb' => '',
			'walker' => new NavBar_Walker('left'),
			'depth' => 3
		) );
	endif;
	
} else {
	//Regular 
	if ( has_nav_menu( 'primary' ) ) : ?>

	<?php do_atomic( 'before_menu_primary' ); // spine_before_menu_primary ?>

		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container' => false,
			'menu_class' => 'menu slimmenu',
			'menu_id' => 'primary-nav',
			'fallback_cb' => '',
			'walker' => new NavBar_Walker('left'),
			'depth' => 3
		) );
		?>
		<?php do_atomic( 'after_menu_primary' ); // spine_after_menu_primary ?>
	<?php else:
		wp_nav_menu();
	endif;
}