<?php 
/*
 * Template Name: Custom Blog Page by Chris Lock
 * Description: Page template without sidebar
 */
?>

<!-- BEGIN TILE CONTENT -->
<?php get_header(); ?>
<?php
$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
global $smof_data;

$tile_type = $smof_data['matrix_archive_tile_type'];
?>

<!-- BEGIN CONTENT -->


<section id="content" class="clearfix"> 
	<!-- Title -->
	<div id="content-title">
		<?php the_title(); ?>
	</div>
	
	<!-- BEGIN LEFT CONTENT -->
	<section id="bloglist-left" class="clearfix">
	<?php if($paged==1): ?>
	<!-- BEGIN PAGE -->
	<section id="page"> 
		<!-- BEGIN PAGE CONTENT -->
		<div id="pg-content" class="clearfix">
			<?php the_post(); ?>
			<?php the_content(); ?>
		</div>
		<!-- end #pg-content --> 
		<!-- END PAGE CONTENT --> 
	</section>
	<!-- END PAGE -->
	<?php endif; ?>
		<?php if ( $tile_type != 'list' ) { ?>
		<div id="content-mos">
			<?php } ?>
			<?php

if ( $smof_data['matrix_tile_number_limit'] != '' ){
	$homepage_tile_limit = $smof_data['matrix_tile_number_limit'];
} else {
	$homepage_tile_limit = 13;
}

$args = array(
		'posts_per_page' => $homepage_tile_limit,
		'paged' => $paged
);
$wp_query = NULL;
$wp_query = new WP_Query( $args );
  
			if ( $wp_query->have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			<?php 
					 //get_template_part( 'content-tile' ); 
					 get_template_part('archive',$tile_type);
					 ?>
			<?php endwhile; ?>
			<?php else : ?>
			<div class="sbp-content">
				<p>
					<?php _e('Sorry, no results were found for the requested category.', 'matrix') ?>
				</p>
			</div>
			<?php endif; ?>
			<?php if ( $tile_type != 'list' ) { ?>
		</div>
		<?php } ?>
		
		<!-- BEGIN PAGINATION -->
		<?php matrix_pagination(); ?>
		<!-- END PAGINATION --> 
		
	</section>
	<!-- END LEFT CONTENT -->
	
	<?php get_sidebar(); ?>
</section>
<!-- END CONTENT -->

<?php get_footer(); ?>
