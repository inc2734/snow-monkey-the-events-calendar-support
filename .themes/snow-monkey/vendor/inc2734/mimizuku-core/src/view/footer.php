<?php
/**
 * @package mimizuku
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

$footer = apply_filters( 'mimizuku_footer', 'footer' );
Helper::get_footer_template( $footer );
