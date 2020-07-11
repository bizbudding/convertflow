<?php

namespace ConvertFlow\Plugin;

\add_shortcode( 'convertflow_cta', __NAMESPACE__ . '\\add_shortcode' );
/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param array $atts
 *
 * @return string
 */
function add_shortcode( $atts = [] ) {
	if ( ! get_value( 'status' ) ) {
		return __( 'ConvertFlow API not connected.', 'convertflow' );
	}

	$atts = \shortcode_atts(
		[
			'id' => null,
		],
		$atts,
		'convertflow_cta'
	);

	if ( \is_null( $atts['id'] ) ) {
		return __( 'Please enter CTA ID.', 'convertflow' );
	}

	$id     = (int) $atts['id'];
	$data   = get_api_data();
	$ctas   = $data['ctas'];
	$output = '';

	foreach ( $ctas as $cta ) {
		if ( isset( $cta['id'] ) && (int) $id === $cta['id'] ) {
			$output = \sprintf(
				'<div class="cf-cta-snippet cta%1$s" website-id="%2$s" cta-id="%1$s"></div>',
				$cta['id'],
				get_value( 'website_id' )
			);
		}
	}

	return $output;
}
