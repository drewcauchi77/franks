<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;
$prod_title = get_the_title();
$prod_tim = explode("*", $prod_title);
$last = array_pop($prod_tim);

$prod_del = array(implode('*', $prod_tim), $last);

?>
<h1 itemprop="name" class="product_title entry-title"><?php echo ($prod_del[0] == "") ? get_the_title() : $prod_del[0]; ?></h1>
<?php
    $curr_terms = get_the_terms($post->id, 'product_cat');
    $brands_cat = get_term_by('name', 'Brands', 'product_cat')->term_id;
    $ff_attr = get_post_meta($product->id, 'description_text', true);

    if ( $ff_attr == "" ) {
        $ff_attr = $product->get_attribute( "pa_product-type");
    }

    


    foreach ($curr_terms as $curr_term) {
        if ($curr_term->parent == $brands_cat) {
            $brand = $curr_term->name;
            $link = get_term_link( $brands_cat, 'product_cat' );
            $link = $link . $brand;
        }
    }
?>
<div class="brand-family">
    <h2>
        <?php if($brand !== "" && $ff_attr !== "")
              { 
                ?><a class="brand-page-link" href=<?= $link ?>><?php echo $brand; ?></a><?php echo " - " . $ff_attr;
              }
              else{
                 echo  "";
              } ?>
    </h2>
</div>
   
<?php
    $tab_headers = array();
    $tab_html = array();

    $check = get_post_meta( $product->id, 'tab_details', true );

    if ($check == '') {
        array_push($tab_headers, "General");
        array_push($tab_html, get_the_content());        
    }

    $custom_fields = get_post_custom();

    foreach ( $custom_fields as $field_key => $field_values ) {
        foreach ( $field_values as $key => $value ) {
            if(strpos($field_key, "tab_") === 0) {
                $header = ucwords(substr(str_replace('-', " ", $field_key), strlen('tab_')));
                
                if ($value != "") {
                    array_push($tab_headers, $header);
                    array_push($tab_html, $value);
                }
            }
        }
    }
?>

<div class="tab-header-cont">
    <?php
        foreach ( $tab_headers as $key => $header ) {
    ?>
           <div data-tab="<?php echo $key; ?>" class="tab-header <?php if ($key == 0) echo "active-tab" ?>">
               <h3><?php echo $header; ?></h3>
           </div>
    <?php
        }
    ?>
</div>
        
<div class="single-product-description">
    <div class="tab-content-cont">
        <?php
            foreach ( $tab_html as $key => $content ) {
        ?>
               <div data-tab="<?php echo $key; ?>" class="product-tab <?php if ($key == 0) echo "active-tab" ?>">
                   <p><?php echo $content; ?></p>
               </div>
        <?php
            }
        ?>
    </div>
</div>

   
<?php
    $product_size = $product->get_attribute( "Size");
    if (strpos($product_size, '|') !== false || $product_size == "") {
        
    } else {
?>
        <div class="size-cont">
        <?php echo '<span>Size : </span>' . $product_size;?>            
        </div>
<?php
    }
?>
