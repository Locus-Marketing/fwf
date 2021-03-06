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

/* If a post password is required or no comments are given and comments/pings are closed, return. */
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
	return;
/* If theme setting says to turn off comments on all non-single post pages, return */
if (hybrid_get_setting( 'misc_disable_comments' ) && !is_single())
	return;
?>

<div id="comments-template">

    <div class="comments-wrap">

        <div id="comments">

					<?php if ( have_comments() ) : ?>

            <h3 id="comments-number" class="comments-header"><?php comments_number( __( 'No Responses', 'spine' ), __( 'One Response', 'spine' ), __( '% Responses', 'spine' ) ); ?></h3>

					<?php if ( get_option( 'page_comments' ) ) : ?>
                <div class="comments-nav">
									<?php previous_comments_link( __( '&larr; Previous', 'spine' ) ); ?>
                    <p><span class="page-numbers"><?php printf( __( 'Page %1$s of %2$s', 'spine' ), ( get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1 ), get_comment_pages_count() ); ?></span></p>

									<?php next_comments_link( __( 'Next &rarr;', 'spine' ) ); ?>
                </div><!-- .comments-nav -->
						<?php endif; ?>

					<?php do_atomic( 'before_comment_list' );// spine_before_comment_list ?>

            <ol class="comment-list">
							<?php wp_list_comments( hybrid_list_comments_args() ); ?>
            </ol><!-- .comment-list -->

					<?php do_atomic( 'after_comment_list' ); // spine_after_comment_list ?>

					<?php endif; ?>

					<?php if ( pings_open() && !comments_open() ) : ?>

            <p class="comments-closed pings-open">
							<?php printf( __( 'Comments are closed, but <a href="%s" title="Trackback URL for this post">trackbacks</a> and pingbacks are open.', 'spine' ), esc_url( get_trackback_url() ) ); ?>
            </p><!-- .comments-closed .pings-open -->

					<?php elseif ( !comments_open() ) : ?>

            <p class="comments-closed">
							<?php _e( 'Comments are closed.', 'spine' ); ?>
            </p><!-- .comments-closed -->

					<?php endif; ?>

        </div><!-- #comments -->

			<?php comment_form(); // Loads the comment form. ?>

    </div><!-- .comments-wrap -->

</div><!-- #comments-template -->