<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_Share_Buttons;

use Inc2734\WP_Share_Buttons\App\Shortcode;

class Bootstrap {

	public function __construct() {
		load_textdomain( 'inc2734-wp-share-buttons', __DIR__ . '/languages/' . get_locale() . '.mo' );

		new Shortcode\Facebook( 'wp_share_buttons_facebook' );
		new Shortcode\Twitter( 'wp_share_buttons_twitter' );
		new Shortcode\Hatena( 'wp_share_buttons_hatena' );
		new Shortcode\Feedly( 'wp_share_buttons_feedly' );
		new Shortcode\GooglePlus( 'wp_share_buttons_google_plus' );
		new Shortcode\Line( 'wp_share_buttons_line' );
		new Shortcode\Pocket( 'wp_share_buttons_pocket' );
		new Shortcode\Pinterest( 'wp_share_buttons_pinterest' );
		new Shortcode\Feed( 'wp_share_buttons_feed' );
		new Shortcode\Copy( 'wp_share_buttons_copy' );
		new Shortcode\Buttons( 'wp_share_buttons' );

		add_action( 'wp_enqueue_scripts', [ $this, '_enqueue_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, '_enqueue_styles' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, '_enqueue_styles' ] );
		add_action( 'after_setup_theme', [ $this, '_add_editor_style' ] );
	}

	/**
	 * Enqueue scripts
	 *
	 * @return void
	 */
	public function _enqueue_scripts() {
		wp_enqueue_script(
			'wp-share-buttons',
			get_template_directory_uri() . '/vendor/inc2734/wp-share-buttons/src/assets/js/wp-share-buttons.min.js',
			[],
			filemtime( get_template_directory() . '/vendor/inc2734/wp-share-buttons/src/assets/js/wp-share-buttons.min.js' ),
			true
		);
	}

	/**
	 * Enqueue styles
	 *
	 * @return void
	 */
	public function _enqueue_styles() {
		wp_enqueue_style(
			'wp-share-buttons',
			get_template_directory_uri() . '/vendor/inc2734/wp-share-buttons/src/assets/css/wp-share-buttons.min.css',
			[],
			filemtime( get_template_directory() . '/vendor/inc2734/wp-share-buttons/src/assets/css/wp-share-buttons.min.css' )
		);
	}

	/**
	 * Add editor style
	 *
	 * @return void
	 */
	public function _add_editor_style() {
		add_editor_style(
			[
				'vendor/inc2734/wp-share-buttons/src/assets/css/wp-share-buttons.min.css',
			]
		);
	}
}
