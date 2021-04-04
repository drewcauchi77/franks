
<?php
/**
 * The main template file
 * 
 * Template Name: Make-Up Academy Template	
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
<main class="make-up-academy services">
    <div class="back-to-home-banner">
        <div class="inner-container">
            <h1 class="page-title">		
                <?php 
                // Obtain the pagename as a string of the current page and print out
                $pagename = $post->post_title;
                echo $pagename;
                ?>
            </h1>
            <p class="page-intro-head"><?php the_field('academy_intro_text'); ?></p>
            <a href="<?php echo get_the_permalink(get_page_by_title('Our services')); ?>">
                <span>Go back to <strong>Our Services</strong> </span>
                <div class="arrow-cont">
                    <div class="arrow"></div>                                            
                </div>
            </a>           
        </div>
    </div>
    <div class="page-container">
        <?php 
            $image = get_field('academy_banner');
            $size = 'full'; // (thumbnail, medium, large, full or custom size)
            if( $image ) {
                echo wp_get_attachment_image( $image, $size );
            }
                    
            $args = array(
                'post_type'   => 'make-up-academy',
                'post_status' => 'publish'
            );
                
                
                $academy = new WP_Query( $args );
                if( $academy->have_posts() ) :
                ?>
                <div class="home-row booking-block">
                    <div class="academy-inner">
                    <?php
                    while( $academy->have_posts() ) :
                        $academy->the_post();
                        ?>
                        <div class="home-row col-1-2">
                            <div class="home-block">
                                <div class="inner-block">
                                <h3><?php echo get_the_title(); ?></h3>
                                <span><?php 
                                the_field('course_subtitle');?></span>
                                <p><?php echo get_the_content();  ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endwhile;
                    wp_reset_postdata();
                    ?></div>
                </div>
        <?php
        else :
            esc_html_e( 'No courses', 'text-domain' );
        endif;
        ?>
        </div>
</main>
<?php
get_footer();
