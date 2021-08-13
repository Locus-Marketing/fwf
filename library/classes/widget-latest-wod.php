<?php
/**
 * The Latest WOD widget adds groups of 3 most recent workout of the day posts
 *
 * @package    Hybrid
 * @subpackage Classes
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2008 - 2012, Justin Tadlock
 * @link       http://themehybrid.com/hybrid-core
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 */

/**
 * Latest WOD Widget Class
 *
 * @since 0.6.0
 */
class Hybrid_Widget_Latest_WOD extends WP_Widget {

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 *
	 * @since 1.2.0
	 */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname'   => 'latest-wod',
			'description' => esc_html__( 'Displays the 3 most recent blog posts', 'hybrid-core' )
		);

		/* Set up the widget control options. */
		$control_options = array(
			'width'  => 200,
			'height' => 350
		);

		/* Create the widget. */
		parent::__construct(
			'hybrid-latest-wod',	                  // $this->id_base
			__( 'Latest Blog (FWF)', 'hybrid-core' ),  // $this->name
			$widget_options,               			  // $this->widget_options
			$control_options               			  // $this->control_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 0.6.0
	 */
	function widget( $sidebar, $instance ) {
		extract( $sidebar );

		/* Output the theme's widget wrapper. */
		echo $before_widget;
		
		?><div class="fwf_latest_wod">
			<div class="row">
				<?php if($instance['title']): ?>
				<div class="wod_header">
					<h4><?php echo $instance['title'] ?></h4>
					<?php if( $instance['sub_title'] ): ?><h5><?php echo $instance['sub_title'] ?></h5><?php endif; ?>
				</div>
				<?php endif; ?>
				
				<div class="wod_content twelve columns">
				<?php
				//wp_reset_query();
				$number_posts = 3;
				$cnt = 0;
				$cat = $instance['cat'];
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				query_posts("paged=$paged&posts_per_page=$number_posts&cat=$cat");

				if ( have_posts() ) :

				while ( have_posts() && $cnt < $number_posts ) : the_post();

					get_template_part( 'content', 'wod-exerpt' );
					++$cnt;

				endwhile;

				else :

				get_template_part( 'loop-error' ); // Loads the loop-error.php template.

				endif; 
				
				wp_reset_query();?>
				</div>
			</div>
		</div><?php

		/* Close the theme's widget wrapper. */
		echo $after_widget;
	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 0.6.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['sub_title'] = strip_tags( $new_instance['sub_title'] );
		$instance['cat'] = strip_tags( $new_instance['cat'] );

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 0.6.0
	 */
	function form( $instance ) {

		/* Set up the default form values. */
		$defaults = array(
			'title'   => esc_attr__( 'Latest News & Articles', 'hybrid-core' ),
			'sub_title'   => esc_attr__( 'Tips, Recipes, and Success Stories', 'hybrid-core' ),
			'cat'   => esc_attr__( '1', 'hybrid-core' )
		);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div class="hybrid-widget-controls columns-1">
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'hybrid-core' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'sub_title' ); ?>"><?php _e( 'Sub-Title:', 'hybrid-core' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'sub_title' ); ?>" name="<?php echo $this->get_field_name( 'sub_title' ); ?>" value="<?php echo esc_attr( $instance['sub_title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Category IDs:', 'hybrid-core' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" value="<?php echo esc_attr( $instance['cat'] ); ?>" /><br /><small><?php _e( '(e.g. 4,15,3)', 'hybrid-core' ); ?></small>
		</p>
		</div>
	<?php
	}
}

?>