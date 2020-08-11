<?php
/**
 * @package inc2734/wp-custom-css-to-editor
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_Custom_CSS_To_Editor;

class Bootstrap {

	public function __construct() {
		add_action( 'enqueue_block_editor_assets', [ $this, '_enqueue_block_editor_assets' ] );
		add_filter( 'tiny_mce_before_init', [ $this, '_tiny_mce_before_init' ], 11 );
	}

	/**
	 * Additional CSS to the block editor
	 *
	 * @return void
	 */
	public function _enqueue_block_editor_assets() {
		add_action( 'admin_head', [ $this, '_admin_head' ] );
	}

	public function _admin_head() {
		$css = $this->_get_minified_custom_css();
		if ( ! $css ) {
			return;
		}

		$css = preg_replace( '/([^\{\}\(\)@]+?\{)/s', '.editor-styles-wrapper $1', $css );
		?>
		<style id="wp-custom-css">
		<?php echo strip_tags( $css ); // WPCS XSS ok. ?>
		</style>
		<?php
	}

	/**
	 * Additional CSS to the classic editor
	 *
	 * @param string $settings
	 * @return string
	 */
	public function _tiny_mce_before_init( $mce_init ) {
		$css = $this->_get_minified_custom_css();
		if ( ! $css ) {
			return $mce_init;
		}

		$css = preg_replace( '/([^\{\}\(\)@]+?\{)/s', '.mce-content-body.mceContentBody $1', $css );

		if ( ! isset( $mce_init['content_style'] ) ) {
			$mce_init['content_style'] = '';
		}

		$mce_init['content_style'] .= addslashes( $css );
		return $mce_init;
	}

	/**
	 * Minify for CSS
	 *
	 * @param string $css
	 * @return string
	 */
	protected function _minify( $css ) {
		$css = str_replace( [ "\t", "\n", "\r" ], '', $css );
		$css = preg_replace( '|\s*([\{\}])\s*|ms', '$1', $css );
		return $css;
	}

	/**
	 * Return minified custom css
	 *
	 * @return string
	 */
	protected function _get_minified_custom_css() {
		$css = wp_get_custom_css();
		return $this->_minify( $css );
	}
}
