<?php
/**
 * @package inc2734/wp-google-fonts
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_Google_Fonts;

class Bootstrap {

	public function __construct() {
		add_filter( 'clean_url', [ $this, '_clean_url' ] );
	}

	public function _clean_url( $url ) {
		if ( false !== strstr( $url, 'fonts.googleapis.com' ) ) {
			$url = str_replace( '&#038;', '&', $url );
		}
		return $url;
	}
}
