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
global $post, $comment;
?>

<li id="comment-<?php comment_ID(); ?>" class="<?php hybrid_comment_class(); ?>">

	<?php do_atomic( 'before_comment' ); // spine_before_comment ?>

    <div class="comment-wrap">

			<?php do_atomic( 'open_comment' ); // spine_open_comment ?>

			<?php echo apply_atomic_shortcode( 'comment_meta', '<div class="comment-meta">[comment-author] [comment-published] [comment-permalink before="| "] [comment-edit-link before="| "] [comment-reply-link before="| "]</div>' ); ?>

			<?php do_atomic( 'close_comment' ); // spine_close_comment ?>

    </div><!-- .comment-wrap -->

	<?php do_atomic( 'after_comment' ); // spine_after_comment ?>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */