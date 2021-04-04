<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/no-products-found.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<p class="woocommerce-info my-custom-no-product"><?php _e( 'Our online shop doesn\'t seem to have what you\'re looking for but please continue to browse our 
	stock in case something else tickles your fancy. <br>Should you need a specific product which is currently not available on our site, 
	kindly send us your request on <span>eshop@franks.com.mt</span></br>and we will find a way to meet your demand.', 'woocommerce' ); ?></p>
