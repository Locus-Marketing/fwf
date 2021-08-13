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
		<div class="search">

				<form method="get" class="search-form" action="<?php echo trailingslashit( home_url() ); ?>">
						<div class="row collapse">
				<div class="eight mobile-three columns">
					<input class="search-text" type="text" name="s" value="<?php if ( is_search() ) echo esc_attr( get_search_query() ); else esc_attr_e( 'Enter search terms...', 'spine' ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
					</div>
					<div class="four mobile-one columns">
              <input type="submit" href="#" class="postfix small button expand" value="<?php _e('Search', 'spine'); ?>">
				</div>
            </div>
				</form><!-- .search-form -->

			</div><!-- .search -->