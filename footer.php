<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package franks
 */

?>	<footer id="colophon" class="site-footer">
		
		<div class="inner-footer">
		
			<div class="foot-cont survey-container">
				<a class="survey-link" href="https://franks.com.mt/survey/" target="_blank">
					<p class="survey-title">Take our Survey!</p>
				</a>
				<p class="survey-desc">Your feedback is important to us</p>
			</div>

			<div class="foot-cont newsletter-container">
				<p class="newsletter-title">Sign up for our Newsletter!</p>

				<!-- Begin Mailchimp Signup Form -->
				<div id="mc_embed_signup">

					<form action="https://franks.us7.list-manage.com/subscribe/post?u=7f5a53e5fbaa9ddf1fcd352c7&amp;id=27e9d69100" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<div id="mc_embed_signup_scroll">
						
					<div class="mc-field-group">
						<label for="mce-FNAME">First Name </label>
						<input type="text" value="" name="FNAME" class="required first-name" id="mce-FNAME">
					</div>
					<div class="mc-field-group">
						<label for="mce-LNAME">Last Name </label>
						<input type="text" value="" name="LNAME" class="required last-name" id="mce-LNAME">
					</div>
					<div class="mc-field-group">
						<label for="mce-EMAIL">E-mail</label>
						<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
					</div>
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_7f5a53e5fbaa9ddf1fcd352c7_18c97931bd" tabindex="-1" value=""></div>
						<div class="clear"><input type="submit" value="Sign up!" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
						</div>
					</form>

				</div>

				<!--End mc_embed_signup-->
			</div>

			<div class="foot-cont privacy-container">
				<ul class="additional-pages">
					<div class="col-md-12">
						<div class="left-side-menu">
							<li><a href="/heritage">ABOUT US</a></li>
							<li><a href="/news-promotions">NEWS & PROMOTIONS</a></li>
							<li><a href="/careers">Careers</a></li>
							<li><a href="/contact">Contact Us</a></li>
						</div>
						<div class="right-side-menu">
							<li><a href="/franks-2019/privacy-policy">Privacy Policy</a></li>
							<li><a href="/cookie-policy">Cookie Policy</a></li>
							<li><a href="/terms-conditions">Terms & Conditions</a></li>
							<li><a href="/delivery-returns">Delivery & Returns</a></li>
						</div>
					</div>
				</ul>
			</div>

			<div class="foot-cont social-container">
				<ul class="social-links">
					<li>
						<a target="_blank" href="https://www.facebook.com/FranksPerfumery">
							<?php include(dirname(__FILE__)."/images/facebook.svg");?>
						</a>
					</li>
					<li>
						<a target="_blank" href="https://twitter.com/FRANKS_Malta">
							<?php include(dirname(__FILE__)."/images/twitter.svg");?>
						</a>
					</li>
					<li>
						<a target="_blank" href="https://www.instagram.com/franksmalta/">
							<?php include(dirname(__FILE__)."/images/instagram.svg");?>
						</a>
					</li>
					<li>
						<a target="_blank" href="https://www.youtube.com/user/FranksMalta">
							<?php include(dirname(__FILE__)."/images/youtube.svg");?>
						</a>
					</li>
					<li>
						<a target="_blank" href="https://www.pinterest.com/franksmalta/">
							<?php include(dirname(__FILE__)."/images/pinterest.svg");?>
						</a>
					</li>
				</ul>
			</div>

			<div class="foot-cont copyright-container">
				<p class="copyright-text">Copyright &copy; 2019 Franks Stores Ltd, <br>No.4 JMA Building, Industry Street, Qormi, Malta.</p>
			</div>

				<div class="foot-cont steves-container fns-footer-logo">
					<!-- <h1 class="steves-text fns-logo-footer"><a href="https://www.stevesandco.com/" target="_blank"> Steves & Co. </a></h1>
					<h2 class="fns-text-footer">another <br/>Steves&Co. website</h2> -->
					<a href="https://www.stevesandco.com/" target="_blank"><img src="/wp-content/themes/franks/images/steves-logo.png"></a>
				</div>
			
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<div class="cookie-policy-bar">

	<div class="inner-cookie-policy">

		<span>    This website uses cookies to improve your experience. We'll assume you're ok with this, but you can opt-out on our <a href="https://franks.com.mt/cookie-policy/">cookie policy</a> page if you wish.</span>
		<div class="close-button">

			<span>Accept</span>

		</div>

	</div>

</div>

<!-- Lightbox Script -->

<!-- Custom scripts -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/minified/sliders-min.js?v=21223"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/minified/product-tabs-min.js?v=213"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/minified/header-animation-min.js?v=213"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/minified/products-min.js?v=216612223"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/minified/careers-min.js?v=213"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/minified/contact-min.js?v=213"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/minified/shared-min.js?v=e651ee1"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/minified/heritage-min.js?v=e64431ee1"></script>
<?php wp_footer(); ?>


</body>
</html>
