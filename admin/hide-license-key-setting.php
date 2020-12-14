<?php
/**
 * Plugin Name: AffiliateWP - Hide License Key
 * Plugin URI: https://affiliatewp.com/
 * Description: Hides the License Key setting from the AffiliateWP -> Settings -> General tab in the admin.
 * Author: Drew Jaynes, DrewAPicture
 * Author URI: https://affiliatewp.com
 * Version: 1.0.0
 */
 
/**
 * Completely hides the License Key setting from AffiliateWP's General settings tab.
 *
 * Define the 'AFFILIATEWP_HIDE_LICENSE_KEY' constant as true in wp-config.php to hide the setting.
 *
 * @since 1.0.0
 *
 * @param array $settings General settings.
 * @return array (Maybe) modified general settings.
 */
function affwp_example_hide_license_key( $settings ) {
	if ( defined( 'AFFILIATEWP_HIDE_LICENSE_KEY' ) && AFFILIATEWP_HIDE_LICENSE_KEY ) {
		unset( $settings['license'] );
		unset( $settings['license_key'] );
	}

	return $settings;
}
add_filter( 'affwp_settings_general', 'affwp_example_hide_license_key', 100 );
