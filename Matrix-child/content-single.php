<?php
$category = get_the_category();
$post_title = get_the_title();
$author = get_the_author();
$post_id = get_the_ID();
$post_format = get_post_format();

$embed_field = get_post_meta( $post_id, '_embed_field', true );
$embed_field_alt = get_post_meta( $post_id, '_embed_field_alt', true );
$video_poster = get_post_meta( $post_id, '_video_poster', true );
$embed_width = get_post_meta( $post_id, '_embed_width', true );
$embed_height = get_post_meta( $post_id, '_embed_height', true );

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

<article id="post-<?php the_ID(); ?>" class="sbp-article clearfix">
    
    <?php if ( $post_format == 'video' || $post_format == 'audio' ) { ?>
		<div class="lb-<?php echo $post_format; ?>"<?php if ( $post_format == 'video' ){ echo ' style="padding:0; height:auto;"';}?>>
        <?php if ( has_post_thumbnail() && $post_format == 'audio' ) {
			$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
			echo '<img class="tile-pre-img" src="'. $imgsrc[0] .'" alt="'.$post_title.'" />';
		} ?>
        <?php matrix_audio_video($post_id, $embed_field, $embed_field_alt, $video_poster, $embed_width, $embed_height) ?>
        </div>
	<?php } else { ?>
        <div class="article-img">
        <?php if ( has_post_thumbnail() ) {
			$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
			echo '<img class="tile-pre-img" src="'. $imgsrc[0] .'" alt="'.$post_title.'" />';
		} else {
			matrix_img_slider($post_id, 'full'); 
		}?>
        </div>
    <?php } ?>
    
    <div class="article-date <?php echo $show_post_colour; ?>txt" <?php if ($post_colour_picker_check == 'on' && $post_colour_pick != '' ) { echo 'style="color:'.$post_colour_pick.';"'; } ?>><span class="date"><?php echo get_the_date( 'j' ); ?></span><span class="month"><?php echo get_the_date( 'M' ); ?></span></div>
    <h1 class="sbp-title"><?php the_title(); ?></h1>
    
    <!-- BEGIN POST CONTENT -->
    <div class="sbp-content clearfix">
    <?php the_content(); ?>
    </div><!-- end .sbp-content -->
    <?php 
	$args = array(
	'before'           => '<div class="post-pagination clearfix">',
	'after'            => '</div>',
	'link_before'      => '<span class="page-numbers">',
	'link_after'       => '</span>',
	'next_or_number'   => 'number',
	'nextpagelink'     => '&raquo',
	'previouspagelink' => '&laquo',
	'pagelink'         => '%',
	'echo'             => 1	);
	wp_link_pages($args);
	?>
    <div id="post-tags"><?php the_tags(); ?></div>
    <!-- END POST CONTENT -->
    <div id="authorinfo"><?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
    <span class="author"><?php _e('Written by ', 'matrix'); ?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo $author; ?></a></span>
    <p><?php the_author_meta( 'description' ); ?></p>
    </div>
    
</article>