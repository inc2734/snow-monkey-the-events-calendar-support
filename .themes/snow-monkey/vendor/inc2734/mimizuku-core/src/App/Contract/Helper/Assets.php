<?php
/**
 * @package mimizuku-core
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\Mimizuku_Core\App\Contract\Helper;

trait Assets {

	/**
	 * Enqueue Noto Sans JP
	 *
	 * @return void
	 */
	public static function enqueue_noto_sans_jp() {
		wp_enqueue_style(
			'noto-sans-jp',
			'https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap&subset=japanese',
			[],
			1
		);
	}

	/**
	 * Enqueue Noto Serif JP
	 *
	 * @return void
	 */
	public static function enqueue_noto_serif_jp() {
		wp_enqueue_style(
			'noto-serif-jp',
			'https://fonts.googleapis.com/css?family=Noto+Serif+JP&display=swap&subset=japanese',
			[],
			1
		);
	}

	/**
	 * Generate script dependencies
	 *
	 * @param array $maybe_dependencies
	 * @return array
	 */
	public static function generate_script_dependencies( $maybe_dependencies ) {
		$dependencies = [];
		foreach ( $maybe_dependencies as $dependency ) {
			if ( ! wp_script_is( $dependency, 'enqueued' ) && ! wp_script_is( $dependency, 'registered' ) ) {
				continue;
			}
			$dependencies[] = $dependency;
		}
		return $dependencies;
	}

	/**
	 * Generate style dependencies
	 *
	 * @param array $maybe_dependencies
	 * @return array
	 */
	public static function generate_style_dependencies( $maybe_dependencies ) {
		$dependencies = [];
		foreach ( $maybe_dependencies as $dependency ) {
			if ( ! wp_style_is( $dependency, 'enqueued' ) && ! wp_style_is( $dependency, 'registered' ) ) {
				continue;
			}
			$dependencies[] = $dependency;
		}
		return $dependencies;
	}

	/**
	 * Returns main script handle
	 *
	 * @return string
	 */
	public static function get_main_script_handle() {
		$handle = get_template();

		if ( is_child_theme() && file_exists( get_stylesheet_directory() . '/assets/js/app.min.js' ) ) {
			$handle = get_stylesheet();
		}

		return $handle;
	}

	/**
	 * Returns main style handle
	 *
	 * @return string
	 */
	public static function get_main_style_handle() {
		$handle = get_template();

		if ( is_child_theme() && file_exists( get_stylesheet_directory() . '/assets/css/style.min.css' ) ) {
			$handle = get_stylesheet();
		}

		return $handle;
	}
}
