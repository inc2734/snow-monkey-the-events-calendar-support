<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_Share_Buttons\App\Shortcode;

use Inc2734\WP_Share_Buttons\App\Contract\Shortcode\Button as Base;
use Inc2734\WP_Share_Buttons\App\Model\Count_Cache;

/**
 * Feedly button
 */
class Feedly extends Base {

	/**
	 * Register shortcode
	 *
	 * @param array $attributes
	 * @return void
	 */
	public function _shortcode( $attributes ) {
		if ( ! isset( $attributes['post_id'] ) ) {
			return;
		}

		$attributes = shortcode_atts(
			[
				'type'    => 'balloon',
				'post_id' => '',
			],
			$attributes
		);

		if ( 'official' === $attributes['type'] ) {
			$file = 'official';
		} else {
			$file = 'feedly';
		}

		if ( function_exists( 'scc_get_follow_feedly' ) ) {
			$has_cache  = true;
			$expiration = null;
			$count      = scc_get_follow_feedly();
		} else {
			$count_cache = new Count_Cache( $attributes['post_id'], 'feedly' );
			$has_cache   = $count_cache->is_enabled();
			$expiration  = $count_cache->get_cache_expiration();
			$cache       = $count_cache->get();
			$count       = $count_cache->is_enabled() ? $cache : '-';
		}

		return $this->render(
			'feedly/' . $file,
			[
				'type'       => $attributes['type'],
				'post_id'    => $attributes['post_id'],
				'has_cache'  => $has_cache,
				'expiration' => $expiration,
				'count'      => $count,
			]
		);
	}
}
