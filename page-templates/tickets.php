<?php
/**
 * The main template file
 * 
 * Template Name: Tickets Template	
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
echo '<style>#sub-theiframe{max-width:100%;}</style>'
?>

<div id="sub-theiframe">

    <iframe width="100%" style="overflow-x: auto; max-width: 100%; padding-top: 145px;" scrolling="yes" height="790" frameborder="0" src="http://frameless.ticketline.com.mt/bookings/Shows.aspx?ProductionId=721&aff=showwebsite"></iframe>

</div>

<?php get_footer(); ?>