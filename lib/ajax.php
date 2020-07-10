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

	$options = \get_option( get_slug() );

	if ( isset( $_POST['api_key'] ) ) {
		$options['api_key'] = \sanitize_text_field( $_POST['api_key'] );
	}

	if ( isset( $_POST['website_id'] ) ) {
		$options['website_id'] = \sanitize_text_field( $_POST['website_id'] );
	}

	$options['status'] = authenticate_api_credentials() ? 'success' : 'error';

	\update_option( get_slug(), $options );

	\wp_send_json( $_POST, $options['status'] );

	exit;
}
