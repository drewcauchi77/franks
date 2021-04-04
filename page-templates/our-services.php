
<?php
/**
 * The main template file
 * 
 * Template Name: Our Services Template	
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
<main class="services">
    <div class="back-to-home-banner">
        <div class="inner-container">
            <h1 class="page-title">		
                <?php 
                // Obtain the pagename as a string of the current page and print out
                $pagename = $post->post_title;
                echo $pagename;
                ?>
            </h1>
            <p class="page-intro-head"><?php the_field('our_services_intro_text'); ?></p>
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
            <?php
            $image = get_field('our_services_banner');
            $size = 'full'; // (thumbnail, medium, large, full or custom size)
            if( $image ) {
                echo wp_get_attachment_image( $image, $size );
            }
            ?>
            <div class="home-row booking-block">
                <div class="our-services">
                    <div class="col-1-2">
                        <h2><?php the_field('left_column_title'); ?></h2>
                        <p><?php the_field('left_column_description'); ?></p>
                    </div>
                    <div class="col-1-2">
                        <h2><?php the_field('right_column_title'); ?></h2>
                        <p><?php the_field('right_column_description'); ?></p>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?php
get_footer();
