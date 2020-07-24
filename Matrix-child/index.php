<?php 
get_header(); 
global $smof_data;
?>

<!-- BEGIN MAIN PAGE CONTENT -->
<section class="mainpage">
<?php if ( $smof_data['matrix_home_slider_toggle'] == 1 && ($smof_data['matrix_home_slider'][1]['url'] != '' || $smof_data['matrix_home_highlighted_text'] != '') ) { ?>
	<!-- BEGIN TOGGLE CONTENT -->
	<div class="toggle-button"><span class="toggle-indicator">+</span></div>
    <div class="toggle-content close">
<?php }

	$slides = $smof_data['matrix_home_slider']; //get the slides array
	if ( $slides != '') { ?>
        <div class="flexslider mainslide">
        <ul class="slides">
        <?php

		foreach ($slides as $slide) {

			if ( $slide['url'] != '' ){

			echo '<li>';
			echo '<img src="'.$slide['url'].'" alt="'.$slide['title'].'" />';
			if ( $slide['link'] != '' ) {
			echo '<a href="'.$slide['link'].'">';
			}
			echo '<p class="flex-title">'.$slide['title'].'</p>';
			if ( $slide['link'] != '' ) {
			echo '</a>';
			}
			if ( $slide['description'] != '' ) {
			echo '<p class="flex-description">'.$slide['description'].'</p>';
			}
			echo '</li>';

			}

		}
		?>
        </ul>
        </div><!-- end .flexslider -->
    <?php } ?>
    
    <?php if ( $smof_data['matrix_home_highlighted_text'] != '' ) { ?>
    <div class="quote-bg1"><div class="quote-w"><?php echo do_shortcode(stripslashes($smof_data['matrix_home_highlighted_text'])); ?></div></div>
    <?php } ?>
    
<?php if ( $smof_data['matrix_home_slider_toggle'] == 1 && ($smof_data['matrix_home_slider'][1]['url'] != '' || $smof_data['matrix_home_highlighted_text'] != '') ) { ?>
    </div><!-- end .toggle-content -->
    <!-- END TOGGLE CONTENT -->
<?php } ?>
</section><!-- end #mainpage -->

<!-- BEGIN portfolio TILE CONTENT -->
<div id="loader"></div>
<section id="mainpage-mos">
<section id="content-mos" class="centered clearfix">
<?php

if ( $smof_data['matrix_tile_number_limit'] != '' ){
	$homepage_tile_limit = $smof_data['matrix_tile_number_limit'];
} else {
	$homepage_tile_limit = 13;
}

$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

$args = array(
	'post_type' => array('matrix_portfolio'),
	'posts_per_page' => $homepage_tile_limit,
	'paged' => $paged,
);
$wp_query= null;
$wp_query = new WP_Query( $args );

			if ( $wp_query->have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                
                	<?php get_template_part( 'content-tile' ); ?>
                    
				<?php endwhile; ?>

			<?php else : ?>

				<article id="post-0" class="post tile large exclude no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'matrix' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'matrix' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

<?php wp_reset_postdata(); ?><!-- END portfolio TILE CONTENT -->
<!-- Begin blog tile content -->
<?php
$homepage_tile_limit = 4;
$tile_type = $smof_data['matrix_archive_tile_type'];
$args = array(
		'posts_per_page' => $homepage_tile_limit,
		//'paged' => $paged
);
$wp_query = NULL;
$wp_query = new WP_Query( $args );
  
			if ( $wp_query->have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			<?php get_template_part('archive',$tile_type); ?>
			<?php endwhile; ?>
			<?php else : ?>
			<div class="sbp-content">
				<p>
					<?php _e('Sorry, no results were found for the requested category.', 'matrix') ?>
				</p>
			</div>
			<?php endif; ?>
			
		<?php wp_reset_postdata(); ?><!-- END blog TILE CONTENT -->
		
		<?php
		global $post;
		$post = get_post( 436 );
		setup_postdata( $post );
		
		get_template_part('archive',$tile_type);
		wp_reset_postdata();
		?>
</section><!-- end #content-mos -->
<?php if ( $smof_data['matrix_ajax_pagination_front'] == 1 ) { ?>
<?php matrix_ajax_pagination(); ?>
<?php } ?>
</section><!-- end #mainpage-mos -->
<section class="mainpage">

<?php 

if ( !empty( $smof_data['matrix_home_featured_content']['1']['title'] ) ) {
	$home_featured_content = $smof_data['matrix_home_featured_content']['1']['title'];
} else {
	$home_featured_content = '';
}

if ( $smof_data['matrix_home_featured_content_toggle'] == 1 && ($home_featured_content != '' || is_active_sidebar( 'matrix_home' )) ) { ?>
<!-- BEGIN TOGGLE CONTENT -->
<div class="toggle-button"><span class="toggle-indicator">+</span></div>
<div class="toggle-content close clearfix">
<?php } ?>
<?php
		$fcontents = $smof_data['matrix_home_featured_content']; //get the slides array

	if ( $fcontents != ''){

		foreach ($fcontents as $fcontent) {
		
			if ( $fcontent['title'] != '' ) {
				echo '<div class="fixed-medium">';

					if ( $fcontent['link'] != '' ) {
						echo '<a href="'.$fcontent['link'].'">';
					}
					if ( $fcontent['url'] != '' ){
						echo '<div class="highlights">';
						echo '<img class="themecolor" src="'.$fcontent['url'].'" alt="'.$fcontent['title'].'" />';
						echo '</div>';
					}
					echo '<div class="highlights-txt">';
						echo '<h2>'.$fcontent['title'].'</h2>';
						if ( $fcontent['description'] != '' ) {
							echo '<p>'.$fcontent['description'].'</p>';
						}
					echo '</div>';
					if ( $fcontent['link'] != '' ) {
						echo '</a>';
					}
				
				echo '</div>';
			}
			
		}

	}

	// homepage widget area
	if ( is_active_sidebar( 'matrix_home' ) ) : 
		dynamic_sidebar( 'matrix_home' );
	endif;
?>
<?php if ( $smof_data['matrix_home_featured_content_toggle'] == 1 && ($home_featured_content != '' || is_active_sidebar( 'matrix_home' )) ) { ?>
</div><!-- end .toggle-content -->
<!-- END TOGGLE CONTENT -->
<?php } ?>

</section><!-- end .main-page -->
<!-- END MAIN PAGE CONTENT -->
<?php get_footer(); ?>