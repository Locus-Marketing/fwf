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
 
$prefix = hybrid_get_prefix();
?>
<div class="<?php hybrid_entry_class('four columns'); ?>" <?php echo ( $logo_src = get_theme_mod( $prefix.'_logo' ) ) ? 'style="background: url('.$logo_src.') no-repeat 50% 80%;background-size:80%;"' : ''; ?>>
	<article id="post-<?php the_ID(); ?>">
		<header class="entry-header">
			<div class="wod_datemeta"><?php the_date( '\<\s\t\r\o\n\g\>d\<\/\s\t\r\o\n\g\> M' ); ?></div>
			<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php if( has_post_thumbnail() ): ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail( 'fwf_latest_blog' ); ?>
				</a>
			<?php else: ?>
				<div class="fwf-wod-noimage" <?php echo ( $logo_src = get_theme_mod( $prefix.'_logo' ) ) ? 'style="background-image: url('.$logo_src.'); background-repeat: no-repeat; background-position: 50% 80%; background-size: 80%; opacity:.5;"' : ''; ?>></div>
			<?php endif; ?>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</article><!-- .hentry -->
</div>