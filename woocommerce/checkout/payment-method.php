<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<li class="wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>">
	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />

	<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
		<?php echo $gateway->get_title(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */

		if( $gateway->id == "apcopay1" ){
			echo '<img src="http://franks.stevesandco.com/wp-content/themes/franks/images/card-logos.png" alt="Pay online and we will deliver to your address">';
		}

		echo $gateway->get_icon(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ 
		?>
	</label>

	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>" 
			<?php if ( ! $gateway->chosen ) : /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>style="display:none;"
			<?php endif; /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>>

			<?php $gateway->payment_fields();?>

			<?php if ( $gateway->id == "apcopay" ) { ?>
			
			<div class="apcopay-collect-from-shop" style="width: 100%;padding: 1em;margin: 1em 0;font-size: .92em;line-height: 1.5;">
				<input type="radio" class="input-radio " value="0" name="radio_choice" id="radio_choice_0">
				<label for="radio_choice_0" class="radio">Collect From Shop</label>
				<div class="collect-from-shop-details">
					<p>Should you prefer to order and pay online, and collect products from one of our stores, this option allows you to do so! Kindly note that upon confirmation of order, products are to be collected within 3 days. 
						Please choose one of the following stores to pickup your order from.</p>
					<select name="shop-collect1" id="shop-collect1">
						<option value="">Choose Shop</option>
						<?php $shop = get_all_shops();
								while ( $shop->have_posts() ) : $shop->the_post();
									global $post;
						?>
									<option value="<?php the_title(); ?>"><?php the_title(); ?></option>
						<?php endwhile; ?>
					</select> 
				</div>
			</div>
			<div class="apcopay-deliver" style="width: 100%;padding: 1em;margin: 1em 0;font-size: .92em;line-height: 1.5;">
				<input type="radio" class="input-radio " value="5" name="radio_choice" id="radio_choice_5">
				<label for="radio_choice_5" class="radio ">Deliver to your door</label>
				<input type="radio" name="radio_choice" id="extra_radio">
			</div>
			
			<?php } ?>

			<?php if ( $gateway->id == "cheque" ) { ?>
				<select name="shop-collect" id="shop-collect">
					<option value="">Choose Shop</option>
					<?php $shop = get_all_shops();
							while ( $shop->have_posts() ) : $shop->the_post();
							global $post;
					?>
								<option value="<?php the_title(); ?>"><?php the_title(); ?></option>
					<?php endwhile; ?>
					</select> 
			<?php } ?>
			
		</div>
	<?php else: ?>
	<!-- <pre><?php echo $gateway->has_fields(); echo $gateway->get_description(); ?></pre> -->
	<!-- <pre><?php print_r($gateway); ?></pre> -->
	<?php endif; ?>
</li>

<script>

$('.input-radio').click(function(){
	$(this).attr('checked','checked');
	// $('#radio_choice_5').click();

	setTimeout(function(){ 
		$('#radio_choice_5').click();
	}, 3000);

	$('.input-radio').not(this).removeAttr('checked');
	
	var attr = $('#payment_method_cheque').attr('checked');

	if(attr){
		$('.woocommerce-shipping-totals').css('visibility','collapse');
	}
	
	if($('input[value=apcopay]:checked, input[value=0]:checked').length == 2){
		$('.woocommerce-shipping-totals').css('visibility','collapse');
	}
	
});

</script>

<style>
	.apcopay-collect-from-shop .collect-from-shop-details{
		display: none;
	}
	.apcopay-collect-from-shop .collect-from-shop-details.active{
		display: block;
	}
	.payment_box.payment_method_apcopay{
		display: grid;
		grid-template-areas: 'collect'
			'deliver'
			'carddetails';
	}
	.payment_box.payment_method_apcopay .apcopay-for-woocommerce-checkout-container{
		grid-area: carddetails;
	}
	.payment_box.payment_method_apcopay .apcopay-collect-from-shop{
		grid-area: collect;
		padding: 0px !important;
	}
	.payment_box.payment_method_apcopay .apcopay-deliver{
		grid-area: deliver;
		padding: 0px !important;
	}
	@media only screen and (max-width: 480px){
		.checkout.woocommerce-checkout{
			padding: 10px !important;
		}
		.wc_payment_methods.payment_methods.methods{
			padding: 0px !important;
		}
	}
</style>