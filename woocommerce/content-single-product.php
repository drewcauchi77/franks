<?php

/**

 * The template for displaying product content in the single-product.php template

 *

 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.

 *

 * HOWEVER, on occasion WooCommerce will need to update template files and you

 * (the theme developer) will need to copy the new files to your theme to

 * maintain compatibility. We try to do this as little as possible, but it does

 * happen. When this occurs the version of the template file will be bumped and

 * the readme will list any important changes.

 *

 * @see 	    https://docs.woocommerce.com/document/template-structure/

 * @author 		WooThemes

 * @package 	WooCommerce/Templates

 * @version     1.6.4

 */



if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

}



?>



<?php
	if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	}

?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php do_action( 'woocommerce_before_single_product'); ?>
	
	<?php
        do_action('woo_custom_breadcrumb'); 
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="<?php if(has_term('dior', 'product_cat')){echo "dior-gallery";}else{echo "gallery-images";}?>">
		<?php
		
		global $product;
		global $images;
		$images = array();

		if($product->get_gallery_attachment_ids()){

			$attachment_ids = $product->get_gallery_attachment_ids();

			foreach($attachment_ids as $attach){

				$name = wp_get_attachment_url($attach);

				if(stripos($name, 'swatch') == false){
					$images[] = $name;
				}
			}

			$size = count($images);

			if($size > 0){
			
				$main_image = get_post_thumbnail_id($product->id);
				$main_image_url = wp_get_attachment_image_src($main_image, 'full');

				?>

				<div class="<?php if(has_term('dior', 'product_cat')){echo "dior-single-image show";}else{echo "single-gallery-image";}?>">
					<img class="change-img" src=<?php echo $main_image_url[0]; ?> onclick="select_img(this.src)">
					<a class="mobile-link" data-fancybox="gallery" href=<?php echo $main_image_url[0]; ?>></a>
				</div>

				<?php foreach( $images as $key => $attachment ) {?>
					
					<div class="<?php if(has_term('dior', 'product_cat')){echo "dior-single-image";}else{echo "single-gallery-image";}?>">
						<img class="change-img" src="<?php echo $attachment; ?>" onclick="select_img(this.src)">
						<a class="mobile-link" data-fancybox="gallery" href=<?php echo $attachment; ?>></a>
					</div>

				<?php

				}
			}

		}

		?>

		<?php 
		$video_links = get_field("video_link", $product->get_id());
		$videolink_len = strlen($video_links);

		// has_term('dior', 'product_cat') && 
		if($video_links !== null && $videolink_len > 0) {
			
			$links = explode(',', $video_links);

			foreach($links as $vl){

				$temp_video_slug = explode("?v=", $vl);
				$video_id = explode("&", $temp_video_slug[1]);

			?>
		 		<div class="<?php if(has_term('dior', 'product_cat')){echo "dior-product-video";}else{echo "product-video";}?>">
					<div class="test" style="display:none;">
						<?php var_dump($videolink_len);?>
					</div>
					<a href=<?php echo $vl; ?> target="_blank">

		 				<img class="video-thumbnail" src="https://img.youtube.com/vi/<?php echo $video_id[0]; ?>/hqdefault.jpg">

						<img class="video-icon" src="../../wp-content/themes/franks/images/film-strip.png">

		 			</a>

		 		</div>

		 <?php }

		}

		$enrichmentfield = get_field("enrichments_variables", $product->get_id());

		if($enrichmentfield != ""){ 
			
			$enrichment_links = explode(";", $enrichmentfield);
			$mastercounter = 0;
			$product_name = $product->get_title();

			foreach($enrichment_links as $el){
				$variation_name = explode('[', $el);
				$full_variation_name = $product_name . ' - ' . $variation_name[0];

				$new_query = $wpdb->get_results($wpdb->prepare(
					"SELECT ID FROM wp_posts WHERE post_title = %s;",
					$full_variation_name
				));
				$variation_id = $new_query[0]->ID;

				//$variation_id = substr($el,0,6);
				preg_match('#\[(.*?)\]#', $el, $match);
				$img_link = explode(",", $match[1]);

				for($counter = 0; $counter < count($img_link); $counter++){
					?>
					<div class="dior-single-image add-image-enrichment image-data-<?php echo $variation_id;?> <?php if($mastercounter == 0){ echo "enable"; }?>">

						<img class="change-img" src=<?php echo $img_link[$counter];?> onclick="select_img(this.src)">
						<a class="mobile-link" data-fancybox="gallery" href=<?php echo $img_link[$counter]; ?>></a>
					 
					</div>
					<?php
				}
				$mastercounter++;

			}

		}

?>
	</div>

	<div class="summary entry-summary">
		
		<?php

		if(has_term('dior', 'product_cat')){

			$product_tag = get_field("product_tag", $product->get_id());
			
			if($product_tag != null){
				echo '<h4 class="dior-new-tag">'. $product_tag . '</h4>';
			}
		}
		?>

		<?php
			do_action( 'woocommerce_single_product_summary_custom' );
		?>

	</div><!-- .summary -->
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

