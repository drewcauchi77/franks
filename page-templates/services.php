
<?php
/**
 * The main template file
 * 
 * Template Name: Services Template	
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
<main class="services services-main">
    <div class="back-to-home-banner">
        <div class="inner-container">
            <h1>At your Service!</h1>

            <p class="page-intro-head">It is our mission to constantly provide you, our esteemed clients, with the best shopping experience possible. As is evident in this year’s campaign, FRANKS is ‘Unanimously’ known as a perfumery, make-up and skin care luxury outlet. However, we want to enhance this reputation by offering our customers a range of services that will take one’s shopping experience to another level.</p>

            <a href="<?php echo get_the_permalink(get_page_by_title('Home')); ?>">
                <div class="arrow-cont">
                    <div class="arrow"></div>                                            
                </div>
            </a>           
        </div>
    </div>
    <div class="page-nav">
        <div class="inner-nav">
            <a href="#">
                <span>DIFFERENT SERVICES OFFERED</span>
            </a>
        </div>
    </div>
    <div class="page-container">


    <div class="home-block-cont service-block-cont">
        <div class="home-row booking-block">
            <div class="inner-block">
                <h2>Booking</h2>
                <p>If you’re interested in any of the below services and require further information, please do not hesitate to enquire at our stores, email us on <a href="mailto:info@franks.com.mt">info@franks.com.mt</a>, or give us a call on 23882300.</p>                   
            </div>
        </div>
        <div class="home-row services-image-banner" style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/images/services-home.jpg')">
        </div>
        <?php
            $s = 0;
            $services = get_all_services();
            while ( $services->have_posts() ) : $services->the_post();
            
                $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

            if ($s == 0) {
                ?>
                <div class="home-row made-easy">
                    <div class="home-block">
                        <div class="inner-block">
                            <h3><?php the_title(); ?></h3>
                            <span>Made Easy</span>
                            <p><?php the_content(); ?></p>                                
                        </div>
                    </div>
                    
                <?php
            } else if ($s == 1) {
                ?>
                    <div class="home-block">
                        <div class="inner-block">
                            <h3><?php the_title(); ?></h3>
                            <span>Made Easy Advanced</span>
                            <p><?php the_content(); ?></p>                                
                        </div>
                    </div>
                </div>                                
                <?php
            } elseif ($s == 2) {
                ?>
                <div class="home-row">
                    <div class="full-block">
                        <h3><?php the_title(); ?></h3>
                    </div>
                </div>
                <div class="home-row one-on-one">
                    <div class="home-block wb-image" style="background-image: url('<?php echo $feat_image; ?>')"></div>
                    <div class="home-block">
                        <div class="inner-block">
                            <p style="margin:0"><?php the_content(); ?></p>
                        </div>
                    </div>
                </div>                                
                <?php
            } elseif ($s == 3) {
                ?>
                <div class="home-row">
                    <div class="full-block">
                        <h3><?php the_title(); ?></h3>
                    </div>
                </div>
                <div class="home-row make-over">
                    <div class="home-block wine-boutique">
                        <div class="inner-block">
                            <p><?php the_content(); ?></p>
                        </div>
                    </div>
                    <div class="home-block wb-image" style="background-image: url('<?php echo $feat_image; ?>')"></div>
                </div>
                    
                <?php
            }  elseif ($s == 4) {
                ?>
                <div class="home-row">
                    <div class="full-block">
                        <h3><?php the_title(); ?></h3>
                    </div>
                </div>
                <div class="home-row">
                    <div class="home-block grooming-block">
                        <div class="inner-block">
                            <p><?php the_content(); ?></p>                                
                        </div>
                    </div>
                </div>                                
                <?php
            }
            
            $s++;
            endwhile;
        ?>
    </div>

      

    </div>
</main>
<?php
get_footer();
