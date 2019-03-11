<?php

/**
 * The public-specific functionality of the plugin.
 *
 * @link       http://wordpress.org/plugins/wp-skeleton/
 * @since      1.0.0
 *
 * @package    WP_Skeleton
 * @subpackage WP_Skeleton/public
 */

// The public functionality of the plugin
class WP_Skeleton_Public {

	// WP Skeleton - string
	private $wp_skeleton;

	//Plugin current version - string
	private $version;

	// Initialize
	public function __construct( $wp_skeleton, $version ) {
		$this->wp_skeleton = $wp_skeleton;
		$this->version = $version;
	}

	// Register and enqueue the public css
	public function enqueue_styles() {
		wp_enqueue_style( $this->wp_skeleton, plugin_dir_url( __FILE__ ) . 'css/wp-skeleton-public.css', array(), $this->version, 'all' );
	}

	// Register and enqueue the public js
	public function enqueue_scripts() {
		wp_enqueue_script( $this->wp_skeleton, plugin_dir_url( __FILE__ ) . 'js/wp-skeleton-public.js', array( 'jquery' ), $this->version, false );
	}

	// Register shortcodes
	public function register_shortcodes() {
		add_shortcode( 'wpskeleton', array( $this, 'wp_skeleton_shortcode' ) );
	}

	public function wp_skeleton_shortcode(){
		return 'WP Skeleton!';
	}

}
