<?php
/**
 * @package mimizuku-core
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

if ( ! apply_filters( 'mimizuku_debug', true ) ) {
	return;
}

if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
	return;
}

if ( is_customize_preview() || is_admin() ) {
	return;
}

if ( function_exists( 'tests_add_filter' ) ) {
	return;
}


/**
 * Output comment of the loaded template
 *
 * @param string $slug
 */
add_action(
	'template_redirect',
	function() {

		/**
		 * Output starting comment of the loaded template
		 *
		 * @param string $slug
		 */
		add_action(
			'inc2734_view_controller_get_template_part_pre_render',
			function( $args ) {
				if ( ! $args['slug'] || 0 === strpos( $args['slug'], 'app/' ) ) {
					return;
				}

				$located = \Inc2734\WP_View_Controller\Helper::locate_template( $args['slug'] . '-' . $args['name'] . '.php', false );
				$slug    = $args['slug'];
				$slug   .= $args['name'] && $located ? '-' . $args['name'] : '';

				printf( "\n" . '<!-- Start : %1$s -->' . "\n", esc_html( $slug ) );
			},
			1
		);

		/**
		 * Output closing comment of the loaded template
		 *
		 * @param string $slug
		 */
		add_action(
			'inc2734_view_controller_get_template_part_post_render',
			function( $args ) {
				if ( ! $args['slug'] || 0 === strpos( $args['slug'], 'app/' ) ) {
					return;
				}

				$located = \Inc2734\WP_View_Controller\Helper::locate_template( $args['slug'] . '-' . $args['name'] . '.php', false );
				$slug    = $args['slug'];
				$slug   .= $args['name'] && $located ? '-' . $args['name'] : '';

				printf( "\n" . '<!-- End : %1$s -->' . "\n", esc_html( $slug ) );
			},
			1
		);
	}
);
