<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package franks
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 
			<div style="display: none; width:100%">
				<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="Stylesheet">
				<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500" rel="Stylesheet">
				<script src="https://secure.staah.com/cal/js/jquery-ui.js"></script>
				<script type="text/javascript" language="javascript" src="https://secure.staah.com/common-cgi/properties/widget/staahbookingcbgrp_mlsearch.php?id=10633&checkintxt=Arrival&showcheckout=yes&checkouttext=Departure&curdate=no&promocode=yes&promotxt=Promocode&promocode=yes&dateformat=dd M yy&buttontext=Book Online&nonights=1&unk=2"></script>
			</div>
		-->
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- <div style="display:none"> -->
	
	<!-- </div> -->
	<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER['SERVER_NAME']; ?>/wp-content/themes/franks/css/style.css?v=02kk2222pbb422y" />
	<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER['SERVER_NAME']; ?>/wp-content/themes/franks/css/no-products-style.css?v=51aakk2566" />
	<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER['SERVER_NAME']; ?>/wp-content/themes/franks/css/dior/dior.css?v=d72g45s8f5masdgf64" />
	<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER['SERVER_NAME']; ?>/wp-content/themes/franks/css/homepage-banners.css?v=ns0924s3sdsadhs7" />
	<link rel="stylesheet" href="https://use.typekit.net/ewm8xiy.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

	<?php 
	global $post;
	$post_slug = $post->post_name;
	?>
	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
	n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
	document,'script','https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '704263593110811'); // Insert your pixel ID here.
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=704263593110811&ev=PageView&noscript=1"
	/></noscript>
	<!-- DO NOT MODIFY -->
	<!-- End Facebook Pixel Code -->
	
	<!-- Facebook Pixel Code -->

	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window,document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '182119422613742'); 
	fbq('track', 'PageView');
	</script>
	<noscript>
	<img height="1" width="1"
	src="https://www.facebook.com/tr?id=182119422613742&ev=PageView
	&noscript=1"/>
	</noscript>

	<!-- End Facebook Pixel Code -->

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '168706267141215'); 
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=168706267141215&ev=PageView&noscript=1"/>
	</noscript>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-42060158-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-42060158-1');
	</script>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-M28DCWD');</script>
	<!-- End Google Tag Manager -->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M28DCWD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="page" class="site">
	<header id="masthead" class="site-header">
	    <div class="header-container">
            <div class="main-bar">
                <div class="col search">
                    <div class="search-container">
                        <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
                    </div>
                </div>
                <div class="col logo">
                    <div id="logo">
                        <a href="<?php echo get_home_url(); ?>">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="FRANKS">
                        </a>       
                    </div>
                </div>
                <div class="col account">
                    <div id="cart-wishlist">
						<div class="account-links">
							<div class="avatar-cont">
                            	<a href="<?php echo get_the_permalink(get_page_by_title('My Account')); ?>">
								<?php include(dirname(__FILE__)."/images/account.svg");?>
                            	</a>
                        	</div>
           
							<div class="cart-cont">
								<div class="cart-link">
									<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
										<span class="cart-icon">
										<?php include(dirname(__FILE__)."/images/cart.svg");?>
										</span>
										<span id="total-cart"><?php echo WC()->cart->get_cart_total(); ?></span>
									</a>
									<?php
										global $woocommerce;
										$items = $woocommerce->cart->get_cart();                               
										$empty_class = (sizeof($items) == 0) ? 'empty' : '';
									?>
									<div class="cart-items-container <?php echo $empty_class; ?>">
									<?php
										if (sizeof($items) > 0) {
									?>
									<div class="list-container">
											<ul class="cart-items-list">                                     
											<?php
												foreach(array_reverse($items) as $item => $values) {
													$_product = $values['data']->post;
													$product_url = get_permalink($values['product_id']);
													$product_url .= ($values['variation']['attribute_size']) ? '?attribute_size=' . $values['variation']['attribute_size'] : '';
													$product_img = wp_get_attachment_image_src( get_post_thumbnail_id($values['product_id']), 'small')[0];
													$title = explode('*', $_product->post_title);
											?>
													<li>
														<a href="<?php echo $product_url; ?>">
															<div class="grid">
																<div class="col-1-3">
																	<div class="img-container">
																		<?php if (!isset($product_img)) {
																			echo wc_placeholder_img();
																		} else { ?>
																			<img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id($values['product_id']), 'small')[0]; ?>" alt="<?php echo $title[0]; ?>">
																		<?php } ?>
																	</div>
																</div>
																<div class="col-2-3 product-details">
																	<span><?php echo $title[0]; ?></span><br>
																	<span><?php echo $values['variation']['attribute_size']; ?></span><br>
																	<span class="quantity">x<?php echo $values['quantity'];?></span><br>
																	<span class="price"><?php echo get_woocommerce_currency_symbol() . number_format($values['line_total'] / $values['quantity'], 2); ?></span>
																</div>
															</div>
														</a>
													</li>
											<?php } ?>
										</ul>
										</div>
										<div class="buttons">
											<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="link-btn red">View Cart</a>
											<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="link-btn dark-red">Checkout</a>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
                    
						<div class="wishlist-cont">
							<a style="color: white;" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Wish list' ) ) ); ?>">
							<?php include(dirname(__FILE__)."/images/wishlist-icon.svg");?>
							</a>
						</div>
                    </div>
                </div>
            </div>  
		</div>
		<div class="secondary-bar">
			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"></button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
				
				<div class="search-container">
					<?php get_search_form(); ?>
				</div>
			</nav>
		</div>
	</header><!-- #masthead -->
	<div class="custom-free-delivery-class">
			<p><img src="https://franks.com.mt/wp-content/uploads/2019/11/delivery-truck-1.png" alt="<?php the_field('free_delivery','option'); ?>"><?php the_field('free_delivery','option'); ?></p>
		</div>
