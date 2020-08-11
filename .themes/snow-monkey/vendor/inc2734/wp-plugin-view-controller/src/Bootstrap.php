<?php
/**
 * @package inc2734/wp-plugin-view-controller
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_Plugin_View_Controller;

use Inc2734\WP_Plugin_View_Controller\App\Model\Variable;

class Bootstrap {

	/**
	 * Prefix of hooks
	 *
	 * @var string
	 */
	protected $prefix = '';

	/**
	 * Default template root path
	 *
	 * @var string
	 */
	protected $path = '';

	/**
	 * Variable object
	 *
	 * @var Variable
	 */
	protected $variable;

	/**
	 * @param array $args
	 * 	@var string $prefix Prefix of hooks
	 * 	@var string $path Default template root path
	 */
	public function __construct( array $args = [] ) {
		$args = shortcode_atts(
			[
				'prefix' => 'inc2734_wp_plugin_view_controller_',
				'path'   => untrailingslashit( __DIR__ ) . '/templates',
			],
			$args
		);

		$this->prefix   = $args['prefix'];
		$this->path     = $args['path'];
		$this->variable = new Variable;
	}

	/**
	 * Render template
	 *
	 * @param string $slug
	 * @param string $name
	 * @param array $vars
	 */
	public function render( $slug, $name = null, $vars = [] ) {
		$args = apply_filters(
			$this->prefix . 'view_args',
			[
				'slug' => $slug,
				'name' => $name,
				'vars' => $vars,
			]
		);

		$this->variable->save( $vars );

		do_action( $this->prefix . 'view_pre_render', $args );

		if ( $this->_enable_debug_mode() ) {
			$this->_debug_comment( $args, 'Start : ' );
		}

		ob_start();

		$action_with_name = $this->prefix . 'view_' . $args['slug'] . '-' . $args['name'];
		$action           = $this->prefix . 'view_' . $args['slug'];
		if ( $name && has_action( $action_with_name ) ) {
			do_action( $action_with_name, $vars );
		} elseif ( has_action( $action ) ) {
			do_action( $action, $name, $vars );
		} else {
			$templates = $this->_get_template_part_slugs( $slug, $name );
			$this->_locate_template( $templates );
		}

		$html = ob_get_clean();

		// @codingStandardsIgnoreStart
		echo apply_filters( $this->prefix . 'view_render', $html, $slug, $name, $vars );
		// @codingStandardsIgnoreEnd

		if ( $this->_enable_debug_mode() ) {
			$this->_debug_comment( $args, 'End : ' );
		}

		do_action( $this->prefix . 'view_post_render', $args );
	}

	/**
	 * Return candidate file names of the root template part
	 *
	 * @param string $slug
	 * @param string $name
	 * @param array $vars
	 * @return array
	 */
	protected function _get_template_part_slugs( $slug, $name = null, $vars = [] ) {
		$hierarchy = apply_filters(
			$this->prefix . 'view_hierarchy',
			[ $this->path ],
			$slug,
			$name,
			$vars
		);
		$hierarchy = array_unique( $hierarchy );

		foreach ( $hierarchy as $root ) {
			if ( $name ) {
				$templates[] = trailingslashit( $root ) . $slug . '-' . $name . '.php';
			}
			$templates[] = trailingslashit( $root ) . $slug . '.php';
		}

		return $templates;
	}

	/**
	 * @see https://developer.wordpress.org/reference/functions/locate_template/
	 */
	protected function _locate_template( $templates ) {
		$located = '';

		foreach ( (array) $templates as $template ) {
			if ( ! $template ) {
				continue;
			} elseif ( file_exists( $template ) ) {
				$located = $template;
				break;
			}
		}

		if ( '' != $located ) {
			extract( $this->variable->get_vars() );
			include( $located );
		}

		return $located;
	}

	/**
	 * Return true when enable debug mode
	 *
	 * @return boolean
	 */
	protected function _enable_debug_mode() {
		if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
			return;
		}

		if ( is_customize_preview() || is_admin() ) {
			return;
		}

		if ( function_exists( 'tests_add_filter' ) ) {
			return;
		}

		return true;
	}

	/**
	 * Print debug comment
	 *
	 * @param array $args
	 * @param string $prefix
	 * @return void
	 */
	public function _debug_comment( $args, $prefix = null ) {
		if ( ! $args['slug'] ) {
			return;
		}

		$slug  = $args['slug'];
		$slug .= $args['name'] ? '-' . $args['name'] : '';
		$slug  = str_replace( [ WP_PLUGIN_DIR, get_template_directory(), get_stylesheet_directory() ], '', $this->path ) . $slug;
		printf( "\n" . '<!-- %1$s%2$s -->' . "\n", esc_html( $prefix ), esc_html( $slug ) );
	}
}
