
<?php
/**
 * The main template file
 * 
 * Template Name: Heritage Template	
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
<div id="heritage" class="site-content">
        <div class="feat-banner-cont">
        <div class="feat-post-cont">
            <div class="heritage-year-cont">
    <?php
//        $i = 0;
        $years = array();
        $heritage = get_heritage_all();
        while ( $heritage->have_posts() ) : $heritage->the_post();
        $color = get_field('background_colour');
        $year = get_field('milestone_year');
        array_push($years, $year);
//        $i++;
    ?>
           <div class="heritage-set">
               <div data-color="<?php echo $color; ?>" class="inner-post heritage-year">
                    <div class="image-holder">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="content-holder">
                        <h1><?php the_title(); ?></h1>
                        <div class="feat-text">
                            <span><?php echo $year ?></span>
                        </div>
                        <?php the_content(); ?>
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
                       <span class="nav-year"><?php echo $years[1]; ?></span>
                   </div>
                   <div id="prev" class="nav-items disabled">
                       <span class="nav-year"></span>
                   </div>
               </div>
               
               <div class="timeline">
                   <?php
                        $active = true;
                        for ($i=0; $i < sizeof($years); $i++) {
                   ?>
                           <div class="milestone <?php echo ($active ? 'active' : '') ?>" data-iter="<?php echo $i; ?>">
                               <span class="milestone-year"><?php echo $years[$i]; ?></span>
                           </div>
                   <?php
                            $active = false;
                        }
                   ?>
               </div>
            </div>
    </div>
    <div class="page-container">
        <?php 
        $title = 'The art of living beautiful';
        include('title-divider.php'); ?>
        <div class="home-block-cont heritage-page-cont">
            <div class="home-row heritage-intro-block">
                <div class="inner-block">
                    <h2>Heritage</h2>
                    <span>Mission Statement</span>
                    <div class="inner-block">
                        <p>Our Mission is to open the doors of luxury to all those with a flair for opulence and extravagance. We make sure that our customers are pampered with the best of service on the island and exposed to the latest beauty and fragrant happenings in the top cities of the world.<br><br>Our distinctiveness in the sector is transmitted by our personnel, through a delicate interplay between professional competency, gentility and a passion for glamour. Today, after more than one hundred years, Franks is the largest and top retailer of fragrances and cosmetics in Malta, with seven outlets in all the main commercial centers. These exclude the other branches of our ever-growing company, namely the Franks Gentlemen's Essentials.<br><br><strong>The Art of Living Beautiful.</strong></p>    
                    </div>                                
                </div>
            </div>
            <div class="home-row">
                <div class="full-block discover-block">
                    <h3>Our Shops Today!</h3>
                    <a href="<?php echo get_permalink( get_page_by_title( 'Contact' ) ); ?>">
                        <span>Store Locator</span>
                        <div class="arrow-cont">
                            <div class="arrow"></div>                                        
                        </div>
                    </a>
                </div>
            </div>
            <div class="home-row heritage-image-block">
            </div>
            <div class="home-row heritage-intro-block">
                <div class="inner-block">
                    <h3>Franks Today</h3>
                    <div class="inner-block">
                        <p>Much of what FRANKS is today started from a dream, which was developed into a thought process, that transformed into a discussion, and eventually, the implementation of the idea. FRANKS’ developments come with great responsibility to keep the brand and its performance at such a high level. We strive to continue offering shoppers the unique service they experience at our outlets, a key component to our brand’s identity and what truly defines FRANKS. This is achieved mainly through our personnel who, apart from having the necessary professional competencies, possess passion and love for this glamorous line of business.</p>    
                    </div>                                
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
get_footer();
