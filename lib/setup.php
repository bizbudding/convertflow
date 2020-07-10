<?php

namespace ConvertFlow\Plugin;

\add_action( 'init', __NAMESPACE__ . '\\load_textdomain' );
/**
 * Load plugin textdomain.
 */
function load_textdomain() {
	\load_plugin_textdomain(
		get_slug(),
		false,
		get_dir() . get_data( 'TextDomain' )
	);
}
