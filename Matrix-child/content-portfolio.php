<?php
$category = get_the_category();
$post_title = get_the_title();
$author = get_the_author();
$post_id = get_the_ID();
$post_format = get_post_format();

$portfolio_full_img = get_post_meta( $post_id, '_portfolio_full_img', true );
$portfolio_date = get_post_meta( $post_id, '_portfolio_date', true );
if (!$portfolio_date) { $portfolio_date = 'Undated'; }
$portfolio_client = get_post_meta( $post_id, '_portfolio_client', true );
if (!$portfolio_client) { $portfolio_client = 'Confidential'; }
$portfolio_client_link = get_post_meta( $post_id, '_portfolio_client_link', true );

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

<article id="post-<?php the_ID(); ?>" class="spf-article clearfix">
    
        
    	<?php if ( $post_format == 'video' || $post_format == 'audio' ) { ?>
		<div class="lb-<?php echo $post_format; ?>">
        <?php if ( has_post_thumbnail() && $post_format == 'audio' ) {
			$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
			echo '<img class="tile-pre-img" src="'. $imgsrc[0] .'" alt="'.$post_title.'" />';
		} ?>
		<?php matrix_audio_video($post_id, $embed_field, $embed_field_alt, $video_poster, $embed_width, $embed_height) ?>
        </div>
	<?php } elseif ( $portfolio_full_img != '' ) {
			$imgsrc = $portfolio_full_img;
			echo '<div class="sgportfolio-img">';
			echo '<a href="'. $imgsrc .'">';
			echo '<div class="enlarge"><div class="enlargeicon"></div></div>';
			echo '<img class="portfolio-fullimg" src="'. $imgsrc .'" alt="'.$post_title.'" />';
			echo '</a>';
			echo '</div>';
			
		} elseif ( has_post_thumbnail() ) {
			$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
			echo '<div class="sgportfolio-img">';
			echo '<img class="portfolio-notfullimg" src="'. $imgsrc[0] .'" alt="'.$post_title.'" />';
			echo '</div>';
			
		} else {
			echo '<div class="article-img">';
			matrix_img_slider($post_id, 'full');
            echo '</div>';
		}?>
        
    
    <h1 class="spf-title"><?php the_title(); ?></h1>
    
    <!-- BEGIN POST CONTENT -->
    <div class="spf-content clearfix">
    <?php the_content(); ?>
    
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
    </div><!-- end .sbp-content -->
    <!-- END POST CONTENT -->
    
</article>