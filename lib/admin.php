<?php

namespace ConvertFlow\Plugin;

\add_action( 'admin_menu', __NAMESPACE__ . '\\admin_menu_page', 0 );
/**
 * Description of expected behavior.
 *
 * @since 0.1.0
 *
 * @return void
 */
function admin_menu_page() {
	$page = \add_menu_page(
		'ConvertFlow',
		'ConvertFlow',
		'manage_options',
		'convertflow',
		__NAMESPACE__ . '\\render_admin_menu_page',
		get_url() . 'assets/img/convertflow.svg',
		80
	);

	add_action( "load-$page", __NAMESPACE__ . '\\admin_scripts' );
}

/**
 * Enqueues admin scripts.
 *
 * @since 1.0.0
 *
 * @return void
 */
function admin_scripts() {
	$handle = get_slug() . '-admin';

	\wp_register_script(
		$handle,
		get_url() . 'assets/js/admin.js',
		[ 'jquery' ],
		get_asset_version( 'admin.js' ),
		true
	);

	\wp_localize_script(
		'convertflowSettings',
		get_slug(),
		[
			'ajax_url'   => \admin_url( 'admin-ajax.php' ),
			'action'     => get_slug(),
			'nonce'      => \wp_create_nonce( get_slug() ),
			'api_key'    => get_value( 'api_key' ),
			'website_id' => get_value( 'website_id' ),
		]
	);

	\wp_enqueue_script( $handle );
}

\add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\admin_styles');
/**
 * Enqueues admin styles.
 *
 * @since 1.0.0
 *
 * @return void
 */
function admin_styles() {
	$handle = get_slug() . '-admin';

	\wp_register_style(
		$handle,
		get_url() . 'assets/css/admin.css',
		[],
		get_version(),
		'all'
	);

	// Always needed for menu icon styles.
	\wp_enqueue_style( $handle );
}

/**
 * Renders the admin page markup.
 *
 * @since 0.1.0
 *
 * @return void
 */
function render_admin_menu_page() {
	$status = get_value( 'status' ) ? 'success' : 'error';

	?>
	<div class="wrap">
		<br>
		<img src="<?php echo esc_url( get_url() . 'assets/img/convertflow.png' ); ?>" alt="ConvertFlow" width="200">
		<br>
		<p><?php esc_html_e( 'Enter your site API Key and Website ID below.', 'convertflow' ) ?></p>
		<form class="convertflow" action="javascript:void(0);" data-status="<?php echo esc_attr( $status ); ?>">
			<p class="success success-message"><?php esc_html_e( 'Connected.', 'convertflow' ); ?></p>
			<p class="error error-message"><?php esc_html_e( 'Incorrect API key or website ID.', 'convertflow' ) ?></p>
			<p>
				<label for="name"><strong><?php esc_html_e( 'API Key', 'convertflow' ); ?></strong></label>
				<br>
				<input type="text" id="api_key" name="api_key" title="api_key" value="<?php echo esc_attr( get_value( 'api_key' ) ); ?>">
				&nbsp;
				<img src="<?php echo esc_url( get_url() . 'assets/img/tick.png' ); ?>" alt="<?php esc_attr_e( 'Check', 'convertflow' ); ?>" width="16">
			</p>
			<p>
				<label for="email"><strong><?php esc_html_e( 'Website ID', 'convertflow' ); ?></strong></label>
				<br>
				<input type="text" id="website_id" name="website_id" title="website_id" value="<?php echo esc_attr( get_value( 'website_id' ) ); ?>">
				&nbsp;
				<img src="<?php echo esc_url( get_url() . 'assets/img/tick.png' ); ?>" alt="<?php esc_attr_e( 'Check', 'convertflow' ); ?>" width="16">
			</p>
			<input type="hidden" name="action" value="custom_action">
			<p>
				<button class="button button-primary button-hero">
					<?php esc_html_e( 'Connect', 'convertflow' ); ?>
					&nbsp;
					<img src="<?php echo esc_url( get_url() . 'assets/img/spinner.gif' ); ?>" alt="<?php esc_attr_e( 'Spinner', 'convertflow' ) ?>" width="16">
				</button>
			</p>
		</form>
	</div>
	<?php
}
