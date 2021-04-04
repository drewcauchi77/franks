<?php
/**
 * The main template file
 * 
 * Template Name: Privacy Policy Template	
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

<main id="privacy-policy">

    <?php 
    $customLink = '/';
	$customMessage = 'Go back to <b>Home</b>';
    include 'back-to-home.php'; ?>

    <div class="main-container">

        <?php the_content(); ?>

    </div>

</main>

<?php
get_footer();
