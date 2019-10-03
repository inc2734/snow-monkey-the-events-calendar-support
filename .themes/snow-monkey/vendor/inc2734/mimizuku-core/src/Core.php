<?php
/**
 * @package mimizuku-core
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\Mimizuku_Core;

use Inc2734\Mimizuku_Core\Helper;

class Core {

	public function __construct() {
		load_textdomain( 'inc2734-mimizuku-core', __DIR__ . '/languages/' . get_locale() . '.mo' );

		$includes = [
			'/setup',
		];
		foreach ( $includes as $include ) {
			Helper::include_files( __DIR__ . $include );
		}
	}
}
