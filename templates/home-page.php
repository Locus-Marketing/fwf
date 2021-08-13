<?php
/**
 * Template Name: Homepage
 *
 * A template for a top page
 *
 * @package    Templates
 * @version    1.0
 * @author     Fitness Website Formula
 * @link       http://fitnesswebsiteformula.com
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 */
?>
<?php get_header(); ?>

<?php 
if( 'bg_content' == get_theme_mod( 'theme_home_opening' ) ) {
	wp_enqueue_script( 'vide', PDW_SPINE_JS_URL . 'vendor/jquery.vide.min.js', array( 'jquery' ), PDW_SPINE_VERSION, true );
	if( $opening_video_url = get_theme_mod( 'theme_opening_video' ) ) {
	?><div class="opening-container">
		<div class="opening-content" data-vide-bg="<?php echo $opening_video_url; ?>" data-vide-options="posterType: jpg, loop: true, muted: true, position: 0% 0%">
		<?php echo do_shortcode( get_theme_mod( 'theme_opening_content' ) ); ?>
		</div>
		<div class="opening-film"></div>
	</div>
	<?php
	}
	
} else {
	do_action( 'fwf_slideshow' ); 
} ?>
	<div class="stripe_container extra">
		<div class="row">
			<?php if (!dynamic_sidebar( 'Home Top Area' )):?><?php endif; ?>
			
			<?php //do_action( 'fwf_ultimate_offer' ); ?>
		</div>
	</div>
	
	<?php do_atomic( 'before_content' ); // pdw_spine_before_content ?>

	<!-- Main Homepage Content -->
	<div id="homepage_content" class="twelve" role="main">

		<?php do_atomic( 'open_content' ); // pdw_spine_open_content ?>

        <div class="hfeed">

					<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

					<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

						<?php if ( is_singular() ) { ?>

							<?php do_atomic( 'after_singular' ); // pdw_spine_after_singular ?>

							<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

							<?php } ?>

						<?php endwhile; ?>

					<?php else : ?>

					<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

					<?php endif; ?>

        </div><!-- .hfeed -->

			<?php do_atomic( 'close_content' ); // pdw_spine_close_content ?>

			<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

    </div><!-- #content -->
<div class="clear_both"></div> 
	<?php do_atomic( 'after_content' ); // pdw_spine_after_content ?>
   
	
	<?php if (!dynamic_sidebar( 'Home Bottom Area' )):?><?php endif; ?>
<div class="clear_both"></div>

<?php
//wp_reset_postdata();
get_footer();