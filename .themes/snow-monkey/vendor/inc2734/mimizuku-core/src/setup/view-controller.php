<?php
/**
 * @package mimizuku
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\App\Controller\Controller;

new Controller();

/**
 * Update view controller config
 *
 * @param array $config
 * @return array
 */
add_filter(
	'inc2734_view_controller_config',
	function() {
		return [
			'templates' => [
				'',
				'vendor/inc2734/mimizuku-core/src/view',
			],
			'page-templates' => [
				'page-templates',
			],
			'layout' => [
				'templates/layout/wrapper',
				'vendor/inc2734/mimizuku-core/src/view/templates/layout/wrapper',
			],
			'header' => [
				'templates/layout/header',
				'vendor/inc2734/mimizuku-core/src/view/templates/layout/header',
			],
			'sidebar' => [
				'templates/layout/sidebar',
				'vendor/inc2734/mimizuku-core/src/view/templates/layout/sidebar',
			],
			'footer' => [
				'templates/layout/footer',
				'vendor/inc2734/mimizuku-core/src/view/templates/layout/footer',
			],
			'view' => [
				'templates/view',
				'vendor/inc2734/mimizuku-core/src/view/templates/view',
			],
			'static' => [
				'templates/static',
				'vendor/inc2734/mimizuku-core/src/view/templates/static',
			],
		];
	}
);

/**
 * Change root directory of get_template_part().
 * If return empty, root is theme directory (= default get_template_part()).
 *
 * @param string $root
 * @param string $slug
 * @param string $name
 * @param array $vars
 */
add_filter(
	'inc2734_view_controller_template_part_root',
	function( $root, $slug, $name, $vars ) {
		return apply_filters( 'mimizuku_template_part_root', $root, $slug, $name, $vars );
	},
	10,
	4
);

/**
 * Change root directory of get_template_part().
 * If return empty, root is theme directory (= default get_template_part()).
 *
 * @param array $hierarchy
 * @param string $slug
 * @param string $name
 * @param array $vars
 */
add_filter(
	'inc2734_view_controller_template_part_root_hierarchy',
	function( $hierarchy, $slug, $name, $vars ) {
		return apply_filters( 'mimizuku_template_part_root_hierarchy', $hierarchy, $slug, $name, $vars );
	},
	10,
	4
);

/**
 * Override inc2734_view_controller_get_template_part_args
 *
 * @param array $args
 *   @param string $slug
 *   @param string $name
 *   @param array $vars
 * @return array
 */
add_filter(
	'inc2734_view_controller_get_template_part_args',
	function( $args ) {
		return apply_filters( 'mimizuku_get_template_part_args', $args );
	},
	9
);

/**
 * Override inc2734_view_controller_get_template_part_{ $slug }
 *
 * @param array $args
 *   @param string $slug
 *   @param string $name
 *   @param array $vars
 */
add_action(
	'inc2734_view_controller_get_template_part_pre_render',
	function( $args ) {
		if ( false !== has_action( 'mimizuku_get_template_part_' . $args['slug'] ) ) {
			do_action( 'mimizuku_get_template_part_' . $args['slug'], $args['name'], $args['vars'] );
			add_action( 'inc2734_view_controller_get_template_part_' . $args['slug'], '__return_true' );
		} else {
			remove_action( 'inc2734_view_controller_get_template_part_' . $args['slug'], '__return_true' );
		}

		if ( $args['name'] ) {
			if ( false !== has_action( 'mimizuku_get_template_part_' . $args['slug'] . '-' . $args['name'] ) ) {
				do_action( 'mimizuku_get_template_part_' . $args['slug'] . '-' . $args['name'], $args['vars'] );
				add_action( 'inc2734_view_controller_get_template_part_' . $args['slug'] . '-' . $args['name'], '__return_true' );
			} else {
				remove_action( 'inc2734_view_controller_get_template_part_' . $args['slug'] . '-' . $args['name'], '__return_true' );
			}
		}
	},
	9
);

/**
 * Override inc2734_view_controller_template_part_render
 *
 * @param string $slug
 * @param string $name
 * @param array $vars
 * @return array
 */
add_filter(
	'inc2734_view_controller_template_part_render',
	function( $html, $slug, $name, $vars ) {
		return apply_filters( 'mimizuku_template_part_render', $html, $slug, $name, $vars );
	},
	9,
	4
);
