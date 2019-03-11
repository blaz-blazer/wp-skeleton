<?php

/**
 * @link              http://wordpress.org/plugins/wp-skeleton/
 * @since             1.0.0
 * @package           WP Skeleton
 *
 * @wordpress-plugin
 * Plugin Name: 			WP Skeleton
 * Plugin URI:
 * Description:				Skeleton for building a WordPress plugin with modern technologies.
 * Version:           1.0.0
 * Author:						John Doe
 * Author URI:
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-skeleton
 * Domain Path:       /languages
 */

/*
BUILT ON TOP OF DEVIN VINSON'S WORDPRESS PLUGIN BOILERPLATE
MORE HERE: https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Plugin version
define( 'WP_SKELETON_VERSION', '1.0.0' );

// Plugin activation
function activate_wp_skeleton() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-skeleton-activator.php';
	WP_Skeleton_Activator::activate();
}

// Plugin deactivation
function deactivate_wp_skeleton() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-skeleton-deactivator.php';
	WP_Skeleton_Deactivator::deactivate();
}

//plugin update
function update_wp_skeleton() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-skeleton-updater.php';
	WP_Skeleton_Updater::update();
}

//hooks and actions 
register_activation_hook( __FILE__, 'activate_wp_skeleton' );
register_deactivation_hook( __FILE__, 'deactivate_wp_skeleton' );
add_action( 'plugins_loaded', 'update_wp_skeleton');

// The core plugin class
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-skeleton.php';

// Execute the plugin
function run_wp_skeleton() {

	$plugin = new WP_Skeleton();
	$plugin->run();

}
run_wp_skeleton();
