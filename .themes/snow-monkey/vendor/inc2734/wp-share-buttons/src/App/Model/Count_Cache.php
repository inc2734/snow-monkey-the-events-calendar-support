<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_Share_Buttons\App\Model;

/**
 * Count cache control
 */
class Count_Cache {

	/**
	 * @var int
	 */
	protected $post_id;

	/**
	 * @var string
	 */
	protected $service_name;

	/**
	 * @param int $post_id
	 * @param string $service_name Social service name
	 */
	public function __construct( $post_id, $service_name ) {
		$this->post_id      = $post_id;
		$this->service_name = $service_name;
	}

	/**
	 * Return count cache
	 *
	 * @return null|int
	 */
	public function get() {
		$cache = get_post_meta( $this->post_id, '_inc2734_count_cache_' . $this->service_name, true );
		return '' !== $cache && time() <= $cache['expiration'] ? $cache['count'] : false;
	}

	/**
	 * Return count cache
	 *
	 * @return null|int
	 */
	public function get_cache_expiration() {
		$cache = get_post_meta( $this->post_id, '_inc2734_count_cache_' . $this->service_name, true );
		if ( ! empty( $cache['expiration'] ) ) {
			return date_i18n( 'm-d-Y H:i:s', $cache['expiration'] );
		}
	}

	/**
	 * Return true when have count cache
	 *
	 * @return bool
	 */
	public function is_enabled() {
		$cache = $this->get();
		return false !== $cache;
	}

	/**
	 * Update count cache
	 *
	 * @return bool
	 */
	public function update( $count ) {
		update_post_meta(
			$this->post_id,
			'_inc2734_count_cache_' . $this->service_name,
			[
				'count'      => $count,
				'expiration' => time() + (int) apply_filters( 'inc2734_wp_share_buttons_count_cache_seconds', 60 * 5 ),
			]
		);
	}
}
