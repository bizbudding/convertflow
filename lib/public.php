<?php

namespace ConvertFlow\Plugin;

\add_action( 'wp_head', __NAMESPACE__ . '\\enqueue_scripts' );
/**
 * Enqueues ConvertFlow install code script.
 *
 * @since 1.0.0
 *
 * @return void
 */
function enqueue_scripts() {
	$status     = get_value( 'status' );
	$website_id = get_value( 'website_id' );

	if ( ! $status || ! $website_id ) {
		return;
	}

	\wp_register_script(
		get_slug(),
		'https://js.convertflow.co/production/websites/' . $website_id . '.js',
		[],
		get_version(),
		false
	);

	\wp_enqueue_script( get_slug() );
}

add_filter( 'script_loader_tag', __NAMESPACE__ . '\\async_script', 10, 2 );
/**
 * Adds aysnc attribute to script.
 *
 * @since 1.0.0
 *
 * @param string $tag    Tag for the enqueued script.
 * @param string $handle The script's registered handle.
 *
 * @return string
 */
function async_script( $tag, $handle ) {
	if ( get_slug() === $handle ) {
		$tag = str_replace( ' src', ' async src', $tag );
	}

	return $tag;
}
