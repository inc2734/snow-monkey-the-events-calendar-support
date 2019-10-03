<?php
/**
 * @package mimizuku
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

$header = apply_filters( 'mimizuku_header', 'header' );
Helper::get_header_template( $header );
