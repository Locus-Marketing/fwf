<?php
/**
 * Creates a meta box for the theme settings page, which displays misc information within the theme. 
 * To use this feature, the theme must support the 'misc' argument for 'hybrid-core-theme-settings' feature.
 *
 * @package    HybridCore
 * @subpackage Admin
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2008 - 2012, Justin Tadlock
 * @link       http://themehybrid.com/hybrid-core
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 */

/* Create the misc theme meta box on the 'add_meta_boxes' hook. */
add_action( 'add_meta_boxes', 'hybrid_meta_box_theme_add_misc' );

/* Sanitize the ultimate offer settings before adding them to the database. */
add_filter( 'sanitize_option_' . hybrid_get_prefix() . '_theme_settings', 'hybrid_meta_box_theme_save_misc' );

/**
 * Adds the core misc theme meta box to the theme settings page.
 *
 * @since 1.2.0
 * @return void
 */
function hybrid_meta_box_theme_add_misc() {

	/* Get theme information. */
	$prefix = hybrid_get_prefix();
	$theme = wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );

	/* Adds the misc box for the parent theme. */
	add_meta_box( 'hybrid-core-misc-theme', __( 'Custom settings', 'hybrid-core' ), 'hybrid_meta_box_theme_display_misc', hybrid_get_settings_page_name(), 'normal', 'high' );
}

/**
 * Creates an information meta box with no settings misc the theme. The meta box will display
 * information misc both the parent theme and child theme. If a child theme is active, this function
 * will be called a second time.
 *
 * @since 1.2.0
 * @param object $object Variable passed through the do_meta_boxes() call.
 * @param array $box Specific information misc the meta box being loaded.
 * @return void
 */
function hybrid_meta_box_theme_display_misc( $object, $box ) {
	wp_nonce_field( basename( __FILE__ ), 'hybrid-core-meta-box-theme-misc' ); 

	/* Get theme information. */
	$prefix = hybrid_get_prefix();
	?>
	<h4><?php _e( 'Custom CSS:', 'hybrid-core' ); ?></h4>
	<style type="text/css">.ace_editor {height:400px;}</style>
	<div id="ace_fwf_theme_css"></div>
	<?php wp_editor(
		esc_textarea( hybrid_get_setting( 'misc_custom_css' ) ),	// Editor content.
		hybrid_settings_field_id( 'misc_custom_css' ),				// Editor ID.
		array(
			'tinymce' => false, // Don't use TinyMCE in a meta box.
			'textarea_name' => hybrid_settings_field_name( 'misc_custom_css' ),
			'textarea_rows' => 10,
			'media_buttons'	=> false,
			'wpautop'		=> false,
			'quicktags'		=> false,
		)
	); ?>
	<h4><?php _e( 'Custom Code for &lt;head&gt; tag', 'hybrid-core' ); ?></h4>
	<?php wp_editor(
		esc_textarea( hybrid_get_setting( 'misc_custom_head' ) ),	// Editor content.
		hybrid_settings_field_id( 'misc_custom_head' ),				// Editor ID.
		array(
			'tinymce' => false, // Don't use TinyMCE in a meta box.
			'textarea_name' => hybrid_settings_field_name( 'misc_custom_head' ),
			'textarea_rows' => 2,
			'media_buttons'	=> false,
			'wpautop'		=> false,
			'quicktags'		=> false,
		)
	); ?>
	<h4><?php _e( 'Custom Code immediately after &lt;body&gt; tag', 'hybrid-core' ); ?></h4>
	<?php wp_editor(
		esc_textarea( hybrid_get_setting( 'misc_after_body' ) ),	// Editor content.
		hybrid_settings_field_id( 'misc_after_body' ),				// Editor ID.
		array(
			'tinymce' => false, // Don't use TinyMCE in a meta box.
			'textarea_name' => hybrid_settings_field_name( 'misc_after_body' ),
			'textarea_rows' => 2,
			'media_buttons'	=> false,
			'wpautop'		=> false,
			'quicktags'		=> false,
		)
	); ?>
	<h4><?php _e( 'Custom Code before &lt;/body&gt; tag', 'hybrid-core' ); ?></h4>
	<?php wp_editor(
		esc_textarea( hybrid_get_setting( 'misc_custom_footer' ) ),	// Editor content.
		hybrid_settings_field_id( 'misc_custom_footer' ),				// Editor ID.
		array(
			'tinymce' => false, // Don't use TinyMCE in a meta box.
			'textarea_name' => hybrid_settings_field_name( 'misc_custom_footer' ),
			'textarea_rows' => 2,
			'media_buttons'	=> false,
			'wpautop'		=> false,
			'quicktags'		=> false,
		)
	); ?>
	<h4><?php _e( 'Google Tag Manager ID:', 'hybrid-core' ); ?></h4>
	<input type="text" name="<?php echo hybrid_settings_field_name('misc_gtm_tag') ?>" value="<?php echo hybrid_get_setting( 'misc_gtm_tag' ) ?>" class="regular-text" placeholder="GTM-XXXXXXX" />

	<h4><?php _e( 'Commments:', 'hybrid-core' ); ?></h4>
	<input type="checkbox" name="<?php echo hybrid_settings_field_name('misc_disable_comments') ?>" value="1" <?php if (hybrid_get_setting( 'misc_disable_comments' )) echo 'checked="checked"'; ?> class="regular-checkbox" /> <?php _e( 'Turn off comments on all "non-blog" pages (site-wide)', 'hybrid-core' ); ?>
	
<?php 
}

/**
 * Saves the ultimate offer meta box settings by filtering the "sanitize_option_{$prefix}_theme_settings" hook.
 *
 * @since 1.0
 * @param array $settings Array of theme settings passed by the Settings API for validation.
 * @return array $settings
 */
function hybrid_meta_box_theme_save_misc( $settings ) {

	/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
	if ( wp_verify_nonce($_POST['hybrid-core-meta-box-theme-misc'], 'spine_action') && !current_user_can( 'unfiltered_html' ) ) {
		$settings['footer_insert'] = stripslashes( wp_filter_post_kses( addslashes( $settings['footer_insert'] ) ) );
		//TODO the rest of the values
	}

	/* Return the theme settings. */
	return $settings;
}

?>