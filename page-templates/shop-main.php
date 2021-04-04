<?php
/**
 * The main template file
 * 
 * Template Name: Shop Main	
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

<!-- Post id of Shop main page -->
<main id="shop-main">

	<div class="delivery-booking" style="display:none;">
		<div class="delivery-content">
			<h1 class="delivery-header">Delivery booking!</h1>
			<p class="delivery-message">Book your order now and have your order delivered whenever you want! Simply specify a delivery date and time in the check-out comment box!</p>
			<span class="delivery-button">CONTINUE SHOPPING</span>
		</div>
	</div>

	<?php 
		/*if (has_post_thumbnail( 1610 ) ):
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(1610), 'single-post-thumbnail'); 
			include('banner.php');
		endif; */
	?>
	<div class="page-container">
		<?php 
			$title = 'The art of living beautiful';
			$post_title = strtolower( str_replace( " ","-",( get_the_title() ) ) );
			echo "<div class='fnk-art-class $post_title' >";
			include(dirname(__FILE__)."/../page-templates/title-divider.php");
			echo "</div>";
		?>
		<div class="shop-categories-container">
			
		<?php
		if( have_rows('Select_category') ):
			while ( have_rows('Select_category') ) : the_row();
				$pro_category = get_sub_field('product_category');
				$cat_image = get_sub_field('background_image');
				$term = get_term_by( 'id', $pro_category, 'product_cat' );
				?>
				<div id="<?= $term->slug; ?>" class="gen-shop-block custom-pro-category-class">
					<a href="<?php echo get_home_url() . '/product-category/'.$term->slug.''; ?>">
						<div class="inner-gen-block" style="background-image: url(<?= $cat_image; ?>)" >              
							<h1><?= $term->name; ?></h1>
						</div>
					</a>
				</div>  
			<?php
			endwhile;
		endif;
		?>
		</div>
		<div class="brands">
			<?php 
			$title = 'Shop by brand';
			include('title-divider.php'); ?>

			<div class="brand-block">                
                <div class="shop-brands-slider">
				   <!-- HTML for brand images + links -->	 
						<?php $query = new WP_Query( array( 'post_type' => 'brands','posts_per_page'=> -1, 'orderby' => 'name', 'order' => 'ASC') );
						if ( $query->have_posts() ) : ?>
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	

								<div class="brand" data-brand-name="<?php echo the_title(); ?>">
									<a href="<?php echo get_home_url() . '/product-category/brands/' . $post->post_name; ?>">
									<?php $image = get_field('brand_logo'); ?>
										<img src="<?php echo $image; ?>" />
										
									</a>
								</div>
							<?php endwhile; wp_reset_postdata(); ?>
						<?php endif; ?>
                </div>              
            </div>
		</div>
	</div>
</main>
<script>
	$(function () {
		if ($(document).scrollTop() == 0) {
			$("html, body").animate({
				scrollTop: $('.page-container').offset().top - $('.site-header').height() + 50
			}, 1000);
		}
		else {
			$("html, body").animate({
				scrollTop: $('.page-container').offset().top - $('.site-header').height()
			}, 1000);
		}
	})
</script>
<?php
get_footer();
