<?php
/**
 * Shop breadcrumb
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

global $post;

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if ( is_wp_error( $result ) ) {
  $error_string = $result->get_error_message();
  echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
}

//$wp_session = WP_Session::get_instance();

$prev_referer = $_SESSION['prev_referer'];
$prev_product = $_SESSION['prev_product'];

if ( ! empty( $breadcrumb ) && ! is_wp_error( $result ) ) {
    

  echo $wrap_before;
   
   if (is_single() && !is_attachment()) {
       
       if ( get_post_type() == 'product' ) {

           echo $prepend;

           if ( $terms = get_the_terms( $post->ID, 'product_cat' ) ) {

               $referer = wp_get_referer();
               $referer_init = $referer;

               if (isset($prev_referer) && isset($prev_product)) {
                if ($post->ID == $prev_product) {
                  $referer = $prev_referer;
                }
              }

               if (strpos($referer, 'product-category') !== false) {

                  $referer = str_replace(home_url() . '/product-category/', '', $referer);
                  $term_slugs = explode('/', $referer);
                   
                   foreach ($term_slugs as $slug) {
                       if ($slug != "" && strpos($slug, '?') === false && !is_numeric($slug)) {
                           $term = get_term_by('slug', $slug, 'product_cat');

    //                        echo $term->name . '<br>';
    //                        echo get_term_link( $slug, 'product_cat' ) . '<br>';
                           if ($slug != "page") {
                            echo $before . '<a href="' . get_term_link( $slug, 'product_cat' ) . '">' . $term->name . '</a>' . $after . $delimiter;
                           }
                           else {
                            $index = array_search($slug, $term_slugs);
                            $page_num = ($index < sizeof($term_slugs) - 1) ? $term_slugs[$index + 1] : '';

                            echo $before . '<a href="' . wp_get_referer() . '">Page ' . $page_num . '</a>' . $after . $delimiter;  
                           }
                       }
                   }
               }

               $_SESSION['prev_referer'] = ($post->ID == $_SESSION['prev_product']) ? $referer_init : wp_get_referer();
               $_SESSION['prev_product'] = $post->ID;
           }
           
           $prod_del = explode("*", get_the_title());
           
           if (sizeof($prod_del) > 1) {
               echo $before . $prod_del[0] . ': ' . $prod_del[1] . $after;
           }
           else {
               echo $before . $prod_del[0]. $after;
           }
       }
   }
   else {
       foreach ( $breadcrumb as $key => $crumb ) {

           echo $before;

           if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
               echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
           } else {
               echo esc_html( $crumb[0] );
           }

           echo $after;

           if ( sizeof( $breadcrumb ) !== $key + 1 ) {
               echo $delimiter;
           }

       }
   }

  echo $wrap_after;

}
