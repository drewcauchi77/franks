<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wpdb;

get_header(); ?>

<div id="content" class="site-content dior-content">

    <div class="dior-container">

        <div class="page-header dior-header">

            <?php 

            $tag = get_term_by('slug', 'dior-categories','product_cat');

            $diorcat_id = get_woocommerce_term_meta($tag->term_id, 'thumbnail_id', true);
            $dior_image = wp_get_attachment_url( $diorcat_id );

            $page = get_page_by_title('Dior');

            ?>

            <a href="https://franks.com.mt/product-category/brands/dior/"><img class="dior-logo" src=<?php echo $dior_image; ?>></a>

        </div>

        <div class="dior-image-sliders">

            <?php if( have_rows('banners', $page->ID) ): ?>

            <div class="dior-campaign-banner">

            <?php while( have_rows('banners', $page->ID) ): the_row(); ?>

                <a href="<?php the_sub_field('link');?>">

                    <img class="banner" src=<?php the_sub_field('image'); ?>>
                    
                </a>

            <?php endwhile; ?>

            </div>

        <?php endif; ?>

        </div>

        <div class="woo-path">

            <?php woocommerce_breadcrumb(); ?>

        </div>

        <div class="dior-main-navigation">

        <div class="navigation-title">

            <h1><a href="https://franks.com.mt/product-category/brands/dior/">Dior</a></h1>

        </div>

            <?php include 'dior-custom-categories.php'; ?>
        
        </div>
        
        <div class="dior-description">
        
            <?php $term = get_queried_object(); ?>

            <p class="brand-desc"><?php echo $term->description; ?></p>

        </div>

        <div class="dior-desktop-navigation">

            <h5 class="section-title">Change Universe:</h5>

                <?php

                foreach($term_id as $term){

                    //assigning the term value saved in an stdObject to a variable to be accessible
                    $term_value = $term->term_id;

                }

                $counter = 0;

                foreach($main_product_categories as $cat){

                    // Obtain the t.name stated above by the SQL query from stdObject
                    $category_name = $cat->name;

                    // Obtain the t.term_id stated above by the SQL query from stdObject
                    $category_id = $cat->term_id;
                    $link = get_category_link($category_id);

                    $counter++;

                    if($counter <= 5){
                        echo '<h5><a href="'. $link .'?orderby=date">'. $category_name . '</a></h5>';
                    }else{
                        //do nothing
                    }

                } 

                ?>

        </div>
        
        <div class="dior-highlighted-section">

            <div class="highlighted-section">
                <?php
                
                $backstage_pros = get_term_by('slug', 'backstage-pros','product_cat');
                $backstagepros_id = get_woocommerce_term_meta($backstage_pros->term_id, 'thumbnail_id', true);
            
                $backstagepros_image = get_field('backstage_pros_image', $page->ID);
                $backstagepros_url = get_category_link($backstage_pros->term_id);
                ?>
                <img class="backstage-pros-img" src="<?php echo $backstagepros_image; ?>">

                <h3>Backstage Pros</h3>

                <a href="<?php echo $backstagepros_url; ?>"><span>Learn More</span></a>

            </div>

            <div class="highlighted-section">

                <?php

                $product_id = get_field('product_id', $page->ID);
                $product_image = get_field('product_image', $page->ID);
                $image_url = wp_get_attachment_url(get_post_thumbnail_id($product_id));
                
                ?>
                
                <img src=<?php echo $product_image; ?>>
                
                <?php

                $product = wc_get_product($product_id);
                
                ?>

                <h3><?php echo $product->get_title(); ?></h3>

                <a href=<?php echo get_permalink($product_id); ?>><span>Learn More</span></a>

            </div>

        </div>

        <div class="whats-new-cont woocommerce-seller">

            <div class="title-holder">
                <h2>What's New</h2>
            </div>

            <ul class="dior-new-slider products">
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

        <div class="best-sellers-cont woocommerce-seller">

            <div class="title-holder">
                <h2>Best Sellers</h2>
            </div>

            <ul class="dior-best-sellers products">
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

        <!-- <div class="dior-expertise-cont woocommerce-seller">
            
            <div class="title-holder">
                <h2>Dior Expertise</h2>
            </div>


            <?php 
            //$dior_expert_id = get_term_by('slug', 'dior-expertise', 'product_cat');
            //$dior_expert_thumbnail = get_woocommerce_term_meta($dior_expert_id->term_id, 'thumbnail_id', true);
            
            //$category_image = wp_get_attachment_url($dior_expert_thumbnail);
            //$dior_expert_url = get_category_link($dior_expert_id->term_id);
            ?>
            <div class="dior-expertise-container">

                <img class="dior-expertise-image" src=<?php //echo $category_image;?>>

                <h3 class="dior-expertise-title"><?php //echo $dior_expert_id->name; ?></h3>

                <p class="dior-expertise-tagline">Discover the unique savoir-faire of Dior</p>

                <a class="dior-expertise-learn" href="<?php //echo $dior_expert_url; ?>"><span>Learn More</span></a>
            
            </div>

        </div> -->

    </div>

</div>

<?php get_footer(); ?>
