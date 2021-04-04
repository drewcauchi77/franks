<?php

/**

 * Single Product Image

 *

 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.

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

 * @version     2.6.3

 */



if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



global $post, $woocommerce, $product;



?>

<?php
            
	// $online_exclusive = get_field('product_tag', $product->get_id());

	// if($online_exclusive == "Online Exclusive"){
	// 	echo '<span class="online-exclusive-tag">'. $online_exclusive . '</span>';
	// }

	$online_exclusive = get_field('product_tag', $product->get_id());

    if(!has_term('Dior','product_cat', $product->get_id())){    
		if($online_exclusive){
			echo '<span class="online-exclusive-tag" style="height:fit-content;width:fit-content;padding:0px 10px;">'. $online_exclusive . '</span>';
		}
	}

?>

<div class="images">

	<?php

		if ( has_post_thumbnail() ) {



			$attachment_count = count( $product->get_gallery_attachment_ids() );

			$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';

			$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );

			$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(

				'title'	 => $props['title'],

				'alt'    => $props['alt'],

			) );

			echo apply_filters(

				'woocommerce_single_product_image_html',

				sprintf(

					'<a href="%s" itemprop="image" data-fancybox="gallery" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s">%s</a>',

					esc_url( $props['url'] ),

					esc_attr( $props['caption'] ),

					$gallery,

					$image

				),

				$post->ID

			);

		} else {

//			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

        ?>

                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/product-fallback.jpg" alt="">

        <?php



		}

	?>



	<?php //do_action( 'woocommerce_product_thumbnails' ); ?>



</div>

