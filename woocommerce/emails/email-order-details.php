<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$text_align = is_rtl() ? 'right' : 'left';

//do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>

<h2>
	<?php
	if ( $sent_to_admin ) {
		$before = '<a class="link" href="' . esc_url( $order->get_edit_order_url() ) . '">';
		$after  = '</a>';
	} else {
		$before = '';
		$after  = '';
	}
	/* translators: %s: Order ID. */

	echo wp_kses_post( $before . sprintf( __( '[Order #%s]', 'woocommerce' ) . $after . ' (<time datetime="%s">%s</time>)', $order->get_order_number(), $order->get_date_created()->format( 'c' ), wc_format_datetime( $order->get_date_created() ) ) );

	?>
</h2>

<?php 

// echo '<pre>' . var_export($order, true) . '</pre>'; 

// $order_meta = $order->get_meta_data();
// echo '<pre>' . var_export($order_meta, true) . '</pre>'; 

// if ( get_post_meta( $order->id, 'Collect From Shop', true ) !== "" ) { 
// 	echo "SHOP SELECTED";
// }

?>

<?php if($order->get_status() !== 'cancelled'){ 
	$item_data    = $order->get_data(); 
	$order_meta = get_post_meta($item_data['id']);
	$items = $order->get_items();
	global $product;
	
	$shipping_total = $order->get_shipping_total();
	
?>

	<table style=" border-collapse: collapse; color: #737373;  border: 1px solid #e5e5e5; vertical-align: middle; width: 100%; font-family: 'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif; margin-bottom:30px;">
		<tr>
			<th style="color:#737373; border:1px solid #e5e5e5; vertical-align:middle; padding:12px; text-align:left"><b>Product</b></th>
			<th style="color:#737373; border:1px solid #e5e5e5; vertical-align:middle; padding:12px; text-align:left"><b>Quantity</b></th>
			<th style="color:#737373; border:1px solid #e5e5e5; vertical-align:middle; padding:12px; text-align:left"><b>Price</b></th>
		</tr>
		<?php foreach ( $items as $item_id => $item_data ) {

				if($item_data['variation_id'] !== 0){
					$product_id = $item_data['variation_id'];
					$product = wc_get_product($product_id);
					$product_barcode = $product->get_sku();
				}else{
					$product_id = $item_data['product_id'];
					$product = wc_get_product($product_id);	
					$product_barcode = $product->get_sku();
				}

				?><tr>
					<td style="color:#737373; border:1px solid #e5e5e5; padding:12px; text-align:left; vertical-align:middle; font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif; word-wrap:break-word">
						<?php echo $item_data['name']; ?> <br>
						<?php echo '(' . $product_barcode . ')'; ?> 
					</td>
					<td style="color:#737373; border:1px solid #e5e5e5; padding:12px; text-align:left; vertical-align:middle; font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif; word-wrap:break-word"><?php echo $order->get_item_meta($item_id, '_qty', true) ?></td>
					<td style="color:#737373; border:1px solid #e5e5e5; padding:12px; text-align:left; vertical-align:middle; font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif; word-wrap:break-word">€<?php echo  number_format($order->get_item_meta($item_id, '_line_total', true),2) ?></td>		
		   <?php } 
		 		// var_dump($order->get_payment_method());
				// var_dump($order_meta['Collect From'][0]);
				// var_dump($order_meta['Collect From Shop'][0]);  
		   ?>
		</tr>
		<tr>
			<td style="color:#737373; border:1px solid #e5e5e5; vertical-align:middle; padding:12px; text-align:left; border-top-width:2px"><b>Subtotal</b></td>
			<td style="color:#737373; border:1px solid #e5e5e5; vertical-align:middle; padding:12px; text-align:left; border-top-width:2px" colspan="2">€<?= number_format($order->get_subtotal(),2); ?></td>		
		</tr>
		<?php 
		if($order->get_payment_method() !== "cheque"){
			if($order_meta['Collect From'][0] == null && $order_meta['Collect From Shop'][0] == null){ ?>
				<tr >
					<td style="color:#737373; border:1px solid #e5e5e5; vertical-align:middle; padding:12px; text-align:left; border-top-width:2px"><b>Delivery Charge</b></td>
					<td style="color:#737373; border:1px solid #e5e5e5; vertical-align:middle; padding:12px; text-align:left; border-top-width:2px" colspan="2">€<?= number_format($shipping_total,2); ?></td>		
				</tr>
			<?php } 
		} ?>
		<tr>
			<td style="color:#737373; border:1px solid #e5e5e5; vertical-align:middle; padding:12px; text-align:left; border-top-width:2px"><b>Payment Method</b></td>
			<td style="color:#737373; border:1px solid #e5e5e5; vertical-align:middle; padding:12px; text-align:left; border-top-width:2px" colspan="2"><?= $order->get_payment_method_title(); ?></td>			
		</tr>
		<tr>
			<td style="color:#737373; border:1px solid #e5e5e5; vertical-align:middle; padding:12px; text-align:left; border-top-width:2px"><b>Total</b></td>
			<td style="color:#737373; border:1px solid #e5e5e5; vertical-align:middle; padding:12px; text-align:left; border-top-width:2px" colspan="2">€<?= number_format($order->get_total(),2);?></td>			
		</tr>
	</table>

	<?php if($order_meta['Collect From'][0]) { ?>
		<p><strong>Collect From:</strong><?= $order_meta['Collect From'][0] ?></p>
	<?php } ?>

	<?php if($order_meta['Collect From Shop'][0]) { ?>
		<p><strong>Collect From:</strong><?= $order_meta['Collect From Shop'][0] ?></p>
	<?php } ?>

	<?php if($order_meta['Gold Card'][0]) { ?>
		<p><strong>Gold Card Number:</strong> <?= $order_meta['Gold Card'][0] ?></p>
	<?php } ?>

	<?php if($order_meta['Gift Wrapping'][0]) { ?>
		<p><strong>Gift Wrapping:</strong> <?= $order_meta['Gift Wrapping'][0] ?></p>
	<?php } ?>

	<?php if($order_meta['Gift Message'][0] && $order_meta['Gift Message'][0] !== 'No Message') { ?>
		 <p><strong>Gift Message:</strong><?= $order_meta['Gift Message'][0] ?></p>
	<?php } ?>

	<?php if($order->get_customer_note()) { ?>
		<p><strong>Customer Note:</strong> <?= $order->get_customer_note(); ?></p>
	<?php } ?>

	<?php if($order_meta['Personalized Note'][0]) { ?>
		<p><strong>Personalized Note:</strong> <?= $order_meta['Personalized Note'][0] ?></p>
	<?php } ?>
	
<?php } ?>

<?php // do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>
