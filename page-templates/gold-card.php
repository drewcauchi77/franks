<?php
/**
 * The main template file
 * 
 * Template Name: Gold Card Template	
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
acf_form_head();
get_header();
?>

<?php $term = $wp_query->queried_object; ?>

<div class="back-to-home-banner gold-card-banner" style="background-image: url(<?php echo $field; ?>)">

        <div class="inner-container">

            <?php 
            // Obtain the pagename as a string of the current page and print out
            the_title('<h1 class="page-title">','</h1>');
            ?>

            <a href="/">

                <span>Go back to Home</span>

                <div class="arrow-cont">

                    <div class="arrow"></div>  

                </div>

            </a>                   
                
        </div>

    </div>

<div class="section loyalty-card-container">

	<div class="inner">

		<?php

		acf_form(array(

            'post_id'		=> 'new_post',

            'post_title'	=> false,

            'post_content'	=> false,

            'new_post'		=> array(

                'post_type'		=> 'loyalty-card',

                'post_status'	=> 'publish'

            ),

            'return' => home_url('gold-card/thank-you'),

            'submit_value' => __('Apply', 'acf')

        ));

		?>

	</div>

</div>

<?php
get_footer();
?>