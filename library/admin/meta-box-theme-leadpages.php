<?php
/**
 * Creates a meta box for the theme settings page, which allows us to turn on/off certain built-in lead pages. To use this feature, the theme 
 * must support the 'leadpages' argument for 'hybrid-core-theme-settings' feature.
 *
 * @package    HybridCore
 * @subpackage Admin
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2008 - 2012, Justin Tadlock
 * @link       http://themehybrid.com/hybrid-core
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 */

/* Create the about theme meta box on the 'add_meta_boxes' hook. */
add_action( 'add_meta_boxes', 'hybrid_meta_box_theme_add_leadpages' );

/**
 * Adds the lead pages meta box to the theme settings page.
 *
 * @since 2.0
 * @return void
 */
function hybrid_meta_box_theme_add_leadpages() {

	/* Get theme information. */
	$prefix = hybrid_get_prefix();
	$theme = wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );

	/* Adds the About box for the parent theme. */
	add_meta_box( 'hybrid-core-leadpages', __( 'Extensions', 'hybrid-core' ), 'hybrid_meta_box_theme_display_leadpages', hybrid_get_settings_page_name(), 'side', 'high' );
	
	
}

/**
 * Creates a setting meta box to turn on/off lead pages
 *
 * @since 2.0
 * @param object $object Variable passed through the do_meta_boxes() call.
 * @param array $box Specific information about the meta box being loaded.
 * @return void
 */
function hybrid_meta_box_theme_display_leadpages( $object, $box ) {

	/* Get theme information. */
	$prefix = hybrid_get_prefix();
	?>
	<!--p><input id="leadpages_backtoschool" type="checkbox" name="<?php echo hybrid_settings_field_name('leadpages_backtoschool'); ?>" value="1" <?php checked( hybrid_get_setting( 'leadpages_backtoschool' ) ); ?> class="regular-checkbox" /> <label for="leadpages_backtoschool"><?php _e( 'Back to School', 'hybrid-core' ); ?></label></P-->
	
	<p><input id="extension_membership" type="checkbox" name="<?php echo hybrid_settings_field_name('extension_membership'); ?>" value="1" <?php checked( hybrid_get_setting( 'extension_membership' ) ); ?> class="regular-checkbox" /> <label for="extension_membership"><?php _e( 'Membership Core (Workouts)', 'hybrid-core' ); ?></label></P>

	<p><input id="extension_tracker" type="checkbox" name="<?php echo hybrid_settings_field_name('extension_tracker'); ?>" value="1" <?php checked( hybrid_get_setting( 'extension_tracker' ) ); ?> class="regular-checkbox" /> <label for="extension_tracker"><?php _e( 'Progress Tracker', 'hybrid-core' ); ?></label></P>
	<?php
}

/**
 * Saves the lead pages meta box settings by filtering the "sanitize_option_{$prefix}_theme_settings" hook.
 *
 * @since 2.0
 * @param array $settings Array of theme settings passed by the Settings API for validation.
 * @return array $settings
 */
function hybrid_meta_box_theme_save_leadpages( $settings ) {

	/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
	if ( wp_verify_nonce($_POST['hybrid-core-meta-box-theme-leadpages'], 'spine_action') && !current_user_can( 'unfiltered_html' ) ) {
		$settings['leadpages_backtoschool'] = stripslashes( wp_filter_post_kses( addslashes( $settings['leadpages_backtoschool'] ) ) );
	}

	/* Return the theme settings. */
	return $settings;
}

?>