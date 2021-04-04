<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package franks
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
<!--		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>-->
	</header><!-- .entry-header -->
	<?php include(dirname(__FILE__)."/../page-templates/homepage-banner.php");?>
	<div class="entry-content">
			<?php if (is_page('Home')) { ?>
				<div class="page-container homepage">
				<?php 
					$title = 'The art of living beautiful';
					include(dirname(__FILE__)."/../page-templates/title-divider.php");?>
					<div class="home-block-cont">
						<div class="home-row">
							<div class="home-block heritage-block">
								<div class="inner-block">
									<h2>Our Heritage</h2>
									<p>Our Mission is to open the doors of luxury to all those with a flair for opulence and extravagance. We make sure that our customers are pampered with the best of service on the island and exposed to the latest beauty and fragrant happenings in the top cities of the world. Our distinctiveness in the sector is transmitted by our personnel, through a delicate interplay between professional competency, gentleness and a passion for glamour. Today, after more than one hundred years, Franks is the largest and top retailer of fragrances and cosmetics in Malta, with seven outlets in all the main commercial centers. These exclude the other branches of our ever growing company, namely the Franks Gentlemen's Essentials.</p>
									
									<div class="read-cont">
										<a href="<?php echo get_permalink( get_page_by_title( 'Heritage' ) ); ?>">
											<span>Read More</span>
											<div class="arrow-cont">
												<div class="arrow"></div>                                            
											</div>
										</a>                                        
									</div>
								</div>
							</div>
						</div>                     
						<div class="home-row">
							<div class="home-block shop-block">
								<div class="info-bar">
									<a href="<?php echo get_permalink( get_page_by_title( 'Shop Main' ) ); ?>">
										<h2>Shop Now!</h2>
									</a>                                
								</div>
							</div>
						</div>
						<!-- <div class="home-row">
							<div class="full-block">
								<h3>FRANKS Gold Card</h3>
								<a href="<?php echo get_permalink( get_page_by_title( 'Gold Card' ) ); ?>">
									<span>Visit Page</span>
									<div class="arrow-cont">
										<div class="arrow"></div>                                        
									</div>
								</a>
							</div>
						</div> -->
						<!-- <div class="home-row gold-card-cont">
							<div class="home-block gold-card">
								<div class="inner-block">
									<p>FRANKS is now rewarding you for your loyalty. Subscribe to the FRANKS Gold Card, accumulate your points and benefit from numerous perks we’ve prepared for you.</p>
									<a href="<?php echo get_permalink( get_page_by_title( 'Gold Card' ) ); ?>">
										<span>Apply Now</span>
										<div class="arrow-cont">
											<div class="arrow"></div>                            
										</div>
									</a>
								</div>
							</div>
							<div class="home-block gold-card-image"></div>
						</div> -->
						<div class="home-row">
							<div class="full-block">
								<h3>The Gentlemen's Essentials</h3>
								<a href="<?php echo get_permalink( get_page_by_title( 'Gentlemen\'s Essentials' ) ); ?>">
									<span>Visit Page</span>
									<div class="arrow-cont">
										<div class="arrow"></div>                                        
									</div>
								</a>
							</div>
						</div>
						<div class="home-row wine-boutique-cont">
							<div class="home-block wine-boutique">
								<div class="inner-block">
									<p>The Gentlemen's Essentials is that special place where quality is chosen over quantity, it is the place where the individual story is prized and given preference over the larger, blander and homogenous ideals of demanding multinational companies.</p>
									<a href="<?php echo get_permalink( get_page_by_title( 'Gentlemen\'s Essentials' ) ); ?>">
										<span>Read More</span>
										<div class="arrow-cont">
											<div class="arrow"></div>                                            
										</div>
									</a>
								</div>
							</div>
							<div class="home-block wb-image"></div>
						</div>                    
						<div class="home-row">
							<div class="full-block discover-block">
								<h3>Our Services</h3>
								<a href="<?php echo get_permalink( get_page_by_title( 'Our services' ) ); ?>">
									<span>Visit Page</span>
									<div class="arrow-cont">
										<div class="arrow"></div>                                        
									</div>
								</a>
							</div>
						</div>                        
						<div class="home-row">
							<div class="home-block services-block">
								<div class="info-bar">
									<div class="inner-info">
										<h2>Services</h2>
										<span>Check our Services!</span>
										<div class="view-services">
											<a href="<?php echo get_permalink( get_page_by_title( 'Our Services' ) ); ?>">
												<span class="view-services">View all</span>
											</a>                                        
										</div>                                      
									</div>
								</div>
							</div>
						</div>
											
						<!-- <div class="home-row">
							<div class="full-block discover-block">
								<h3>Discover our newest products.</h3>
								<a href="<?php echo get_permalink( get_page_by_title( 'Shop Main' ) ); ?>">
									<span>Shop now</span>
									<div class="arrow-cont">
										<div class="arrow"></div>                                        
									</div>
								</a>
							</div>
						</div>                                                        
						<div class="home-row">
							<div class="home-block top-10-block">
								<div class="info-bar">
									<h3>Top 10 Fragrances</h3>
									<a href="<?php echo get_permalink( get_page_by_title( 'Top 10' ) ); ?>">
										<span>View the collection</span>                                        
									</a>  
								</div>
							</div>
						</div>                     -->
						<div class="home-row">
							<div class="full-block discover-block">
								<h3>Contact Us</h3>
								<a href="<?php echo get_permalink( get_page_by_title( 'Contact' ) ); ?>">
									<span>Store Locator</span>
									<div class="arrow-cont">
										<div class="arrow"></div>                                        
									</div>
								</a>
							</div>
						</div>
						<div class="home-row">
							<div class="home-block store-image"></div>
							<div class="home-block store-locator">
								<div class="inner-block">                                    
									<p>Franks Stores Ltd,<br>
									No.4 JMA Building,<br>
									Industry Street, Qormi.<br>
									+356 23882300</p>
									
									<h3><a href="#colophon" class="elem-link">Follow us on social media!</a></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } else if (is_page('credit-card')) {
				get_template_part( 'template-parts/content', 'credit-card' );
				} else if (is_page('wish-list')) {    ?>  
				    <div class="page-container">
						<div class="inner-page-space">
							<?php if ( !is_user_logged_in() ) { ?>                        
								<div class="grid v-padding wishlist-grid">
									<div class="col col-1-2">
										<h2>What is My Wishlist?</h2>
										<p style="margin-top:0">My Wishlist is a list of all those products you love so much from our FRANKS stores.  Your family and friends can easily access your Wishlist from our stores and purchase any thing that your heart desires.  You can even set up your Wishlist at our FRANKS outlets, so make sure you ask our team for assistance!</p>
										<img class="wishlist-text-img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/wishlist-text.svg" alt="">
									</div>
									
									<div class="col col-1-2">
										<h2>How it works!</h2>
										<p><span class="num">1.</span> Create your own wishlist by logging in or registering as a new user.</p>
										<p><span class="num">2.</span> All that your heart desires is just a few clicks away! Add a product to your Wishlist by clicking on the heart icon when on the product’s page or by simply typing out the product’s title in the Wishlist section.</p>
										<p><span class="num">3.</span> Share your wishlist on facebook or email it to a friend. You can always come back to your wishlist whenever you like!</p>
									</div>                            
								</div>
								
								<div class="grid wishlist-form">
									<div class="col col-1-2">
										<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>
										<div class="inner-wl-form">
											<?php 
												echo do_shortcode('[theme-my-login default_action="login" login_template="my-login-form.php"]');
											?>                                    
										</div>
									</div>                            
									<div class="col col-1-2">
										<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>
										<div class="inner-wl-form">
											<?php 
												echo do_shortcode('[theme-my-login default_action="register" register_template="my-register-form.php"]');
											?>                                    
										</div>
									</div>
								</div>
							<?php } else { //if user is logged in 
							?>
								<div class="text-cont">
									<?php the_content(); ?>
								</div>
						</div>
					</div>
				<?php }

			
			} else {
				/* used to show the cart and checkout pages - the_content() fetches the shortcodes found in the WordPress pages */ 
			?>
				<?php
                        if (is_page('Checkout')) {
							?>
							<div class="page-container checkout">
							<?php
						} else { ?>
						<div class="page-container">
					<?php } ?>
					<div class="text-cont">
						<?php the_content(); ?>
						<?php
                        if (is_page('careers')) {
                            $careers = get_all_careers();
						?>
						<h2>Current Vacancies</h2>
						<div class="vacancies">
							<?php
								$key = 0;
								while ( $careers->have_posts() ) : $careers->the_post();
							?>
									<div class="vacancy">
										<h3><?php the_title(); ?></h3>
										<a href="javascript:;" class="vacancy-info" data-index="<?php echo $key; ?>">View more</a>
									</div>
							<?php
								$key++;
								endwhile;
							?>
						</div>
						<div class="vacancy-details-container">
							<?php
								$key = 0;
								while ( $careers->have_posts() ) : $careers->the_post();
							?>
									<div class="vacancy-details" data-index="<?php echo $key; ?>">
										<h3><?php the_title(); ?></h3>
										<?php the_content(); ?>
									</div>
							<?php
								$key++;
								endwhile;
							?>
						</div>
						<?php
							} //end if (page == careers)
						?>
					</div>					 
				</div>
			<?php }?>
	</div>
</article><!-- #post-## -->
                 
                   