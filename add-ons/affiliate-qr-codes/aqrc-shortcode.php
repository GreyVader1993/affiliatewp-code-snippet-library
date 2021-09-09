<?php
/**
 * Plugin Name: AffiliateWP - Affiliate QR Codes - QR Code Shortcode
 * Plugin URI: https://affiliatewp.com
 * Description: Displays the QR code for the current or specified affiliate when using the Affiliate QR Codes add-on.
 * Author: Drew Jaynes
 * Author URI: https://werdswords.com
 * Version: 1.0
 */

if ( class_exists( 'AffiliateWP_Affiliate_QR_Codes' ) && ! shortcode_exists( 'affiliate_qr_code' ) ) {

	add_shortcode( 'affiliate_qr_code', 'affwp_render_affiliate_qr_code' );

	/**
	 * Renders the [affiliate_qr_code] shortcode.
	 *
	 * If the current user is an affiliate and no 'affiliate' attribute is set, the current
	 * affiliate ID will be used. If the current user is not an affiliate and no 'affiliate'
	 * attribute is set, nothing will be displayed.
	 *
	 * @param array $atts    {
	 *     Shortcode attributes.
	 *
	 *     @type int $affiliate Optional. Affiliate ID. Default is the current affiliate ID.
	 * }
	 * @param null  $content Shortcode content (unused).
	 * @return string Shortcode output.
	 */
	function affwp_render_affiliate_qr_code( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'affiliate' => 0,
			),
			$atts,
			'affiliate_qr_code'
		);

		if ( affwp_is_affiliate() && empty( $atts['affiliate' ] ) ) {
			$atts['affiliate'] = affwp_get_affiliate_id();
		}

		if ( empty( $atts['affiliate'] )
		     || ( isset( $atts['affiliate'] ) && ! affwp_get_affiliate( $atts['affiliate'] ) )
		) {
			return '';
		}

		$generator = affiliatewp_affiliate_qr_codes()->generator;
		$image_url = $generator->get_code_for_affiliate( $atts['affiliate'] );

		// Set margin=1 for the QR code link.
		$image_url_href = add_query_arg( array( 'margin' => 1 ), $image_url );

		// Set margin=0 for the QR code display.
		$image_url_src = add_query_arg( array( 'margin' => 0 ), $image_url );

		$image  = $generator->build_image_html( $image_url_src );
		$output = sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( $image_url_href ), $image );

		return $output;
	}
}
