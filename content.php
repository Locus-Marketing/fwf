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
?>
<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
    <div class="row">
		<?php do_atomic( 'open_entry' ); // spine_open_entry ?>

			<?php if ( is_singular() && is_main_query() ) { ?>

        <header class="entry-header twelve columns">
					<?php if( !is_front_page() && !is_pageTitleHidden() ) echo apply_atomic_shortcode( 'entry_title', the_title( '<h1 class="entry-title">', '</h1>', false ) ); ?>
					<?php echo apply_atomic_shortcode( 'byline', '<div class="byline"><p>' . __( 'Published by [entry-author] <span class="on">on</span> [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'spine' ) . '</p></div>' ); ?>
        </header><!-- .entry-header -->
        <div class="entry-content twelve columns">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'spine' ), 'after' => '</p>' ) ); ?>
        </div><!-- .entry-content -->

        <div class="entry-footer twelve columns">
					<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-terms taxonomy="category" before="Posted in "] [entry-terms before="Tagged "]', 'spine' ) . '</div>' ); ?>
        </div><!-- .entry-footer -->

			<?php } else { ?>

				<?php $image = get_the_image( array( 'echo' => false ) ); ?>
			<?php if ( !empty($image) ) { ?>
				<div class="twelve columns">
						<?php }else{ ?>
					<div class="twelve columns">
				<?php } ?>
			<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'link_to_post' => false, 'meta_key' => 'Featured', 'size' => 'featured' ) ); ?>
			<?php if (  !empty($image) ) : ?></div><!-- two columns --><?php endif; ?>
			<?php if (  !empty($image) ) : ?><div class="twelve columns"><?php endif; ?>
        <header class="entry-header">
					<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
					<?php echo apply_atomic_shortcode( 'byline', '<div class="byline"><p>' . __( 'Published by [entry-author] <span class="on">on</span> [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'spine' ) . '</p></div>' ); ?>
        </header><!-- .entry-header -->

        <div class="entry-summary">
					<?php global $more; $more = 0; ?>
					<?php if( is_home() ): ?>
					<?php the_excerpt(); ?>
					<?php else: ?>
					<?php the_content("<p>Continue reading " . the_title('', '', false). ' &#187;</p>'); ?>
					<?php endif; ?>
					<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'spine' ), 'after' => '</p>' ) ); ?>
        </div><!-- .entry-summary -->

        <div class="entry-footer">
					<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-terms taxonomy="category" before="Posted in "] [entry-terms before="Tagged "]', 'spine' ) . '</div>' ); ?>
        </div><!-- .entry-footer -->
			<?php if (  !empty($image) ) : ?></div><!-- ten columns --><?php endif; ?>
			<?php } ?>

			<?php do_atomic( 'close_entry' ); // spine_close_entry ?>
    </div>
</article><!-- .hentry -->

<?php do_atomic( 'after_entry' ); // spine_after_entry ?>

<hr />