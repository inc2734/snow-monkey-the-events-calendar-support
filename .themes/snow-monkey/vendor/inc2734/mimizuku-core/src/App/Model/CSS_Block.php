<?php
/**
 * @package mimizuku
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\Mimizuku_Core\App\Model;

class CSS_Block {

	/**
	 * Selectors
	 *
	 * @var array
	 */
	protected $selectors = [];

	/**
	 * CSS properties
	 *
	 * @var string
	 */
	protected $properties;

	/**
	 * Pre selectors
	 *
	 * @var array
	 */
	protected $pre_selectors = [];

	/**
	 * @param array $selectors
	 * @param string $properties
	 * @param array $pre_selectors
	 */
	public function __construct( array $selectors, $properties, array $pre_selectors = [] ) {
		$this->selectors     = $selectors;
		$this->properties    = $properties;
		$this->pre_selectors = $pre_selectors;
	}

	/**
	 * Return inline CSS
	 *
	 * @return string
	 */
	public function get_inline_css() {
		if ( $this->get_pre_selectors() ) {
			$inline_css = sprintf(
				'%1$s { %2$s }',
				implode( ',', $this->get_selectors() ),
				$this->get_properties()
			);
			foreach ( $this->get_pre_selectors() as $pre_selector ) {
				$inline_css = sprintf(
					'%1$s { %2$s }',
					$pre_selector,
					$inline_css
				);
			}
			return $inline_css;
		}

		return sprintf(
			'%1$s { %2$s }',
			implode( ',', $this->get_selectors() ),
			$this->get_properties()
		);
	}

	/**
	 * Return selectors
	 *
	 * @return array
	 */
	public function get_selectors() {
		return $this->selectors;
	}

	/**
	 * Return CSS properties
	 *
	 * @return string
	 */
	public function get_properties() {
		return $this->properties;
	}

	/**
	 * Return pre selectors
	 *
	 * @return array
	 */
	public function get_pre_selectors() {
		return $this->pre_selectors;
	}

	/**
	 * Set selectors
	 *
	 * @param array
	 */
	public function set_selectors( array $selectors ) {
		$this->selectors = $selectors;
	}
}
