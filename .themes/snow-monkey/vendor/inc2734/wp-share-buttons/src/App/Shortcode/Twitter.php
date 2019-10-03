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
 * Twitter button
 */
class Twitter extends Base {

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

		$title = wp_strip_all_tags( get_the_title( $attributes['post_id'] ) . ' - ' . get_bloginfo( 'name' ) );

		$attributes = shortcode_atts(
			[
				'type'     => 'balloon',
				'title'    => apply_filters( 'inc2734_wp_share_buttons_shared_title', $title, 'twitter' ),
				'post_id'  => '',
				'hashtags' => apply_filters( 'inc2734_wp_share_buttons_shared_hashtags', '', 'twitter' ),
			],
			$attributes
		);

		if ( 'official' === $attributes['type'] ) {
			$file = 'official';
		} else {
			$file = 'twitter';
		}

		if ( function_exists( 'scc_get_share_twitter' ) ) {
			$has_cache  = true;
			$expiration = null;
			$count      = scc_get_share_twitter();
		} else {
			$count_cache = new Count_Cache( $attributes['post_id'], 'twitter' );
			$has_cache   = $count_cache->is_enabled();
			$expiration  = $count_cache->get_cache_expiration();
			$cache       = $count_cache->get();
			$count       = $count_cache->is_enabled() ? $cache : '-';
		}

		return $this->render(
			'twitter/' . $file,
			[
				'type'       => $attributes['type'],
				'title'      => $attributes['title'],
				'post_id'    => $attributes['post_id'],
				'hashtags'   => $attributes['hashtags'],
				'has_cache'  => $has_cache,
				'expiration' => $expiration,
				'count'      => $count,
			]
		);
	}
}
