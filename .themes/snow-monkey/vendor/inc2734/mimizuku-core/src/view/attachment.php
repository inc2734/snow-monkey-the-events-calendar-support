<?php
/**
 * @package mimizuku
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\App\Controller\Controller;

add_filter(
	'mimizuku_layout',
	function( $layout ) {
		if ( is_attachment() ) {
			return 'blank';
		}
		return $layout;
	},
	99999
);

Controller::layout( 'blank' );
Controller::render( 'attachment' );
