<?php
/**
 * Conditional asset-loading examples for WooCommerce.
 *
 * IMPORTANT:
 * - Treat this as a reference file, not a drop-in plugin.
 * - Confirm each script/style is unused before dequeuing it.
 * - Test cart, checkout, account, filters, variations, and extension features.
 *
 * @package WooCommercePerformanceToolkit
 */

defined( 'ABSPATH' ) || exit;

/**
 * Example: dequeue a known third-party asset outside the pages that need it.
 *
 * Replace the placeholder handles and condition with your own verified case.
 */
function arwpt_conditionally_dequeue_example_assets() {
	if ( is_admin() ) {
		return;
	}

	$feature_is_needed = is_product() || is_cart() || is_checkout();

	if ( $feature_is_needed ) {
		return;
	}

	// Example placeholders only. Do not use until you confirm the real handles.
	wp_dequeue_script( 'example-feature-script' );
	wp_dequeue_style( 'example-feature-style' );
}
add_action( 'wp_enqueue_scripts', 'arwpt_conditionally_dequeue_example_assets', 100 );

/**
 * Example: register a small feature script only on product pages.
 */
function arwpt_enqueue_product_only_script() {
	if ( ! is_product() ) {
		return;
	}

	$relative_path = '/assets/js/product-enhancement.js';
	$absolute_path = get_stylesheet_directory() . $relative_path;

	if ( ! file_exists( $absolute_path ) ) {
		return;
	}

	wp_enqueue_script(
		'arwpt-product-enhancement',
		get_stylesheet_directory_uri() . $relative_path,
		array(),
		(string) filemtime( $absolute_path ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'arwpt_enqueue_product_only_script' );

/**
 * Example: add defer only to a script you own and have verified as defer-safe.
 *
 * Do not apply defer blindly to WooCommerce, payment, consent, or dependency-
 * sensitive scripts.
 *
 * @param string $tag    Full script tag.
 * @param string $handle Script handle.
 * @param string $src    Script URL.
 * @return string
 */
function arwpt_defer_owned_script( $tag, $handle, $src ) {
	unset( $src );

	$defer_handles = array(
		'arwpt-product-enhancement',
	);

	if ( ! in_array( $handle, $defer_handles, true ) ) {
		return $tag;
	}

	if ( false !== strpos( $tag, ' defer' ) ) {
		return $tag;
	}

	return str_replace( ' src=', ' defer src=', $tag );
}
add_filter( 'script_loader_tag', 'arwpt_defer_owned_script', 10, 3 );
