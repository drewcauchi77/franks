
<?php
/**
 * The main template file
 * 
 * Template Name: Tips and Tricks Template	
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
<main class="tips-tricks">
    <?php
        $page_title = get_the_title();
        $cnt = 1;
        $tips = get_all_tips();
        while ( $tips->have_posts() ) : $tips->the_post();
        $link = get_post_meta($post->ID, 'tips_post_link', true);
        $fields = get_fields();
        $temp = parse_url($link, PHP_URL_QUERY);
        parse_str($temp);
        // $vid_id = $v;
        $vid_id = $fields['video_id'];
        $embed_code = 'https://www.youtube.com/embed/' . $vid_id . '?autoplay=1&showinfo=0&controls=0&modestbranding=1&rel=0';

        if ( $cnt == 1 ) {
    ?>
        <div class="feat-banner-cont tips-feat-banner">
            <div class="feat-post-cont">
                <div class="page-title">
                    <h1><?php echo $page_title; ?></h1>
                </div>
               <div class="inner-post">
                    <div class="image-holder">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="content-holder">
                        <h1><?php the_title(); ?></h1>
                        <div class="feat-text">
                        </div>
                        <?php the_content(); ?>
                        <div class="show-video" data-link="<?php echo $embed_code; ?>">
                            <span>Watch</span>
                        </div>
                    </div>                   
               </div>
            </div>
        </div>
        <div class="entry-content">
            <div class="page-container">
<?php
    }
    
    $cnt ++;
    endwhile; 
    wp_reset_postdata();
        $all_terms = get_terms( 'tips_category' );
                
            foreach ($all_terms as $term) {
        ?>
            <div class="term-holder">
                <div class="page-header">
                    <span><?php echo $term->name; ?></span>
                </div>  
        <?php
                $cat_tips = get_tips($term->name);
                while ( $cat_tips->have_posts() ) : $cat_tips->the_post();
                    $fields = get_fields();
                    $link = get_post_meta($post->ID, 'tips_post_link', true);
                    $temp = parse_url($link, PHP_URL_QUERY);
                    parse_str($temp);
                    // $vid_id = $v;
                    $vid_id = $fields['video_id'];
                    $embed_code = 'https://www.youtube.com/embed/' . $vid_id . '?autoplay=1&showinfo=0&controls=0&modestbranding=1&rel=0';
        ?>
               <div class="tips-cont">           
                    <div class="inner-post">
                        <div class="image-holder">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="content-holder">
                            <div class="text-cont">
                                <div class="feat-text">
                                    <h2><?php the_title(); ?></h2>
<!--                                    <span><?php the_time('M d'); ?></span>-->
                                </div>
                                <div class="tips-desc">
                                    <?php the_content(); ?>                                
                                </div>                                
                            </div>
                            <div class="show-video" data-link="<?php echo $embed_code; ?>">
                                <span>Watch</span>
                            </div>
                        </div>                   
                   </div>
               </div>               
        <?php
                endwhile;
        ?>
           </div>
        <?php
            }
        ?>
           </div>
       </div>
        <div class="video-cont">
            <div class="video-container">
                <iframe width="1120" height="630" src="" frameborder="0" ></iframe>
            </div>
        </div>
</main>
<?php
get_footer();
