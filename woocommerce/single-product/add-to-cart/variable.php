<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
$attribute_keys = array_keys( $attributes );
do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>
	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
<!--		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>-->
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
						<td class="value">
							<?php
								$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
                                wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
							?>
						</td>
					</tr>
		        <?php endforeach;?>
			</tbody>
		</table>
		
        <?php
            global $product;
            $attachment_ids = $product->get_gallery_attachment_ids();
            $gallery_images = [];
            foreach( $attachment_ids as $attachment_id ) {
                $image_link = wp_get_attachment_url( $attachment_id );
                array_push($gallery_images, $image_link);
            ?>
<!--                <img width="50px" src="<?php echo $image_link; ?>" alt="">-->
            <?php    
            }
            
            $gallery_images = array_reverse($gallery_images);
            
            $sizes = $product->get_attribute( 'size' );
            $values = $product->get_attribute( 'value' );
        ?>    
        <div class="product-selection-var">
        <div style="display:none"><?php var_dump(strpos($sizes, '|')); ?></div>
        <?php
            if ( $sizes !== '' && strpos($sizes, '|') !== false) {
        ?>
            <div id="var-holder" class="variations-cont" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
                <?php
                    $default_att = $product->get_variation_default_attribute( $attribute_name );
                    $size_arr = array();
                    $variation_arr = array();
                 
                    foreach ( $available_variations as $key => $variable ) {
                        if ( $variable["attributes"]["attribute_size"] == $default_att ) {
                            $class = "active-var";
                        } else {
                            $class="";
                        }
                                              
                        
						if($variable["is_in_stock"] == 1 && $variable["variation_is_active"] == 1 ){
	$markup = "<span class='" . $class . "' data-key='" . $variable["variation_id"] . "'>" . $variable["attributes"]["attribute_size"] . "</span>";
}
else{
	
   $markup = "<span stlye='pointer-events:none;' class=' multi-ofs " . $class . "' data-key='" . $variable["variation_id"] . "'>" . $variable["attributes"]["attribute_size"] . "</span>";
	// $markup = "<span class='disabled varclrspan' style='cursor:not-allowed;' disabled><div class='colour-tooltip' style='width:165px;'><b style='color:red;'>Out Of Stock</b> </div>" . $variable["attributes"]["attribute_size"] . "</span>";
	
}
						
                        array_push($size_arr, $variable["attributes"]["attribute_size"]);
                        array_push($variation_arr, $markup);
//                        echo "<span class='" . $class . "' data-key='" . $key . "'>" . $variable["attributes"]["attribute_size"] . "</span>";
//


						
						
                    }
                
                    
                    sort($size_arr, SORT_NATURAL | SORT_FLAG_CASE);
                
                    
                    foreach ( $size_arr as $var ) {                    
                        $i = 0;
                        
                        while ( $i < sizeof($variation_arr) ) {
                            
                            if (strpos($variation_arr[$i], '>' . $var . '<') !== false) {
                                echo $variation_arr[$i];
                                break;
                            }
                            
                            $i++;
                        }
                    }
                    
                ?>
            </div>  
        <?php
            }
            
            if ($values !== '') {
                
        ?>
                <div id="var-holder" class="variations-cont" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
                <?php
                    $default_att = $product->get_variation_default_attribute( $attribute_name );
                    $value_arr = array();
                    $variation_arr = array();
                 
                
                    foreach ( $available_variations as $key => $variable ) {
                        if ( $variable["attributes"]["attribute_value"] == $default_att ) {
                            $class = "active-var";
                        } else {
                            $class="";
                        }
                        
                        $markup = "<span class='" . $class . "' data-key='" . $variable["variation_id"] . "'>" . $variable["attributes"]["attribute_value"] . "</span>";
                        array_push($value_arr, $variable["attributes"]["attribute_value"]);
                        array_push($variation_arr, $markup);
                        
//                        echo "<span class='" . $class . "' data-key='" . $key . "'>" . $variable["attributes"]["attribute_size"] . "</span>";

                    }
//                        var_dump($variation_arr);
//                        var_dump($value_arr);
                    
//                    sort($value_arr, SORT_NATURAL | SORT_FLAG_CASE);
                
                    foreach ( $variation_arr as $var ) {
                        $i = 0;
                        echo $var;
//                        while ( $i < sizeof($variation_arr) ) {
//                            if (strpos($variation_arr[$i], $var) !== false) {
//                                echo $variation_arr[$i];
//                                break;
//                            }
//                            
//                            $i++;
//                        }
                    }
                    
                ?>
            </div> 
        <?php
            }
            
            $colours = $product->get_attribute( 'colour' );
//            var_dump(json_encode( $available_variations ));
//            $json = json_encode($available_variations);
//            foreach ($available_variations as $variation) {
//                echo $variation["variation_id"] . ' - ' . $variation["attributes"]["attribute_colour"]  . '<br>';
//            }
//            var_dump($available_variations);
            
            if ( $colours !== '' ) {
        ?>
                <div id="var-holder" class="variations-cont colours-var" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
                    <?php
			
                        $default_att = $product->get_variation_default_attribute( $attribute_name );
                        $json = $available_variations;               
                         echo '<script>console.log('. $json .')</script>';
                        usort($json, function($a, $b) {
                            $a_colour = $a["variation_id"];
                            $b_colour = $b["variation_id"];
                            return strcmp($a_colour, $b_colour);
                        });
                        
                        foreach ( $json as $key => $variable ) {
                            if ( $variable["attributes"]["attribute_colour"] == $default_att ) {
                                $class = "active-var";
                            } else {
                                $class = "";
                            }
                            
                            if ($gallery_images[$key] != "") {
                                $img_link = $gallery_images[(sizeof($available_variations) - $key)-1];
                            } else {
                                $img_link = $variable['image']['src'];
                            }

                            if(has_term('dior','product_cat')){
                                $tooltip_name_raw = $variable["attributes"]["attribute_pa_colour"];
                                $tooltip_name = str_replace('-',' ',$tooltip_name_raw);
								
								if($variable["is_in_stock"] == 1 && $variable["variation_is_active"] == 1 ){
									echo "<span class='" . $class . "' data-key='" . $variable["variation_id"] . "'><div class='colour-tooltip'><figure>" . $tooltip_name . "</figure></div><div class='colour-cont'>" . "<img src='" . $img_link . "'></div></span>";
								}
								else{
									echo "<span class='disabled varclrspan' style='cursor:not-allowed;' disabled><div class='colour-tooltip'><figure>" .$tooltip_name." <b style='color:red;'>Out Of Stock</b> </figure></div><div class='colour-cont'>" . "<img src='" . $img_link . "'></div></span>";
								}

                            }else{
								if($variable["is_in_stock"] == 1 && $variable["variation_is_active"] == 1 ){
									echo "<span class='" . $class . "' data-key='" . $variable["variation_id"] . "'><div class='colour-tooltip'><figure>" . $variable["attributes"]["attribute_colour"] . "</figure></div><div class='colour-cont'>" . "<img src='" . $img_link . "'></div></span>";
								}
								else{
									echo "<span class='disabled varclrspan' style='cursor:not-allowed;' disabled><div class='colour-tooltip'><figure>" .$variable["attributes"]["attribute_colour"]." <b style='color:red;'>Out Of Stock</b> </figure></div><div class='colour-cont'>" . "<img src='" . $img_link . "'></div></span>";
								}
                                
                            }
                        }
                    ?>
                </div>
			<script>
			$(document).ready(function () {
				$('.varclrspan').prop('disabled', true);
			});
			</script>
        <?php
            }
        ?>
            
            <div class="qty-cont">
                <span>QTY : </span><input id="qty-label" type="number" step="1" min="1" max="9" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" autocomplete="off">
            </div>
        </div>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<div class="single_variation_wrap" style="display:none;">
            <?php
             $available_variations = $product->get_available_variations();
             //var_dump($available_variations);
             $counter = 1;

             $arr_sale = array();
             $arr_price = array();
             $price = 0;
             $p_counter = 0;

             foreach($available_variations as $v){
                 $arr_price[] = $v['display_price'];
                 $arr_sale[] = $v['display_regular_price'];

                 if($v['display_regular_price'] != $price){
                     $price = $v['display_regular_price'];
                     $p_counter++;
                 }
             }

             $min_cost = min($arr_price);
             $min_orig_cost = min($arr_sale);

             if ( $product->is_on_sale() && $p_counter == 1){
            ?>
            <div class="temp-price">
             <span class="woocommerce-Price-currencySymbol">€</span><?php echo $min_orig_cost;?></span>
            </div>
            <?php
             }
            if ( $colours !== '' ) {
                $price_html = $product->get_price_html(); 
                
//                var_dump($product);
                if (strpos($price_html, '-') !== false) {
                    $price = explode('-', $price_html);
            //        echo 'true';
                } else {
                    $price = $product->get_price_html();
                }
            }
            
           
            ?>
                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <!-- <?php //  if($attribute_keys[0] !== 'Colour'){?> -->
                    <h3  class="price"><?php echo $price_html; ?></h3>
                    
                   
                    <!-- <?php // } ?> -->
                    <!-- <meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" /> -->
                    <meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
                    <link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
                </div>
			<?php
         
				/**
				 * woocommerce_before_single_variation Hook.
				 */
				do_action( 'woocommerce_before_single_variation' );
				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );
				/**
				 * woocommerce_after_single_variation Hook.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>
   
    <div class="cart-wishlist shop-loc">
        <div class="add-to-wishlist variable-wl">
            <?php
                $arg = array (
                    'echo' => true
                );
                do_action('gd_mylist_btn',$arg);
            ?>
<!--
            <a href="javascript:void()">
                add My List
            </a>
-->
        </div>
    </div>
	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>
<?php
do_action( 'woocommerce_after_add_to_cart_form' );
