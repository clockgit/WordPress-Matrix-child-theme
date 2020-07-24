<?php
	$category = get_the_category();
	$post_id = get_the_ID();
	$post_class = get_post_class();
	$post_title = get_the_title();
	$post_format = get_post_format();
	if (!$post_format) { $post_format = 'article'; }
	$post_type = get_post_type();
	$url = get_template_directory_uri();

	$live_check = get_post_meta( $post_id, '_live_tile_check', true );
	$live_tile_speed = get_post_meta( $post_id, '_live_tile_speed', true );
	$live_tile_dir = get_post_meta( $post_id, '_live_tile_dir', true );
	$live_tile_mode = get_post_meta( $post_id, '_live_tile_mode', true );
	$live_data_stack = get_post_meta( $post_id, '_live_data_stack', true );
	$live_data_stops = get_post_meta( $post_id, '_live_data_stops', true );
	$live_data_delay = get_post_meta( $post_id, '_live_data_delay', true );
	$tile_img_front = get_post_meta( $post_id, '_tile_img_front', true );
	$tile_img_back = get_post_meta( $post_id, '_tile_img_back', true );
	$lightbox_check = get_post_meta( $post_id, '_lightbox_check', true );
	$tile_size = get_post_meta( $post_id, '_tile_size', true );
	if ($tile_size == ''){
		$tile_size = 'small';
	}
	$tile_colour = get_post_meta( $post_id, '_tile_colour', true );
	$tile_colour_pick = get_post_meta( $post_id, '_tile_colour_pick', true );
	$colour_picker_check = get_post_meta( $post_id, '_colour_picker_check', true );
	if ( !$tile_img_front && !$tile_img_back && $colour_picker_check != 'on' ){
		if (!$tile_colour && $colour_picker_check != 'on' ) { $tile_colour = 'themecolor'; }
		$show_tile_colour = $tile_colour;
	} else {
		$show_tile_colour = '';
	}
	$tile_icon_sel = get_post_meta( $post_id, '_tile_icon', true );
	$tile_icon_check = get_post_meta( $post_id, '_tile_icon_check', true );
	$tile_date_check = get_post_meta( $post_id, '_tile_date_check', true );
	
	$post_hyperlink = get_post_meta( $post_id, '_post_hyperlink', true );
	
$post_colour = get_post_meta( $post_id, '_post_colour', true );
$post_colour_pick = get_post_meta( $post_id, '_post_colour_pick', true );
$post_colour_picker_check = get_post_meta( $post_id, '_post_colour_picker_check', true );
if ( $post_colour_picker_check != 'on' ){
	if (!$post_colour && $post_colour_picker_check != 'on' ) { $post_colour = 'themecolor'; }
	$show_post_colour = $post_colour;
	} else {
		$show_post_colour = '';
}
	
if ( $post_format != 'link' ) { echo '<a href="'. get_permalink() .'">'; }
if ( $post_format == 'link' ) { echo '<a href="'.$post_hyperlink.'">'; }
?>

    <div class="tile <?php echo $tile_size; if ( $live_check == 'on' ) { echo ' live'; }?> <?php echo $post_class[1]; ?> <?php echo $show_tile_colour; ?>" data-stops="<?php echo $live_data_stops; ?>" data-speed="<?php echo $live_tile_speed; ?>" data-delay="<?php echo $live_data_delay; ?>" data-direction="<?php echo $live_tile_dir; ?>" data-stack="<?php if ($live_data_stack == 'on') {echo 'true'; } else { echo 'false'; } ?>" data-mode="<?php echo $live_tile_mode; ?>" <?php if ($colour_picker_check == 'on' && $tile_colour_pick != '' ) { echo 'style="background-color:'.$tile_colour_pick.';"'; } ?>>
    
    <?php if ( $tile_img_front != '' && $tile_img_back != '' ) { ?>
        <div class="live-front">
        	<img class="live-img" src="<?php echo $tile_img_front; ?>" alt="<?php echo $post_title; ?>"/>
        </div>
        <div class="live-back">
        	<img class="live-img" src="<?php echo $tile_img_back; ?>" alt="<?php echo $post_title; ?>"/>
        </div>
    <?php } elseif ( $tile_img_front != '' ) { ?>
    	<div class="live-front">
        	<img class="live-img" src="<?php echo $tile_img_front; ?>" alt="<?php echo $post_title; ?>"/>
        </div>
    <?php } elseif ( $tile_img_back != '' ) {?>
    	<div class="live-back">
        	<img class="live-img" src="<?php echo $tile_img_back; ?>" alt="<?php echo $post_title; ?>"/>
        </div>
    <?php } elseif ($tile_icon_check == 'on') { ?>
    	<div class="live-front">
        	<img class="icon-img" src="<?php echo ''.$url.'/images/'.$tile_icon_sel.'.png'; ?>" alt="<?php echo $post_title; ?>"/>
        </div>
    <?php } elseif ( has_post_thumbnail() ) { 
    	$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'matrix_tile_'.$tile_size.'' ); ?>
    	<div class="live-front">
        	<img class="live-img" src="<?php echo $imgsrc[0]; ?>" alt="<?php echo $post_title; ?>"/>
        </div>
    <?php } 
	
	if ($tile_size != 'small') {?>
        <span class="tile-cat <?php echo $show_post_colour; ?>" <?php if ($post_colour_picker_check == 'on' && $post_colour_pick != '' ) { echo 'style="background-color:'.$post_colour_pick.';"'; } ?>>
			 <?php echo $post_title; ?>
	    </span>
        
    <?php } ?>
    </div>
    
</a>

	<!-- Lightbox Article Preview -->
<?php
if ( $lightbox_check == 'on' ) {
	
    if ( $post_type == 'matrix_portfolio' && $post_format != 'video' && $post_format != 'audio' ) {
    	get_template_part( 'lightbox-portfolio' );
    } else {
    	get_template_part( 'lightbox', $post_format );
	}
	
}
?>