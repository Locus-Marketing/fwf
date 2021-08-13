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
$page_background = '';

if( is_page() )
	$page_background = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><html class="no-js" <?php language_attributes(); ?>><![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php hybrid_document_title(); ?></title>
	<?php do_action('fb_gtm_header'); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" href="<?php bloginfo( 'url' ); ?>" hreflang="en-us" />
<?php /*<script type='text/javascript' src='http://dfcb.github.io/BigVideo.js/'></script> */?>
<?php wp_head(); ?>
<?php do_action('fwf_head'); ?>
<?php if($fwf_favicon = get_theme_mod( 'fwf_favicon' )): ?><link rel="shortcut icon" href="<?php echo $fwf_favicon;?>" type="image/x-icon" /><?php endif; ?>
</head>

<body class="<?php hybrid_body_class(); ?>" id="locus-marketing">
<?php do_action('fb_after_body'); //get_template_part( 'menu', 'secondary' ); // Loads the menu-primary.php template. ?>
<?php echo hybrid_get_setting('misc_after_body'); ?>
<div class="fwf-root">
<div class="shadow">

<div class="background"<?php echo ( $page_background ) ? ' style="background:url(' . $page_background[0] . ') no-repeat center top;background-attachment:fixed;"': '';?>>

<?php if( fwf_has_header_footer() ) { 
$header_cols = fwf_getHeaderCols();

if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'top_bar' ) ) { //do nothing 
}
?>
<header class="header">
	<div class="row">

		<div class="row">
			<div class="<?php echo $header_cols['left']; ?> columns">
				<?php if ( get_theme_mod( 'fwf_logo' ) ) : ?>
					<div class="site-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo str_replace( 'http://', '//', get_theme_mod( 'fwf_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
					</div>
				<?php else : ?>
				<h1 id="site-title">
					<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<?php endif; ?>
			</div>
			<div class="<?php echo $header_cols['right']; ?> columns">
				<?php if ( get_header_image() ): ?> 
					<?php echo '<img class="header-image" src="' . esc_url( get_header_image() ) . '" alt="personal training" />';  ?>
				<?php elseif( hybrid_get_setting( 'uo_phone_number' ) || hybrid_get_setting( 'uo_phone_number' ) || hybrid_get_setting( 'theme_url_member_login' ) ): ?>
					
					<?php if( !get_theme_mod('theme_hide_h_social') ): ?><div class="social_icons"><?php do_action('fwf_social_icons'); ?></div><? endif; ?>

					<?php if ( '' != ( $member_login = get_theme_mod('theme_url_member_login') ) ): ?><p class="member_login"><a href="<?php echo $member_login; ?>" target="_new"><span class="icon">- </span><?php echo _e('Member Login', 'fitnessthemes' ); ?></a></p><?php endif; ?>
					
					<?php if( !get_theme_mod('theme_hide_h_phone') ): ?><p class="phone_number"><?php /*<span class="icon">- </span><?php */ 

					// Fast Fitness Only
					if( get_current_blog_id() == 69 ) {
						?><a href="tel:+16184449913" rel="nofollow">618-444-9913 (Glen Carbon)</a> | <a href="tel:+16185809834" rel="nofollow">618-580-9834 (Shiloh)</a><?php
					} else {
						echo ( get_current_blog_id() == 97 ) ? 'Call <!--or Text -->' : '';
						echo ( get_current_blog_id() == 70 ) ? 'Call Us Today! ' : '';
						echo '<a href="tel:' . hybrid_get_setting( 'uo_phone_number' ) . '" rel="nofollow">' . hybrid_get_setting( 'uo_phone_number' ) . '</a>';
					}; ?></p><? endif; //End Phone Number ?>

					<?php if( !get_theme_mod('theme_hide_h_address') ): ?><p class="address"><?php echo hybrid_get_setting( 'uo_address' ); ?></p><? endif; ?>
				<?php else: ?>
				<h2 id="site-description">
					<small><?php bloginfo( 'description' ); ?></small>
				</h2>
				<?php endif; ?>
				
				<div class="top-navbar">
					<?php if (!is_pageNavHidden()) get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>
				</div>

			</div>
		</div>
	</div>
</header>
<?php } //end if fwf_has_header_footer ?>

<?php if ( !is_page_template('templates/home-page.php') ): ?>

<!-- Main Page Content and Sidebar -->
<?php do_action( 'fwf_before_pagestarts' ); ?>

<?php echo fwf_has_container() ?>
 
<?php endif; ?>

<script>console.log('new-loadedd')</script>