<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package franks
 */

?>

<section class="no-results not-found page-container">
	<header class="page-header">
		<?php 
			$title = 'Nothing Found';
			include(dirname(__FILE__)."/../page-templates/title-divider.php"); ?>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'franks' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p class="woocommerce-info">
                Our online shop doesn’t seem to have what you’re looking for but please continue to browse our stock in case something else tickles your fancy.<br><br>Should you need a specific product which is currently not available on our site, kindly send us your request on <a class="no-style" href="mailto:eshop@franks.com.mt">eshop@franks.com.mt</a> and we will find a way to meet your demand.
            </p>
			<?php
		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'franks' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
