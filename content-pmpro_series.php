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

global $current_blog_id;

do_atomic( 'before_entry' ); // spine_before_entry ?>

<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php do_atomic( 'open_entry' ); // spine_open_entry ?>

	<?php if ( is_singular() ) { ?>

	    <?php if( !is_front_page() && !is_pageTitleHidden() && !is_page_template( 'templates/layout-5.php' ) ): ?>
		<header class="entry-header page-header">
				<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
	    </header><!-- .entry-header -->
		<?php endif; ?>

    	<div class="entry-content">
			<div class="row">
				<?php the_content(); ?>
			</div>

			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'spine' ), 'after' => '</p>' ) ); ?>
    	</div><!-- .entry-content -->

    <div class="entry-footer">
			<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>
    </div><!-- .entry-footer -->

	<?php } ?>

	<?php do_atomic( 'close_entry' ); // spine_close_entry ?>

</article><!-- .hentry -->

<?php do_atomic( 'after_entry' ); // spine_after_entry