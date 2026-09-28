<?php
/**
 * Database diagnostics for WordPress/WooCommerce.
 *
 * These helpers REPORT suspicious data. They do not delete production data.
 *
 * @package WooCommercePerformanceToolkit
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return the largest autoloaded options by stored value size.
 *
 * Use this for diagnosis. Large does not automatically mean unnecessary.
 *
 * @param int $limit Maximum rows.
 * @return array
 */
function arwpt_get_largest_autoloaded_options( $limit = 20 ) {
	global $wpdb;

	$limit = max( 1, min( 100, absint( $limit ) ) );

	// phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
	$sql = $wpdb->prepare(
		"SELECT option_name, LENGTH(option_value) AS bytes
		FROM {$wpdb->options}
		WHERE autoload IN ('yes', 'on', 'auto', 'auto-on')
		ORDER BY bytes DESC
		LIMIT %d",
		$limit
	);

	// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
	return $wpdb->get_results( $sql, ARRAY_A );
}

/**
 * Sum autoloaded option payload size.
 *
 * This is diagnostic only; serialized/DB storage overhead means it should be
 * interpreted as an approximate payload measure rather than memory usage.
 *
 * @return int Bytes.
 */
function arwpt_get_autoload_payload_bytes() {
	global $wpdb;

	// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
	$bytes = $wpdb->get_var(
		"SELECT COALESCE(SUM(LENGTH(option_value)), 0)
		FROM {$wpdb->options}
		WHERE autoload IN ('yes', 'on', 'auto', 'auto-on')"
	);

	return (int) $bytes;
}

/**
 * Format bytes for an admin/debug report.
 *
 * @param int $bytes Byte count.
 * @return string
 */
function arwpt_format_bytes( $bytes ) {
	return size_format( max( 0, (int) $bytes ), 2 );
}

/*
Example usage in WP-CLI, an authenticated admin-only debug screen, or local
diagnostics:

$bytes = arwpt_get_autoload_payload_bytes();
$options = arwpt_get_largest_autoloaded_options( 20 );

Do not expose option values publicly. Option values may contain secrets or
private application data.
*/
