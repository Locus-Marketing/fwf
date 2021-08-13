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

do_atomic( 'before_entry' ); // spine_before_entry ?>

<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php do_atomic( 'open_entry' ); // spine_open_entry ?>

	<header class="entry-header page-header">
			<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
    </header><!-- .entry-header -->

    <div class="row">
		<div class="three columns">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( 'lessons-sidebar' ) ) { 
				//ask to use widget?
			}
			?>
		</div>

		<div class="nine columns" role="main">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'spine' ), 'after' => '</p>' ) ); ?>

		    <div class="entry-footer">
					<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>
		    </div><!-- .entry-footer -->
		</div>
    </div><!-- .entry-content -->

	<?php do_atomic( 'close_entry' ); // spine_close_entry ?>

</article><!-- .hentry -->

<?php do_atomic( 'after_entry' ); // spine_after_entry