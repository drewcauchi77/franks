<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates/Emails
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
															</div>
														</td>
													</tr>
												</table>
												<!-- End Content -->
											</td>
										</tr>
									</table>
									<!-- End Body -->
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<!-- Footer -->
									<table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer">
										<tr>
											<td valign="top">
												<table border="0" cellpadding="10" cellspacing="0" width="100%">
													<tr>
														<td colspan="2" valign="middle" id="credit">
															<?php echo wpautop( wp_kses_post( wptexturize( apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) ) ) ) ); ?>
															<ul style="list-style: none; padding-left: 0px;">
																<li style="display: inline-block; margin: 0px 10px;">
																	<a target="_blank" href="https://www.facebook.com/FranksPerfumery">
																		<img src="https://franks.com.mt/wp-content/themes/franks/images/facebook.png" style="width: 30px !important; margin-right: 0px;">
																	</a>
																</li>
																<li style="display: inline-block; margin: 0px 10px;">
																	<a target="_blank" href="https://twitter.com/FRANKS_Malta">
																		<img src="https://franks.com.mt/wp-content/themes/franks/images/twitter.png" style="width: 30px !important; margin-right: 0px;">
																	</a>
																</li>
																<li style="display: inline-block; margin: 0px 10px;">
																	<a target="_blank" href="https://www.instagram.com/franksmalta/">
																		<img src="https://franks.com.mt/wp-content/themes/franks/images/instagram-2.png" style="width: 30px !important; margin-right: 0px;">
																	</a>
																</li>
																<li style="display: inline-block; margin: 0px 10px;">
																	<a target="_blank" href="https://www.youtube.com/user/FranksMalta">
																		<img src="https://franks.com.mt/wp-content/themes/franks/images/youtube.png" style="width: 30px !important; margin-right: 0px;">
																	</a>
																</li>
																<li style="display: inline-block; margin: 0px 10px;">
																	<a target="_blank" href="https://www.pinterest.com/franksmalta/">
																		<img src="https://franks.com.mt/wp-content/themes/franks/images/pinterest.png" style="width: 30px !important; margin-right: 0px;">
																	</a>
																</li>
															</ul>
															<img src="https://franks.com.mt/wp-content/themes/franks/images/brand-tagline.png" style="width: 600px;padding-top: 40px;">

														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<!-- End Footer -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
