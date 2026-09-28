<?php
/**
 * Conservative WooCommerce cleanup patterns.
 *
 * The goal is to remove optional work only when the store does not use it.
 * Never disable a WooCommerce feature solely because a generic performance
 * checklist recommends it.
 *
 * @package WooCommercePerformanceToolkit
 */

defined( 'ABSPATH' ) || exit;

/**
 * Example: disable cart fragments only on pages where you have proven that
 * no mini-cart/header-cart or extension depends on live fragment updates.
 *
 * This example intentionally requires an explicit opt-in constant.
 */
function arwpt_maybe_disable_cart_fragments() {
	if ( ! defined( 'ARWPT_DISABLE_CART_FRAGMENTS' ) || true !== ARWPT_DISABLE_CART_FRAGMENTS ) {
		return;
	}

	if ( is_admin() || is_cart() || is_checkout() || is_account_page() ) {
		return;
	}

	/**
	 * Before enabling this:
	 * - verify the theme header cart does not rely on fragments
	 * - verify add-to-cart feedback remains correct
	 * - verify third-party extensions do not depend on the script
	 */
	wp_dequeue_script( 'wc-cart-fragments' );
}
add_action( 'wp_enqueue_scripts', 'arwpt_maybe_disable_cart_fragments', 100 );

/**
 * Example: remove WooCommerce generator metadata.
 *
 * This is a tiny cleanup; it is not a meaningful performance optimization.
 * Included to distinguish low-value cleanup from real bottleneck work.
 */
function arwpt_remove_woocommerce_generator_tag() {
	remove_action( 'wp_head', 'wc_generator_tag' );
}
add_action( 'init', 'arwpt_remove_woocommerce_generator_tag' );

/**
 * Keep transactional pages out of generic page-cache logic built by custom
 * code. Most production sites should configure this in the hosting/cache layer.
 *
 * @return bool
 */
function arwpt_is_transactional_request() {
	if ( is_admin() ) {
		return true;
	}

	if ( function_exists( 'is_cart' ) && is_cart() ) {
		return true;
	}

	if ( function_exists( 'is_checkout' ) && is_checkout() ) {
		return true;
	}

	if ( function_exists( 'is_account_page' ) && is_account_page() ) {
		return true;
	}

	if ( wp_doing_ajax() ) {
		return true;
	}

	if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
		return true;
	}

	return is_user_logged_in();
}
