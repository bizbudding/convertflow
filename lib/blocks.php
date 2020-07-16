<?php

namespace ConvertFlow\Plugin;

\add_action( 'init', __NAMESPACE__ . '\\register_blocks' );
/**
 * Register our custom blocks.
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_blocks() {
	$handle      = get_slug() . '-blocks';
	$build       = require_once get_dir() . 'build/blocks.asset.php';
	$data        = get_api_data();
	$ctas        = isset( $data['ctas'] ) ? $data['ctas'] : [];
	$areas       = isset( $data['areas'] ) ? $data['areas'] : [];
	$cta_data    = [];
	$area_data   = [];
	$screenshots = [];

	foreach ( $ctas as $cta ) {
		$cta_data[] = [
			'value' => isset( $cta['id'] ) ? $cta['id'] : null,
			'label' => isset( $cta['name'] ) ? $cta['name'] : null,
		];

		$screenshots[ $cta['id'] ] = isset( $cta['variants'][0]['screenshot'] ) ? $cta['variants'][0]['screenshot'] : null;
	}

	foreach ( $areas as $area ) {
		$area_data[ $area['id'] ] = $area['name'];
	}

	\wp_register_script(
		$handle,
		get_url() . 'build/blocks.js',
		$build['dependencies'],
		$build['version']
	);

	\wp_localize_script(
		$handle,
		'convertflowData',
		[
			'website_id'  => get_value( 'website_id' ),
			'screenshots' => $screenshots,
			'ctas'        => $cta_data,
			'areas'       => $area_data,
			'logo'        => get_url() . 'assets/img/convertflow.png',
		]
	);

	\wp_register_style(
		$handle,
		get_url() . 'assets/css/blocks.css',
		[],
		get_asset_version( 'blocks.css' )
	);

	\register_block_type( 'convertflow/cta', [
		'editor_script' => $handle,
		'editor_style'  => $handle,
	] );

	\register_block_type( 'convertflow/area', [
		'editor_script' => $handle,
		'editor_style'  => $handle,
	] );
}
