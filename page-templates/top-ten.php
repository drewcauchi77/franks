<?php
/**
 * The main template file
 * 
 * Template Name: Top 10 Template	
 * 
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package franks
 */
get_header();
?>

<div id="main" class="page-container top-ten-container">

    <div class="feat-banner-cont top-10-feat">

        <div class="top-10-nav">

            <span id="men" class="top10-button men-button enable">Men</span>

            <span id="women" class="top10-button women-button">Women</span>

        </div>

        <div class="feat-post-cont men-container-slider active">

            <div class="heritage-year-cont">

            <?php
        //        $i = 0;
                $positions = array();
                $top_men = get_top('men');

                while ( $top_men->have_posts() ) : $top_men->the_post();

                    $pos = get_field('top_items_ranking_position');
                    $link = get_field('top_items_product_link');
                    array_push($positions, $pos);
        //        $i++;
                ?>

                    <div class="heritage-set">

                        <div data-color="<?php echo $color; ?>" class="inner-post heritage-year">
                                
                            <div class="image-holder">

                                <?php the_post_thumbnail(); ?>

                            </div>

                            <div class="content-holder">

                                <div class="feat-text">

                                    <span class="item-ranking"><?php echo $pos ?></span>

                                </div>

                                <h1><?php the_title(); ?></h1>

                                <?php the_content(); ?>

                                <?php if($link !== ""){?>

                                    <a class="buy-now-link" href=<?php echo $link; ?>>

                                        <span class="button-text">BUY NOW!</span>

                                    </a>
                                
                                <?php } ?>

                            </div>   

                        </div>

                    </div>

                <?php 
                endwhile; 

                wp_reset_postdata();
                ?>

            </div>
                        
            <div class="banner-nav heritage-nav">

                <div id="next" class="nav-items">

                    <span class="nav-year"><?php echo $positions[1]; ?></span>

                </div>

                <div id="prev" class="nav-items disabled">

                    <span class="nav-year"></span>

                </div>

            </div>

        </div>

        <div class="feat-post-cont women-container-slider">

            <div class="heritage-year-cont">

            <?php
        //        $i = 0;
                $positions = array();
                $top_women = get_top('women');

                while ( $top_women->have_posts() ) : $top_women->the_post();

                    $pos = get_field('top_items_ranking_position');
                    $link = get_field('top_items_product_link');
                    array_push($positions, $pos);
        //        $i++;
                ?>

                    <div class="heritage-set">

                        <div data-color="<?php echo $color; ?>" class="inner-post heritage-year">
                                
                            <div class="image-holder">

                                <?php the_post_thumbnail(); ?>

                            </div>

                            <div class="content-holder">

                                <div class="feat-text">

                                    <span class="item-ranking"><?php echo $pos ?></span>

                                </div>

                                <h1><?php the_title(); ?></h1>

                                <?php the_content(); ?>

                                <?php if($link !== ""){?>

                                    <a class="buy-now-link" href=<?php echo $link; ?>>

                                        <span class="button-text">BUY NOW!</span>

                                    </a>

                                <?php } ?>

                            </div>   

                        </div>

                    </div>

                <?php 
                endwhile; 

                wp_reset_postdata();
                ?>

            </div>
                        
            <div class="banner-nav heritage-nav">

                <div id="next" class="nav-items">

                    <span class="nav-year"><?php echo $positions[1]; ?></span>

                </div>

                <div id="prev" class="nav-items disabled">

                    <span class="nav-year"></span>

                </div>

            </div>

        </div>

        <div class="timeline">

                <?php
                        $active = true;
                        for ($i=0; $i < sizeof($positions); $i++) {
                ?>

                        <div class="milestone <?php echo ($active ? 'active' : '') ?>" data-iter="<?php echo $i; ?>">
                            
                            <span class="milestone-year"><?php echo $positions[$i]; ?></span>
                        
                        </div>
                <?php
                            $active = false;
                        }
                ?>

            </div>

    </div>

    <div class="top-10-bottom-content">

        <h3 class="top-ten-statement">Browse our top ten fragrances available at all FRANKS outlets.</h3>

        <div class="mens-top-10-list top-10-items">

            <div class="mens-list list"><span>MEN'S TOP 10</span></div>
            
            <div class="list-content">
                <?php 

                $mens_args = array(
                    'post_type' => 'top-products',
                    'posts_per_page' => 10,
                    'post_status' => 'publish',
                    'post__not_in' => array($post_id),
                    'meta_key' => 'top_items_ranking_position',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'topproductscat',
                            'field'    => 'slug',
                            'terms'    => 'men',
                        ),
                    ),
                );
                
                $mens_query = new WP_Query($mens_args);

                if($mens_query->have_posts()){

                    while ($mens_query->have_posts() ) : $mens_query->the_post(); 

                        $product_link = get_field('top_items_product_link', get_the_id());
                        $ranking = get_field('top_items_ranking_position', get_the_id());?>

                            <div class="top-10-item-link men-item-link">

                                <a href=<?php echo $product_link?>>

                                <?php
                                if(has_post_thumbnail()){
                                    $img_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                                ?>

                                    <img class="top-10-item-img men-item-img" src=<?php echo $img_url;?>>

                                <?php
                                }
                                ?>

                                <h6 class="top-10-item-ranking men-item-ranking">No.<?php echo $ranking;?></h6>
                                <?php the_title('<h5 class="top-10-item-name men-item-name">','</h5>');?>

                                </a>

                            </div>

                        <?php
                    
                    endwhile;

                }
                ?>

            </div>

        </div>

        <div class="womens-top-10-list top-10-items">

            <div class="womens-list list"><span>WOMEN'S TOP 10</span></div>

            <div class="list-content">

                <?php 

                $womens_args = array(
                    'post_type' => 'top-products',
                    'posts_per_page' => 10,
                    'post_status' => 'publish',
                    'post__not_in' => array($post_id),
                    'meta_key' => 'top_items_ranking_position',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'topproductscat',
                            'field'    => 'slug',
                            'terms'    => 'women',
                        ),
                    ),
                );
                
                $womens_query = new WP_Query($womens_args);

                if($womens_query->have_posts()){

                    while ($womens_query->have_posts() ) : $womens_query->the_post(); 

                        $product_link = get_field('top_items_product_link', get_the_id());
                        $ranking = get_field('top_items_ranking_position', get_the_id());?>

                            <div class="top-10-item-link women-item-link">

                                <a href=<?php echo $product_link?>>

                                <?php
                                if(has_post_thumbnail()){
                                    $img_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                                ?>

                                    <img class="top-10-item-img women-item-img" src=<?php echo $img_url;?>>

                                <?php
                                }
                                ?>

                                <h6 class="top-10-item-ranking women-item-ranking">No.<?php echo $ranking;?></h6>
                                <?php the_title('<h5 class="top-10-item-name women-item-name">','</h5>');?>

                                </a>

                            </div>

                        <?php

                    endwhile;

                }
                ?>

            </div>

        </div>

    </div>

</div>

<?php
get_footer();
?>