<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_Share_Buttons\App\Contract\Shortcode;

/**
 * Abstract share button shortcodes
 *
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class Button {

	/**
	 * @param string $shortcode_name
	 * @param boolean $is_request
	 */
	public function __construct( $shortcode_name ) {
		add_shortcode( $shortcode_name, [ $this, '_shortcode' ] );

		$requester = $this->_get_requester();
		if ( $requester ) {
			new $requester();
		}
	}

	/**
	 * Register shortcode
	 *
	 * @param array $attributes
	 * @return void
	 */
	abstract public function _shortcode( $attributes );

	/**
	 * Return Requester class name
	 *
	 * @return string
	 */
	protected function _get_requester() {
		$this_class = get_class( $this );
		$this_class = explode( '\\', $this_class );
		$this_class = array_pop( $this_class );

		$requester_class = '\Inc2734\WP_Share_Buttons\App\Model\Requester\\' . $this_class;
		if ( ! class_exists( $requester_class ) ) {
			return;
		}

		return $requester_class;
	}

	/**
	 * Load shortcode
	 *
	 * @param string $filepath
	 * @param array $vars
	 * @return string
	 */
	protected function render( $filepath, $vars ) {
		$filepath = __DIR__ . '/../../../view/' . $filepath . '.php';
		if ( file_exists( $filepath ) ) {
			ob_start();
			// @todo Using getter method
			// @codingStandardsIgnoreStart
			extract( $vars );
			// @codingStandardsIgnoreEnd
			include( $filepath );
			return ob_get_clean();
		}
	}
}
