<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_Share_Buttons\App\Shortcode;

use Inc2734\WP_Share_Buttons\App\Contract\Shortcode\Button as Base;

/**
 * Pocket button
 */
class Pocket extends Base {

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
			$file = 'pocket';
		}

		return $this->render(
			'pocket/' . $file,
			[
				'type'    => $attributes['type'],
				'post_id' => $attributes['post_id'],
			]
		);
	}
}
