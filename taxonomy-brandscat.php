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
get_header();
?>
<!-- The single page for WB Brands Categories to be shown. This includes the category taxonomies
of Wine, Cigars, Essentials and Whiskies from the Gentlemen's Essentials section.
This is the single structure of the page which will be viewed from the page-nav section of
gentlemens-essentials.php in this case, which would be the main page of the whole categories -->
<main id="category-brandscat">
    <?php 
    
    // Gets the object which is currently on the page, the queried object. Obtains 
    // the name, slug, id, parent name etc... which would be the current name of the page
    // Example: Wine with slug wine
    $term = $wp_query->queried_object; 
    // Gets the image of the category taxonomy which is set by the Custom Field
    // by the name 'image' and saved as an image url which is confirmed prior by 
    // ACF and saved in variable.
    $field = get_field('image', $term->taxonomy.'_'.$term->term_taxonomy_id);
    ?>
    <!-- ACF Field image for category set as background image -->
    <div class="back-to-home-banner" style="background-image: url(<?php echo $field; ?>)">
        <div class="inner-container">
            <h1 class="page-title">		
                <?php 
                // Obtain the pagename as a string of the current page and print out
                echo $term->name;
                ?>
            
            </h1>
            <a href="/gentlemens-essentials">
                <span>Go back to <strong>The Gentlemen's Essentials </strong>Home</span>
                <div class="arrow-cont">
                    <div class="arrow"></div>                                            
                </div>
            </a>                   
                
        </div>
    </div>
    <div class="page-nav">
        <div class="inner-nav">
            <?php
            // Page navigation to get the LEVEL 1 categories with no parents under the section
            // brandscat fro Wine, Ciagrs, Accessories and Whisky.
            $category_args = array(
                'orderby' => 'name',
                'hide_empty' => false,
                'parent' => 0
            );
            
            $taxonomy = "brandscat";
            
            // Get terms obtains an array of such args above as long as they are abided
            // and saved in array form to be accesssed by foreach as below. A href link
            // for the slug to open a secondary page for the specific category is tagged
            // within the name of the category.
            $categories = get_terms( $taxonomy,$category_args );
            foreach ($categories as $cat){
                if($cat->parent==0){
                    ?>
                    <a href=<?php echo get_term_link($cat->slug, $taxonomy)?>>
                
                    <span class="section-title"><?php echo $cat->name; ?></span>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        
    </div>
    <div class="page-container">
        <div class="description-container">
            
            <!-- The description of the category within wb_brand which is for each and every category
            present under WB Brands -->
            <p><?php echo $term->description; ?></p>
        </div>
        <div class="category-brands">
            <?php 
            // Current args is to obtain the posts/brands under the specific category
            // All the posts will be published and shown here beneath in ascending order
            // by name. The parent taxonomy in this case would be brandscat and the 
            // final child category would be set by the queried object above, $term->slug
            // set as the main section/category of the page
            $current_args = array(
                'post_type' => 'wb_brand',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'post__not_in' => array($post_id),
                'orderby' => 'name',
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'brandscat',
                        'field'    => 'slug',
                        'terms'    => $term->slug,
                    ),
                ),
            );
            // WP_query required to set the current_Args
            $current_query = new WP_Query($current_args);
            if($current_query->have_posts()){
                // Wordpress loop to make work of all the posts to be looped
                // as per the arguments provided above.
                while($current_query->have_posts() ) : $current_query->the_post();
                    // Obtaining the custom field for the links of the separate web 
                    // pages of each. The field name is wine_boutique_brand_link and
                    // is obtained by the current $post->ID of the current page. This
                    // is then posted as an a href link with a separate browser tab opener.
                    $field = get_fields($post->ID);
                    $outer_link = $field['wine_boutique_brand_link'];
                    ?>
                    
                    <a href=<?php echo $outer_link; ?> target="_blank">
                    
                    <?php
                        // Featured iamge of the brand enclosed within the links
                        if(has_post_thumbnail()){
                            $img_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                        ?>
                        <!-- Showing the image -->
                            <img class="brand-logo" src=<?php echo $img_url;?>>
                        <?php
                        }
                    ?>
                    
                    </a>
                    <?php
                endwhile;
            }
            ?>
        </div>
    </div>
</main>
<?php
get_footer();