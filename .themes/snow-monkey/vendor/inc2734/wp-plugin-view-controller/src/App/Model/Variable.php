<?php
/**
 * @package inc2734/wp-plugin-view-controller
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_Plugin_View_Controller\App\Model;

class Variable {

	/**
	 * Saved variables
	 *
	 * @var array
	 */
	protected $vars = [];

	/**
	 * Sets variables
	 *
	 * @param array $vars
	 * @return void
	 */
	public function save( array $vars = [] ) {
		foreach ( $vars as $key => $value ) {
			$this->vars[ $key ] = $value;
		}
	}

	/**
	 * Return all vars
	 *
	 * @return array
	 */
	public function get_vars() {
		return $this->vars;
	}
}
