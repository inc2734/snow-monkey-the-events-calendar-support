<?php
/**
 * @package mimizuku
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\Mimizuku_Core\App\Model;

class CSS_To_Array {

	/**
	 * CSS
	 *
	 * @var string
	 */
	protected $css;

	/**
	 * @param string $css
	 */
	public function __construct( $css ) {
		$this->css = $this->_convert( $css );
	}

	/**
	 * @return string
	 */
	public function get() {
		return $this->css;
	}

	/**
	 * Convert inline css to PHP array
	 *
	 * @param string $css
	 * @return array
	 */
	protected function _convert( $css ) {
		$css = $this->_clean( $css );
		$css = explode( '}', $css );
		$css = array_filter( $css, 'strlen' );

		foreach ( $css as $key => $val ) {
			$css[ $key ] = explode( '{', $val );
		}

		foreach ( $css as $key => $css_block ) {
			$css[ $key ] = $this->_create_css_block( $css_block );
		}

		return $css;
	}

	/**
	 * Create CSS_Block
	 *
	 * @param array $css_block
	 * @return CSS_Block
	 */
	protected function _create_css_block( $css_block ) {
		if ( $this->_has_pre_selector( $css_block ) ) {
			$css_block     = array_reverse( $css_block );
			$selectors     = explode( ',', $css_block[1] );
			$properties    = $css_block[0];
			$pre_selectors = array_slice( $css_block, 2 );
		} else {
			$selectors     = explode( ',', $css_block[0] );
			$properties    = $css_block[1];
			$pre_selectors = [];
		}
		return new CSS_Block( $selectors, $properties, $pre_selectors );
	}

	/**
	 * Return true when has pre selector
	 *
	 * @param array $css_block
	 * @return boolean
	 */
	protected function _has_pre_selector( $css_block ) {
		return 2 < count( $css_block );
	}

	/**
	 * Remove tab and line breaks
	 *
	 * @param string $value
	 * @return string
	 */
	protected function _clean( $value ) {
		return str_replace( [ "\t", "\n", "\r" ], '', $value );
	}
}
