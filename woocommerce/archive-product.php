<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $wpdb; // WordPress Database Access Abstraction Object
get_header( 'shop' ); ?>
   
<?php
//Gets slug of the page when the page is a parent of brands
$brands_cat = get_term_by('name', 'Brands', 'product_cat')->term_id;
//Denotes the queried object to obtain the necessary details from here about the specific brand
$queried_object = get_queried_object();
$cateID = $queried_object->term_id;
//Get the WP_TERM object that gets term_id, name, slug, term_group, term_taxonomy_id, taxonomy, description and parent
//In case of a brand page such as product-category/brands/calvin-klein, the parent will be 6354 - Brands
$term = get_term_by('id', $cateID, 'product_cat');
//Get information about the current brand such as post_content, date, ID etc...
$curr_brand = get_brand($term->name)->post;
//Gets the slug of the brand such as calvin-klein
$post_name = $curr_brand->post_name;
//CALLING DIOR CUSTOM PAGE FOR FRANKS
if($post_name == 'dior' || $queried_object->slug == 'dior'){
    //INCLUDING THE DIOR ARCHIVE PRODUCT PAGE
    include 'dior-archive-product.php';
    //STOPPING EXECUTION OF CURRENT PHP FILE AND CONTINUING WITH STATED ABOVE
    return;
}
if(has_term('dior-categories', 'product_cat')){
    //INCLUDING THE DIOR CUSTOM CATEGORIES PAGE
    include 'dior-content-product.php';
    //STOPPING EXECUTION OF CURRENT PHP FILE AND CONTINUING WITH STATED ABOVE
    return;
}

$parent_array = get_ancestors($cateID, 'product_cat');
sort($parent_array);
$parent_term = get_term_by('id', $parent_array[0], 'product_cat');
$parent_slug = $parent_term->slug;

if($parent_slug == 'dior-categories'){
    include 'dior-content-product.php';
    return;
}
//Unsure what this achieves
if (!isset($curr_brand) && isset($_GET['brand'])) {
    $curr_brand = get_post($_GET['brand']);
}
$brand_banner = wp_get_attachment_url( get_post_thumbnail_id($curr_brand->ID) );
$brand_logo = get_field('brand_logo', $curr_brand->ID);
//$brand_logo =  wp_get_attachment_url(get_post_thumbnail_id($curr_brand->ID));
$brand_banner_arch = wp_get_attachment_url(get_post_thumbnail_id($curr_brand->ID));
$how_to_link = get_how_to_use_link($cateID);
//If statement that checks whether the parent of the current brand page is part of the brands category or not
//If the page is part of brands, the information is fed from the respective Franks Brands CPT and then shown into this page
//For example /product-category/brands/calvin-klein/
if ( $term->parent == $brands_cat || isset($_GET['brand'])/* && z_taxonomy_image_url() != "" */) {
    ?>
    <?php do_action( 'woocommerce_before_single_product'); ?>
    <div class="brand-banner" style="padding: 179px 0 0;">
        <?php
            if ( $_GET['bpage'] == 'products' || isset($_GET['brand']) ) {
                if ($brand_banner_arch == "") {
        ?>
                    <div class="inner-banner logo-holder"> <img src="<?php echo $brand_logo; ?>" alt=""> </div>
        <?php                        
                } else {
        ?>
                    <div class="inner-banner"> <img src="<?php echo $brand_logo; ?>" alt="" style="max-height: 300px; width: auto;"> </div>
        <?php
                }
            } else {
                if (get_post_meta($curr_brand->ID, 'brands_post_banner_link', true) !== "") {
        ?>
                    <a href="<?php echo get_field('brand_banner_link', $curr_brand->ID); ?>">
                        <img class="inner-brand-banner" src="<?php echo $brand_banner; ?>" alt="">
                    </a>                        
        <?php
                } else {
        ?>                   
                    <a href="<?php echo get_field('brand_banner_link', $curr_brand->ID); ?>">
                        <img class="inner-brand-banner" src="<?php echo $brand_banner; ?>" alt="">
                    </a>
        <?php
                }
            }
        ?>
    </div>
    <?php
    } else {
?>               
<!-- Post id of Shop main page -->
<?php 

// verify that this is a product category page
if ( is_product_category() ){
    global $wp_query;
    $cat = $wp_query->get_queried_object();
    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 
	
	//if (term_is_ancestor_of(12725, $cateID,'product_cat') || is_term( 12725, 'product_cat' )){
	if ( $cat->term_id=="12725" ){
		// echo "<div class='fns-slider-class'>";
		// echo do_shortcode( '[rev_slider alias="Category slider"]' );
        // echo "</div>";
        
		$page_id = get_page_by_path('seasonal-offers');
        ?>

        <div class="desktop-banners homepage-desktop-banners">

        <?php

            while( have_rows('banners-desktop', $page_id->ID) ): the_row(); ?>

                <div class="single-desktop-slide">

                    <img class="banner" src=<?php the_sub_field('image'); ?>>

                    <?php if(get_sub_field('title')){?>
                        
                        <div class="title-overlay">

                            <h3 class="title-text"><?php the_sub_field('title');?></h3>

                    <?php } ?>

                    <?php if(get_sub_field('button_text')){
                        
                        $button_pos = get_sub_field('button_position');
                        $button_color = get_sub_field('button_color_picker');
                        $text_color = get_sub_field('text_in_button_color_picker');

                        ?>

                        <a class="button-link" href=<?php the_sub_field('link'); ?> style="<?php 
                            if($button_pos == "Left"){
                                echo "left: calc((100vw/786)*125);right:unset;margin:unset;";
                            }else if($button_pos == "Right"){
                                echo "right: calc((100vw/786)*125);left:unset;margin:unset;";
                            }
                            if($button_color !== "#2f3030"){
                                echo "background-color:".$button_color.";";
                            }
                            if($text_color !== "#ffffff"){
                                echo "color:".$text_color.";";
                            }
                        ?>">

                            <span class="button-text">
                                <?php the_sub_field('button_text');?>
                            </span>

                        </a>

                    <?php } ?>

                    <?php if(get_sub_field('title')){?>
                        
                        </div>

                    <?php } ?>


                </div>	

            <?php endwhile; ?>

        </div>

        <div class="mobile-banners homepage-mobile-banners">
        <?php

        while( have_rows('banners-mobile', $page_id->ID) ): the_row(); ?>

            <div class="single-mobile-slide">

                <img class="banner" src=<?php the_sub_field('image'); ?>>

                <?php if(get_sub_field('title')){?>
                    
                    <div class="title-overlay">

                        <h3 class="title-text"><?php the_sub_field('title');?></h3>

                <?php } ?>
                
                <?php if(get_sub_field('button_text')){
                    
                    $button_color = get_sub_field('button_color_picker');
				    $text_color = get_sub_field('text_in_button_color_picker');
                    ?>

                    <a class="button-link" href=<?php the_sub_field('link'); ?> style="<?php 
                        if($button_color !== "#2f3030"){
                            echo "background-color:".$button_color.";";
                        }
                        if($text_color !== "#ffffff"){
                            echo "color:".$text_color.";";
                        }
                    ?>">

                        <span class="button-text">
                            <?php the_sub_field('button_text');?>
                        </span>

                    </a>
                
                <?php } ?>

                <?php if(get_sub_field('title')){?>
                    
                    </div>

                <?php } ?>


            </div>	

        <?php endwhile; ?>
    </div>

    <?php
	}else
	{	
		$image = wp_get_attachment_url( $thumbnail_id ); 
		?>

        <?php 
        $current_category = get_queried_object();
        $parent_id = $current_category->parent;
        $parent = get_term_by('id', $parent_id, 'product_cat');

        $categ = get_ancestors($current_category->term_id, 'product_cat');
        $custom = get_term_by( 'slug', 'seasonal-offers', 'product_cat' );
        $status = false;
        foreach($categ as $c){
            if($c == $custom->term_id){
                $status = true;
            }
        }
        ?>

        <div class='fns-banner-class <?= $cat->slug; ?> <?php if($status == true){ echo 'seasonal-offers-section ';} ?>'>
			<div style="background-image: url(<?= $image; ?>)"><h1><?=  trim($cat->name); ?></h1></div>
		</div>
		<?php
	}
}


/*
if (has_post_thumbnail( 1610 ) ):
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(1610), 'single-post-thumbnail'); 
    include(dirname(__FILE__).'../../page-templates/banner.php');
endif; 
*/


$title = 'The art of living beautiful';
$post_title = strtolower( str_replace( " ","-",( get_the_title() ) ) );
echo "<div class='fnk-art-class $post_title' >";
include(dirname(__FILE__)."/../page-templates/title-divider.php");
echo "</div>";
?>

<?php 
	if (! (term_is_ancestor_of(12725, $cateID,'product_cat') || (is_term( 12725, 'product_cat' ) && $cateID == 12725)) )
	{ 
?>
	<script>
	$(function () {
		if ($(document).scrollTop() == 0) {
			$("html, body").animate({
				scrollTop: $('.page-container').offset().top - $('.site-header').height() - 150 
			}, 1000);
		}
	})
	</script>

<?php } ?>

<?php 
woocommerce_breadcrumb(); 

} ?>

<div class="page-container">
    <?php
    if ( $term->parent == $brands_cat && $_GET['bpage'] !== 'products' ) {
        ?>

            <div class="shop-sidebar brand-bar">
                <div class="filter-container category-container">

                    <div class="filter-trigger close-sidebar">
                        <span>Close</span>
                    </div>

                    <h1><?php echo $curr_brand->post_title; ?></h1>

                    <div style="display:none">
                        <?php var_dump($term->slug); ?>
                    </div>

                    <?php
                    $product_categories = $wpdb->get_results($wpdb->prepare(
                        "CALL get_brand_product_categories(%s)",
                        $term->slug
                    ));

                    $brand_categories = array();

                    // for each product category parent
                    foreach ($product_categories as $category) {
                        $id = intval($category->parent);
                        $product_cat = get_term($id);
                        if ($product_cat->parent !== 0) {
                            // get parent -> top level category
                            $parent = get_term($product_cat->parent);
                            // add to array
                            if (array_key_exists($parent->term_id, $brand_categories)) {

                                if (!in_array($product_cat->term_id, $brand_categories[$parent->term_id]['sub_cats'])) {
                                    $brand_categories[$parent->term_id]['sub_cats'][$product_cat->term_id] = $product_cat->name;
                                }

                            }else {

                                $brand_categories[$parent->term_id] = array(
                                    'title' => $parent->name,
                                    'sub_cats' => array(
                                        $product_cat->term_id => $product_cat->name
                                    )
                                );

                            }
                        }
                    }
                    ?>

                    <?php wp_reset_query(); ?>

                    <?php
                    asort($brand_categories);

                    foreach ( $brand_categories as $main_category ) {
                        echo '<div class="brand-cat-filter">';
                        echo '<figure class="parent_filter">' . $main_category['title'] . '</figure>';

                        asort($main_category['sub_cats']);
                        
                        $term_link = get_term_link($queried_object->term_id, 'product_cat');
                        
                        foreach ($main_category['sub_cats'] as $subcat_id => $title) {
                            echo '<a href="' . $term_link . '?bpage=products&cat_id=' . $subcat_id . '&filters=product_cat[' . $subcat_id . ']">' . $title . '</a><br>';
                        }

                        echo '</div>';
                    }
                    ?>

                </div>

                <?php
                $args = array( 'posts_per_page' => -1, 'post_type' => 'post', 'category_name' => $curr_brand->post_title );

                $myposts = get_posts( $args );

                if ( sizeof($myposts) > 0 ) { ?>

                    <div class="explore-brand">
                        <h3>Explore<br>the Brand</h3>
                        <ul>
                            <?php    
                            foreach ( $myposts as $post ) : setup_postdata( $post ); 
                            ?>

                            <li>
                                <a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
                            </li>

                            <?php 
                            endforeach;
                            wp_reset_postdata();
                            ?>

                        </ul>
                    </div>
                <?php
                }
                ?>

            </div>
            
            <?php 
            $parent_term = get_term_by('id', $queried_object->parent, 'product_cat');
            ?>

            <div class="products-container <?php echo 'term-'.$parent_term->slug.'-cols';?>">

                <?php echo $how_to_link; ?>

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
                    //                'meta_key' => 'total_sales',
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

                        wp_reset_query();
                        ?>

                    </ul>
                                
                </div>

                <div class="best-sellers-cont woocommerce">

                    <div class="title-holder">
                        <h2>Best Sellers</h2>
                    </div>

                    <ul class="products">

                        <?php
                        $args = array(
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
                        $url = get_field("brand_video_link", $curr_brand->ID); 
                        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                        $id = $matches[1];    
                    ?>
                    
                    <?php if ($url !== ""){?>

                        <iframe type="text/html" width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>
                    
                    <?php }else{ ?>

                        <?php $brand_media_image = get_field('brand_media_image', $curr_brand->ID); ?>
                        <img src="<?php echo $brand_media_image; ?>" alt="">

                    <?php } ?>
                    
                    <div class="brand-text">
                        <?php echo apply_filters('the_content', $curr_brand->post_content); ?>
                    </div>

                </div>
            </div>

            <?php
            } else {
            ?>

                <?php //woocommerce_breadcrumb(); ?>
                <?php //var_dump($curr_brand); 
                    if ($_GET['bpage'] == 'products' || isset($_GET['brand'])) {
                        
                    ?>
                        <div class="brand-back">
                            <?php
                            $title = 'The art of living beautiful';
                            include(dirname(__FILE__)."/../page-templates/title-divider.php");
                            ?>

                            <div class="inner-post">
                                <a href="<?php echo get_home_url() . '/product-category/brands/' . $curr_brand->post_name; ?>">
                                    <div style="display:inline-block" class="arrow-cont">
                                        <div class="arrow"></div>                                            
                                    </div>
                                    <span>Go back to <strong><?php echo $curr_brand->post_title; ?></strong></span>
                                </a>                                       
                            </div>
                        </div>                                        
                    <?php
                    } 
                                    
                    $q_object = get_queried_object();
                    $this_term = $q_object->term_id;

                    if ( $_GET['bpage'] == 'products' ) {
                        $this_term = $_GET['cat_id'];
                    }        

                    $taxonomy = 'product_cat';
                    $termchildren = get_terms($taxonomy, array('parent' => $this_term,'hide_empty'=>1));
                
                    ?>
                                        
                    <div class="children-sidebar shop-sidebar <?php echo ($term->count == 0 && sizeof($termchildren) == 0) ? "no-products-side" : ""; ?>">

                        <div class="filter-trigger close-sidebar">
                            <span>Close</span>
                        </div>

                        <?php get_product_search_form(); ?>
                        
                                        <!--
                        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                            <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

                        <?php endif; ?>
        -->
                        <?php
                        do_action( 'woocommerce_archive_description' );
                        ?>

                        <?php if ( have_posts() ) : ?>

                        <?php
                        /**
                         * woocommerce_before_shop_loop hook
                         *
                         * @hooked woocommerce_result_count - 20
                         * @hooked woocommerce_catalog_ordering - 30
                         */
        //				do_action( 'woocommerce_before_shop_loop' );

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
						
						/*if (term_is_ancestor_of(12725, $cateID,'product_cat') || (is_term( 12725, 'product_cat' ) && $cateID == 12725)){
						?>
						<div class="filter-container category-container">
						<h3 class="widget-title">
                            <span>Categories</span>
                        </h3>
						<?php
						//echo do_shortcode('[product_category category="seasonal-offers"]');
						
						$args = array(
								'show_option_none' => '',
								'hide_empty' => 0,
								'orderby' => 'name',
								'order'   => 'ASC',
								'parent' => 12725,
								'taxonomy' => 'product_cat'
						);
						$subcats = get_categories($args);
						echo '<div class="seasonal-offers"><ul class="wooc_sclist">';
						foreach ($subcats as $sc) {
							
							if (term_is_ancestor_of(12725, $cateID,'product_cat') || (is_term( 12725, 'product_cat' ) && $cateID == 12725)){
								$latest = "?orderby=date";
								if($this_term != '12725') {
									$display = "display:block";
								}else{
									$display = "display:none";
								}
							}else{ 
								$latest = ""; 
							}
							$link = get_term_link( $sc->slug, $sc->taxonomy );
							
							$args2 = array(
							   'show_option_none' => '',
							   'hide_empty' => 0,
							   'orderby' => 'date',
								'order'   => 'ASC',
							   'parent' => $sc->term_id,
							   'taxonomy' => 'product_cat'
							);
							$subsubcategories = get_categories( $args2 );
							
							if(count( $subsubcategories ) > 0){
								echo '<li class="child-filter cat-parent"><a href="'. $link .''.$latest.'">'.$sc->name.'</a>';
								echo '<ul class="subsubcat children" style="'.$display.'">';
								foreach ($subsubcategories as $subcat) {
									$link2 = get_term_link( $subcat->slug, $subcat->taxonomy );
									echo '<li class="child-filter"><a href="'. $link2 .''.$latest.'">'.$subcat->name.'</a><li>';
								}
								echo '</ul></li>';
							} else {
								echo '<li class="child-filter"><a href="'. $link .'">'.$sc->name.'</a></li>';
							}
							
							  
						}
						echo '</ul></div>';
						
						?>
						</div>
						<?php
						} else {*/
                        if (sizeof($termchildren) > 0) {
                            // var_dump($q_object);
                        ?>
                       
                        <?php
											
						$queried_object = get_queried_object();
						
						$cateID = $queried_object->term_id;
						
						
                        if ($_GET['bpage'] == 'products' ) {
							
						?>
						 <div class="filter-container category-container">
						<?php
                            $subcategories = $wpdb->get_results($wpdb->prepare(
                                "SELECT DISTINCT t.*, tt.*
                                FROM `wp_terms` t
                                JOIN `wp_term_taxonomy` tt ON (t.term_id = tt.term_id)
                                JOIN `wp_term_relationships` tr ON (tt.term_taxonomy_id = tr.term_taxonomy_id)
                                JOIN `wp_posts` p ON (tr.object_id = p.ID)
                                WHERE p.post_type = \"product\" and tt.parent = %d and p.ID IN (
                                    SELECT DISTINCT p.ID
                                    FROM `wp_posts` p
                                    JOIN `wp_term_relationships` tr ON (p.ID = tr.object_id)
                                    JOIN `wp_term_taxonomy` tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
                                    JOIN `wp_terms` t ON (tt.term_id = t.term_id)
                                    WHERE p.post_type = \"product\" and t.name = %s
                                )
                                ORDER BY t.name",
                                $_GET['cat_id'], $curr_brand->post_title
                            ));
                        ?>
                                   
                        <h3 class="widget-title">
                            <span>Sub-Categories</span>
                        </h3>
						
                        <?php
                        $brand_term = get_term_by('name', $curr_brand->post_title, 'product_cat');
                        
                        $brand_url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                        
                        $term_link = get_term_link($queried_object->term_id, 'product_cat');

                        // foreach($termchildren as $term) {
                        foreach ($subcategories as $subcat) {
                            
                            $term_id = intval($subcat->term_id);
                            $name = $subcat->name;
                            
                            $brand_filter = '?filters=product_cat[' . $brand_term->term_id . ']&brand=' . $curr_brand->ID;
                            
                            $term_link = get_term_link($queried_object->term_id, 'product_cat');

                            if (strpos($brand_url, '/product-category/brands/') !== true){
                                echo "<li class='child-filter'><a href=" . $term_link . '?bpage=products&cat_id=' . $term_id . '&filters=product_cat[' . $term_id . ']><label>' . $name . '</label></a></li>';
                            }else{
                                echo "<li class='child-filter'><a href='" . get_term_link($term_id) . $brand_filter . "'><label>" . $name . "</label></a></li>";

                            }                        
                        }
					
					?></div><?php 
					
                    }
					 else{
						 
						/* if($cateID != 6518)
						 {*/
					
                    ?>
					     
                        <h3 class="widget-title">
                            <span>Sub-Categories</span>
                        </h3>
						<div class="seasonal-offers">
                    <?php

                        foreach($termchildren as $term) {
    //                                        var_dump($term);
                            echo "<li class='child-filter'><a href='" . get_term_link($term) . "'><label>" . $term->name . "</label></a></li>";

                        }
						
                                ?>
								</div><?php
						/* }*/
                    }
					                    ?>
                    

                <?php
						}
                /*}*/
                
                if ($_GET['bpage'] !== 'products' && !isset($_GET['brand'])) { ?>

                    <div class="clear-filters">

                    <?php
                        echo do_shortcode('[br_filter_single filter_id=261995]');
                    ?>

                    </div>
                            
                    <div class="filter-container brand-container">
                        <div class="filter-cont">
                            <div class="inner-filter-cont">
                                <?php
                                $brands_cat = get_term_by('name', 'Brands', 'product_cat')->term_id;
                                //echo do_shortcode('[br_filters filter_type="product_cat" type="checkbox" title="Brands" operator="OR" parent_product_cat="' . $brands_cat . '" hide_collapse_arrow="1" cat_propagation="" order_values_by="Alpha"]');
                                ?>
                            </div>
                        </div>
                    </div>

                <?php
                } else {
                    if (isset($_GET['brand'])):
                ?>
                        <div class="clear-filters">

                        <?php
                            echo do_shortcode('[br_filters widget_type="reset_button" title="Clear Filters"]');
                        ?>

                        </div>

                    <?php endif; ?>
                            
                    <div class="filter-container brand-container" style="display: none">
                        <div class="filter-cont">
                            <div class="inner-filter-cont">
                                <?php
                                $brands_cat = get_term_by('name', 'Brands', 'product_cat')->term_id;
                                //echo do_shortcode('[br_filters filter_type="product_cat" type="checkbox" title="Brands" operator="OR" parent_product_cat="' . $brands_cat . '" hide_collapse_arrow="1" cat_propagation="" order_values_by="Alpha"]');
                                ?>
                            </div>
                        </div>
                    </div>

                <?php
                }
            
                $attribute_taxonomies = wc_get_attribute_taxonomies();
                $taxonomy_terms = array();
                global $product;

                if ( /*($attribute_taxonomies && $_GET['bpage'] == 'products') ||*/ ($attribute_taxonomies && sizeof($termchildren) == 0 && $_GET['bpage'] !== 'products') /*&&  && */ ) :
                    foreach ($attribute_taxonomies as $tax) :        
                        if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name)) && $tax->attribute_name != 'barcode') :
                            
                            // var_dump($tax->attribute_name);                    
        
                            if ( $tax->attribute_name == 'gender' || ( $tax->attribute_name !== 'fragrance-family' && term_is_ancestor_of( $fragrance_cat, $term->term_id, 'product_cat') ) && ( $tax->attribute_name !== 'product-type' && term_is_ancestor_of( $fragrance_cat, $term->term_id, 'product_cat') ) ) {
                                
                            } elseif ($tax->attribute_name == 'product-type') {
                                
                                if (term_is_ancestor_of($skin_cat, $term->term_id, 'product_cat') || term_is_ancestor_of($sun_cat, $term->term_id, 'product_cat') || term_is_ancestor_of($makeup_cat, $term->term_id, 'product_cat') ) {
                                    
                                } else {
                                // var_dump($tax->attribute_name);
                                // echo "test1";
                            ?>
                                    <div class="filter-container">
                                        <div class="filter-cont">
                                            <div class="inner-filter-cont">
                                                <?php
                                                //echo do_shortcode('[br_filters title="Product Type" type="checkbox" operator="OR" attribute="pa_product-type" hide_collapse_arrow="1" order_values_by="Alpha" show_product_count_per_attr="1"]');
                                                ?>
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
                                                <?php
                                                // echo do_shortcode("[br_filters widget_type='filter' title='" . $filter_title . "' attribute='pa_" . $tax->attribute_name . "' operator='OR' hide_collapse_arrow='1' order_values_by='Alpha']");
                                                //echo do_shortcode('[br_filters title="' . $filter_title . '" type="checkbox" operator="OR" attribute="pa_' . $tax->attribute_name . '" hide_collapse_arrow="1" order_values_by="Alpha" show_product_count_per_attr="1"]');
                                                ?>
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

                <div class="filter-container price-container primary-filter-container">

                    <?php $url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];?>

                    <?php $myArray = explode('/', $url);
                    $myArrayCount = count($myArray);
                    ?>

                    <?php if(strpos($url, 'fragrance') !== false && $myArrayCount >= 8){?>

                        <div class="product-type-filter-cont child-filter">
                            <?php
                                // PRODUCT-TYPE FILTER
                                echo do_shortcode('[br_filter_single filter_id=235039]');
                            ?>
                        </div>

                    <?php }else{

                    } ?>

                    <?php if (strpos($url, '/product-category/brands/') !== false || strpos($url, '&brand') !== false){?>

                        <div class="hidden-filter" style="display: none;">
                        
                            <?php echo do_shortcode('[br_filter_single filter_id=248869]'); ?>

                        </div>

                    <?php
                    }else{?>
                        <div class="brand-filter-cont child-filter">
                            <?php
                                // BRANDS FILTER
                                echo do_shortcode('[br_filter_single filter_id=235025]');
                            ?>
                        </div>
                   <?php }
                    ?>
                    
                    <?php if($myArrayCount >= 8 || (strpos($url, '/product-category/brands/') !== false && $myArrayCount >= 7)){?>
                        <div class="skin-types-filter-cont child-filter">
                            <?php
                                // SKIN TYPES FILTER
                                echo do_shortcode('[br_filter_single filter_id=235021]');
                            ?>
                        </div>
                        
                        <div class="benefits-filter-cont child-filter">
                            <?php
                                // BENEFITS FILTER
                                echo do_shortcode('[br_filter_single filter_id=235091]');
                            ?>
                        </div>

                        <div class="concern-filter-cont child-filter">
                            <?php
                                // CONCERN FILTER
                                echo do_shortcode('[br_filter_single filter_id=235022]');
                            ?>
                        </div>

                        <div class="coverage-filter-cont child-filter">
                            <?php
                                // COVERAGE FILTER
                                echo do_shortcode('[br_filter_single filter_id=235092]');
                            ?>
                        </div>

                        <div class="finish-filter-cont child-filter">
                            <?php
                                // FINISH FILTER
                                echo do_shortcode('[br_filter_single filter_id=235093]');
                            ?>
                        </div>

                        <div class="formulation-filter-cont child-filter">
                            <?php
                                // FORMULATION FILTER
                                echo do_shortcode('[br_filter_single filter_id=235094]');
                            ?>
                        </div>

                        <div class="fragrance-family-filter-cont child-filter">
                            <?php
                                // FRAGRANCE FAMILY FILTER
                                echo do_shortcode('[br_filter_single filter_id=235095]');
                            ?>
                        </div>

                        <div class="hair-concern-filter-cont child-filter">
                            <?php
                                // HAIR CONCERN FILTER
                                echo do_shortcode('[br_filter_single filter_id=235096]');
                            ?>
                        </div>

                        <?php if (strpos($url, '/product-category/brands/') !== false || strpos($url, '&brand') !== false){?>
                            
                            <div class="product-type-filter-cont child-filter">
                                <?php
                                    // PRODUCT-TYPE FILTER
                                    echo do_shortcode('[br_filter_single filter_id=235039]');
                                ?>
                            </div>

                        <?php } ?>

                        <div class="texture-filter-cont child-filter">
                            <?php
                                // TEXTURE FILTER
                                echo do_shortcode('[br_filter_single filter_id=235023]');
                            ?>
                        </div>

                        <div class="time-of-use-filter-cont child-filter">
                            <?php
                                // TIME OF USE FILTER
                                echo do_shortcode('[br_filter_single filter_id=235024]');
                            ?>
                        </div>

                        <div class="spf-protection-filter-cont child-filter">
                            <?php
                                // SPF PROTECTION FILTER
                                echo do_shortcode('[br_filter_single filter_id=235020]');
                            ?>
                        </div>

                        <div class="use-filter-cont child-filter">
                            <?php
                                // USE FILTER
                                echo do_shortcode('[br_filter_single filter_id=235097]');
                            ?>
                        </div>

                    <?php } ?>
                    
                    <!-- //ALWAYS SHOWN -->
                    <div class="price-filter-cont child-filter">
                        <div class="price-inner-filter-cont">
                            <?php
                                // PRICE TROLLEY FILTER
                                echo do_shortcode('[br_filter_single filter_id=261993]');
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <?php do_action( 'woocommerce_before_single_product'); ?>
            <div class="products-container children-prod-container">
                <?php echo $how_to_link; ?>
                <div class="product-sorting-bar">
                    <div class="sorting-container">
                        <div class="filter-trigger">
                            <span>Filter</span>
                        </div>

                        <?php
                        do_action( 'woocommerce_before_shop_loop' );
                        //do_shortcode('[br_filters filter_type="attribute" type="slider" hide_collapse_arrow="1"]')
                        ?>

                    </div>
                </div>
				
                <?php if($queried_object->slug == "seasonal-offers"){?>
                    <div>
                    <?php 
                        // Category Listing By alphabetically
                        $terms = get_terms($taxonomy, array('parent' => $this_term,'hide_empty'=>1));

                        if ( !empty( $terms ) && !is_wp_error( $terms ) ){    
                        $term_list = [];    
                        foreach ( $terms as $term ){
                            $first_letter = strtoupper($term->name[0]);
                            $term_list[$first_letter][] = $term;
                        }
                        unset($term);

                        echo '<div class="seasonal-offers"><ul class="wooc_sclist">';
                            
                            foreach ( $term_list as $key=>$value ) {
                                foreach ( $value as $term ) {
                                    echo "<div class='fns-product-title'>".$term->name."</div>";
                                    echo "<div class='test' style='display:none;'>";
                                    var_dump($term);
                                    echo "</div>";
                                    //echo do_shortcode('[products limit="9" column="3" category="'.$term->slug.'"]');

                                    // woocommerce_product_loop_start();
                                    // while ( have_posts() ) : the_post();
                                    //     wc_get_template_part( 'content', 'product' );
                                    // endwhile; 
                                    // woocommerce_product_loop_end();

                                    $args = array(
                                        'post_type'             => 'product',
                                        'post_status'           => 'publish',
                                        'posts_per_page'        => '6',
                                        'tax_query'             => array(
                                            array(
                                                'taxonomy'      => 'product_cat',
                                                'terms'         => $term->term_id,
                                                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                                            )
                                        )
                                    );
                                    $products = new WP_Query($args);

                                    // echo "<div class='test' style='display:none;'>";
                                    // echo '<pre>' . var_export($products->posts, true) . '</pre>';
                                    // echo "</div>";
                                    
                                    $counter_prod = 0;
                                    woocommerce_product_loop_start();

                                    if ( $products->have_posts() ) {
                                        while ( $products->have_posts() ) : $products->the_post();
                                            wc_get_template_part( 'content', 'product' );
                                        endwhile;
                                    }

                                    // foreach($products->posts as $pid){
                                    //     echo "<div class='test-id' style='display:none;'>";
                                    //     echo '<pre>' . var_export($pid->ID, true) . '</pre>';
                                    //     echo "</div>";
                                    //     $post = wc_get_product($pid->ID);
                                    //     echo "<div class='test-prod' style='display:none;'>";
                                    //     echo '<pre>' . var_export($post, true) . '</pre>';
                                    //     echo "</div>";
                                    // }

                                    // while(have_posts() && $counter_prod < 6){

                                    //     the_post();
                                    //     wc_get_template_part( 'content', 'product' );
                                    //     $counter_prod++;
                                    // }
                                    woocommerce_product_loop_end();

                                    wp_reset_postdata();

                                    $term_link = get_term_link($term->slug, 'product_cat');

                                    //do_action( 'woocommerce_after_shop_loop' );

                                    echo "<div class='seasonal-view-more'>
                                            <a href=".$term_link.">
                                                <span>VIEW ALL</span>
                                            </a>
                                        </div>";

                                }
                            }

                        echo '</ul></div>';
                        }

                    
                    ?>
                    </div>
                <?php }else{ ?>

                    <?php woocommerce_product_loop_start(); ?>
                <?php woocommerce_product_subcategories(); ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    <?php endwhile; // end of the loop. ?>
                    <?php woocommerce_product_loop_end(); ?>

                    <?php
                    do_action( 'woocommerce_after_shop_loop' );
                    ?>

                <?php } ?>
			
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
            ?>

            <?php
                /**
                 * woocommerce_sidebar hook
                 *
                 * @hooked woocommerce_get_sidebar - 10
                 */
                do_action( 'woocommerce_sidebar' );       
            }
        ?>
    </div>
    <div class="overlay"></div>
<?php get_footer( 'shop' ); ?>