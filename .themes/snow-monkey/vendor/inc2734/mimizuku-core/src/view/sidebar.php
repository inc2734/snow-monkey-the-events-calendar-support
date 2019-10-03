<?php
/**
 * @package mimizuku
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

$sidebar = apply_filters( 'mimizuku_sidebar', 'sidebar' );
Helper::get_sidebar_template( $sidebar );
