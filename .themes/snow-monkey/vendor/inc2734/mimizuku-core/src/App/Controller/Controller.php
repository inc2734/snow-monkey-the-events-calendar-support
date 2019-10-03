<?php
/**
 * @package mimizuku
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\Mimizuku_Core\App\Controller;

use Inc2734\WP_View_Controller;

/**
 * Add filter hook to WP_View_Controller\Bootstrap
 */
class Controller extends WP_View_Controller\Bootstrap {

	public function __construct() {
		parent::__construct();

		add_filter(
			'inc2734_wp_view_controller_layout',
			function( $layout ) {
				return apply_filters( 'mimizuku_layout', $layout );
			}
		);

		add_filter(
			'inc2734_wp_view_controller_view',
			function( $view ) {
				return apply_filters( 'mimizuku_view', $view );
			}
		);
	}
}
