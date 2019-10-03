<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_Share_Buttons\App\Model\Requester;

use Inc2734\WP_Share_Buttons\App\Contract\Model\Requester as Base;

/**
 * For API CORS
 */
class Twitter extends Base {

	/**
	 * Social service name
	 *
	 * @var string
	 */
	protected $service_name = 'twitter';

	/**
	 * Get count from API
	 *
	 * @param string $permalink
	 * @return int Count
	 */
	protected function _get_count( $permalink ) {
		$request  = "https://opensharecount.com/count.json?url=$permalink";
		$response = wp_remote_get( $request );
		$body = wp_remote_retrieve_body( $response );
		$body = json_decode( $body, true );

		if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
			error_log( '[WP Share Buttons] Twitter request / ' . $request . ' / ' . json_encode( $body ) );
		}

		if ( ! is_array( $body ) ) {
			return '-';
		}

		if ( ! isset( $body['count'] ) ) {
			return '-';
		}

		if ( isset( $body['error'] ) ) {
			if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
				error_log( get_stylesheet() . ': ' . $body['error'] );
			}
			return '-';
		}

		return $body['count'];
	}
}
