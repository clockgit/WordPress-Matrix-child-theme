<?php
// Get URL of first image in a post
function matrix_first_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches [1];

// no image found display default image instead
if(empty($first_img)){
$first_img = "/wp-content/uploads/2016/04/bkgrnd-3.jpg";
}
return $first_img;
}


/* Create one or more meta boxes to be displayed on the post editor screen */
function matrix_child_tile() {
	add_meta_box(
		'matrix-tile',			// Unique ID
		esc_html__( 'Tile Settings', 'matrix' ),		// Title
		'matrix_child_tile_settings',		// Callback function
		'post',					// Admin page (or post type)
		'normal',					// Context
		'high'					// Priority
	);
	add_meta_box(
		'matrix-tile',			// Unique ID
		esc_html__( 'Tile Settings', 'matrix' ),		// Title
		'matrix_child_tile_settings',		// Callback function
		'page',					// Admin page (or post type)
		'normal',					// Context
		'high'					// Priority
	);
	add_meta_box(
		'matrix-tile',			// Unique ID
		esc_html__( 'Tile Settings', 'matrix' ),		// Title
		'matrix_child_tile_settings',		// Callback function
		'matrix_portfolio',					// Admin page (or post type)
		'normal',					// Context
		'high'					// Priority
	);
}
/* Display the tile meta box */
function matrix_child_tile_settings( $object, $box ) {
	
	$options_array = get_option('matrix_options');

	global $post;
    $live_tile_speed = get_post_meta( $post->ID, '_live_tile_speed', true );
	if (!$live_tile_speed) { $live_tile_speed = '1000'; }
    $live_tile_dir_sel = get_post_meta( $post->ID, '_live_tile_dir', true );
	$live_tile_mode_sel = get_post_meta( $post->ID, '_live_tile_mode', true );
	$tile_colour_sel = get_post_meta( $post->ID, '_tile_colour', true );
	$tile_colour_pick = get_post_meta( $post->ID, '_tile_colour_pick', true );
	if (!$tile_colour_pick) { $tile_colour_pick = 'none'; }
	$colour_picker_check = get_post_meta( $post->ID, '_colour_picker_check', true );
    $live_check = get_post_meta( $post->ID, '_live_tile_check', true );
	$live_data_stack = get_post_meta( $post->ID, '_live_data_stack', true );
	$live_data_stops = get_post_meta( $post->ID, '_live_data_stops', true );
	if (!$live_data_stops) { $live_data_stops = '0%,100%'; }
	$live_data_delay = get_post_meta( $post->ID, '_live_data_delay', true );
	if (!$live_data_delay) { $live_data_delay = '0'; }
	$tile_img_front = get_post_meta( $post->ID, '_tile_img_front', true );
	$tile_img_back = get_post_meta( $post->ID, '_tile_img_back', true );
	$list_img_front = get_post_meta( $post->ID, '_list_img_front', true );
	$archive_tile_img_front = get_post_meta( $post->ID, '_archive_tile_img_front', true );
	$lightbox_check = get_post_meta( $post->ID, '_lightbox_check', true );
	if (!$lightbox_check) { $lightbox_check = 'on'; };
	$tile_size = get_post_meta( $post->ID, '_tile_size', true );
	if (!$tile_size && $options_array['matrix_archive_tile_type'] != 'list') { $tile_size = $options_array['matrix_archive_tile_type']; } elseif ( !$tile_size ) { $tile_size = 'large'; };
	$tile_display = get_post_meta( $post->ID, '_tile_display', true );
	$tile_icon_sel = get_post_meta( $post->ID, '_tile_icon', true );
	$tile_icon_check = get_post_meta( $post->ID, '_tile_icon_check', true );
	$tile_date_check = get_post_meta( $post->ID, '_tile_date_check', true );
	if (!$tile_date_check ) { $tile_date_check = 'on'; };
	
	wp_nonce_field( basename( __FILE__ ), 'matrix_tile_nonce' );
	
	//var_dump($post->post_type); ?>
	
	<?php if($post->post_type == 'matrix_portfolio' || $post->post_type == 'post') : ?>
    <table class="form-table">
    <tbody>
	<?php if($post->post_type == 'matrix_portfolio') : ?>
    <tr valign="top">
    	<th scope="row">
        <?php _e( "Lightbox", 'matrix' ); ?>
        </th>
    	<td>
    	<input type="checkbox" id="lightbox_check" name="_lightbox_check" <?php checked( $lightbox_check, 'on' ); ?> />  
        <label for="lightbox_check"><?php _e( "Enable lightbox", 'matrix' ); ?></label> 
        </td>
    </tr>
    <tr valign="top">
    	<th scope="row">
        <?php _e( "Tile size", 'matrix' ); ?>
        </th>
    	<td>
    	<input type="radio" id="tile_size" name="_tile_size" <?php checked( $tile_size, 'small' ); ?> value="small"/><?php _e( "Small", 'matrix' ); ?>
        </td>
    </tr>
    <tr valign="top">
    	<th scope="row">
        
        </th>
        <td>
        <input type="radio" id="tile_size" name="_tile_size" <?php checked( $tile_size, 'medium' ); ?> value="medium"/><?php _e( "Medium", 'matrix' ); ?>
        </td>
    </tr>
    <tr valign="top">
    	<th scope="row">
        
        </th>
        <td>
        <input type="radio" id="tile_size" name="_tile_size" <?php checked( $tile_size, 'large' ); ?> value="large"/><?php _e( "Large", 'matrix' ); ?>
        </td>
    </tr>
	<?php elseif($post->post_type == 'post'): ?>
    <tr valign="top">
    	<th scope="row">
        <?php _e( "Date Display", 'matrix' ); ?>
        </th>
    	<td>
    	<input type="checkbox" id="tile_date_check" name="_tile_date_check" <?php checked( $tile_date_check, 'on'); ?> />  
        <label for="tile_date_check"><?php _e( "Show date on tile", 'matrix' ); ?></label> 
        </td>
    </tr>
	<?php endif; ?>
    </tbody>
    </table>
	<?php endif; ?>
	
	<script type="text/javascript">
	var ori_post_id;
	
	jQuery(document).ready(function(){
		var matrix_uploader;

		if (wp.media.model.settings.post.id != 0){
			ori_post_id = wp.media.model.settings.post.id;
		}
		jQuery("div#matrix-tile").on('click', 'input.upload_image_button', function(e) {
			e.preventDefault();
			wp.media.model.settings.post.id = 0;
			var formloc = jQuery(this).parent().parent();
			//Extend the wp.media object
			matrix_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Use Image',
				button: {
					text: 'Use Image'
				},
				multiple: false
			});

			//When a file is selected, grab the URL and set it as the text field's value
			matrix_uploader.on('select', function() {
				attachment = matrix_uploader.state().get('selection').first().toJSON();
				jQuery(formloc).next('tr').find('img').attr('src', attachment.url);
				jQuery(formloc).find('input.upload-url').val(attachment.url);
				
			});
	
			//Open the uploader dialog
			matrix_uploader.open('#matrix-tile');
		
		});
		if( jQuery('#matrixcolourpicker').length ) {
			jQuery('#matrixcolourpicker').hide();
			jQuery('#matrixcolourpicker').farbtastic("#color");
			jQuery("#color").click(function(){
				jQuery('#matrixcolourpicker').slideToggle();
			});
		}
	});
	</script>
	
    <?php if($post->post_type == 'matrix_portfolio') : ?>
    <strong><p><?php _e( "Tile Animation", 'matrix' ); ?></p></strong>
    <p><?php _e( "Settings for the animation of this tile. Front and back tile images are 1st and 2nd images in the Product Gallery, respectively. This has higher priority than Featured Image to be displayed on tiles.", 'matrix' ); ?></p>
    <table class="form-table">
    <tbody>
    <tr valign="top">
    	<th scope="row">
        <?php _e( "Tile Animation", 'matrix' ); ?>
        </th>
        <td>
    	<input type="checkbox" id="live_tile_check" name="_live_tile_check" <?php checked( $live_check, 'on' ); ?> />  
        <label for="live_tile_check"><?php _e( "Enable tile animation", 'matrix' ); ?></label>
        </td>
    </tr>
    </tbody>
    </table>
    
    <div id="live_settings">
    <table class="form-table">
    <tbody>
    <tr valign="top">
        <th scope="row">
        <label for="live_tile_mode"><?php _e( "Mode of animation", 'matrix' ); ?></label>
        </th>
        <td>
        <select name="_live_tile_mode" id="live_tile_mode">  
            <option value="slide" <?php selected( $live_tile_mode_sel, 'slide' ); ?>><?php _e( "Slide", 'matrix' ); ?></option>  
            <option value="flip" <?php selected( $live_tile_mode_sel, 'flip' ); ?>><?php _e( "Flip", 'matrix' ); ?></option>  
        </select>
        </td>
    </tr>
	<tr valign="top">
    	<th scope="row">
    	<label for="live_tile_dir"><?php _e( "Direction of animation", 'matrix' ); ?></label>
        </th>
        <td>
        <select name="_live_tile_dir" id="live_tile_dir">  
            <option value="horizontal" <?php selected( $live_tile_dir_sel, 'horizontal' ); ?>><?php _e( "Horizontal", 'matrix' ); ?></option>  
            <option value="vertical" <?php selected( $live_tile_dir_sel, 'vertical' ); ?>><?php _e( "Vertical", 'matrix' ); ?></option>  
        </select>
        </td>
    </tr>
	<tr valign="top">
    	<th scope="row">
    	<label for="live_tile_speed"><?php _e( "Speed of animation (millisecond)", 'matrix' ); ?></label>
        </th>
        <td>
    	<input type="text" name="_live_tile_speed" id="live_tile_speed" value="<?php echo $live_tile_speed ?>"/>
        </td>
    </tr>
	<tr valign="top">
    	<th scope="row">
    	<label for="live_data_delay"><?php _e( "Data delay (millisecond)", 'matrix' ); ?></label>
        </th>
        <td>
    	<input type="text" name="_live_data_delay" id="live_data_delay" value="<?php echo $live_data_delay ?>"/>
        </td>
    </tr>
	<tr valign="top">
    	<th scope="row">
    	<label for="live_data_stops"><?php _e( "Data stops (percentage)", 'matrix' ); ?></label>
        </th>
        <td>
    	<input type="text" name="_live_data_stops" id="live_data_stops" value="<?php echo $live_data_stops ?>"/>
        </td>
    </tr>
	<tr valign="top">
    	<th scope="row">
    	<?php _e( "Tile Image Stacking", 'matrix' ); ?>
        </th>
        <td>
        <input type="checkbox" id="live_data_stack" name="_live_data_stack" <?php checked( $live_data_stack, 'on' ); ?> />
        <label for="live_data_stack"><?php _e( "Make tile move synchronously", 'matrix' ); ?></label> 
        </td>
    </tr>
    </tbody>
    </table>
    </div><!-- #live_settings -->
	<script>
	jQuery(document).ready(function(){
		if ( jQuery('#live_tile_check').is(':checked') ) {
			jQuery('#live_settings').show();
		} else {
			jQuery('#live_settings').hide();
		}
		jQuery('#live_tile_check').click(function(){
			jQuery('#live_settings').slideToggle(this.checked);
		});
	});
	</script>
	
    <p><strong><?php _e( "Tile Display", 'matrix' ); ?></strong></p>
    <p><?php _e( "Only upload front image if tile is not animated.", 'matrix' ); ?></p>
    
    <table class="form-table">
    <tbody>
    <tr valign="top">
    	<th scope="row">
        <?php _e( "Front Image", 'matrix' ); ?>
        </th>
        <td>
    	<input class="upload_image_button button" type="button" value="<?php _e( "Upload", 'matrix' ); ?>" />
    	<input type="text" name="_tile_img_front" id="tile_img_front" class="upload-url regular-text" value="<?php echo $tile_img_front ?>"/>
        </td>
    </tr>
    <tr valign="top">
    	<th scope="row">
        </th>
        <td class="upload-preview">
        <img id="tile_img_front" src="<?php echo $tile_img_front ?>" alt="Preview" />
        </td>
    </tr>
	<tr valign="top">
    	<th scope="row">
        <?php _e( "Back Image", 'matrix' ); ?>
        </th>
        <td>
    	<input class="upload_image_button button" type="button" value="<?php _e( "Upload", 'matrix' ); ?>" />
    	<input type="text" name="_tile_img_back" id="tile_img_back" class="upload-url regular-text" value="<?php echo $tile_img_back ?>"/>
        </td>
    </tr>
    <tr valign="top">
    	<th scope="row">
        </th>
        <td class="upload-preview">
        <img id="tile_img_back" src="<?php echo $tile_img_back ?>" alt="Preview" />
        </td>
    </tr>
    </tbody>
    </table>
	
	<?php else: ?>
	<p><strong><?php _e( "Thumbnail Image for Archive", 'matrix' ); ?></strong></p>
    <p><?php _e( "This image is used at the archives as the thumbnail. Please upload the correct thumbnail size for the tile type set in the theme settings page. Note that you may need to reupload all thumbnails when you change the tile type for archive in order to have them displayed correctly.", 'matrix' ); ?></p>
    <p><?php _e('Current tile type : ', 'matrix'); echo $options_array['matrix_archive_tile_type']; ?>
	<table class="form-table">
    <tbody>
    <?php if ( $options_array['matrix_archive_tile_type'] == 'list' ) { ?>
    <tr valign="top">
    	<th scope="row">
        <?php _e( "List Image", 'matrix' ); ?>
        </th>
        <td>
    	<input class="upload_image_button button" type="button" value="<?php _e( "Upload", 'matrix' ); ?>" />
    	<input type="text" name="_list_img_front" id="list_img_front" class="upload-url regular-text" value="<?php echo $list_img_front ?>"/>
        </td>
    </tr>
    <tr valign="top">
    	<th scope="row">
        </th>
        <td class="upload-preview">
        <img id="list_img_front" src="<?php echo $list_img_front ?>" alt="Preview" />
        </td>
    </tr>
    <?php } else { ?>
    <tr valign="top">
    	<th scope="row">
        <?php _e( "Tile Image", 'matrix' ); ?>
        </th>
        <td>
    	<input class="upload_image_button button" type="button" value="<?php _e( "Upload", 'matrix' ); ?>" />
    	<input type="text" name="_archive_tile_img_front" id="archive_tile_img_front" class="upload-url regular-text" value="<?php echo $archive_tile_img_front ?>"/>
        </td>
    </tr>
    <tr valign="top">
    	<th scope="row">
        </th>
        <td class="upload-preview">
        <img id="archive_tile_img_front" src="<?php echo $archive_tile_img_front ?>" alt="Preview" />
        </td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
	<p><?php _e( "Or use options below if you don't have a tile image. These settings won't be applied if there is a tile image assigned above.", 'matrix' ); ?></p>
    <table class="form-table">
    <tbody>
	<tr valign="top">
    	<th scope="row">
    	<?php _e( "Choose a colour", 'matrix' ); ?>
        </th>
        <td>
        <select name="_tile_colour" id="tile_colour">
        	<option value="themecolor" <?php selected( $tile_colour_sel, 'themecolor' ); ?>><?php _e( "Theme Colour", 'matrix' ); ?></option>
            <option value="blue" <?php selected( $tile_colour_sel, 'blue' ); ?>><?php _e( "Blue", 'matrix' ); ?></option>
            <option value="brown" <?php selected( $tile_colour_sel, 'brown' ); ?>><?php _e( "Brown", 'matrix' ); ?></option>
            <option value="green" <?php selected( $tile_colour_sel, 'green' ); ?>><?php _e( "Green", 'matrix' ); ?></option>
            <option value="lime" <?php selected( $tile_colour_sel, 'lime' ); ?>><?php _e( "Lime", 'matrix' ); ?></option>
            <option value="magenta" <?php selected( $tile_colour_sel, 'magenta' ); ?>><?php _e( "Magenta", 'matrix' ); ?></option>
            <option value="mango" <?php selected( $tile_colour_sel, 'mango' ); ?>><?php _e( "Mango", 'matrix' ); ?></option>
            <option value="pink" <?php selected( $tile_colour_sel, 'pink' ); ?>><?php _e( "Pink", 'matrix' ); ?></option>
            <option value="purple" <?php selected( $tile_colour_sel, 'purple' ); ?>><?php _e( "Purple", 'matrix' ); ?></option>
            <option value="red" <?php selected( $tile_colour_sel, 'red' ); ?>><?php _e( "Red", 'matrix' ); ?></option>
            <option value="teal" <?php selected( $tile_colour_sel, 'teal' ); ?>><?php _e( "Teal", 'matrix' ); ?></option>
        </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
        <?php _e( "Colour picker", 'matrix' ); ?>
        </th>
        <td>
        <input type="checkbox" id="colour_picker_check" name="_colour_picker_check" <?php checked( $colour_picker_check, 'on' ); ?> />  
        <label for="colour_picker_check"><?php _e( "Use value from colour picker : ", 'matrix' ); ?></label>
        <input type="text" id="color" name="_tile_colour_pick" value="<?php echo $tile_colour_pick; ?>" />
        <div id="matrixcolourpicker"></div>
        </td>
    </tr>
	<tr valign="top">
    	<th scope="row">
    	<?php _e( "Choose an icon (optional)", 'matrix' ); ?>
        </th>
        <td>
        <input type="checkbox" id="tile_icon_check" name="_tile_icon_check" <?php checked( $tile_icon_check, 'on' ); ?> />
        <label for="tile_icon_check"><?php _e( "Use icon", 'matrix' ); ?></label>
        <select name="_tile_icon" id="tile_icon">
        	<option value="quote-dark" <?php selected( $tile_icon_sel, 'quote-dark' ); ?>><?php _e( "Dark Quote", 'matrix' ); ?></option>
            <option value="quote-white" <?php selected( $tile_icon_sel, 'quote-white' ); ?>><?php _e( "White Quote", 'matrix' ); ?></option>
            <option value="video" <?php selected( $tile_icon_sel, 'video' ); ?>><?php _e( "Video", 'matrix' ); ?></option>
            <option value="hyperlink" <?php selected( $tile_icon_sel, 'hyperlink' ); ?>><?php _e( "Hyperlink", 'matrix' ); ?></option>
            <option value="password" <?php selected( $tile_icon_sel, 'password' ); ?>><?php _e( "Password", 'matrix' ); ?></option>
        </select>
        </td>
    </tr>
    </tbody>
    </table>
	<?php endif;
}?>
<?php
/* Load Scripts */
function matrix_child_load_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'movevideo', get_stylesheet_directory_uri() . '/js/movevideo.js', array("jquery"), '1.0.0', true );
}
add_action('wp_enqueue_scripts', 'matrix_child_load_scripts');

function child_remove_parent_function() {
	/* Remove parent meta_boxes */
    remove_action( 'load-post.php', 'matrix_meta_box' );
	remove_action( 'load-post-new.php', 'matrix_meta_box' );
	/* Add child meta boxes */
	add_action( 'add_meta_boxes', 'matrix_child_tile');
	/* Load parent */
	//add_action( 'add_meta_boxes', 'matrix_tile' );
	//add_action( 'add_meta_boxes', 'matrix_post_slider' );
	//add_action( 'add_meta_boxes', 'matrix_portfolio_func' );
	add_action( 'add_meta_boxes', 'matrix_upload_image_func' );
	add_action( 'add_meta_boxes', 'matrix_post_settings_func' );
	add_action( 'save_post', 'matrix_save_tile_settings', 10, 2 );
	//add_action( 'save_post', 'matrix_save_post_slider_settings', 10, 2 );
	//add_action( 'save_post', 'matrix_save_portfolio_settings', 10, 2 );
	add_action( 'save_post', 'matrix_save_media_settings', 10, 2 );
	add_action( 'save_post', 'matrix_save_post_settings', 10, 2 );
	if ( post_type_exists( 'product' ) ) {
		add_action( 'add_meta_boxes', 'matrix_product_tile' );
		add_action( 'save_post', 'matrix_save_product_tile_settings', 10, 2 );
	}

}
add_action( 'load-post.php', 'child_remove_parent_function', 5);
add_action('load-post-new.php', 'child_remove_parent_function', 5);
//add_action( 'init', 'child_remove_parent_function' );
//add_action( 'wp_loaded', 'child_remove_parent_function' );
//add_action( 'after_setup_theme', 'child_remove_parent_function' );