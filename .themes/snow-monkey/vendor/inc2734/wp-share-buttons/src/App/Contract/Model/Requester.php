<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_Share_Buttons\App\Contract\Model;

use Inc2734\WP_Share_Buttons\App\Model\Count_Cache;

abstract class Requester {

	/**
	 * Social service name
	 *
	 * @var string
	 */
	protected $service_name;

	/**
	 * @param string $service_name
	 */
	public function __construct() {
		if ( ! $this->service_name ) {
			error_log( '[WP Share Buttons] $service_name is not defined.' );
			return;
		}

		add_action( 'wp_enqueue_scripts', [ $this, '_add_localize_script' ], 10000 );
		add_action( 'wp_ajax_inc2734_wp_share_buttons_' . $this->service_name, [ $this, '_ajax' ] );
		add_action( 'wp_ajax_nopriv_inc2734_wp_share_buttons_' . $this->service_name, [ $this, '_ajax' ] );
	}

	protected function _get_nonce_key() {
		return 'inc2734_wp_share_buttons_' . $this->service_name;
	}

	/**
	 * Setup localize script
	 *
	 * @return void
	 */
	public function _add_localize_script() {
		$handle = get_template();
		if ( ! wp_script_is( get_template() ) && wp_script_is( get_stylesheet() ) ) {
			$handle = get_stylesheet();
		}
		$handle = apply_filters( 'inc2734_wp_share_buttons_localize_script_handle', $handle );

		wp_localize_script(
			$handle,
			'inc2734_wp_share_buttons_' . $this->service_name,
			[
				'endpoint'    => admin_url( 'admin-ajax.php' ),
				'action'      => 'inc2734_wp_share_buttons_' . $this->service_name,
				'_ajax_nonce' => wp_create_nonce( $this->_get_nonce_key() ),
			]
		);
	}

	/**
	 * Ajax
	 *
	 * @return void
	 */
	public function _ajax() {
		check_ajax_referer( $this->_get_nonce_key() );

		if ( ! isset( $_GET['post_id'] ) ) {
			$this->_send_json( '-' );
			return;
		}

		$post_id = sanitize_text_field( wp_unslash( $_GET['post_id'] ) );
		$count_cache = new Count_Cache( $post_id, $this->service_name );

		$cache = $count_cache->get();
		if ( false !== $cache ) {
			$this->_send_json( $cache );
			return;
		}

		$count = $this->_request();
		$count_cache->update( $count );
		$this->_send_json( $count );
	}

	/**
	 * Send json
	 *
	 * @param array $count
	 * @return json
	 */
	protected function _send_json( $count ) {
		if ( ! is_numeric( $count ) ) {
			$count = '-';
		}

		wp_send_json(
			[
				'count' => $count,
			]
		);
	}

	/**
	 * Request to API
	 *
	 * @return int Count
	 */
	protected function _request() {
		if ( empty( $_GET['post_id'] ) ) {
			return '-';
		}

		$permalink = get_permalink( sanitize_text_field( wp_unslash( $_GET['post_id'] ) ) );
		if ( ! $permalink ) {
			return '-';
		}

		if ( 0 === strpos( $permalink, 'http://' ) ) {
			$count = $this->_get_count( rawurlencode( $permalink ) );
		} elseif ( 0 === strpos( $permalink, 'https://' ) ) {
			$count = $this->_get_count( rawurlencode( $permalink ) );
			if ( apply_filters( 'inc2734_wp_share_buttons_apply_https_total_count', true ) ) {
				$https_count = $count;
				$http_count  = $this->_get_count( rawurlencode( str_replace( 'https://', 'http://', $permalink ) ) );
				$count       = $this->_add( $https_count, $http_count );
			}
		}

		if ( ! is_numeric( $count ) ) {
			return '-';
		}

		return $count;
	}

	/**
	 * Add count
	 *
	 * @param int|- $a
	 * @param int|- $b
	 */
	protected function _add( $arg1, $arg2 ) {
		if ( is_numeric( $arg1 ) && is_numeric( $arg2 ) ) {
			return $arg1 + $arg2;
		} elseif ( is_numeric( $arg2 ) ) {
			return $arg1;
		} elseif ( is_numeric( $arg2 ) ) {
			return $arg2;
		}

		return '-';
	}

	/**
	 * Get count from API
	 *
	 * @param string $permalink
	 * @return int Count
	 */
	abstract protected function _get_count( $permalink );
}
