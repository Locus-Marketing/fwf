<?php 
/**
 * Template Name: Blog
 *
 * A template for a blog page
 *
 * @package    Templates
 * @version    1.0
 * @author     Fitness Website Formula
 * @link       http://fitnesswebsiteformula.com
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 */
$pp = get_option('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts("paged=$paged&showposts=$number_posts");
?>
<?php get_header(); ?>
<?php do_atomic( 'before_content' ); // pdw_spine_before_content ?>

	<!-- Main Blog Content -->
	<div class="eight columns" role="main">

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

	<?php do_atomic( 'after_content' ); // pdw_spine_after_content ?>

<?php
//wp_reset_postdata();
get_footer();