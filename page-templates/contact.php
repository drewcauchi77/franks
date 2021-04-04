<?php
/**
 * The main template file
 * 
 * Template Name: Contact Template	
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
    <div id="content" class="site-content">
        <div class="map-contact-cont">

            <div class="shop-images-cont">
                <?php if (has_post_thumbnail(1621) ): ?>
                    <!-- Post id of Contact page -->
                    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(1621), 'single-post-thumbnail'); 
                    ?>

                    <div class="my-slider">
                        <div class="inner-shop-sliderr" style="background-image: url(<?php echo $image[0]; ?>)"></div>
                        <div class="inner-shop-sliderr2" style=""></div>
                    </div>

                    <?php endif; ?>
            </div>   
        </div>
        <script>


       </script>
            
       <style>
        .slick-track{
                
        }
        .inner-shop-sliderr, .inner-shop-sliderr2{
            height: 600px;
            pointer-events: none;
            background-size: cover;
            background-position: center;
            
            background-repeat: no-repeat;
        }
        .my-slider{
            max-height: 600px;
        }
        @media screen and (max-width:768px) {
        /* style changes when the screen gets smaller */
        .my-slider{
                max-height: 300px;
            }
            .inner-shop-sliderr, .inner-shop-sliderr2{
                height: 300px;
                pointer-events: none;
                background-size: cover;
                background-position: center;
                
                background-repeat: no-repeat;
            }
        }
        
        
       
       </style>
        <div class="page-container">   
            <?php 
            $title = 'The art of living beautiful';
            include('title-divider.php'); ?>
                            
            <div class="marker-cont">
                <?php
                    $i = 0;
                    $shop = get_all_shops();
                    while ( $shop->have_posts() ) : $shop->the_post();
                        $telephone = get_field('shop_telephone');
                        $address = get_field('shop_address');
                        $times = get_field('shop_opening_hours');
                        $co_ord = get_field('shop_coordinates');
                        $shop_image = get_field('shop_illustration');
                        $shop_image2 = get_field('shop_secondary_image');
                        $shop_image3 = get_field('shop_secondary_image_2');
                ?>
                        <div id="loc-<?php echo $i+1;?>" class="location" data-shop_img2="<?php echo $shop_image2; ?>" data-shop_img3="<?php echo $shop_image3; ?>">
                            <div class="content-cont">
                                <img src="<?php echo $shop_image; ?>" alt="shop illustration"/>
                                <h3><?php the_title(); ?></h3>
                                <p class="open-time">
                                    <?php echo $times; ?>
                                </p>
                                <p class="shop-address">
                                    <?php echo $address; ?>
                                </p>
                                <span class="tel-shop"><strong>Tel: </strong><?php echo $telephone; ?></span>
                                
                                <div class="show-map">
                                    <span class="button-text">View</span>
                                </div>
                            </div>
                        </div>                       
                <?php
                        $i++;
                    endwhile; 
                    wp_reset_postdata();
                ?>
            </div>
                            
            <div class="contact-content">
                <div class="col-1-2">
                    <div class="inner-col">
                        <h3>Main Office</h3>
                        <p>Franks Stores Ltd,<br>
                            No.4 JMA Building,<br>
                            Industry Street, Qormi.<br>
                            <b>Tel: </b>+356 23882300<br>
                            <b>Email: </b><a href="mailto:info@franks.com.mt">info@franks.com.mt</a></p>
                        <h3>Online Order</h3>
                        <p><b>Email: </b><a href="mailto:eshop@franks.com.mt">eshop@franks.com.mt</a></p>
                    </div>
                </div>
                <div class="col-1-2">
                    <div class="contact-form">
                        <h3>Drop us a line:</h3>
                        <?php echo do_shortcode('[contact-form-7 id="234991" title="Contact Form"]'); ?>
                    </div>
                </div>
            </div>
        </div>	
    </div>
<?php
get_footer();
