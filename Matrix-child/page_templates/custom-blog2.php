<?php 
/*
 * Template Name: Custom Blog Page 2 by Chris Lock
 * Description: Page template without sidebar
 */

$homepage_tile_limit = 9;
$matrix_home_category = "All categories";
$tile_type = 'large';//$smof_data['matrix_archive_tile_type'];
get_header(); 
global $smof_data;
$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
?>
<!-- BEGIN CONTENT -->
<section id="content" class="clearfix">
<!-- Title --><div id="content-title"><?php the_title(); ?></div>
<?php if($paged==1): ?>
<!-- BEGIN PAGE -->
<section id="page">
<!-- BEGIN PAGE CONTENT -->
<div id="pg-content" class="clearfix">
<?php the_post(); ?>
<?php the_content(); ?>
</div><!-- end #pg-content -->
<!-- END PAGE CONTENT -->
</section>
<!-- END PAGE -->
<?php endif; ?>

<!-- BEGIN TILE CONTENT -->
<div id="loader"></div>
<section id="mainpage-mos">
<section id="content-mos" class="centered clearfix">
<?php



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

				<article id="post-0" class="post tile large exclude no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'matrix' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'matrix' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; 

 wp_reset_postdata(); ?>

<!-- END TILE CONTENT -->
</section><!-- end #content-mos -->
<nav><?php matrix_pagination(); ?></nav>
</section><!-- end #mainpage-mos -->
</section><!-- END CONTENT -->
<?php get_footer(); ?>