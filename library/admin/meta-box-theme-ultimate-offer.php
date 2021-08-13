<?php
/**
 * Creates a meta box for the theme settings page, which sets ultimate offer options within 
 * the theme.  To use this feature, the theme must support the 'ultimate-offer' argument for the 
 * 'hybrid-core-theme-settings' feature.
 *
 * @package    HybridCore
 * @subpackage Admin
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2008 - 2012, Justin Tadlock
 * @link       http://themehybrid.com/hybrid-core
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 */

/* Create the ultimate offer meta box on the 'add_meta_boxes' hook. */
add_action( 'add_meta_boxes', 'hybrid_meta_box_theme_add_ultimateoffer' );

/* Sanitize the ultimate offer settings before adding them to the database. */
add_filter( 'sanitize_option_' . hybrid_get_prefix() . '_theme_settings', 'hybrid_meta_box_theme_save_ultimateoffer' );

/**
 * Adds the core theme ultimate offer meta box to the theme settings page in the admin.
 *
 * @since 1.0
 * @return void
 */
function hybrid_meta_box_theme_add_ultimateoffer() {

	add_meta_box( 'hybrid-core-ultimateoffer', __( 'Sales Copy/Offer settings', 'hybrid-core' ), 'hybrid_meta_box_theme_display_ultimateoffer', hybrid_get_settings_page_name(), 'normal', 'high' );
}

/**
 * Creates a meta box that allows users to customize their ultimate offer.
 *
 * @since 1.0
 * @return void
 */
function hybrid_meta_box_theme_display_ultimateoffer() { 
	wp_nonce_field( basename( __FILE__ ), 'hybrid-core-meta-box-theme-ultimateoffer' ); 
	//$value = get_post_meta( $_POST['post_ID'], $key = '_my_meta_value_key', $single = true );
	?>
	<h4><?php _e( 'Fixed-position Offer Tab:', 'hybrid-core' ); ?></h4>
	<table class="form-table"><tbody>
	<tr valign="top"><th scope="row">Tab Text</th><td><input type="text" name="<?php echo hybrid_settings_field_name('offer_tab_text') ?>" value="<?php echo hybrid_get_setting( 'offer_tab_text' ) ?>" class="regular-text" /></td></tr>
	<tr valign="top"><th scope="row">Offer URL</th><td><input type="text" name="<?php echo hybrid_settings_field_name('offer_tab_url') ?>" value="<?php echo hybrid_get_setting( 'offer_tab_url' ) ?>" class="regular-text" /><br /><small>Leave as blank to use the default pop up offer.</small></td></tr>
	<tr valign="top"><th scope="row">CSS Class</th><td><input type="text" name="<?php echo hybrid_settings_field_name('offer_tab_class') ?>" value="<?php echo hybrid_get_setting( 'offer_tab_class' ) ?>" class="regular-text" /><br /><small>(Advanced setting for popupmaker)</small></td></tr>
	</tbody>
	</table>
	
	<h4><?php _e( 'Simple Shortcodes:', 'hybrid-core' ); ?></h4>
	<table class="form-table"><tbody>
	<tr valign="top"><th scope="row">[MY_CITY]</th><td><input type="text" name="<?php echo hybrid_settings_field_name('uo_my_city') ?>" value="<?php echo hybrid_get_setting( 'uo_my_city' ) ?>" class="regular-text" /></td></tr>
	<tr valign="top"><th scope="row">[MY_STATE]</th><td><input type="text" name="<?php echo hybrid_settings_field_name('uo_my_state') ?>" value="<?php echo hybrid_get_setting( 'uo_my_state' ) ?>" class="regular-text" /></td></tr>
	<tr valign="top"><th scope="row">[YEAR]</th><td><input type="text" name="<?php echo hybrid_settings_field_name('uo_year') ?>" value="<?php echo hybrid_get_setting( 'uo_year' ) ?>" class="regular-text" /></td></tr>
	<tr valign="top"><th scope="row">[MY_NAME]</th><td><input type="text" name="<?php echo hybrid_settings_field_name('uo_my_name') ?>" value="<?php echo hybrid_get_setting( 'uo_my_name' ) ?>" class="regular-text" /></td></tr>
	<tr valign="top"><th scope="row">[BUSINESS_NAME]</th><td><input type="text" name="<?php echo hybrid_settings_field_name('uo_business_name') ?>" value="<?php echo hybrid_get_setting( 'uo_business_name' ) ?>" class="regular-text" /></td></tr>
	<tr valign="top"><th scope="row">[PHONE_NUMBER]</th><td><input type="text" name="<?php echo hybrid_settings_field_name('uo_phone_number') ?>" value="<?php echo hybrid_get_setting( 'uo_phone_number' ) ?>" class="regular-text" /></td></tr>
	<tr valign="top"><th scope="row">[ADDRESS]</th><td><input type="text" name="<?php echo hybrid_settings_field_name('uo_address') ?>" value="<?php echo hybrid_get_setting( 'uo_address' ) ?>" class="regular-text" /></td></tr>
	<tr valign="top"><th scope="row">[LIST_OF_CITIES]</th><td><input type="text" name="<?php echo hybrid_settings_field_name('uo_list_of_cities') ?>" value="<?php echo hybrid_get_setting( 'uo_list_of_cities' ) ?>" class="regular-text" /></td></tr>
	<tr valign="top"><th scope="row">[LIST_OF_ZIPCODES]</th><td><input type="text" name="<?php echo hybrid_settings_field_name('uo_list_of_zipcodes') ?>" value="<?php echo hybrid_get_setting( 'uo_list_of_zipcodes' ) ?>" class="regular-text" /></td></tr>
	<tr valign="top"><th scope="row">[SIGN_UP_BUTTON]</th><td>
		<?php wp_editor(
			esc_textarea( hybrid_get_setting( 'uo_sign_up_button' ) ),	// Editor content.
			hybrid_settings_field_id( 'uo_sign_up_button' ),		// Editor ID.
			array(
				'tinymce' => false, // Don't use TinyMCE in a meta box.
				'textarea_name' => hybrid_settings_field_name( 'uo_sign_up_button' ),
				'textarea_rows' => 4
			)
		); ?>
	</td></tr>
	</tbody></table>
	
	<h4><?php _e( 'Advanced Shortcodes:', 'hybrid-core' ); ?></h4>
	<table class="form-table"><tbody>
	<tr valign="top"><th scope="row"><?php _e( 'Trial Offer on Home Page:', 'hybrid-core' ); ?></th><td>
		<?php wp_editor(
			esc_textarea( hybrid_get_setting( 'uo_trial_offer_box_home' ) ),	// Editor content.
			hybrid_settings_field_id( 'uo_trial_offer_box_home' ),		// Editor ID.
			array(
				'tinymce' => false, // Don't use TinyMCE in a meta box.
				'textarea_name' => hybrid_settings_field_name( 'uo_trial_offer_box_home' ),
				'textarea_rows' => 3
			)
		); ?>
	<span class="description"><?php _e( 'HTML code for your sign up form', 'fitnessthemes' ) ?></span></td></tr>
	
	<tr valign="top"><th scope="row"><?php _e( 'Video on Home Page:', 'hybrid-core' ); ?></th><td>
		<?php wp_editor(
			esc_textarea( hybrid_get_setting( 'uo_video_home' ) ),	// Editor content.
			hybrid_settings_field_id( 'uo_video_home' ),		// Editor ID.
			array(
				'tinymce' => false, // Don't use TinyMCE in a meta box.
				'textarea_name' => hybrid_settings_field_name( 'uo_video_home' ),
				'textarea_rows' => 3
			)
		); ?>
	<span class="description"><?php _e( 'Optional HTML code for your video box next to the trial offer.', 'fitnessthemes' ) ?></span></td></tr>
	
	<tr valign="top"><th scope="row"><?php _e( 'Trial Offer Message For Popup Box:', 'hybrid-core' ); ?></th><td>
		<?php wp_editor(
			esc_textarea( hybrid_get_setting( 'uo_trial_offer_box' ) ),	// Editor content.
			hybrid_settings_field_id( 'uo_trial_offer_box' ),		// Editor ID.
			array(
				'tinymce' => false, // Don't use TinyMCE in a meta box.
				'textarea_name' => hybrid_settings_field_name( 'uo_trial_offer_box' ),
				'textarea_rows' => 3
			)
		); ?>
	<span class="description"><?php _e( 'Offer message that appear above the form.', 'fitnessthemes' ) ?></span>
	</td></tr>
	
	<tr valign="top"><th scope="row"><?php _e( 'Trial Offer Form Shortcode:', 'hybrid-core' ); ?></th><td>
		<?php wp_editor(
			esc_textarea( hybrid_get_setting( 'uo_trial_offer_shortcode' ) ),	// Editor content.
			hybrid_settings_field_id( 'uo_trial_offer_shortcode' ),		// Editor ID.
			array(
				'tinymce' => false, // Don't use TinyMCE in a meta box.
				'textarea_name' => hybrid_settings_field_name( 'uo_trial_offer_shortcode' ),
				'textarea_rows' => 1,
				'media_buttons'	=> false,
				'wpautop'		=> false,
				'quicktags'		=> false,
			)
		); ?>
	<span class="description"><?php _e( 'Use "Contact Form 7" plugin to create this shortcode', 'fitnessthemes' ) ?></span></td></tr>
	
	<tr valign="top"><th scope="row"><?php _e( 'Or, paste HTML code (advanced):', 'hybrid-core' ); ?></th><td><textarea type="text" name="<?php echo hybrid_settings_field_name('uo_trial_offer_formhtml') ?>" class="large-text code" rows="4" cols="50"><?php echo hybrid_get_setting( 'uo_trial_offer_formhtml' ) ?></textarea><br /><span class="description"><?php _e( 'Form embed code from AWeber, MailChimp, Fitpro Newsletter, etc', 'fitnessthemes' ) ?></span></td></tr>
	<tr valign="top"><th scope="row"><?php _e( 'Guarantee Copy:', 'hybrid-core' ); ?></th><td>
		<?php wp_editor(
			esc_textarea( hybrid_get_setting( 'uo_guarantee_copy' ) ),	// Editor content.
			hybrid_settings_field_id( 'uo_guarantee_copy' ),		// Editor ID.
			array(
				'tinymce' => false, // Don't use TinyMCE in a meta box.
				'textarea_name' => hybrid_settings_field_name( 'uo_guarantee_copy' ),
				'textarea_rows' => 4
			)
		); ?>
	</td></tr>
	</tbody></table>
	
<?php }

/**
 * Saves the ultimate offer meta box settings by filtering the "sanitize_option_{$prefix}_theme_settings" hook.
 *
 * @since 1.0
 * @param array $settings Array of theme settings passed by the Settings API for validation.
 * @return array $settings
 */
function hybrid_meta_box_theme_save_ultimateoffer( $settings ) {

	/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
	if ( wp_verify_nonce($_POST['hybrid-core-meta-box-theme-ultimateoffer'], 'spine_action') && !current_user_can( 'unfiltered_html' ) ) {
		$settings['footer_insert'] = stripslashes( wp_filter_post_kses( addslashes( $settings['footer_insert'] ) ) );
	}

	/* Return the theme settings. */
	return $settings;
}

?>