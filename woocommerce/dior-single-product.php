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

get_header( 'shop' ); 

?>
<div class="feat-banner-cont dior-banner-cont">

    <div class="feat-post-cont dior-single-content">

        <div class="page-header dior-header">

            <?php 

            $diorcat_id = get_woocommerce_term_meta( 3080, 'thumbnail_id', true ); 
            $dior_image = wp_get_attachment_url( $diorcat_id );

            ?>

            <img class="dior-logo" src=<?php echo $dior_image; ?>>

        </div>

        <div class="woo-path dior-path">

            <?php woocommerce_breadcrumb(); ?>

        </div>

        <div class="inner-post"> 
        
            <?php while ( have_posts() ) : the_post(); ?>

            <?php wc_get_template_part( 'content', 'single-product' ); ?>

            <?php endwhile; // end of the loop. ?>

        </div>

    </div>

    <?php 

        wp_reset_postdata();

    ?>

</div>

<div class="page-container dior-container">
    <?php 
        $title = 'People who viewed this also liked:';
        include(dirname(__FILE__)."/../page-templates/title-divider.php");?>

    <?php

        do_action( 'woocommerce_after_single_product_summary_custom' );
    ?>            
</div>

<?php get_footer( 'shop' ); ?>

