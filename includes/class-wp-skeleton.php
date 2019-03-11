<?php

/**
 * The core plugin class
 *
 * @link       http://wordpress.org/plugins/wp-skeleton/
 * @since      1.0.0
 *
 * @package    WP_Skeleton
 * @subpackage WP_Skeleton/includes
 */


// Defines internationalization, admin-specific hooks and public hooks
class WP_Skeleton {

	// Registers all hooks for the plugin
	protected $loader;

	// WP Skeleton - string
	protected $wp_skeleton;

	//Plugin current version - string
	protected $version;

    // Set the WP Skeleton and the plugin version, and fire the methods!
	public function __construct() {
		if ( defined( 'WP_SKELETON_VERSION' ) ) {
			$this->version = WP_SKELETON_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->wp_skeleton = 'wp-skeleton';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	//Load the required dependencies for this plugin.

	private function load_dependencies() {
		// Menages hooks
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-skeleton-loader.php';

		// Menages internationalization
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-skeleton-i18n.php';

		// Menages admin side
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-skeleton-admin.php';

		// Menages public side
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-skeleton-public.php';

        //Fire the loader
		$this->loader = new WP_Skeleton_Loader();
	}

	// Register internationalization
	private function set_locale() {
		$plugin_i18n = new WP_Skeleton_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	// Register admin hooks
	private function define_admin_hooks() {
		$plugin_admin = new WP_Skeleton_Admin( $this->get_WP_Skeleton(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	// Register public hooks
	private function define_public_hooks() {

		$plugin_public = new WP_Skeleton_Public( $this->get_WP_Skeleton(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_public, 'register_shortcodes' );

	}

	// Run the loader to execute all hooks
	public function run() {
		$this->loader->run();
	}

	// WP Skeleton for identification
	public function get_WP_Skeleton() {
		return $this->wp_skeleton;
	}

	// The reference to the class that orchestrates the hooks with the plugin
	public function get_loader() {
		return $this->loader;
	}

	// Retrive the plugin version
	public function get_version() {
		return $this->version;
	}

}
