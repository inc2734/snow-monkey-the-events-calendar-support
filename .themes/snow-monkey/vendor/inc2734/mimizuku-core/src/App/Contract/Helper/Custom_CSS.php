<?php
/**
 * @package mimizuku-core
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\Mimizuku_Core\App\Contract\Helper;

use Inc2734\Mimizuku_Core\App\Model;

trait Custom_CSS {

	public static function get_custom_css_array() {
		$css = wp_get_custom_css();
		$css_to_array = new Model\CSS_To_Array( $css );
		return $css_to_array->get();
	}
}
