<?php
/**
 * @package mimizuku-core
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\Mimizuku_Core\App\Contract\Helper;

use Inc2734\WP_Page_Speed_Optimization;

trait Page_Speed_Optimization {

	/**
	 * Write ache control setting into .htaccess
	 *
	 * @param bool $enable
	 * @return int|false bytes
	 */
	public static function write_cache_control_setting( $enable ) {
		return WP_Page_Speed_Optimization\Helper\write_cache_control_setting( $enable );
	}
}
