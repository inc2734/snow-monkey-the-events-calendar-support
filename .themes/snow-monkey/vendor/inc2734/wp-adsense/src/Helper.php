<?php
/**
 * @package inc2734/wp-adsense
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_Adsense;

class Helper {

	/**
	 * Display google adsense
	 *
	 * @param $code
	 * @param $size
	 * @return void
	 */
	public static function the_adsense_code( $code, $size = null ) {
		if ( ! is_null( $size ) ) {
			if ( in_array( $size, [ 'big-banner', 'large-mobile' ] ) ) {
				$code = preg_replace( '/data-ad-format=[\"|\'][a-z]+?[\"|\']/', 'data-ad-format="horizontal"', $code );
			} elseif ( in_array( $size, [ 'large-sky-scraper' ] ) ) {
				$code = preg_replace( '/data-ad-format=[\"|\'][a-z]+?[\"|\']/', 'data-ad-format="vertical"', $code );
			} elseif ( in_array( $size, [ 'rectangle-big', 'rectangle', 'rectangle-big-2', 'rectangle-2' ] ) ) {
				$code = preg_replace( '/data-ad-format=[\"|\'][a-z]+?[\"|\']/', 'data-ad-format="rectangle"', $code );
			} elseif ( in_array( $size, [ 'link' ] ) ) {
				$code = preg_replace( '/data-ad-format=[\"|\'][a-z]+?[\"|\']/', 'data-ad-format="link"', $code );
			}
		}

		if ( ! preg_match( '/<script>/s', $code ) ) {
			if ( ! preg_match( '/<ins /s', $code ) ) {
				// Auto ads.
				$code = '<script>' . $code . '</script>';
			} else {
				// Not auto ads.
				$code .= '<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
			}
		}

		// @todo
		// @codingStandardsIgnoreStart
		echo apply_filters( 'inc2734_wp_adsense_the_adsense_code', $code );
		// @codingStandardsIgnoreEnd
	}
}
