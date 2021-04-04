<?php
/**
 * The main template file	
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
 global $post;

 $post_type = get_post_type(get_the_ID());


?>
<div class="back-to-home-banner">
	<div class="inner-container">
		<h1 class="page-title">		
			<?php 
			// Obtain the pagename as a string of the current page and print out
			$pagename = $post->post_title;
			echo $pagename;
			?>
		
		</h1>
		<a href="<?php if($post_type == 'post'){ echo '/news-promotions';}else {echo $customLink;} ?>">
			<span><?php echo $customMessage ?></span>
			<div class="arrow-cont test">
				<div class="arrow"></div>                                            
			</div>
		</a>               
	</div>
</div>
	