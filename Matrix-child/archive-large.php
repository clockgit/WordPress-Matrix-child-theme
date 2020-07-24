<?php
$category = get_the_category();
$post_title = get_the_title();
$post_id = get_the_ID();
$post_url = get_permalink();
$post_format = get_post_format();
	if (!$post_format) { $post_format = 'article'; }
$post_type = get_post_type();
$url = get_template_directory_uri();
$post_hyperlink = get_post_meta( $post_id, '_post_hyperlink', true );

$lightbox_check = get_post_meta( $post_id, '_lightbox_check', true );
$tile_date_check = get_post_meta( $post_id, '_tile_date_check', true );
$archive_tile_img_front = get_post_meta( $post_id, '_archive_tile_img_front', true );
$tile_img_front = get_post_meta( $post_id, '_tile_img_front', true );
$tile_colour = get_post_meta( $post_id, '_tile_colour', true );
$tile_colour_pick = get_post_meta( $post_id, '_tile_colour_pick', true );
	$colour_picker_check = get_post_meta( $post_id, '_colour_picker_check', true );
	if ( !$tile_img_front && $colour_picker_check != 'on' ){
		if (!$tile_colour && $colour_picker_check != 'on' ) { $tile_colour = 'themecolor'; }
		$show_tile_colour = $tile_colour;
	} else {
		$show_tile_colour = '';
	}
$tile_icon_sel = get_post_meta( $post_id, '_tile_icon', true );
$tile_icon_check = get_post_meta( $post_id, '_tile_icon_check', true );
$tile_date_check = get_post_meta( $post_id, '_tile_date_check', true );

$post_colour = get_post_meta( $post_id, '_post_colour', true );
$post_colour_pick = get_post_meta( $post_id, '_post_colour_pick', true );
$post_colour_picker_check = get_post_meta( $post_id, '_post_colour_picker_check', true );
if ( $post_colour_picker_check != 'on' ){
	if (!$post_colour && $post_colour_picker_check != 'on' ) { $post_colour = 'themecolor'; }
	$show_post_colour = $post_colour;
	} else {
		$show_post_colour = '';
}

?>

<div class="tile large <?php echo $show_tile_colour; ?>" <?php if ($colour_picker_check == 'on' && $tile_colour_pick != '' ) { echo 'style="background-color:'.$tile_colour_pick.';"'; } ?>>
<?php 
if ( $post_format != 'link' ) { echo '<a href="'. get_permalink() .'">'; }
if ( $post_format == 'link' ) { echo '<a href="'.$post_hyperlink.'">'; } ?>
    <div class="pl-projecttitle"><span class="pl-title"><?php echo $post_title; ?></span></div>
    <?php if ( $archive_tile_img_front != '' ) { ?>
    <img class="tile-pre-img" src="<?php echo $archive_tile_img_front ?>" alt="<?php echo $post_title; ?>" />
    <?php } elseif ( $tile_img_front != '' ) { ?>
    <img class="tile-pre-img" src="<?php echo $tile_img_front ?>" alt="<?php echo $post_title; ?>" />
	<?php } elseif ($tile_icon_check == 'on') { ?>
    <img class="icon-img" src="<?php echo ''.$url.'/images/'.$tile_icon_sel.'.png'; ?>" alt="<?php echo $post_title; ?>" />
    <?php } ?>
<?php if ( $tile_date_check == 'on' ) { ?>
        <span class="tile-date <?php echo $show_post_colour; ?>txt" <?php if ($post_colour_picker_check == 'on' && $post_colour_pick != '' ) { echo 'style="color:'.$post_colour_pick.';"'; } ?>><span class="date"><?php echo get_the_date( 'j' ); ?></span><span class="month"><?php echo get_the_date( 'M' ); ?></span></span>
    <?php } ?>
    <!--<span class="tile-cat <?php echo $show_post_colour; ?>" <?php if ($post_colour_picker_check == 'on' && $post_colour_pick != '' ) { echo 'style="background-color:'.$post_colour_pick.';"'; } ?>><?php if (!$category) { echo 'Uncategorized'; } else { echo $category[0]->cat_name; }?></span>-->
	</a>
</div>
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