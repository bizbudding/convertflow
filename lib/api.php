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
 * @param string $api_key
 * @param string $website_id
 *
 * @return bool
 */
function authenticate_api_credentials( $api_key, $website_id ) {
	$response = \wp_remote_get(
		get_api_root() . 'websites/' . $website_id,
		[
			'headers' => [
				'Authorization' => $api_key,
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
 * @param string $query   Query parameters.
 * @param string $api_key API key.
 *
 * @return mixed
 */
function get_remote_data( $query, $api_key ) {
	$response = \wp_remote_get(
		get_api_root() . $query,
		[
			'headers' => [
				'Authorization' => $api_key,
			],
		]
	);

	return \json_decode( \wp_remote_retrieve_body( $response ), true );
}

\add_action( 'init', __NAMESPACE__ . '\\get_api_data' );
/**
 * Saves API data as transients.
 *
 * @since 1.0.0
 *
 * @param bool $reset Whether to bypass transient timeout check.
 *
 * @return array
 */
function get_api_data( $reset = false ) {
	if ( ! get_value( 'status' ) ) {
		return [];
	}

	$transient = get_transient( get_slug() );

	if ( ! $reset && $transient ) {
		return $transient;
	}

	$api_key         = get_value( 'api_key' );
	$website_id      = get_value( 'website_id' );
	$data['website'] = get_remote_data( 'websites/' . $website_id, $api_key );
	$data['areas']   = get_remote_data( 'areas', $api_key );
	$ctas            = get_remote_data( 'ctas', $api_key );

	foreach ( $ctas as $cta ) {
		if ( isset( $cta['cta_type'] ) && 'inline' === $cta['cta_type'] ) {
			$data['ctas'][] = $cta;
		}
	}

	set_transient( get_slug(), $data, HOUR_IN_SECONDS );

	return $data;
}
