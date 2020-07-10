<?php

namespace ConvertFlow\Plugin;

/**
 * Returns the main plugin directory.
 *
 * @since 1.0.0
 *
 * @return string
 */
function get_dir() {
	static $dir = null;

	return \is_null( $dir ) ? \trailingslashit( \dirname( __DIR__ ) ) : $dir;
}

/**
 * Returns the main plugin file.
 *
 * @since 1.0.0
 *
 * @return string
 */
function get_file() {
	static $file = null;

	return \is_null( $file ) ? get_dir() . 'convertflow.php' : $file;
}

/**
 * Returns the plugin directory URL.
 *
 * @since 1.0.0
 *
 * @return string
 */
function get_url() {
	static $url = null;

	return \is_null( $url ) ? \trailingslashit( \plugin_dir_url( get_file() ) ) : $url;
}

/**
 * Returns plugin slug.
 *
 * @since 1.0.0
 *
 * @return string
 */
function get_slug() {
	static $slug = null;

	return is_null( $slug ) ? 'convertflow' : $slug;
}

/**
 * Returns plugin file headers data.
 *
 * @since 1.0.0
 *
 * @param string $header Header to retrieve.
 *
 * @return array
 */
function get_data( $header ) {
	static $data = [];

	if ( empty( $data ) ) {
		$data = \get_file_data(
			get_file(),
			[
				'Name'        => 'Plugin Name',
				'PluginURI'   => 'Plugin URI',
				'Version'     => 'Version',
				'Description' => 'Description',
				'Author'      => 'Author',
				'AuthorURI'   => 'Author URI',
				'TextDomain'  => 'Text Domain',
				'DomainPath'  => 'Domain Path',
				'Network'     => 'Network',
			],
			'plugin'
		);
	}

	return $data[ $header ];
}

/**
 * Returns value of a single option.
 *
 * @since 1.0.0
 *
 * @param string $name    Name of option to retrieve.
 * @param mixed  $default Default value (optional).
 *
 * @return mixed
 */
function get_value( $name, $default = null ) {
	static $options = [];

	if ( ! \array_key_exists( $name, $options ) ) {
		$all_options = \get_option( get_slug() );

		$options[ $name ] = isset( $all_options[ $name ] ) ? $all_options[ $name ] : $default;
	}

	return $options[ $name ];
}
