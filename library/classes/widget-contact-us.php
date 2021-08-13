<?php
/**
 * Quicky and easy way to add basic contact info
 */

/**
 * Contact Us Widget Class
 *
 * @since 0.6.0
 */
class Hybrid_Widget_Contact_Us extends WP_Widget {

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 *
	 * @since 1.2.0
	 */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname'   => 'contact-us',
			'description' => esc_html__( 'Displays contact us info in a pre-set format', 'fitnessthemes' )
		);

		/* Set up the widget control options. */
		$control_options = array(
			'width'  => 200,
			'height' => 350
		);

		/* Create the widget. */
		parent::__construct(
			'hybrid-contact-us',	                  // $this->id_base
			__( 'Contact us (FWF)', 'fitnessthemes' ),  // $this->name
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
		
		?>
		<div class="fwf-contact-us">
			<?php if( $instance['title'] ): ?><h5 class="widget-title"><?php echo $instance['title'] ?></h5><?php endif; ?>
			<p><span class="footer-dba"><?php echo $instance['dba'] ?></span></p>
			<p><span class="footer-address"><?php echo $instance['address'] ?></span></p>
			<p><span class="footer-phone"><?php echo $instance['phone'] ?></span></p>
			<p><a href="<?php echo $instance['button_url'] ?>" class="<?php echo $instance['button_classes'] ?>"><?php echo $instance['button_text'] ?></a></p>
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

		$instance['title'] = strip_tags( $new_instance['title'], '<span><br><br/><b><strong>' );
		$instance['dba'] = strip_tags( $new_instance['dba'], '<span><br><br/><b><strong>' );
		$instance['address'] = strip_tags( $new_instance['address'], '<span><br><br/><b><strong>' );
		$instance['phone'] = strip_tags( $new_instance['phone'], '<span><br><br/><b><strong><a>' );
		$instance['button_url'] = strip_tags( $new_instance['button_url'] );
		$instance['button_classes'] = strip_tags( $new_instance['button_classes'] );
		$instance['button_text'] = strip_tags( $new_instance['button_text'] );

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
			'title'   => esc_attr__( 'Contact Info', 'fitnessthemes' ),
			'dba'   => esc_attr__( 'Business Name', 'fitnessthemes' ),
			'address'   => esc_attr__( '555 My Street San Francisco CA, 96666', 'fitnessthemes' ),
			'phone'   => esc_attr__( 'Call Today! <b>(555) 555-5555</b>', 'fitnessthemes' ),
			'button_url'   => esc_attr__( get_bloginfo('url') . '/contact/', 'fitnessthemes' ),
			'button_classes'   => esc_attr__( 'button', 'fitnessthemes' ),
			'button_text'   => esc_attr__( 'Contact Us &#187;', 'fitnessthemes' )
		);
		
		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		if( !empty( $instance['button_url'] ) && $instance['button_url'] != 'http://' ) {
			$button_url = esc_attr( $instance['button_url'] );
		} else {
			$button_url = get_bloginfo('url') . '/contact/';
		}
		?>

		<div class="hybrid-widget-controls columns-1">
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:', 'fitnessthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'dba' ); ?>"><?php _e( 'Business Name:', 'fitnessthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'dba' ); ?>" name="<?php echo $this->get_field_name( 'dba' ); ?>" value="<?php echo esc_attr( $instance['dba'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address:', 'fitnessthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo esc_attr( $instance['address'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone:', 'fitnessthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo esc_attr( $instance['phone'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Contact Button Text:', 'fitnessthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" value="<?php echo esc_attr( $instance['button_text'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button URL:', 'fitnessthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" value="<?php echo $button_url; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'button_classes' ); ?>"><?php _e( 'Button CSS Classes:', 'fitnessthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_classes' ); ?>" name="<?php echo $this->get_field_name( 'button_classes' ); ?>" value="<?php echo esc_attr( $instance['button_classes'] ); ?>" />
		</p>
		</div>
	<?php
	}
}

?>