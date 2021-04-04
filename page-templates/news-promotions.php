<?php
/**
 * The main template file
 * 
 * Template Name: News & Promotions Template	
 * 
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package franks
 */
get_header();
?>
<div id="primary" class="content-area news-promotions">
	<main id="main" class="site-main" role="main">
	
		 <?php 
		   $args = array(
				'post_type' => 'post',
				'posts_per_page' => 12,
                'orderby' => 'date',
			);

			$post_query = new WP_Query($args);
		 if ( $post_query->have_posts() ) { ?>
            <?php
                $cnt = 1;
			?>
			<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
			<?php
                if ( $cnt == 1 ) {
            ?>
				<div class="feat-banner-cont news-feat-banner">
					<div class="feat-post-cont">
					<div class="inner-post">
							<div class="image-holder">
								<?php
									$large_image = get_field('news_large_image');
								?>
								<img src="<?php echo $large_image; ?>" alt="Post banner">
							</div>
							<div class="content-holder">
								<h1><?php the_title(); ?></h1>
								<div class="feat-text">
									<span><?php the_time('M d'); ?></span>
								</div>
								
								<?php $trimmed = wp_trim_words( get_the_content(), $num_words = 55, $more = null ); ?>
								<p><?php echo $trimmed; ?></p>
								<a href="<?php the_permalink(); ?>">
									<span>Read More</span>
								</a>
							</div>                   
					</div>
					</div>
				</div>
				<div class="entry-content">
					<div class="page-container">
						<?php 
						$title = 'The art of living beautiful';
						include('title-divider.php'); ?>
					<?php
						} else if(!has_category($category = 'Wine Boutique', $post->ID)){
					?>
						<div class="news-post">
							<div class="inner-post">
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<header class="entry-header">
										<?php 
										if (has_post_thumbnail( $post->ID ) ) { ?>
											<?php $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
										} ?>
										<div class="post-image" style="background-image: url('<?php echo $feat_image[0]; ?>')"></div>
										<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
										<span><?php the_time('M d'); ?></span>
									</header><!-- .entry-header -->
									<div class="entry-content">
										<?php 
											$content = wp_strip_all_tags(get_the_content());
											$trimmed = $the_str = substr($content, 0, 130);
										?>
										<?php
											echo $trimmed . '...';
										?>
								
										
									</div><!-- .entry-content -->
								</article><!-- #post-## -->        
							</div>
						</div>
					<?php
						}
							$cnt++;
						?>

					<?php endwhile; ?>						
					</div>
			</div>
					<?php } else  { ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php } ?> 
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
