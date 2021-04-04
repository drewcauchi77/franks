<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package franks
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<!-- Query Woocommerce Products -->
			<?php
				$args = array_merge( $wp_query->query, array( 'post_type' => 'product' ) );
				$the_query = new WP_Query( $args );
			?>
            <?php 
                if (has_post_thumbnail( 1610 ) ):
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(1610), 'single-post-thumbnail'); 
                    include('page-templates/banner.php');
                endif; ?>
			<?php if ( $the_query->have_posts() ) : ?>
				<div class="woocommerce woocommerce-page">
	            <?php
	                add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );
	                woocommerce_get_template('archive-product-search.php');
	            ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else:  ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
			
			<!-- Query additional results -->
			<?php
				$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
				$args = array_merge( $wp_query->query, array( 
					'post_type' => array('post', 'events', 'video', 'tips', 'top'),
					'posts_per_page' => 12
				));
				$the_query = new WP_Query( $args );
			?>
			
			<?php if ( $the_query->have_posts() ) : ?>
			<h2 style="width: 80%; max-width: 1000px; text-align: center; margin: 32px auto 0;">Other Results matching your query:</h2>
				<div class="container-search other-results">
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="entry-content search-item">
						<?php get_template_part( 'template-parts/content', 'search' ); ?>
		            </div>
				<?php endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else:  ?>
				<!-- <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p> -->
			<?php endif; ?>
			<?php get_footer( 'shop' ); ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>