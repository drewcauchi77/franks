<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package franks
 */

?>

<!-- Commented out because it was being included in the product-category pages above the archive-product.php, will have to be amended if its needed for another page -->
<?php if (get_post_type() === 'careers' ) { ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			$customMessage = 'Go back to Careers Page';
			$customLink = get_the_permalink(get_page_by_title('Careers'));
			include(dirname(__FILE__)."/../page-templates/back-to-home.php");

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				franks_posted_on();
				franks_posted_by();
				?>
			</div>
		<?php endif; ?>
	</header>

	<?php franks_post_thumbnail(); ?>
	<div class="page-container">
		<div class="entry-content">
			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'franks' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'franks' ),
				'after'  => '</div>',
			) );
			?>
		</div>
		            <h3>Share on:</h3>
            <div class="social-container careers">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 96 96" style="enable-background:new 0 0 96 96;" xml:space="preserve" width="30px" height="30px">
                        <g>
                            <path d="M48,0C21.49,0,0,21.49,0,48c0,26.511,21.49,48,48,48s48-21.489,48-48C96,21.49,74.51,0,48,0z    M59.369,33.17h-7.217c-0.854,0-1.805,1.121-1.805,2.623v5.211h9.021v7.428h-9.021v22.306h-8.52V48.432h-7.723v-7.428h7.723v-4.372   c0-6.269,4.352-11.368,10.324-11.368h7.217L59.369,33.17L59.369,33.17z" fill="#2f3030"/>
                        </g>
                    </svg>
                </a>
                <a href="https://twitter.com/intent/tweet?text=My Franks Wishlist&url=<?php echo get_the_permalink(); ?>" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 96 96" style="enable-background:new 0 0 96 96;" xml:space="preserve" width="30px" height="30px">
                        <g>
                            <path d="M48,0C21.488,0,0,21.49,0,48c0,26.511,21.488,48,48,48c26.51,0,48-21.489,48-48   C96,21.49,74.51,0,48,0z M67.521,39.322c0.02,0.406,0.027,0.814,0.027,1.224c0,12.493-9.51,26.899-26.898,26.899   c-5.338,0-10.307-1.566-14.49-4.249c0.738,0.089,1.49,0.133,2.254,0.133c4.43,0,8.506-1.511,11.742-4.048   c-4.137-0.075-7.629-2.809-8.832-6.564c0.578,0.109,1.17,0.17,1.779,0.17c0.861,0,1.697-0.116,2.49-0.332   c-4.324-0.869-7.584-4.689-7.584-9.271c0-0.04,0-0.079,0.002-0.118c1.273,0.708,2.732,1.133,4.281,1.183   c-2.537-1.696-4.205-4.589-4.205-7.87c0-1.732,0.465-3.355,1.279-4.752c4.662,5.72,11.629,9.483,19.486,9.878   c-0.162-0.692-0.244-1.414-0.244-2.155c0-5.221,4.232-9.453,9.453-9.453c2.719,0,5.176,1.148,6.9,2.985   c2.154-0.424,4.178-1.21,6.004-2.294c-0.707,2.207-2.205,4.061-4.156,5.23c1.912-0.229,3.734-0.736,5.43-1.488   C70.973,36.324,69.369,37.99,67.521,39.322z" fill="#2f3030"/>
                        </g>
                    </svg>
                </a>
                <a href="mailto:?subject=Franks: News&body=<?php echo get_the_title(); ?> : <?php echo get_the_permalink(); ?>">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    width="30px" height="30px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                        <g>
                            <path fill="#2f3030" d="M12.38,17.93V32.06L20.42,25L12.38,17.93z M28.53,25.91L25,29.01l-3.53-3.1l-7.96,6.99h22.98L28.53,25.91z
                            M29.57,25l8.05,7.06V17.93L29.57,25z M29.57,25l8.05,7.06V17.93L29.57,25z M25,29.01l-3.53-3.1l-7.96,6.99h22.98l-7.96-6.99
                            L25,29.01z M12.38,17.93V32.06L20.42,25L12.38,17.93z M25,0C11.19,0,0,11.19,0,25c0,13.81,11.19,25,25,25c13.81,0,25-11.19,25-25
                            C50,11.19,38.81,0,25,0z M39,34.28H11V15.72h28V34.28z M37.62,17.93L29.57,25l8.05,7.06V17.93z M36.49,32.9l-7.96-6.99L25,29.01
                            l-3.53-3.1l-7.96,6.99H36.49z M12.38,17.93V32.06L20.42,25L12.38,17.93z"/>
                            <polygon fill="#2f3030" points="36.48,17.1 25,27.18 13.52,17.1  "/>
                        </g>
                    </svg>
                </a>                
                <a href="https://plus.google.com/share?url=<?php echo get_the_permalink(); ?>" target="_blank">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"  width="30px" height="30px"
                         viewBox="0 0 220 220" style="enable-background:new 0 0 220 220;" xml:space="preserve">
                    <path fill="#2f3030" d="M110,0C49.249,0,0,49.247,0,110s49.249,110,110,110s110-49.247,110-110S170.75,0,110,0z M137.625,110
                        c0,27.604-22.457,50.061-50.061,50.061c-27.604,0-50.061-22.457-50.061-50.061S59.96,59.939,87.564,59.939
                        c11.137,0,21.688,3.585,30.512,10.368l-11.623,15.119c-5.461-4.198-11.993-6.417-18.889-6.417c-17.088,0-30.99,13.902-30.99,30.99
                        s13.902,30.99,30.99,30.99c13.763,0,25.459-9.018,29.49-21.455h-29.49v-19.07h50.061V110z M190.33,116.234h-14.34v14.342h-12.47
                        v-14.342h-14.334v-12.469h14.334V89.424h12.47v14.342h14.34V116.234z"/>
                    </svg>
                </a>
                <a href="https://pinterest.com/pin/create/button/?url=<?php echo get_the_permalink(); ?>&media=<?php echo $large_image; ?>&description=" target="_blank">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"             y="0px"
                          width="30px" height="30px" viewBox="0 0 533.333 533.333" style="enable-background:new 0 0 533.333 533.333;"
                         xml:space="preserve">
                    <g>
                        <path fill="#2f3030" d="M266.667,0C119.391,0,0,119.391,0,266.667c0,147.275,119.388,266.666,266.667,266.666
                            c147.275,0,266.667-119.391,266.667-266.666C533.333,119.391,413.942,0,266.667,0z M292.523,356.311
                            c-24.229-1.882-34.397-13.883-53.388-25.421c-10.448,54.781-23.21,107.302-61.01,134.734
                            c-11.669-82.795,17.132-144.981,30.505-210.997c-22.804-38.389,2.744-115.643,50.844-96.601
                            c59.18,23.41-51.25,142.712,22.881,157.613c77.406,15.556,109.004-134.302,61.011-183.035
                            c-69.354-70.367-201.874-1.604-185.578,99.144c3.966,24.631,29.412,32.103,10.168,66.095c-44.385-9.839-57.63-44.845-55.925-91.517
                            c2.744-76.393,68.638-129.877,134.733-137.274c83.584-9.356,162.035,30.681,172.867,109.311
                            C431.826,267.107,381.899,363.223,292.523,356.311z"/>
                    </g>
                    </svg>
                </a>
            </div>
	</div>
	<footer class="entry-footer">
		<?php franks_entry_footer(); ?>
	</footer>
</article> 
<?php } else if (is_page('credit-card')) {
$apco_url = $_GET['url'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'franks' ),
				'after'  => '</div>',
			) );
        ?>
		<img class="apco-logo" src="<?php echo get_template_directory_uri() . '/images/apcopay-logo.png'; ?>" />
		
        <iframe src="<?php echo $apco_url; ?>" frameborder="0" class="cc-payment"></iframe>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'franks' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->

            <?php } ?>
