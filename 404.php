<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * Description
 *
 * @package    Templates
 * @version    1.0
 * @author     Fitness Website Formula
 * @link       http://fitnesswebsiteformula.com
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 */

get_header(); // Loads the header.php template. ?>
<?php $content_grid_classes = pdw_spine_fetch_content_grid_classes(); ?>
<?php do_atomic( 'before_content' ); // spine_before_content ?>

<div class="<?php echo $content_grid_classes; ?>" role="main">

	<?php do_atomic( 'open_content' ); // spine_open_content ?>

    <div class="hfeed">

        <article id="post-0" class="<?php hybrid_entry_class(); ?>">

            <header class="entry-header">
                <h1 class="error-404-title entry-title"><?php _e( 'Page not found', 'spine' ); ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">

                <p>
					<?php _e( 'Sorry, we weren\'t able to find the page you requested.', 'spine' ); ?>
                </p>
                <p>
					<?php _e( "May we suggest checking out our recent blog posts or trying a saerch?", 'spine' ); ?>
                </p>

                <ul>
					<?php wp_get_archives( array( 'limit' => 20, 'type' => 'postbypost' ) ); ?>
                </ul>

            </div><!-- .entry-content -->

        </article><!-- .hentry -->

    </div><!-- .hfeed -->

	<?php do_atomic( 'close_content' ); // spine_close_content ?>

</div><!-- #content -->

<?php do_atomic( 'after_content' ); // spine_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>