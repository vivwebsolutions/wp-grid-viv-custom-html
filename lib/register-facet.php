<?php
/**
 * Custom HTML facet class — loaded by vivgb_check_plugins() in SHORTINIT AJAX context.
 */
class ViV_Custom_Html_Class {

	public function __construct() {}

	public function render_facet( $facet, $items ) {
		$fs = is_array( $facet['settings'] ) ? (object) $facet['settings'] : json_decode( $facet['settings'] );
		$html = $fs->html ?? '';
		return $html;
	}
}
