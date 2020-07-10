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
	\add_menu_page(
		'ConvertFlow',
		'ConvertFlow',
		'manage_options',
		'convertflow',
		__NAMESPACE__ . '\\render_admin_menu_page',
		get_url() . 'assets/img/convertflow.svg',
		80
	);
}

\add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\enqueue_admin_scripts_styles' );
/**
 * Enqueues admin scripts and styles.
 *
 * @since 1.0.0
 *
 * @return void
 */
function enqueue_admin_scripts_styles() {
	\wp_enqueue_script(
		get_slug(),
		get_url() . 'assets/js/ajax.js',
		[ 'jquery' ],
		'',
		true
	);

	\wp_localize_script(
		get_slug(),
		get_slug(),
		[
			'ajax_url'   => \admin_url( 'admin-ajax.php' ),
			'action'     => get_slug(),
			'nonce'      => \wp_create_nonce( get_slug() ),
			'api_key'    => get_value( 'api_key' ),
			'website_id' => get_value( 'website_id' ),
		]
	);

	\wp_enqueue_style(
		get_slug(),
		get_url() . 'assets/css/admin.css'
	);
}

/**
 * Description of expected behavior.
 *
 * @since 0.1.0
 *
 * @return void
 */
function render_admin_menu_page() {
	?>
	<div class="wrap">
		<br>
		<img src="<?php echo esc_url( get_url() . 'assets/img/convertflow.png' ); ?>" alt="ConvertFlow" width="200">
		<br>
		<p><?php esc_html_e( 'Enter your site API Key and Website ID below.', 'convertflow' ) ?></p>
		<div class="convertflow">
			<p>
				<label for="name"><strong><?php esc_html_e( 'API Key', 'convertflow' ); ?></strong></label>
				<br>
				<input type="text" id="api_key" name="api_key" title="api_key" value="<?php echo esc_attr( get_value( 'api_key' ) ); ?>">
				&nbsp;
				<img src="<?php echo esc_url( get_url() . 'assets/img/tick.png' ); ?>" alt="<?php esc_attr_e( 'Tick', 'convertflow' ); ?>" width="16">
			</p>
			<p>
				<label for="email"><strong><?php esc_html_e( 'Website ID', 'convertflow' ); ?></strong></label>
				<br>
				<input type="text" id="website_id" name="website_id" title="website_id" value="<?php echo esc_attr( get_value( 'website_id' ) ); ?>">
				&nbsp;
				<img src="<?php echo esc_url( get_url() . 'assets/img/tick.png' ); ?>" alt="<?php esc_attr_e( 'Tick', 'convertflow' ); ?>" width="16">
			</p>
			<input type="hidden" name="action" value="custom_action">
			<p>
				<button id="submit_button" class="button button-primary button-hero">
					<?php esc_html_e( 'Connect', 'convertflow' ); ?>
					&nbsp;
					<img src="<?php echo esc_url( get_url() . 'assets/img/spinner.gif' ); ?>" alt="<?php esc_attr_e( 'Spinner', 'convertflow' ) ?>" width="16">
				</button>
			</p>
		</div>
	</div>
	<?php
}
