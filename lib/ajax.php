<?php

namespace ConvertFlow\Plugin;

\add_action( 'wp_ajax_convertflow', __NAMESPACE__ . '\\update_options' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @return void
 */
function update_options() {
	\check_ajax_referer( get_slug(), 'nonce' );

	$options               = \get_option( get_slug(), [] );
	$options['api_key']    = \sanitize_text_field( $_POST['api_key'] );
	$options['website_id'] = \sanitize_text_field( $_POST['website_id'] );
	$options['status']     = authenticate_api_credentials( $options['api_key'], $options['website_id'] );

	\update_option( get_slug(), $options );

	if ( $options['status'] ) {
		get_api_data( 1 );
	} else {
		\delete_transient( get_slug() );
	}

	\wp_send_json( $options, $options['status'] );

	exit;
}
