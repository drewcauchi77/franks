<?php

/* 
 *
 * Template Name: Home page
 *
*/

get_header();

// $slider = get_field( "home_slider", get_the_ID() );
// if( !empty($slider) ){
// 	echo "<div class='custom-slider-class'>";
// 	echo do_shortcode( $slider );
// 	echo "</div>";
// }
?>

<div class="desktop-banners homepage-desktop-banners">

	<?php

	while( have_rows('banners-desktop', get_the_ID()) ): the_row(); ?>

		<div class="single-desktop-slide">

			<?php if(!get_sub_field('button_text')){?>

				<a class="banner-link" href=<?php the_sub_field('link'); ?>>

			<?php }?>

			<img class="banner" src=<?php the_sub_field('image'); ?>>

			<?php if(get_sub_field('title')){?>
				
				<div class="title-overlay">

					<h3 class="title-text"><?php the_sub_field('title');?></h3>

			<?php } ?>
			
			<?php if(get_sub_field('button_text')){
				
				$button_pos = get_sub_field('button_position');
				$button_color = get_sub_field('button_color_picker');
				$text_color = get_sub_field('text_in_button_color_picker');

				?>

				<a class="button-link" href=<?php the_sub_field('link'); ?> style="<?php 
					if($button_pos == "Left"){
						echo "left: calc((100vw/786)*125);right:unset;margin:unset;";
					}else if($button_pos == "Right"){
						echo "right: calc((100vw/786)*125);left:unset;margin:unset;";
					}
					if($button_color !== "#2f3030"){
						echo "background-color:".$button_color.";";
					}
					if($text_color !== "#ffffff"){
						echo "color:".$text_color.";";
					}
				?>">

					<span class="button-text">
						<?php the_sub_field('button_text');?>
					</span>

				</a>

			<?php } ?>
			
			<?php if(get_sub_field('title')){?>
				
				</div>

			<?php } ?>

			<?php if(!get_sub_field('button_text')){?>

				</a>

			<?php }?>

		</div>	

	<?php endwhile; ?>

</div>

<div class="mobile-banners homepage-mobile-banners">
	<?php

	while( have_rows('banners-mobile', get_the_ID()) ): the_row(); ?>

		<div class="single-mobile-slide">
			
			<?php if(!get_sub_field('button_text')){?>

				<a class="banner-link" href=<?php the_sub_field('link'); ?>>

			<?php }?>

			<img class="banner" src=<?php the_sub_field('image'); ?>>

			<?php if(get_sub_field('title')){?>
				
				<div class="title-overlay">

					<h3 class="title-text"><?php the_sub_field('title');?></h3>

			<?php } ?>
			
			<?php if(get_sub_field('button_text')){
				
				$button_color = get_sub_field('button_color_picker');
				$text_color = get_sub_field('text_in_button_color_picker');

				?>

				<a class="button-link" href=<?php the_sub_field('link'); ?> style="<?php 
					if($button_color !== "#2f3030"){
						echo "background-color:".$button_color.";";
					}
					if($text_color !== "#ffffff"){
						echo "color:".$text_color.";";
					}
				?>">

					<span class="button-text">
						<?php the_sub_field('button_text');?>
					</span>

				</a>

			<?php } ?>

			<?php if(get_sub_field('title')){?>
				
				</div>

			<?php } ?>

			<?php if(!get_sub_field('button_text')){?>

				</a>

			<?php }?>

		</div>	

	<?php endwhile; ?>
</div>

<?php
$title = 'The art of living beautiful';
$post_title = strtolower( str_replace( " ","-",( get_the_title() ) ) );
echo "<div class='fnk-art-class $post_title'>";?>
<div class="title-divider-container"><h1 class="title">The art of living beautiful</h1></div><?php
echo "</div>";
?>

    <div class="entry-content">
        <div class="page-container">
            <?php

if( have_rows('home_page_flexible_content') ){

    while ( have_rows('home_page_flexible_content') ) : the_row();

		// For New Arravial Section
		if( get_row_layout() == 'new_in_section' ){
			$hide_show = get_sub_field('new_in_show_hide',get_the_ID() );
			if($hide_show == "show"){

				?>
                <div class="fns-section-class fns-new-in-section">
                    <div class="page-container">
                        <div class="title-divider-container">
                            <h2 class="title"><?php the_sub_field('new_in_title', get_the_ID() ); ?></h2>
                        </div>
                    </div>
                    <?php

				if( have_rows('new_in_section_rep') ):
				?>
                        <div class="fns-new-in-slider-section">
                            <div class="woocommerce">
                                <ul class="products custom-product-slider-class">
                                    <?php
					$nproductids = array();
						while ( have_rows('new_in_section_rep') ) : the_row();
							$product = get_sub_field_object('select_product', get_the_ID() );
							$post_id = $product['value'];
							$product = wc_get_product( $post_id );
							// array_push($nproductids,$post_id);
							?>
                                        
							<li class="product type-product status-publish">
								<a href="<?= get_permalink( $post_id ) ; ?>" class="product-list-link">
									<div class="product-image-holder ">
										<img width="208" height="400" alt="<?= get_the_title($post_id); ?>" src="<?= get_the_post_thumbnail_url($post_id); ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" sizes="(max-width: 208px) 100vw, 208px">
									</div>
									<div class="inner-prod-text">
									<?php
											if(has_term('Dior','product_cat', $post_id)){
												echo '<h3>DIOR</h3>';
											}else{
												echo '<br>';
											}
										?>
										<h3><?= get_the_title($post_id); ?></h3>
									</div>
									<?php 
									$no_of_chars = strlen(substr(strrchr($product->price,"."),1));
									if($no_of_chars == 0){?>

										<span class="price"><h4 class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">€</span><?= $product->price .'.00'; ?></h4></span>

									<?php
									}else if($no_of_chars == 1){?>

										<span class="price"><h4 class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">€</span><?= $product->price .'0'; ?></h4></span>

									<?php
									}else{
									?>

										<span class="price"><h4 class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">€</span><?= $product->price; ?></h4></span>
										
									<?php } ?>
								</a>
								<a href="<?= get_permalink( $post_id ) ; ?>" class="button product_type_variable add_to_cart_button" rel="nofollow">Add To Cart</a>
								<div class="cart-wishlist">
									<div class="add-to-wishlist"></div>
								</div>
								<div data-item_id="<?= $post_id; ?>" data-action="alg-wc-wl-toggle" class="alg-wc-wl-btn alg-wc-wl-thumb-btn alg-wc-wl-thumb-btn-abs alg-wc-wl-thumb-btn-loop add" style="left: 17px; top: 17px; right: auto; bottom: auto;">
													<div class="alg-wc-wl-view-state alg-wc-wl-view-state-add">
														<i class="fa fa-heart" aria-hidden="true"></i>
													</div>
													<div class="alg-wc-wl-view-state alg-wc-wl-view-state-remove">
														<i class="fa fa-heart" aria-hidden="true"></i>
													</div>
												</div>
							</li> 
							

                                        <?php 
						endwhile;
						// echo do_shortcode('[products limit=-1 columns=3 ids="'.implode(",",$nproductids).'"]');
					?>
                                </ul>
                            </div>
                        </div>
                </div>
                <?php 
				endif;
			}
		}

		// For Special Offer Section
		if( get_row_layout() == 'other_section' ){ 

			$hide_show = get_sub_field('hide_show',get_the_ID() );
			if($hide_show == "show"){

				$tilte = get_sub_field('tilte',get_the_ID() );
				$image = get_sub_field('image',get_the_ID() );
				$text = get_sub_field('text',get_the_ID() );
				$button_text = get_sub_field('button_text',get_the_ID() );
				$button_link = get_sub_field('button_link',get_the_ID() );
				?>
                    <div class="fns-section-class <?= str_replace(" ","-",trim($tilte)); ?>">
                        <div class="custom-offer-section-class">
                            <div class="page-container">
                                <div class="title-divider-container">
                                    <h2 class="title"><?= $tilte; ?></h2>
                                </div>
                            </div>
                            <div class="<?= strtolower( str_replace("&","", trim(str_replace(" ","-", trim($tilte)) )  ) ); ?> custom-offer-image-class">
                                <div style="background-image: url(<?= $image; ?>)"></div>
                            </div>
                            <p>
                                <?= $text; ?>
                            </p>
                            <div class="section-button">
                                <a href="<?= $button_link; ?>">
                                    <?= $button_text; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
			}
		}

		// For Trending Section
		if( get_row_layout() == 'trending_section' ){
			$hide_show = get_sub_field('trending_show_hide',get_the_ID() );
			if($hide_show == "show"){ ?>
				<div class="fns-section-class fns-trending-section-class">
						<div class="page-container">
							<div class="title-divider-container">
								<h2 class="title"><?php the_sub_field('trending_title', get_the_ID() ); ?></h2>
							</div>
							<div class="gender_dropdown fnk-arrow-class">
								<select name="treding_gender" id="treding_gender">
									<option value="">All</option>
									<option value="For-Him" class="gender-option-him" >For Him</option>
									<option value="For-Her" class="gender-option-her" >For Her</option>
								<select>
							</div>
						</div>
						<?php

						if( have_rows('select_products')   ):
						?>
						
							<div class="trending-products-class">
								<div class="woocommerce">
									<ul class="products custom-product-trending-slider-class">
										<?php
										$himproductids = array();
										while ( have_rows('select_products') ) : the_row();
											$product = get_sub_field_object('select_product', get_the_ID() );
											$post_id = $product['value'];
											$product = wc_get_product( $post_id );
											$gender = str_replace(" ","-",get_sub_field('gender'));
											array_push($himproductids,$post_id);
											?>
										
											<li class="product type-product status-publish <?= $gender; ?>">
												<a href="<?= get_permalink( $post_id ) ; ?>" class="product-list-link">
													<div class="product-image-holder ">
														<img width="208" alt="<?= get_the_title($post_id); ?>" height="400" src="<?= get_the_post_thumbnail_url($post_id); ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" sizes="(max-width: 208px) 100vw, 208px">
													</div>
													<?php
															if(has_term('Dior','product_cat', $post_id)){
																echo '<h3>DIOR</h3>';
															}else{
																echo '<p style="margin-top: 65px;"></p>';
															}
														?>
													<div class="inner-prod-text">
														<h3><?= get_the_title($post_id); ?></h3>
													</div>

													<?php 
													$no_of_chars = strlen(substr(strrchr($product->price,"."),1));
													if($no_of_chars == 0){?>

														<span class="price"><h4 class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">€</span><?= $product->price .'.00'; ?></h4></span>

													<?php
													}else if($no_of_chars == 1){?>

														<span class="price"><h4 class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">€</span><?= $product->price .'0'; ?></h4></span>

													<?php
													}else{
													?>

														<span class="price"><h4 class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">€</span><?= $product->price; ?></h4></span>
														
													<?php } ?>												
												</a>
												<a href="<?= get_permalink( $post_id ) ; ?>" class="button product_type_variable add_to_cart_button" rel="nofollow">Add To Cart</a>
												<div class="cart-wishlist">
													<div class="add-to-wishlist"></div>
												</div>
												<div data-item_id="<?= $post_id; ?>" data-action="alg-wc-wl-toggle" class="alg-wc-wl-btn alg-wc-wl-thumb-btn alg-wc-wl-thumb-btn-abs alg-wc-wl-thumb-btn-loop add" style="left: 17px; top: 17px; right: auto; bottom: auto;">
													<div class="alg-wc-wl-view-state alg-wc-wl-view-state-add">
														<i class="fa fa-heart" aria-hidden="true"></i>
													</div>
													<div class="alg-wc-wl-view-state alg-wc-wl-view-state-remove">
														<i class="fa fa-heart" aria-hidden="true"></i>
													</div>
												</div>
											</li> 
											<?php
										endwhile;
									//echo do_shortcode('[products limit=-1 columns=3 ids="'.implode(",",$himproductids).'"]');
									?>
								</ul>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<?php 
				}
			}

    // End loop.
	endwhile;
	?>
	<div class="brands">
			<div class="page-container">
				<div class="title-divider-container">
					<h2 class="title">Brands</h2>
				</div>
			</div>

			<div class="brand-block">                
                <div class="shop-brands-slider">
				   <!-- HTML for brand images + links -->	 
						<?php $query = new WP_Query( array( 'post_type' => 'brands','posts_per_page'=> -1, 'orderby' => 'name', 'order' => 'ASC') );
						if ( $query->have_posts() ) : ?>
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>	

								<div class="brand" data-brand-name="<?php echo the_title(); ?>">
									<a href="<?php echo get_home_url() . '/product-category/brands/' . $post->post_name; ?>">
									<?php $image = get_field('brand_logo'); ?>
										<img src="<?php echo $image; ?>" />
										
									</a>
								</div>
							<?php endwhile; wp_reset_postdata(); ?>
						<?php endif; ?>
                </div>              
            </div>
		</div><?php
}
?>

        </div>
    </div>

    <?php 

get_footer();

?>