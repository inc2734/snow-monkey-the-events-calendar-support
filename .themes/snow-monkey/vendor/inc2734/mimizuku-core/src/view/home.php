<?php
/**
 * @package mimizuku
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\App\Controller\Controller;

Controller::layout( 'wrapper' );
if ( have_posts() ) {
	Controller::render( 'archive', get_post_type() );
} else {
	Controller::render( 'none' );
}
