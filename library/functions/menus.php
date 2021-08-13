<?php
/**
 * The menus functions deal with registering nav menus within WordPress for the core framework.  Theme 
 * developers may use the default menu(s) provided by the framework within their own themes, decide not
 * to use them, or register additional menus.
 *
 * @package    HybridCore
 * @subpackage Functions
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2008 - 2012, Justin Tadlock
 * @link       http://themehybrid.com/hybrid-core
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 */

/* Register nav menus. */
add_action( 'init', 'hybrid_register_menus' );

/**
 * Registers the the framework's default menus based on the menus the theme has registered support for.
 *
 * @since 0.8.0
 * @access private
 * @uses register_nav_menu() Registers a nav menu with WordPress.
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menu
 * @return void
 */
function hybrid_register_menus() {

	/* Get theme-supported menus. */
	$menus = get_theme_support( 'hybrid-core-menus' );

	/* If there is no array of menus IDs, return. */
	if ( !is_array( $menus[0] ) )
		return;

	/* Register the 'primary' menu. */
	if ( in_array( 'primary', $menus[0] ) )
		register_nav_menu( 'primary', _x( 'Primary', 'nav menu location', 'hybrid-core' ) );

	/* Register the 'secondary' menu. */
	if ( in_array( 'secondary', $menus[0] ) )
		register_nav_menu( 'secondary', _x( 'Secondary', 'nav menu location', 'hybrid-core' ) );

	/* Register the 'footer' menu. */
	if ( in_array( 'footer', $menus[0] ) )
		register_nav_menu( 'footer', _x( 'Footer', 'nav menu location', 'hybrid-core' ) );

	/* Register the 'bottom' menu. */
	if ( in_array( 'bottom', $menus[0] ) )
		register_nav_menu( 'bottom', _x( 'Bottom', 'nav menu location', 'hybrid-core' ) );
		
	/* Register the 'members' menu. */
	if ( in_array( 'members', $menus[0] ) )
		register_nav_menu( 'members', _x( 'Members Only', 'nav menu location', 'hybrid-core' ) );
}

?>