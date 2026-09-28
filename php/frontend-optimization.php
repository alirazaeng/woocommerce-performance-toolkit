<?php
/**
 * Frontend rendering examples for WordPress/WooCommerce.
 *
 * @package WooCommercePerformanceToolkit
 */

defined( 'ABSPATH' ) || exit;

/**
 * Example: add fetchpriority="high" to one verified LCP image by attachment ID.
 *
 * Define ARWPT_LCP_ATTACHMENT_ID only after measuring the actual LCP image.
 *
 * @param array $attr       Image attributes.
 * @param mixed $attachment Attachment object.
 * @param mixed $size       Requested image size.
 * @return array
 */
function arwpt_prioritize_verified_lcp_image( $attr, $attachment, $size ) {
	unset( $size );

	if ( ! defined( 'ARWPT_LCP_ATTACHMENT_ID' ) ) {
		return $attr;
	}

	if ( empty( $attachment->ID ) || (int) $attachment->ID !== (int) ARWPT_LCP_ATTACHMENT_ID ) {
		return $attr;
	}

	$attr['fetchpriority'] = 'high';
	$attr['loading']       = 'eager';

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'arwpt_prioritize_verified_lcp_image', 10, 3 );

/**
 * Example: preconnect to a verified critical cross-origin host.
 *
 * Do not add speculative preconnects; each one consumes browser resources.
 *
 * @param array  $urls          Existing resource hint URLs.
 * @param string $relation_type Hint type.
 * @return array
 */
function arwpt_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' !== $relation_type ) {
		return $urls;
	}

	if ( ! defined( 'ARWPT_CRITICAL_ORIGIN' ) || ! ARWPT_CRITICAL_ORIGIN ) {
		return $urls;
	}

	$urls[] = array(
		'href'        => esc_url( ARWPT_CRITICAL_ORIGIN ),
		'crossorigin' => 'anonymous',
	);

	return $urls;
}
add_filter( 'wp_resource_hints', 'arwpt_resource_hints', 10, 2 );

/**
 * Example helper for rendering reserved image space.
 *
 * Prefer WordPress-generated image markup where possible because it includes
 * width/height and responsive attributes automatically.
 *
 * @param int    $attachment_id Attachment ID.
 * @param string $size          Registered image size.
 * @return string
 */
function arwpt_render_stable_image( $attachment_id, $size = 'large' ) {
	return wp_get_attachment_image(
		$attachment_id,
		$size,
		false,
		array(
			'decoding' => 'async',
		)
	);
}
