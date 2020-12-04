<?php
/**
 * Plugin Name: AffiliateWP - Add a new currency
 * Plugin URI: http://affiliatewp.com
 * Description: Adds a new currency to AffiliateWP
 * Author: Andrew Munro, Drew Jaynes
 * Author URI: https://affiliatewp.com
 * Version: 1.0
 */
 
// Register the currency and code.
add_filter( 'affwp_currencies', function( $currencies ) {
	$currencies['GHS'] = __( 'Ghanaian Cedi', 'textdomain' );

	return $currencies;
} );

// Handle formatting the Cedi with the symbol before the amount.
add_filter( 'affwp_ghs_currency_filter_before', function( $formatted, $currency, $amount ) {
	$formatted = '&#8373;' . $amount;

	return $formatted;
}, 10, 3 );

// Handle formatting the Cedi with the symbol after the amount.
add_filter( 'affwp_ghs_currency_filter_after', function( $formatted, $currency, $amount ) {
	$formatted = $amount . '&#8373;';

	return $formatted;
}, 10, 3 );
