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
class Facebook extends Base {

	/**
	 * Social service name
	 *
	 * @var string
	 */
	protected $service_name = 'facebook';

	/**
	 * Get count from API
	 *
	 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 *
	 * @see https://developers.facebook.com/tools/accesstoken
	 *
	 * @param string $permalink
	 * @return int Count
	 */
	protected function _get_count( $permalink ) {
		$app_token = apply_filters( 'inc2734_wp_share_buttons_facebook_app_token', false );

		if ( ! $app_token ) {
			error_log( '[WP Share Buttons] You need to set Facebook App Token.' );
			return '-';
		}

		$request  = "https://graph.facebook.com/?id={$permalink}&fields=engagement&access_token={$app_token}";
		$response = wp_remote_get( $request );
		$body = wp_remote_retrieve_body( $response );
		$body = json_decode( $body, true );

		if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
			error_log( '[WP Share Buttons] Facebook request / ' . $request . ' / ' . json_encode( $body ) );
		}

		if ( ! is_array( $body ) ) {
			return '-';
		}

		if ( isset( $body['share']['share_count'] ) ) {
			return $body['share']['share_count'];
		}

		if ( isset( $body['engagement']['share_count'] ) || isset( $body['engagement']['reaction_count'] ) ) {
			$engagement_count = 0;

			if ( isset( $body['engagement']['share_count'] ) ) {
				$engagement_count += $body['engagement']['share_count'];
			}

			if ( isset( $body['engagement']['reaction_count'] ) ) {
				$engagement_count += $body['engagement']['reaction_count'];
			}

			return $engagement_count;
		}

		return '-';
	}
}
