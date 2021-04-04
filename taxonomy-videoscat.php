<?php

/**

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


$term_id = get_queried_object_id();
$category_name = get_cat_name( $term_id );
$category_link = get_category_link( $term_id );

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <div class="home-banner-cont feat-banner-cont wine-boutique-category single-news-feat how-to-use">
            <div class="inner-post">
                <div class="content-holder">
                    <h1>How to Use: <?php echo $category_name; ?></h1>
                    <!-- <a href="<?php echo $category_link; ?>">
                        <span>Go back to <strong>How to Use: <?php echo $category_name; ?></strong></span>
                        <div style="display:block" class="arrow-cont">
                            <div class="arrow"></div>
                        </div>
                    </a> -->
                </div>
            </div>
        </div>

		<div class="page-container">

        <?php if ( have_posts() ) : ?>

            <div class="entry-content video-list">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php

                        /*
                            * Include the Post-Format-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                            */

                        get_template_part( 'template-parts/content', 'video-cat' );
                    ?>

                <?php endwhile; ?>

                <?php // the_posts_navigation(); ?>
                
                <div class="video-cont videocat-cont" style="display:none;">
                    <div class="video-container videocat-container">
                        <iframe class="videocat-iframe" width="1120" height="630" src="" frameborder="0" ></iframe>
                    </div>
                </div>

            </div>

        <?php else : ?>
            
            <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>
    
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>