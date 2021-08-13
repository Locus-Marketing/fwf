<?php
/**
 * The Featured Content Boxes widget
 *
 * @package    Hybrid
 * @subpackage Classes
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2008 - 2012, Justin Tadlock
 * @link       http://themehybrid.com/hybrid-core
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 */

/**
 * Featured Content Class
 *
 * @since 0.6.0
 */
class Hybrid_Widget_Featured_Content extends WP_Widget {

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 *
	 * @since 1.2.0
	 */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname'   => 'fwf-featured-content',
			'description' => esc_html__( 'Displays 3 featured boxes to promote CrossFit and specials', 'hybrid-core' )
		);

		/* Set up the widget control options. */
		$control_options = array(
			'width'  => 200,
			'height' => 350
		);

		/* Create the widget. */
		parent::__construct(
			'hybrid-featured-content',	              // $this->id_base
			__( 'Featured Content Boxes (FWF)', 'hybrid-core' ),  // $this->name
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
		
		/*switch ($instance['position']) {
			case 'left':
				$class = 'leftbox';
				break;
			case 'right':
				$class = 'rightbox';
				break;
			case 'center':
				$class = 'centerbox';
				break;
			default:
				$class = 'row';
				break;
		}*/
		?>
		<div class="featured_box">
			<div class="box_content">
				<h4><?php echo $instance['title_left'] ?></h4>
				<?php echo $instance['content'] ?>
			</div>
			<div class="more_info"><a href="<?php echo $instance['url'] ?>"><?php _e( 'Read more &#0187;', 'hybrid-core' ); ?></a></div>
		</div>
		
		<div class="featured_box box_center latest_promo">
			<?php
			$args = array( 'post_type' => 'cp_promotion', 'posts_per_page' => 1 );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) {
				$loop->the_post(); 
				$thumbnail = get_the_post_thumbnail( get_the_ID(), 'full' );
				$length = ($thumbnail) ? '130' : '270';
				$excerpt = the_excerpt_max_charlength( $length );
				$url = get_permalink();
				$pro_sub_head = get_the_title();
			}
			wp_reset_query();
			?>			
			<div class="box_content">
				<h4><?php echo $instance['title_center'] ?></h4>
                <h5><?php echo $pro_sub_head; ?></h5>
				<?php if ($thumbnail) echo $thumbnail; ?>
				<?php echo ($loop->post_count > 0) ? $excerpt : _e( 'No post found. Add a new promotion from your dashboard.', 'hybrid-core' ); ?>
                
			</div>
			<div class="more_info"><a href="<?php echo $url ?>"><?php _e( 'Read more &#0187;', 'hybrid-core' ); ?></a></div>
		</div>
		
		<div class="featured_box latest_event">
			<?php
			$args = array( 'post_type' => 'cp_event', 'posts_per_page' => 1 );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) {
				$loop->the_post();
				$event_day  = get_the_date('j ');
				$event_month  = get_the_date('M');
				$event_thumbnail = get_the_post_thumbnail( get_the_ID(), 'full' );
				$event_title = get_the_title();
				$event_length = ($thumbnail) ? '130' : '270';
				$event_excerpt = the_excerpt_max_charlength( $event_length );
				$event_url = get_permalink();
			}
			
			wp_reset_query();
			?>		
			<div class="box_content">
				<h4><?php echo $instance['title_right']; ?></h4>
                <time><?php echo $event_day; ?> <small> <?php echo $event_month ?></small></time>
				<h6><?php echo $event_title; ?></h6>                
				<?php if ($event_thumbnail) echo $event_thumbnail; ?>
				<?php echo ($loop->post_count > 0) ? $event_excerpt : _e( 'No post found. Add a new event from your dashboard.', 'hybrid-core' ); ?>
			</div>
			<div class="more_info"><a href="<?php echo $event_url ?>"><?php _e( 'Read more &#0187;', 'hybrid-core' ); ?></a></div>
		</div>
		<?php

		/* Close the theme's widget wrapper. */
		echo $after_widget;
	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 0.6.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance['title_left'] = strip_tags( $new_instance['title_left'] );
		$instance['title_right'] = strip_tags( $new_instance['title_right'] );
		$instance['title_center'] = strip_tags( $new_instance['title_center'] );
		$instance['content'] = strip_tags( $new_instance['content'] );
		$instance['url'] = strip_tags( $new_instance['url'] );
		$instance['position'] = strip_tags( $new_instance['position'] );

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
			'title_left'   => esc_attr__( 'What is CrossFit?', 'hybrid-core' ),
			'content'   => esc_attr__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. ', 'hybrid-core' ),
			'url'   => esc_attr__( 'http://', 'hybrid-core' ),
			'position'   => esc_attr__( 'none', 'hybrid-core' ),

			'title_center'   => esc_attr__( 'Grand Opening Special', 'hybrid-core' ),
			'title_right'   => esc_attr__( 'Upcoming Events', 'hybrid-core' )
		);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div class="hybrid-widget-controls columns-1">
		<h4><?php _e( 'Free-style Content', 'hybrid-core' ); ?></h4>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_left' ); ?>"><?php _e( 'Title:', 'hybrid-core' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title_left' ); ?>" name="<?php echo $this->get_field_name( 'title_left' ); ?>" value="<?php echo esc_attr( $instance['title_left'] ); ?>" />
		</p>
		<p>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' );?>" rows="8" cols="20"><?php echo esc_attr( $instance['content'] ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:', 'hybrid-core' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo esc_attr( $instance['url'] ); ?>" />
		</p>
		<? /*<p>
			<label for="<?php echo $this->get_field_id( 'position' ); ?>"><?php _e( 'Position:', 'hybrid-core' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'position' ); ?>">
				<option value="left"><?php _e( 'Left', 'hybrid-core' ); ?></option>
				<option value="center"><?php _e( 'Center', 'hybrid-core' ); ?></option>
				<option value="right"><?php _e( 'Right', 'hybrid-core' ); ?></option>
				<option value="none"><?php _e( 'None (Full width)', 'hybrid-core' ); ?></option>
			</select>			
		</p> */ ?>
		<hr />
		<h4><?php _e( 'Latest Promotion', 'hybrid-core' ); ?></h4>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_center' ); ?>"><?php _e( 'Title:', 'hybrid-core' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title_center' ); ?>" name="<?php echo $this->get_field_name( 'title_center' ); ?>" value="<?php echo esc_attr( $instance['title_center'] ); ?>" />
		</p>
		<hr />
		<h4><?php _e( 'Latest Events', 'hybrid-core' ); ?></h4>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_right' ); ?>"><?php _e( 'Title:', 'hybrid-core' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title_right' ); ?>" name="<?php echo $this->get_field_name( 'title_right' ); ?>" value="<?php echo esc_attr( $instance['title_right'] ); ?>" />
		</p>
		</div>
		<div style="clear:both;">&nbsp;</div>
	<?php
	}
}
?>