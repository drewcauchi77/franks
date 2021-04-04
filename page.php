<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package franks
 */

get_header();
?>

<?php 
			// $url = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>
				
	<div id="primary" class="content-area">

		<main id="main" class="site-main">
		<?php

		if (is_page('wish-list')) {		
			?>
			<div class="wishlist-banner">
			<?php
				$customMessage = 'Go to Home';
				$customLink = get_the_permalink(get_page_by_title('Home'));
				include(dirname(__FILE__)."/page-templates/back-to-home.php");  
			?>
			</div>	
			<?php				
		} else if (is_page('view-wishlist')) {
					$query_id = $_GET['id'];
					$user_id = decrypt_val($query_id);
					$user = get_userdata( $user_id );
					$user_fname = $user->first_name;
					$user_lname = $user->last_name;
					$user_fullname = $user_fname . ' ' . $user_lname;
					$last_let = substr($user_name, -1);
					if ( $last_let == 's' ) {
					$conc_cat = "' Wishlist";
					} else {
					$conc_cat = "'s Wishlist";                                
					}
				?>
					<div class="home-banner-cont feat-banner-cont service-feat wishlist-banner">
					<div class="inner-post">
							<div class="content-holder">
								<h1><?php echo $user_fullname . $conc_cat; ?></h1>
								<a href="<?php echo get_the_permalink(get_page_by_title('Home')); ?>">
									<span>Go to <strong>Home</strong></span>
									<div class="arrow-cont">
										<div class="arrow"></div>
									</div>
								</a>
							</div>
					</div>
					</div>
				<?php
		} else if (!is_page('Home')){
		 	if (is_page('Checkout') || is_page('Cart')){
				$customMessage = 'Continue Shopping';
				$customLink = get_the_permalink(get_page_by_title('Shop Main'));
			} else if(strpos($url, '/view-order/') !== false){
				$customMessage = 'Go to My Account';
				$customLink = get_the_permalink(get_page_by_title('My Account'));

			} else {
				$customMessage = 'Go to Home';
				$customLink = get_the_permalink(get_page_by_title('Home'));
			}
			include(dirname(__FILE__)."/page-templates/back-to-home.php"); 
		}

		?>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
