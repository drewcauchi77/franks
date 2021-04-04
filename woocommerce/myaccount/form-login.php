<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">
        <div class="grid account-container">
                <div class="col col-1-2 login">
					<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>

					<div class="inner-wl-form">
						<?php 
                            echo do_shortcode('[theme-my-login default_action="login" login_template="my-login-form.php"]');
                        ?>                                    
                    </div>
                </div>                            
            </div>

	</div>

	<div class="u-column1 col-1">
        <div class="grid account-container">
                <div class="col col-1-2 register">
					<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>
					<div class="inner-wl-form">
                        <?php 
                            echo do_shortcode('[theme-my-login default_action="register" register_template="register.php"]');
                        ?>                                    
                    </div>
                </div>                            
            </div>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
