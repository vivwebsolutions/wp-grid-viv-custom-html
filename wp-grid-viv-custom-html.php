<?php
/*
 * Plugin Name:       WP Grid Builder ViV Custom HTML Facet
 * Description:       Adds a Custom HTML facet type to WP Grid Builder. Use it to inject arbitrary HTML into the grid sidebar (descriptions, CTAs, branding, etc.). Requires WP Grid Builder and WP Grid Builder ViV Addon.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            ViVwebsolutions
 * Author URI:        https://vivwebsolutions.com/
 * Text Domain:       wp-grid-viv-custom-html
 * Requires Plugins:  wp-grid-builder, wp-grid-viv-addon
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WPGB_VCH_FILE', __FILE__ );
define( 'WPGB_VCH_PATH', plugin_dir_path( WPGB_VCH_FILE ) );
define( 'WPGB_VCH_VERSION', '1.0.0' );

foreach ( glob( WPGB_VCH_PATH . '/lib/*.php' ) as $filename ) {
	include_once $filename;
}

register_activation_hook( __FILE__, function () {
	$vivgb_data = get_option( 'vivgb_data', [] );
	if ( ! is_array( $vivgb_data ) ) {
		$vivgb_data = [];
	}
	$vivgb_data['plugins']['viv_custom_html'] = [
		'dir' => basename( __DIR__ ),
	];
	update_option( 'vivgb_data', $vivgb_data, false );
} );

register_deactivation_hook( __FILE__, function () {
	$vivgb_data = get_option( 'vivgb_data', [] );
	if ( isset( $vivgb_data['plugins']['viv_custom_html'] ) ) {
		unset( $vivgb_data['plugins']['viv_custom_html'] );
		update_option( 'vivgb_data', $vivgb_data, false );
	}
} );

/**
 * Register the Custom HTML facet type with WPGB.
 * This runs in normal WP context (admin + front-end).
 */
add_filter( 'wp_grid_builder/facets', function ( $facets ) {
	$facets['custom_html'] = [
		'name'     => __( 'Custom HTML', 'wp-grid-viv-custom-html' ),
		'type'     => 'load',
		'class'    => 'ViV_Custom_Html_Class',
		'icon'     => '<svg viewBox="0 0 24 24" width="24" height="24"><path d="M8 12.5h8V11H8v1.5Z M19 6.5H5a2 2 0 0 0-2 2V15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.5a2 2 0 0 0-2-2ZM5 8h14a.5.5 0 0 1 .5.5V15a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V8.5A.5.5 0 0 1 5 8Z"/></svg>',
		'controls' => [
			[
				'type'   => 'fieldset',
				'panel'  => 'general',
				'fields' => [
					'html' => [
						'type'        => 'code',
						'label'       => __( 'HTML Code', 'wp-grid-viv-custom-html' ),
						'placeholder' => __( 'Enter your HTML code here...', 'wp-grid-viv-custom-html' ),
					],
				],
			],
		],
	];
	return $facets;
}, 10, 1 );
