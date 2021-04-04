<?php

/**

 * The Template for displaying product archives, including the main shop page which is a post type archive.

 *

 * Override this template by copying it to yourtheme/woocommerce/archive-product.php

 *

 * @author 		WooThemes

 * @package 	WooCommerce/Templates

 * @version     2.0.0

 */



if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

}



get_header( 'shop' ); ?>

   

    <?php

        $brands_cat = get_term_by('name', 'Brands', 'product_cat')->term_id;

        $queried_object = get_queried_object();

        $cateID = $queried_object->term_id;

        $term = get_term_by('id', $cateID, 'product_cat');



        $curr_brand = get_brand($term->name)->post;



        if (!isset($curr_brand) && isset($_GET['brand'])) {

            $curr_brand = get_post($_GET['brand']);

        }



        $brand_banner = wp_get_attachment_url( get_post_thumbnail_id($curr_brand->ID) );
        $brand_logo = wp_get_attachment_url( get_post_thumbnail_id($curr_brand->ID) );
        $brand_banner_arch = wp_get_attachment_url(get_post_thumbnail_id($curr_brand->ID));      



        if ( $term->parent == $brands_cat || isset($_GET['brand'])/* && z_taxonomy_image_url() != "" */) { ?>

            <div class="brand-banner">

                <?php

                    if ( $_GET['bpage'] == 'products' || isset($_GET['brand']) ) {

                        if ($brand_banner_arch == "") {

                ?>

                            <div class="inner-banner logo-holder"> <img src="<?php echo $brand_logo; ?>" alt=""> </div>

                <?php                        

                        } else {

                ?>

                            <div class="inner-banner"> <img src="<?php echo $brand_banner_arch; ?>" alt=""> </div>

                <?php

                        }

                    } else {

                        if (get_post_meta($curr_brand->ID, 'brands_post_banner_link', true) !== "") {

                ?>

                            <a href="<?php echo get_post_meta($curr_brand->ID, 'brands_post_banner_link', true); ?>">

                                <img class="inner-brand-banner" src="<?php echo $brand_banner; ?>" alt="">

                            </a>                        

                <?php

                        } else {

                ?>                   

                            <img class="inner-brand-banner" src="<?php echo $brand_banner; ?>" alt="">

                <?php

                        }

                    }

                ?>

            </div>

        <?php } else { ?>

            <?php get_template_part( 'template-parts/content', 'slider' ); ?>

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

        <?php } ?>

            <div class="page-container">

                <?php if ( $term->parent == $brands_cat && $_GET['bpage'] !== 'products' ) { ?>

                <div class="shop-sidebar brand-bar">

                    <div class="filter-container category-container">

                        <div class="filter-trigger"> <span>Close</span> </div>

                        <h1><?php echo $curr_brand->post_title; ?></h1>
                       
                        <?php                



                            $brand_cat = array();

                            $brand_cat2 = array();

                    

                            $args = array( 'post_type' => 'product', 'product_cat' => $curr_brand->post_title, 'posts_per_page' => -1 );

                            $loop = new WP_Query( $args );

                            while ( $loop->have_posts() ) : $loop->the_post(); global $product;



                                $categories = wp_get_post_terms($product->id , 'product_cat');                

                                $categories = wp_list_filter($categories, array('name'=>$curr_brand->post_title),'NOT');

                    

                                foreach ( $categories as $category ) {

                                    $main_cat = get_term_by('id', $category->parent, 'product_cat');

                                    

                                    while ($main_cat->parent != 0) {

                                        $child_cat = get_term_by('id', $main_cat->term_id, 'product_cat');

                                        $main_cat = get_term_by('id', $main_cat->parent, 'product_cat');

                                    }

                                    

                                    if ($main_cat->name != '' && $main_cat->name != 'Brands') {

                                        $link_mark2 = '<a href="' . get_term_link($queried_object->term_id, 'product_cat') . '?bpage=products&cat_id=' . $child_cat->term_id . '&filters=product_cat[' . $child_cat->term_id . ']">' . $child_cat->name . '</a>';                                      

                                        if (array_key_exists($main_cat->name, $brand_cat2)) {

                                            $present_child = $brand_cat2[$main_cat->name];

                                            

                                            if (strpos($present_child, $link_mark2) !== false) {

                                            } else {

                                                $brand_cat2[$main_cat->name] = $present_child . $link_mark2;

                                            }

                                            

                                        } else {

                                            $brand_cat2[$main_cat->name] = $link_mark2;

                                        }                                    

                                    }

                                }



                            endwhile; ?>

                        <?php wp_reset_query(); ?>

                    <?php

                        ksort($brand_cat2);

                    

                        foreach ( $brand_cat2 as $key => $brand ) {

                            echo '<div class="brand-cat-filter">';

                            echo '<figure class="parent_filter">' . $key . '</figure>';

                            echo $brand;

                            echo '</div>';

                        } ?>

                    </div>

                    <?php 

                        $args = array( 'posts_per_page' => -1, 'post_type' => 'post', 'category_name' => $curr_brand->post_title );



                        $myposts = get_posts( $args );



                        if ( sizeof($myposts) > 0 ) { 

                    ?>

                            <div class="explore-brand">

                                <h3>Explore<br>the Brand</h3>

                                <ul>

                                <?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>

                                    <li>

                                        <a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>

                                    </li>

                                <?php endforeach; ?>

                                <?php wp_reset_postdata(); ?>

                                </ul>

                            </div>

                        <?php } ?>

                </div>

                <div class="products-container">

                    <div class="sorting-container">

                        <div class="filter-trigger brand-trigger">

                            <span>View Categories</span>

                        </div>

                    </div>

                                

                    <div class="whats-new-cont woocommerce">

                        <div class="title-holder">

                            <h2>What's New</h2>

                        </div>

                        <ul class="products">

                            <?php 

                            wp_reset_query();

            

                            $args_new = array(

                                'post_type' => 'product',

                                'posts_per_page' => 4,

                                'product_cat' => $curr_brand->post_name,

                                'orderby' => 'date',

                                'order' => 'desc'

                            );



                            $loop = new WP_Query( $args_new );

                            if ( $loop->have_posts() ) {

                                while ( $loop->have_posts() ) : $loop->the_post();

                                    woocommerce_get_template_part( 'content', 'product' );

                                endwhile;

                            } else {

                                echo __( 'No products found' );

                            }

                            wp_reset_query(); ?>

                        </ul>

                    </div>

                    <div class="best-sellers-cont woocommerce">

                        <div class="title-holder">

                            <h2>Best Sellers</h2>

                        </div>

                        <ul class="products">

                            <?php $args = array(

                                'post_type' => 'product',

                                'posts_per_page' => 4,

                                'product_cat' => $curr_brand->post_name,

                                'meta_key' => 'total sales',

                                'orderby' => 'meta_value_num',

                            );



                            $loop = new WP_Query( $args );

                            if ( $loop->have_posts() ) {

                                while ( $loop->have_posts() ) : $loop->the_post();

                                    woocommerce_get_template_part( 'content', 'product' );

                                endwhile;

                            } else {

                                echo __( 'No products found' );

                            }



                            wp_reset_query();

                            ?>

                        </ul>

                    </div>

                    <div class="brand-page-cont">

                        <?php

                        $media_image = wp_get_attachment_url(get_post_thumbnail_id($curr_brand->ID));



                        if ($media_image != null) { ?>

                            <div class="brand-media" style="background-image: url(<?php echo $media_image; ?>)"></div>

                        <?php } else { ?>

                            <div class="brand-media">

                        <?php

                            $url = get_post_meta($curr_brand->ID, 'brands_post_media', true);

                            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);

                            $id = $matches[1];

                        ?>

                                <iframe type="text/html" width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>

                            </div>

                        <?php } ?>

                        <div class="brand-text">

                            <?php echo apply_filters('the_content', $curr_brand->post_content); ?>

                        </div>

                    </div>

                </div>

        <?php } else { ?>
            <?php 
                $title = 'The art of living beautiful';
                include(dirname(__FILE__)."/../page-templates/title-divider.php");?>

            <?php if ($_GET['bpage'] == 'products' || isset($_GET['brand'])) { ?>

                <div class="brand-back">

                    <div class="inner-post">

                        <a href="<?php echo get_home_url() . '/product-category/brands/' . $curr_brand->post_name; ?>">

                            <div style="display:inline-block" class="arrow-cont">

                                <div class="arrow"></div>                                            

                            </div>

                            <span>Go back to <strong><?php echo $curr_brand->post_title; ?></strong></span>

                        </a>                                       

                    </div>

                </div>                                        

            <?php } else { ?>

                <?php woocommerce_breadcrumb(); ?>

            <?php } ?>

            <?php 

                $q_object = get_queried_object();

                $this_term = $q_object->term_id;



                if ( $_GET['bpage'] == 'products' ) {

                    $this_term = $_GET['cat_id'];

                }



                $taxonomy = 'product_cat';

                $termchildren = get_terms($taxonomy, array('parent' => $this_term,'hide_empty'=>1));    

            ?>

            <div class="shop-sidebar <?php echo ($term->count == 0 && sizeof($termchildren) == 0) ? "no-products-side" : ""; ?>">

                <div class="filter-trigger"> <span>Close</span> </div>

                    <?php get_product_search_form(); ?>

                    <?php do_action( 'woocommerce_archive_description' ); ?>

                    <?php if ( have_posts() ) : ?>

                        <?php

                            $brands_cat = get_term_by('name', 'Brands', 'product_cat')->term_id;

                            $fragrance_cat = get_term_by('name', 'Fragrance', 'product_cat')->term_id;

                            $skin_cat = get_term_by('name', 'Skin Care', 'product_cat')->term_id;

                            $sun_cat = get_term_by('name', 'Sun Care', 'product_cat')->term_id;

                            $makeup_cat = get_term_by('name', 'Make-Up', 'product_cat')->term_id;

                            $bath_cat = get_term_by('slug', 'bath-body', 'product_cat')->term_id;

                            $shaving_cat = get_term_by('name', 'Shaving', 'product_cat')->term_id;

                            $men_cat = get_term_by('name', 'For Men', 'product_cat')->term_id;

                            

                            function cmp($a, $b) {

                                return strcmp($a->name, $b->name);

                            }



                            usort($termchildren, "cmp");

                        ?>

                    <?php if (sizeof($termchildren) > 0) { ?>

                        <div class="filter-container category-container test">

                        <?php if ($_GET['bpage'] == 'products') {

                            global $wpdb;

                            $subcategories = $wpdb->get_results($wpdb->prepare(

                                "CALL get_brand_subcategories(%d, %s)",

                                $_GET['cat_id'], $curr_brand->post_title

                            ));

                        ?>

                            <h3 class="widget-title"><span>Sub-Categories</span></h3>

                    <?php

                            $brand_term = get_term_by('name', $curr_brand->post_title, 'product_cat');

                            foreach ($subcategories as $subcat) {

                                

                                $term_id = intval($subcat->term_id);

                                $name = $subcat->name;

                                

                                $brand_filter = '?filters=product_cat[' . $brand_term->term_id . ']&brand=' . $curr_brand->ID;

                                

                                echo "<li class='child-filter'><a href='" . get_term_link($term_id) . $brand_filter . "'><label>" . $name . "</label></a></li>";

                            }
?>
                            <div class="filter-container price-container">
                                <div class="price-filter-cont">
                                    <div class="price-inner-filter-cont">
                                        <?php
                                            echo do_shortcode('[br_filter_single filter_id=222146]');
                                            ?>
                                    </div>
                                </div>
                            </div>
<?php
                        } else { ?>

                            <h3 class="widget-title"><span>Sub-Categories</span></h3>

                    <?php

                            foreach($termchildren as $term) {

                                echo "<li class='child-filter'><a href='" . get_term_link($term) . "'><label>" . $term->name . "</label></a></li>";

                            }

                        }

                    ?>

                        </div>

                    <?php }

                    if ($_GET['bpage'] !== 'products' && !isset($_GET['brand'])) { ?>

                        <div class="clear-filters">

                            <?php echo do_shortcode('[br_filters widget_type="reset_button" title="Clear Filters"]'); ?>

                        </div>

                        <div class="filter-container brand-container">

                            <div class="filter-cont">

                                <div class="inner-filter-cont">

                                <?php

                                    $brands_cat = get_term_by('name', 'Brands', 'product_cat')->term_id;

                                    echo do_shortcode('[br_filters filter_type="product_cat" type="checkbox" title="Brands" operator="OR" parent_product_cat="' . $brands_cat . '" hide_collapse_arrow="1" cat_propagation="" order_values_by="Alpha"]');

                                ?>

                                </div>

                            </div>

                        </div>

                    <?php } else {

                        if (isset($_GET['brand'])): ?>

                            <div class="clear-filters">

                                <?php echo do_shortcode('[br_filters widget_type="reset_button" title="Clear Filters"]'); ?>

                            </div>

                        <?php endif; ?>

                            

                            <div class="filter-container brand-container" style="display: none">

                                <div class="filter-cont">

                                    <div class="inner-filter-cont">

                                    <?php

                                        $brands_cat = get_term_by('name', 'Brands', 'product_cat')->term_id;

                                        echo do_shortcode('[br_filters filter_type="product_cat" type="checkbox" title="Brands" operator="OR" parent_product_cat="' . $brands_cat . '" hide_collapse_arrow="1" cat_propagation="" order_values_by="Alpha"]');

                                    ?>

                                    </div>

                                </div>

                            </div>

                    <?php }

            

                        $attribute_taxonomies = wc_get_attribute_taxonomies();

                        $taxonomy_terms = array();

                        global $product;



                        if ( /*($attribute_taxonomies && $_GET['bpage'] == 'products') ||*/ ($attribute_taxonomies && sizeof($termchildren) == 0 && $_GET['bpage'] !== 'products') /*&&  && */ ) :

                            foreach ($attribute_taxonomies as $tax) :        

                                if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name)) && $tax->attribute_name != 'barcode') :

                                    if ( $tax->attribute_name == 'gender' || ( $tax->attribute_name !== 'fragrance-family' && term_is_ancestor_of( $fragrance_cat, $term->term_id, 'product_cat') ) && ( $tax->attribute_name !== 'product-type' && term_is_ancestor_of( $fragrance_cat, $term->term_id, 'product_cat') ) ) {

                                        

                                    } elseif ($tax->attribute_name == 'product-type') {

                                        if (term_is_ancestor_of($skin_cat, $term->term_id, 'product_cat') || term_is_ancestor_of($sun_cat, $term->term_id, 'product_cat') || term_is_ancestor_of($makeup_cat, $term->term_id, 'product_cat') ) {

                                            

                                    } else { ?>

                                        <div class="filter-container">

                                            <div class="filter-cont">

                                                <div class="inner-filter-cont">

                                                    <?php echo do_shortcode('[br_filters title="Product Type" type="checkbox" operator="OR" attribute="pa_product-type" hide_collapse_arrow="1" order_values_by="Alpha" show_product_count_per_attr="1"]'); ?>

                                                </div>

                                            </div>

                                        </div>

                                    <?php                                             

                                        }

                                    } else {

                                        if ( (term_is_ancestor_of($bath_cat, $term->term_id, 'product_cat')) || term_is_ancestor_of($men_cat, $term->term_id, 'product_cat') ) {

                                        } else {

                                            $filter_title_txt = str_replace('-', ' ', $tax->attribute_label);

                                            $filter_title = ucwords($filter_title_txt);

                                        ?>

                                            <div class="filter-container <?php echo $tax->attribute_name; ?>">

                                                <div class="filter-cont">

                                                    <div class="inner-filter-cont">

                                                        <?php echo do_shortcode('[br_filters title="' . $filter_title . '" type="checkbox" operator="OR" attribute="pa_' . $tax->attribute_name . '" hide_collapse_arrow="1" order_values_by="Alpha" show_product_count_per_attr="1"]'); ?>

                                                    </div>

                                                </div>

                                            </div>

                                        <?php                                            

                                        }

                                    }

                                endif;

                            endforeach;

                        endif;                            

                    ?>

                <div class="filter-container price-container">
                    <div class="price-filter-cont">
                        <div class="price-inner-filter-cont">
                            <?php
                                echo do_shortcode('[br_filters widget_type="filter" filter_type="attribute" attribute="price" type="slider" title="Price" hide_collapse_arrow="1"]');
                                ?>
                        </div>
                    </div>
                </div>

                    </div>

                    <div class="products-container">

                        <div class="product-sorting-bar">

                            <div class="sorting-container">

                                <div class="filter-trigger">

                                    <span>Filter</span>

                                </div>

                                <?php do_action( 'woocommerce_before_shop_loop' ); ?>

                            </div>

                        </div>

                        <?php woocommerce_product_loop_start(); ?>

                        <?php woocommerce_product_subcategories(); ?>

                        

                        <?php while ( have_posts() ) : the_post(); ?>



                            <!-- Product Loop -->

                            <?php wc_get_template_part( 'content', 'product' ); ?>

                        <?php endwhile; ?>



                        <?php woocommerce_product_loop_end(); ?>

                        <div class="navigation">

                            <div class="nav-previous alignleft">
                                <?php previous_posts_link( '<div class="arrow-cont">
                                    <div class="arrow"></div>                                            
                                </div>
                                PREV' ); ?>
                            </div>

                            <div class="nav-next alignright">
                                <?php next_posts_link( 'NEXT 
                                <div class="arrow-cont">
                                    <div class="arrow"></div>                                            
                                </div>' 
                                ); ?>

                            </div>

                        </div>
                    
                    </div>

                    <?php

                        /**

                         * woocommerce_after_shop_loop hook

                         *

                         * @hooked woocommerce_pagination - 10

                         */

                    ?>

                    <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                        <?php wc_get_template( 'loop/no-products-found.php' ); ?>

                            <?php endif; ?>

                                <?php

                /**

                 * woocommerce_after_main_content hook

                 *

                 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)

                 */

                do_action( 'woocommerce_after_main_content' );  

            }

            ?>

        </div>