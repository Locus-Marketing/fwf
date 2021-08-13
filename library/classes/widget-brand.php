<?php
/**
 * Site Brand
 */

/**
 * Brand Widget Class
 *
 * @since 0.6.0
 */
class Hybrid_Widget_Brand extends WP_Widget {

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 *
	 * @since 1.2.0
	 */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname'   => 'site-brand',
			'description' => esc_html__( 'Displays logo and social media icons', 'fitnessthemes' )
		);

		/* Set up the widget control options. */
		$control_options = array(
			'width'  => 200,
			'height' => 350
		);

		/* Create the widget. */
		parent::__construct(
			'hybrid-site-brand',	                  // $this->id_base
			__( 'Site Brand (FWF)', 'fitnessthemes' ),  // $this->name
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
		<div class="fwf-site-brand">
			<?php if ( $instance['brand_logo_url'] ) : ?>
				<div class="site-brand-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo $instance['brand_logo_url']; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a></div>
			<?php endif;?>
		
			<ul class="social_media">
				<li class="facebook"><a href="<?php echo get_theme_mod('theme_url_facebook') ?>" target="_new" rel="me">facebook</a></li>
				<?php if( $url_twitter = get_theme_mod('theme_url_twitter') ): ?><li class="twitter"><a href="<?php echo $url_twitter ?>" target="_new" rel="me">twitter</a></li><?php endif; ?>
				<?php if( $url_youtube = get_theme_mod('theme_url_youtube') ): ?><li class="youtube"><a href="<?php echo $url_youtube ?>" target="_new" rel="me">youtube</a></li><?php endif; ?>
				<?php if( $url_instagram = get_theme_mod('theme_url_instagram') ): ?><li class="instagram"><a href="<?php echo $url_instagram ?>" target="_new" rel="me">Instagram</a></li><?php endif; ?>
				<?php if( $url_googleplus = get_theme_mod('theme_url_googleplus') ): ?><li class="googleplus"><a href="<?php echo $url_googleplus ?>" target="_new" rel="publisher">Google+</a></li><?php endif; ?>
				<?php if( $url_yelp = get_theme_mod('theme_url_yelp') ): ?><li class="yelp"><a href="<?php echo $url_yelp ?>" target="_new" rel="me">Yelp</a></li><?php endif; ?>
			</ul>
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
	
		$instance['brand_logo_url'] = strip_tags( $new_instance['brand_logo_url'] );

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
			'brand_logo_url'   => esc_attr__( get_theme_mod( 'fwf_logo' ), 'fitnessthemes' )
		);
		
		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		if( !empty( $instance['brand_logo_url'] ) && $instance['brand_logo_url'] != 'https://' ) {
			$brand_logo_url = esc_attr( $instance['brand_logo_url'] );
		} else {
			$brand_logo_url = get_theme_mod( 'fwf_logo' );
		}
		?>
		<div class="hybrid-widget-controls columns-1">
			<p>
				<label for="<?php echo $this->get_field_id( 'brand_logo_url' ); ?>"><?php _e( 'Logo URL:', 'fitnessthemes' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'brand_logo_url' ); ?>" name="<?php echo $this->get_field_name( 'brand_logo_url' ); ?>" value="<?php echo $brand_logo_url; ?>" />
			</p>
		</div>
	<?php
	}
}

?>