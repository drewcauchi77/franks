<?php get_header(); ?>

<?php $current_category = get_queried_object();?>

<div id="content" class="site-content dior-content">

    <div class="dior-child-container">

        <div class="page-header dior-header">

            <?php 

            $tag = get_term_by('slug', 'dior-categories','product_cat');

            $diorcat_id = get_woocommerce_term_meta($tag->term_id, 'thumbnail_id', true);
            $dior_image = wp_get_attachment_url( $diorcat_id );

            $page = get_page_by_title('Dior');

            $parent_id = $current_category->parent;
            $parent = get_term_by('id', $parent_id, 'product_cat');

            ?>

            <a href="https://franks.com.mt/product-category/brands/dior/"><img class="dior-logo" src=<?php echo $dior_image; ?>></a>

        </div>

        <div class="dior-categories-button">

            <h2 class="category-button">See all Dior Categories</h2>

        </div>

        <div class="navigation-area">

            <h1 class="dior-title"><?php echo single_term_title(); ?></h1>

            <?php include 'dior-custom-categories.php'; ?>
            
            <div class="dior-filtering <?php echo 'parent-' . $parent->slug . '-filter '; echo $current_category->slug . '-filter'; ?>">

            <?php $url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];?>

            <?php $myArray = explode('/', $url);
            $myArrayCount = count($myArray);?>

            <?php //if(strpos($url, 'lips-makeup') !== false || strpos($url, 'eyes-makeup') !== false || strpos($url, 'dior-complexion') !== false || strpos($url, 'lips-makeup') !== false){?>

                <div class="navigation-filter-cont child-filter dior-filter">
                    <?php
                        // LEVEL 3 NAVIGATION
                        echo do_shortcode('[br_filter_single filter_id=252639]');

                    ?>
                </div>

            <?php //} ?>
            
            <div class="product-type-filter-cont child-filter dior-filter">
            <?php
                    // PRODUCT-TYPE FILTER
                    echo do_shortcode('[br_filter_single filter_id=252640]');
                ?>
            </div>
            
            <!-- USE FILTER SHOWN IN SKINCARE ONLY -->

            <?php if(strpos($url, 'skincare') !== false){ ?>

                <div class="use-filter-cont child-filter dior-filter">
                    <?php
                        // USE FILTER
                        echo do_shortcode('[br_filter_single filter_id=235097]');
                    ?>
                </div>

            <?php } ?>

            <div class="price-filter-cont child-filter dior-filter">
                <?php
                    // PRICE TROLLEY FILTER
                    echo do_shortcode('[br_filter_single filter_id=261993]');
                ?>
            </div>

        </div>

        </div>
        
        <?php 
        $cat_desc = $current_category->description;
        $desc_array = explode(";", $cat_desc);

        ?>

        <?php if($cat_desc !== ""){?>

            <div class="category-information <?php echo $current_category->slug . '-information';?>">

                <h1 class="category-title"><?php echo single_term_title(); ?></h1>

                <?php 
                $cat_id = get_woocommerce_term_meta($current_category->term_id, 'thumbnail_id', true);
                $category_image = wp_get_attachment_url($cat_id);
                ?>

                <img class="category-image" src=<?php echo $category_image;?>>

                <!-- <div class="category-description">

                    <div class="category-sect">

                        <h3><?php //echo $desc_array[0]; ?></h3>

                        <p><?php //echo $desc_array[1]; ?></p>

                    </div>

                </div> -->


            </div>
        
        <?php } ?>
        
        <?php 
        if($current_category->slug == 'dior-expertise'){

            //INCLUDING THE DIOR EXPERTISE PAGE
            include 'dior-expertise.php';
            //STOPPING EXECUTION OF CURRENT PHP FILE AND CONTINUING WITH STATED ABOVE
            // return;

        }else{
        ?>

        <div class="woo-path">

            <?php do_action('woo_custom_breadcrumb');?>

        </div>
        
        <div class="dior-mob-filtering-button">

            <h2 class="filter-button">Filters</h2>

        </div>
        
        <div class="mobile-dior-filtering <?php echo 'parent-' . $parent->slug . '-filter '; echo $current_category->slug . '-filter'; ?>">

            <?php $url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];?>

            <?php $myArray = explode('/', $url);
            $myArrayCount = count($myArray);?>

            <?php //if(strpos($url, 'lips-makeup') !== false || strpos($url, 'eyes-makeup') !== false || strpos($url, 'dior-complexion') !== false || strpos($url, 'lips-makeup') !== false){?>

                <div class="navigation-filter-cont child-filter dior-filter">
                    <?php
                        // LEVEL 3 NAVIGATION
                        echo do_shortcode('[br_filter_single filter_id=252639]');

                    ?>
                </div>

            <?php //} ?>
            
            <div class="product-type-filter-cont child-filter dior-filter">
            <?php
                    // PRODUCT-TYPE FILTER
                    echo do_shortcode('[br_filter_single filter_id=252640]');
                ?>
            </div>
            
            <!-- USE FILTER SHOWN IN SKINCARE ONLY -->

            <?php if(strpos($url, 'skincare') !== false){ ?>

                <div class="use-filter-cont child-filter dior-filter">
                    <?php
                        // USE FILTER
                        echo do_shortcode('[br_filter_single filter_id=235097]');
                    ?>
                </div>

            <?php } ?>

            <div class="price-filter-cont child-filter dior-filter">
                <?php
                    // PRICE TROLLEY FILTER
                    echo do_shortcode('[br_filters widget_type="filter" filter_type="attribute" attribute="price" type="slider" title="Price" hide_collapse_arrow="1"]');
                ?>
            </div>

        </div>

        <div class="dior-sorting-container">

            <?php do_action( 'woocommerce_before_shop_loop' ); ?>

        </div>

        <?php woocommerce_product_loop_start(); ?>

        <?php woocommerce_product_subcategories(); ?>

        <?php while ( have_posts() ) : the_post(); ?>
            <?php wc_get_template_part( 'content', 'product' ); ?>
        <?php endwhile; ?>

        <?php woocommerce_product_loop_end(); ?>

        <?php do_action( 'woocommerce_after_shop_loop' ); ?>
        
        <?php if($cat_desc !== ""){?>

            <!-- <div class="dior-end-container">

                <?php //if($desc_array[4] !== null){ ?>

                    <img class="closing-img" src=<?php //echo $desc_array[4]; ?>>

                <?php //}else{ ?>

                    <img class="closing-img" src=<?php //echo $category_image; ?>>
                
                <?php //} ?>

                <?php //if($desc_array[2] !== null){

                    //$additional_cat = get_term_by('slug', $desc_array[2], 'product_cat');

                ?>
                    <div class="information-container">

                        <?php?>

                        <h2 class="additional-category-title"><?php //echo $additional_cat->name; ?></h2>
                        
                        <p class="closing-description"><?php //echo $desc_array[3]; ?></p>

                        <a href=<?php 
                            // if($current_category->slug == "backstage-pros"){
                            //     echo get_category_link($additional_cat->term_id) . '#backstage-pros';
                            // }else if($current_category->slug == "skincare"){
                            //     echo get_category_link($additional_cat->term_id) . '#skincare';
                            // }else if($current_category->slug == "womens-fragrance" || $current_category->slug == "mens-fragrance"){
                            //     echo get_category_link($additional_cat->term_id) . '#fragrance';
                            // }else if($current_category->slug == "makeup-dior-categories"){
                            //     echo get_category_link($additional_cat->term_id) . '#makeup';
                            // }else{
                            //     echo get_category_link($additional_cat->term_id);
                            // }
                            ?>>
                            <h2 class="additional-learn-more">Learn More</h2>
                        </a>

                    </div>

                <?php //} ?>

            </div> -->

            <?php } ?>

        <?php } ?>

    </div>

</div>

<?php get_footer(); ?>