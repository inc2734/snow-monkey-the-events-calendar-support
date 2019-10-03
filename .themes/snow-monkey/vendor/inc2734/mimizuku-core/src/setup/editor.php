<?php
/**
 * @package mimizuku
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;

/**
 * Additional CSS to the block editor
 *
 * @return void
 */
add_action(
	'enqueue_block_editor_assets',
	function() {
		add_action(
			'admin_head',
			function() {
				$css = Helper::get_custom_css_array();

				foreach ( $css as $key => $css_block ) {
					$selectors = $css_block->get_selectors();
					foreach ( $selectors as $i => $selector ) {
						$selectors[ $i ] = '.editor-styles-wrapper ' . $selector;
					}
					$css_block->set_selectors( $selectors );
					$css[ $key ] = $css_block;
				}

				$new_css = '';
				foreach ( $css as $key => $css_block ) {
					$new_css .= $css_block->get_inline_css();
				}

				if ( ! $new_css ) {
					return;
				}
				?>
				<style id="wp-additional-css">
				<?php echo strip_tags( $new_css ); // WPCS XSS ok. ?>
				</style>
				<?php
			}
		);
	}
);

/**
 * Additional CSS to the classic editor
 *
 * @param string $settings
 * @return string
 */
add_filter(
	'tiny_mce_before_init',
	function( $mce_init ) {
		$css = Helper::get_custom_css_array();

		$new_css = '';
		foreach ( $css as $key => $css_block ) {
			$new_css .= $css_block->get_inline_css();
		}

		if ( ! $new_css ) {
			return $mce_init;
		}

		if ( ! isset( $mce_init['content_style'] ) ) {
			$mce_init['content_style'] = '';
		}

		$mce_init['content_style'] .= addslashes( $new_css );
		return $mce_init;
	}
);
