<?php

namespace ConvertFlow\Plugin;

/**
 * Returns API root path.
 *
 * @since 1.0.0
 *
 * @return string
 */
function get_api_root() {
	return 'https://app.convertflow.co/api/v1/';
}

/**
 * Returns true or false depending on API authentication credentials.
 *
 * @since 1.0.0
 *
 * @return bool
 */
function authenticate_api_credentials() {
	$response = \wp_remote_get(
		get_api_root() . 'websites/' . get_value( 'website_id' ),
		[
			'headers' => [
				'Authorization' => get_value( 'api_key' ),
			],
		]
	);

	$status = \wp_remote_retrieve_response_code( $response );

	return 200 === $status ?: false;
}

/**
 * Returns JSON response body from API calls.
 *
 * @since 1.0.0
 *
 * @param string $query Query parameters.
 *
 * @return mixed
 */
function get_remote_data( $query = '' ) {
	$response = \wp_remote_get(
		get_api_root() . $query,
		[
			'headers' => [
				'Authorization' => get_value( 'api_key' ),
			],
		]
	);

	return \json_decode( \wp_remote_retrieve_body( $response ) );
}
