<?php
/**
 * Plugin Name: AffiliateWP - Disable Affiliate To Affiliate Referrals
 * Plugin URI: http://affiliatewp.com
 * Description: Prevents affiliates from earning a commission if the purchase was made by another logged-in affiliate
 * Author: Andrew Munro
 * Author URI: http://affiliatewp.com
 * Version: 2.0
 */
function affwp_custom_disable_affiliate_to_affiliate_referrals( $referral_amount, $affiliate_id, $amount, $reference, $product_id, $context ) {
	$user = wp_get_current_user();

	// affwp_is_affiliate() will check if the currently logged in user is an affiliate.
	// if they are an affiliate, set the referral amount to 0.00
	if ( affwp_is_affiliate( $user->ID ) ) {
		$referral_amount = 0.00;
	}

	return $referral_amount;
}
add_filter( 'affwp_calc_referral_amount', 'affwp_custom_disable_affiliate_to_affiliate_referrals', 10, 6 );
