<?php

/**
 * Membership site related
 *
 * @since Fitness Membership 2.1
 */
 
 
function pdw_spine_custom_init() {
	$custom_types = array(
		array('training-plan', 'Training Plan', 'Training Plans', 'training-plans'), //[0] system [1] Singular [2] Prural [3] slug
		array('workout', 'Workout', 'Workouts', 'workouts'),
	);
	foreach($custom_types as $type) {
		$labels = array(
		'name' => __($type[2]),
		'singular_name' => __($type[1]),
		'add_new_item' => __('Add New '. $type[1]),
		'edit_item' => __('Edit '. $type[1]),
		'new_item' => __('New '. $type[1]),
		'all_items' => __('All '. $type[2]),
		'view_item' => __('View '. $type[1]),
		'search_items' => __('Search '. $type[2]),
		'not_found' =>  __('No '. $type[3] .' found'),
		'not_found_in_trash' => __('No '. $type[3] .' found in Trash')
		);
		
		$args = array(
		'labels' => $labels,
		'public' => true,
		'show_in_nav_menus' => true, 
		'show_in_menu' => true,
		'rewrite' => array( 'slug' => $type[3] ),
		'capability_type'    => 'post',
		'menu_position' => 10,
		'supports' => array( 'title', 'thumbnail')
		);
		
		register_post_type($type[0], $args); //Create new content types
	}
}
add_action('init', 'pdw_spine_custom_init');

/**
 * Activate URL rewrites for custom content types on theme activation
 */
/* function pdw_spine_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'twentytwelve_rewrite_flush' ); */

/**
 * Overwrite the columns for the custom content type edit screen
 */
function pdw_spine_change_columns($cols) {
  $cols = array(
    'cb' => '<input type="checkbox" />',
    'title' => __( 'Title'),
    'date' => __( 'Date'),
    'id' => __( 'ID')
  );
  return $cols;
}
add_filter( "manage_video_posts_columns", "pdw_spine_change_columns");
add_filter( "manage_manual_posts_columns", "pdw_spine_change_columns");

function pdw_spine_add_columns($column, $post_id) {
	switch($column){
		case 'id':
			echo $post_id;
			break;
    }
}
add_action( "manage_posts_custom_column", "pdw_spine_add_columns", 10, 2);

/**
 * Display the metabox for PDFs
 */
function pdw_spine_url_custom_metabox_pdf() {
	global $post;
	$urllink = get_post_meta( $post->ID, 'urllink', true );
	
	if ( !preg_match( "/http(s?):\/\//", $urllink )) {
		$urllink = 'http://';
	}?>	
	<p><input id="urllink" size="70" name="urllink" value="<?php if( $urllink ) { echo $urllink; } ?>" /></label></p>
	<style type="text/css">#post-body-content {margin-bottom: 0 !important;}</style>
<?php
}
function title_custom_metabox() {
	global $post;
	$short_title = get_post_meta( $post->ID, 'short_title', true );?>	
	<p><input id="short_title" size="70" name="short_title" value="<?php if( $short_title ) { echo $short_title; } ?>" /></label></p>
<?php
}
/**
 * Process the custom metabox fields
 */
function pdw_spine_save_custom_url( $post_id ) {
	global $post;
	
	if(in_array($post->post_type, array('video', 'manual')) && $_POST ) {
		update_post_meta( $post->ID, 'urllink', $_POST['urllink'] );
		update_post_meta( $post->ID, 'short_title', $_POST['short_title'] );
	}
}

add_action( 'save_post', 'pdw_spine_save_custom_url' );


/**
 * Add meta box
 */
function fwf_add_mem_metabox() {
	add_meta_box( 'custom-title-metabox', __( 'Short Title' ), 'title_custom_metabox', 'video', 'normal', 'high' );
	add_meta_box( 'custom-title-metabox', __( 'Short Title' ), 'title_custom_metabox', 'manual', 'normal', 'high' );
	add_meta_box( 'custom-metabox', __( 'URL' ), 'pdw_spine_url_custom_metabox_video', 'video', 'normal', 'high' );
	add_meta_box( 'custom-metabox', __( 'URL' ), 'pdw_spine_url_custom_metabox_pdf', 'manual', 'normal', 'high' );
}

add_action( 'admin_init', 'fwf_add_mem_metabox' );

/**
 * Display the metabox for videos
 */
function pdw_spine_url_custom_metabox_video() {
	global $post;
	$urllink = get_post_meta( $post->ID, 'urllink', true );
	
	if ( !preg_match( "/\/\/player.vimeo.com\/video\/[0-9]{8,}/", $urllink )) {
		$urllink = '//player.vimeo.com/video/';
	}?>	
	<p><input id="urllink" size="70" name="urllink" value="<?php if( $urllink ) { echo $urllink; } ?>" /></label></p>
	<style type="text/css">#post-body-content {margin-bottom: 0 !important;}</style><?php
}

/**
 * Get and return the values for the URL
 */
function fwf_get_content_url($pid = 0) {
	global $post;
	if($pid) {
		return get_post_meta( $pid, 'urllink', true );
	} else {
		return get_post_meta( $post->ID, 'urllink', true );
	}
}

/**
 * Get and return the values for the short title
 */
function get_short_title($pid = 0) {
	global $post;
	if($pid) {
		return get_post_meta( $pid, 'short_title', true );
	} else {
		return get_post_meta( $post->ID, 'short_title', true );
	}
}

/**
 * Displays download boxes
 */
function the_download_content() {
	
	//If Wishlist is enabled, check level permissions
	/*if( function_exists('wlmapi_get_member_levels') ) {
		
		$current_user = wp_get_current_user();
		$user_levels = wlmapi_get_member_levels( $current_user->ID );
	}*/
	
	$download_categories = array(
		'starthere' => 75,
		'level1' => 86,
		'level2' => 88,
		'level3' => 90,
		'bonus-one' => 20,
		'bonus-two' => 44
	);
	
	global $post;
	$post_ids = get_post_meta( $post->ID, 'downloads', true );
	$post_ids = explode(',', str_replace(' ', '', $post_ids));
	
	foreach($post_ids as $id) {
		$type = get_post_type($id);
		//$post_levels = WLMAPI::GetPostLevels($id);
		
		//if( wl_skip_box($post_levels, $user_levels) === TRUE ) continue;
		?>
		<div class="dl_box <?php echo ($type == 'manual') ? 'pdfbox' : '' ?>" <?php //echo customBannerStyle($post->ID, $download_categories); ?>>
			<div class="dl_title"><?php $title = get_the_title($id); echo '<span class="maintitle">'.str_replace(':',':</span><br /><span>', $title). '</span>' ?></div>
			<div class="mask <?php echo $type; ?>">
				<h4><?php echo get_short_title($id); ?></h4>
				<?php if ($type == 'video'):?>
				<p><a href="#videobox_<?php echo $id ?>_frame" class="fancybox">play video</a><br /></p>
				<?php elseif ($type == 'manual'): ?>
				<p><a href="<?php echo get_permalink($id); ?>" target="_blank">Download PDF</a></p><small>(Right click and "Save As")</small>
				<?php endif; ?>
			</div>
		</div>
		<div id="videobox_<?php echo $id ?>_frame" style="display: none;" class="responsive-overlay">
			<iframe src="<?php echo fwf_get_content_url($id); ?>?rel=0&amp;title=0&amp;byline=0&amp;portrait=0" style="width:100%;height:100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			<?php /*<div id="videobox_<?php echo $id ?>"></div>
			<script type="text/javascript">
				jwplayer("videobox_<?php echo $id ?>").setup({
					"file": "<?php echo fwf_get_content_url($id); ?>",
					"width": "100%",
					"height": "100%",
					"stretching": "exactfit",
					"controlbar": "none",
					"autostart": false,
					"primary": "flash",
					"plugins": {
					"ova-jw": {
					  "player": {
						"modes": {
						  "linear": {
							"controls": { "enable": false }
						  }
						}
					  }
					}
				  }
				});
			</script>*/ ?>
		</div>
		<?php
	}
}

function wl_skip_box($post_levels, $user_levels) {

	$post_levels = array_keys($post_levels);
	//print_r($post_levels);
	//print_r($user_levels);
	
	if( empty($post_levels) ) return FALSE; //no check required
	
	foreach($post_levels as $level) {
		if ( array_key_exists($level, $user_levels) ) return FALSE;
	}
	return TRUE;
}

function customBannerStyle($pid, $categories) {
	if (in_array($pid, $categories)) {
		$categories = array_flip($categories);
		return 'style="background:url('. get_bloginfo('template_url') .'/images/banner-'.$categories[$pid]. '.jpg) no-repeat" ';
	}
}
?>