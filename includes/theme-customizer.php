<?php
/**
 * Functions for registering and setting theme settings that tie into the WordPress theme customizer.
 * This file loads additional classes and adds settings to the customizer for the built-in Hybrid Core
 * settings.
 *
 * @package    HybridCore
 * @subpackage Functions
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2008 - 2012, Justin Tadlock
 * @link       http://themehybrid.com/hybrid-core
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 */

/* Register custom sections, settings, and controls. */
add_action( 'customize_register', 'pdw_spine_customize_register' );

/* Add the footer content Ajax to the correct hooks. */
add_action( 'wp_ajax_pdw_spine_customize_footer_content', 'pdw_spine_customize_colors_ajax' );
add_action( 'wp_ajax_nopriv_pdw_spine_customize_footer_content', 'pdw_spine_customize_colors_ajax' );



/**
 * Registers custom sections, settings, and controls for the $wp_customize instance.
 *
 * @since 1.4.0
 * @access private
 * @param object $wp_customize
 */
function pdw_spine_customize_register( $wp_customize ) {

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/*Add the ' color scheme ' setting.
	$wp_customize->add_setting(
		"{$prefix}_theme_settings[color_scheme_select]",
		array(
			'default'              => 'default',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'pdw_spine_customize_sanitize',
			'sanitize_js_callback' => 'pdw_spine_customize_sanitize',
			'transport'            => 'postMessage',
		)
	);

	$schemes = array(
		'default' => __('Default', 'spine'),
		'blue' => __('Blue', 'spine'),
		'red' => __('Red', 'spine'),
		'green' => __('Green', 'spine'),
	);
	
	$wp_customize->add_control( 'spine_color_scheme', array(
	'label' => __( 'Color Scheme', 'spine' ),
	'section'=> 'spine-scheme',
	'settings'=> "{$prefix}_theme_settings[color_scheme_select]",
	'type'=> 'radio',
	'choices'=> $schemes
	) );
*/

	//Add the logo option
	$wp_customize->add_section(
		"{$prefix}_logo_section",
		array(
			'title'              => __( 'Logo', 'fitnessthemes' ),
			'priority'           => 30,
			'description'        => __( 'Upload your logo', 'fitnessthemes' ),
		)
	);
	
	$wp_customize->add_setting( "{$prefix}_logo" );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "{$prefix}_logo", array(
		'label'    => __( 'Logo', 'fitnessthemes' ),
		'section'  => "{$prefix}_logo_section",
		'settings' => "{$prefix}_logo",
	) ) );
	
	$wp_customize->add_setting( "{$prefix}_favicon" );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "{$prefix}_favicon", array(
		'label'    => __( 'Favicon', 'fitnessthemes' ),
		'section'  => "{$prefix}_logo_section",
		'settings' => "{$prefix}_favicon",
	) ) );

}

/**
 * Sanitizes the footer content on the customize screen.  Users with the 'unfiltered_html' cap can post
 * anything.  For other users, wp_filter_post_kses() is ran over the setting.
 *
 * @since 1.4.0
 * @access public
 * @param mixed $setting The current setting passed to sanitize.
 * @param object $object The setting object passed via WP_Customize_Setting.
 * @return mixed $setting
 */
function pdw_spine_customize_sanitize( $setting, $object ) {

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
	if ( "{$prefix}_theme_settings[footer_insert]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );

	/* Return the sanitized setting and apply filters. */
	return apply_filters( "{$prefix}_customize_sanitize", $setting, $object );
}

/**
 * Handles changing settings for the live preview of the theme.
 *
 * @since 1.4.0
 * @access private
 */
function pdw_spine_customize_preview_script() {
	?>
<script type="text/javascript">
	( function( $ ) {
		wp.customize('<?php echo hybrid_get_prefix(); ?>_theme_settings[body_color]',function( value ) {
			value.bind(function(to) {
				$('body').css('color', to );
			});
		});
		wp.customize('<?php echo hybrid_get_prefix(); ?>_theme_settings[headline_color]',function( value ) {
			value.bind(function(to) {
				$('h1, h2, h2 a, h3, h4, h5, h6').css('color', to );
			});
		});
		wp.customize('<?php echo hybrid_get_prefix(); ?>_theme_settings[link_color]',function( value ) {
			value.bind(function(to) {
				$('a:link,a:visited').css('color', to );
			});
		});
		wp.customize('<?php echo hybrid_get_prefix(); ?>_theme_settings[link_hover_color]',function( value ) {
			var linkColor = $('a').css('color');
			value.bind(function(to) {
				$('a').on({
					mouseenter: function(to){
						$(this).css('color', to );
					},
					mouseleave: function(linkColor){
						$(this).css('color', linkColor );
					}
				})
			});
		});
	} )( jQuery )
</script>
<?php
}