<?php
/**
 * @package mimizuku-core
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\Mimizuku_Core\App\Contract\Helper;

use Inc2734\Mimizuku_Core\App\Model;

trait Utility {

	/**
	 * Return custom post type names.
	 * This method only works correctly after the init hook.
	 *
	 * @return array
	 */
	public static function get_custom_post_types() {
		$post_types = wp_cache_get( 'mimizuku-custom-post-types' );
		if ( is_array( $post_types ) ) {
			return $post_types;
		}

		$post_types = get_post_types(
			[
				'public'   => true,
				'_builtin' => false,
			]
		);

		wp_cache_set( 'mimizuku-custom-post-types', $post_types );
		return $post_types;
	}

	/**
	 * Return custom taxonomy names.
	 * This method only works correctly after the init hook.
	 *
	 * @return array
	 */
	public static function get_taxonomies() {
		$taxonomies = wp_cache_get( 'mimizuku-taxonomies' );
		if ( is_array( $taxonomies ) ) {
			return $taxonomies;
		}

		$taxonomies = get_taxonomies(
			[
				'public'   => true,
				'_builtin' => false,
			]
		);

		wp_cache_set( 'mimizuku-taxonomies', $taxonomies );
		return $taxonomies;
	}

	/**
	 * Return file header
	 *
	 * @see https://developer.wordpress.org/reference/functions/get_file_data/
	 * @param string $file Full file path
	 * @return string
	 */
	protected static function _get_file_data( $file ) {
		// We don't need to write to the file, so just open for reading.
		$file_pointer = fopen( $file, 'r' );

		// Pull only the first 8kiB of the file in.
		$file_data = fread( $file_pointer, 8192 );

		// PHP will close file handle, but we are good citizens.
		fclose( $file_pointer );

		// Make sure we catch CR-only line endings.
		return str_replace( "\r", "\n", $file_data );
	}

	/**
	 * Return @version data
	 *
	 * @param string $file Full file path
	 * @return string|null
	 */
	public static function get_file_version( $file ) {
		// Make sure we catch CR-only line endings.
		$file_data = static::_get_file_data( $file );

		if ( preg_match( '/^[ \t\/*#@]*@version(.*)$/mi', $file_data, $match ) && $match[1] ) {
			return _cleanup_header_comment( $match[1] );
		}
	}

	/**
	 * Return renamed: data
	 *
	 * @param string $file Full file path
	 * @return array
	 */
	public static function get_file_renamed( $file ) {
		// Make sure we catch CR-only line endings.
		$file_data = static::_get_file_data( $file );

		if ( preg_match_all( '/^[ \t\/*#@]*renamed:(.*)$/mi', $file_data, $match ) && $match[1] ) {
			return array_map( '_cleanup_header_comment', $match[1] );
		}

		return [];
	}
}
