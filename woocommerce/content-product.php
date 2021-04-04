<?php

/**

 * The template for displaying product content within loops

 *

 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.

 *

 * HOWEVER, on occasion WooCommerce will need to update template files and you

 * (the theme developer) will need to copy the new files to your theme to

 * maintain compatibility. We try to do this as little as possible, but it does

 * happen. When this occurs the version of the template file will be bumped and

 * the readme will list any important changes.

 *

 * @see     https://docs.woocommerce.com/document/template-structure/

 * @author  WooThemes

 * @package WooCommerce/Templates

 * @version 2.6.1

 */



if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

}



global $product, $woocommerce_loop;



// Store loop count we're currently on

if ( empty( $woocommerce_loop['loop'] ) ) {

	$woocommerce_loop['loop'] = 0;

}



// Store column count for displaying the grid

if ( empty( $woocommerce_loop['columns'] ) ) {

	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

}



// Ensure visibility

if ( empty( $product ) || ! $product->is_visible() ) {

	return;

}



$how_to_video = ($custom_post) ? true : false;

if ($how_to_video) {

    $img_class = 'video';

    $link_class = 'product-link';

}



// Increase loop count

$woocommerce_loop['loop']++;



// Extra post classes

$classes = array();



if ($how_to_video) {

    $li_class = 'video-product-item';

    $classes[] = $li_class;

}

if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {

    $li_class .= ' first';

	$classes[] = $li_class;

}

if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {

    $li_class .= ' last';

	$classes[] = $li_class;

}

?>

<li <?php post_class( $classes ); ?>>



	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>



    <a href="<?php the_permalink(); ?>" class="product-list-link <?php echo $link_class; ?>">

        <div class="product-image-holder <?php echo $img_class; ?>">

        <?php
            
            // $online_exclusive = get_field('product_tag', $product->get_id());
        
            // if($online_exclusive == "Online Exclusive"){
            //     echo '<span class="online-exclusive-tag">'. $online_exclusive . '</span>';
            // }

            $online_exclusive = get_field('product_tag', $product->get_id());
            
            if(!has_term('Dior','product_cat', $product->get_id())){
                if($online_exclusive){
                    echo '<span class="online-exclusive-tag" style="height:fit-content;">'. $online_exclusive . '</span>';
                }
            }
        
        ?>

        <?php

            /**

            * woocommerce_before_shop_loop_item hook.

            *

            * @hooked woocommerce_template_loop_product_link_open - 10

            */

            // do_action( 'woocommerce_before_shop_loop_item' );



            /**

            * woocommerce_before_shop_loop_item_title hook.

            *

            * @hooked woocommerce_show_product_loop_sale_flash - 10

            * @hooked woocommerce_template_loop_product_thumbnail - 10

            */

            do_action( 'woocommerce_before_shop_loop_item_title' );

        ?>

        </div>



        <?php if ($how_to_video): ?>



        <div class="product-item-details">



        <?php endif; ?>

        

        <div class="inner-prod-text">
            
        <?php

			/**

			 * woocommerce_shop_loop_item_title hook.

			 *

			 * @hooked woocommerce_template_loop_product_title - 10

			 */

            // do_action( 'woocommerce_shop_loop_item_title' );

        

            $prod_title = get_the_title();

            $prod_tim = explode("*", $prod_title);

            $last = array_pop($prod_tim);



            $prod_del = array(implode('*', $prod_tim), $last);

    ?>      

        <?php if(has_term('Dior','product_cat', $product->get_id())){?>

            <?php 
            $product_tag = get_field("product_tag", $product->get_id());
            if($product_tag != ''){
                echo '<h4 class="dior-new-tag">'. $product_tag . '</h4>';
            }else{
                echo "<h4 style='height: 0px;'></h4>";
            }
            

            ?>

            <h3 class="dior-category" style="font-weight:900;">DIOR</h3>

        <?php }else{
            echo "<h4 style='height: 23px;'></h4>";
        } ?>

            <h3><?php echo ($prod_del[0] == "") ? get_the_title() : $prod_del[0]; ?></h3>  

    <?php

            // wp_reset_postdata();

            $make_up_state = false;

            $queried_object = get_queried_object();

            $cateID = $queried_object->term_id;

            $term = get_term_by('id', $cateID, 'product_cat');

            $makeup_cat = get_term_by('name', 'Make-Up', 'product_cat')->term_id;

            $product_terms = get_the_terms( $product->id, 'product_cat' );

            $ff_attr = get_post_meta($product->id, 'description_text', true);

            

            if ($product_terms) {

                foreach ($product_terms as $term) {

                    if (term_is_ancestor_of( $makeup_cat, $term->term_id, 'product_cat')) {

                        $make_up_state = true;

                    }

                }

            }

            

            if ( $ff_attr == "" ) {                

                $ff_attr = $product->get_attribute( "pa_fragrance-type");

            }

                            

            if ( $ff_attr == "" && !$make_up_state) {

                $ff_attr = $product->get_attribute( "pa_product-type");

            } 

            // var_dump($all_att);

            if(!has_term('Dior','product_cat',$product->get_id()) && $ff_attr !== ""){
                echo '<span>' . $ff_attr . '</span>';
            }

    ?>

        </div>

    <?php

        

			/**

			 * woocommerce_after_shop_loop_item_title hook.

			 *

			 * @hooked woocommerce_template_loop_rating - 5

			 * @hooked woocommerce_template_loop_price - 10

			 */
            
            if ( $product->is_type( 'variable' )) {
                $default_variation = $product->get_default_attributes();
                $available_variations = $product->get_available_variations();
                //var_dump($available_variations);
                $counter = 1;

                $arr_sale = array();
                $arr_price = array();

                foreach($available_variations as $v){
                    $arr_price[] = $v['display_price'];
                    $arr_sale[] = $v['display_regular_price'];
                }

                $min_cost = min($arr_price);
               
                //var_dump($min_orig_cost);
                if ( $product->is_on_sale() )  {    
                    $min_orig_cost = min($arr_sale);
                }
                else{
                    $min_orig_cost = '';
                }

               

                foreach($available_variations as $var){

                    if($var['attributes']['attribute_size'] == $default_variation['size'] && $counter == 1){
                        ?>
                        <span class="price">
                            <del <?php if($var['display_regular_price'] == $var['display_price']){echo 'style="display:none;"';}?>>
                                <span class="woocommerce-Price-amount amount">
                                    <!-- <span class="woocommerce-Price-currencySymbol">€</span><?php //echo $var['display_regular_price'];?></span> -->
                                    <span class="woocommerce-Price-currencySymbol">€</span><?php echo $min_orig_cost;?></span>
                            </del>
                            <ins>
                                <!-- <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">€</span><?php //echo $var['display_price'];?></span> -->
                                <span class=" test woocommerce-Price-amount amount">
                                    <?php $no_of_chars = strlen(substr(strrchr($min_cost,"."),1)); 
                                    if($no_of_chars == 1){?>
                                        <!-- <span class="woocommerce-Price-currencySymbol">€</span><?php //echo $var['display_price'] . '0';?></span> -->
                                        <span class="woocommerce-Price-currencySymbol">€</span><?php echo $min_cost . '0';?></span>
                                    <?php
                                    }else if($no_of_chars == 0){
                                    ?>
                                        <!-- <span class="woocommerce-Price-currencySymbol">€</span><?php //echo $var['display_price'] . '.00';?></span> -->
                                        <span class="woocommerce-Price-currencySymbol">€</span><?php echo $min_cost . '.00';?></span>
                                    <?php
                                    }else{
                                    ?>
                                        <!-- <span class="woocommerce-Price-currencySymbol">€</span><?php //echo $var['display_price'];?></span> -->
                                        <span class="woocommerce-Price-currencySymbol">€</span><?php echo $min_cost;?></span>
                                    <?php } ?>
                                </span>
                            </ins>
                        </span>
                        <?php
                        //Sale price
                        //var_dump($var['display_price']);
                        //Regular original price
                        //var_dump($var['display_regular_price']);
                        $counter++;
                    }
                    
                }
    
            }else{
                do_action( 'woocommerce_after_shop_loop_item_title' );
            }

		?>

        <?php if ($how_to_video): ?>



        </div>



        <?php endif; ?>



    </a>

    

    <?php if ($how_to_video): ?>



    <div class="product-btns">



    <?php endif; ?>

	

	<?php



		/**

        * woocommerce_after_shop_loop_item hook.

        *

        * @hooked woocommerce_template_loop_product_link_close - 5

        * @hooked woocommerce_template_loop_add_to_cart - 10

        */

		do_action( 'woocommerce_after_shop_loop_item' );

	?>

    

    <div class="cart-wishlist">

        <div class="add-to-wishlist">

            <?php

                $arg = array (

                    'echo' => true

                );

                do_action('gd_mylist_btn',$arg);

            ?>

        </div>

    </div>



    <?php if ($how_to_video): ?>



    </div>



    <?php endif; ?>



</li>

