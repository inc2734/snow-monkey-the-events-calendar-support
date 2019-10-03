<?php
/**
 * @package mimizuku
 * @author inc2734
 * @license GPL-2.0+
 */

add_filter(
	'clean_url',
	function( $url ) {
		if ( false !== strstr( $url, 'fonts.googleapis.com' ) ) {
			$url = str_replace( '&#038;', '&', $url );
		}
		return $url;
	}
);
