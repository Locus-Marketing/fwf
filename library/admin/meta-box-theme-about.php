<?php
/**
 * Creates a meta box for the theme settings page, which displays information about the theme.  If a child 
 * theme is in use, an additional meta box will be added with its information.  To use this feature, the theme 
 * must support the 'about' argument for 'hybrid-core-theme-settings' feature.
 *
 * @package    HybridCore
 * @subpackage Admin
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2008 - 2012, Justin Tadlock
 * @link       http://themehybrid.com/hybrid-core
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 */

/* Create the about theme meta box on the 'add_meta_boxes' hook. */
add_action( 'add_meta_boxes', 'hybrid_meta_box_theme_add_about' );

/**
 * Adds the core about theme meta box to the theme settings page.
 *
 * @since 1.2.0
 * @return void
 */
function hybrid_meta_box_theme_add_about() {

	/* Get theme information. */
	$prefix = hybrid_get_prefix();
	$theme = wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );

	/* Adds the About box for the parent theme. */
	add_meta_box( 'hybrid-core-about-theme', sprintf( __( 'About %s', 'hybrid-core' ), $theme->get( 'Name' ) ), 'hybrid_meta_box_theme_display_about', hybrid_get_settings_page_name(), 'side', 'high' );

	/* If the user is using a child theme, add an About box for it. */
	if ( is_child_theme() ) {
		$child = wp_get_theme( get_stylesheet(), get_theme_root( get_stylesheet_directory() ) );
		add_meta_box( 'hybrid-core-about-child', sprintf( __( 'About %s', 'hybrid-core' ), $child->get( 'Name' ) ), 'hybrid_meta_box_theme_display_about', hybrid_get_settings_page_name(), 'side', 'high' );
	}
}

/**
 * Creates an information meta box with no settings about the theme. The meta box will display
 * information about both the parent theme and child theme. If a child theme is active, this function
 * will be called a second time.
 *
 * @since 1.2.0
 * @param object $object Variable passed through the do_meta_boxes() call.
 * @param array $box Specific information about the meta box being loaded.
 * @return void
 */
function hybrid_meta_box_theme_display_about( $object, $box ) {

	/* Get theme information. */
	$prefix = hybrid_get_prefix();

	/* Grab theme information for the parent/child theme. */
	$theme = ( 'hybrid-core-about-child' == $box['id'] ) ? wp_get_theme( get_stylesheet(), get_theme_root( get_stylesheet_directory() ) ) : wp_get_theme( get_template(), get_theme_root( get_template_directory() ) ); ?>

	<table class="form-table">
		<tr>
			<th>
				<?php _e( 'Theme:', 'hybrid-core' ); ?>
			</th>
			<td>
				<a href="<?php echo esc_url( $theme->get( 'ThemeURI' ) ); ?>" title="<?php echo esc_attr( $theme->get( 'Name' ) ); ?>"><?php echo $theme->get( 'Name' ); ?></a>
			</td>
		</tr>
		<tr>
			<th>
				<?php _e( 'Version:', 'hybrid-core' ); ?>
			</th>
			<td>
				<?php echo $theme->get( 'Version' ); ?>
			</td>
		</tr>
		<tr>
			<th>
				<?php _e( 'Author:', 'hybrid-core' ); ?>
			</th>
			<td>
				<a href="<?php echo esc_url( $theme->get( 'AuthorURI' ) ); ?>" title="<?php echo esc_attr( $theme->get( 'Author' ) ); ?>"><?php echo $theme->get( 'Author' ); ?></a>
			</td>
		</tr>
		<tr>
			<th>
				<?php _e( 'Description:', 'hybrid-core' ); ?>
			</th>
			<td>
				<?php echo $theme->get( 'Description' ); ?>
			</td>
		</tr>
	</table><!-- .form-table --><?php
}

?>