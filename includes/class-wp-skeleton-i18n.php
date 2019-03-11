<?php

/**
 * Define the internationalization functionality for translations 
 *
 * @link       http://wordpress.org/plugins/wp-skeleton/
 * @since      1.0.0
 *
 * @package    WP_Skeleton
 * @subpackage WP_Skeleton/includes
 */

class WP_Skeleton_i18n {

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-skeleton',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
