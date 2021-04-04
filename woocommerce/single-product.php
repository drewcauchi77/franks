<?php



/**



 * The Template for displaying all single products



 *



 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.



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





global $product;

get_header( 'shop' ); ?>

<div id="content" class="site-content">

    <div class="feat-banner-cont <?php if(has_term('Dior','product_cat', $product->get_id())){echo 'dior-prod-feat-banner';}?>">

        <?php

        if(has_term('Dior','product_cat', $product->get_id())){
            $tag = get_term_by('slug', 'dior-categories','product_cat');

            $diorcat_id = get_woocommerce_term_meta($tag->term_id, 'thumbnail_id', true);
            $dior_image = wp_get_attachment_url( $diorcat_id );
         ?>
        <div class="dior-banner-single-prod">

            <a href="https://franks.com.mt/product-category/brands/dior/"><img class="dior-logo" src=<?php echo $dior_image; ?>></a>
        
        </div>
        <?php } ?>

        <!-- <div class="product-breadcrumb" style="width: 80%; margin: 0 auto; padding-bottom: 15px;">
            <?php //woocommerce_breadcrumb();?>
        </div> -->

        <div class="feat-post-cont">

            

           <div class="inner-post">                 



                <?php while ( have_posts() ) : the_post(); ?>







			    <?php wc_get_template_part( 'content', 'single-product' ); ?>







               <?php endwhile; // end of the loop. ?>



           </div>



        </div>

</div>

<?php 



    wp_reset_postdata();



?>



    </div>



    <div class="page-container">

		<?php 

			$title = 'People who viewed this also liked:';

			include(dirname(__FILE__)."/../page-templates/title-divider.php");?>

        <?php



            do_action( 'woocommerce_after_single_product_summary_custom' );

        ?>            

   </div>

<?php get_footer( 'shop' ); ?>



