<?php

/**
 * Fired on plugins loaded
 *
 * @link       http://wordpress.org/plugins/wp-skeleton/
 * @since      1.0.0
 *
 * @package    WP_Skeleton
 * @subpackage WP_Skeleton/includes
 */


class WP_Skeleton_Updater {
    //Runs on activation
	public static function update() {
    if ( WP_SKELETON_VERSION !== get_option( 'wp_skeleton_version' ) ) {
      //update_option( 'wp_skeleton_version', WP_SKELETON_VERSION );
      //do stuff on plugin update
    }
	}

}
