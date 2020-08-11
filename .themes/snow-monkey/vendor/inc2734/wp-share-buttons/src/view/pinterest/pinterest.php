<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<div id="wp-share-buttons-pinterest-<?php echo esc_attr( $post_id ); ?>"
	class="wp-share-button wp-share-button--<?php echo esc_attr( $type ); ?> wp-share-button--pinterest"
>
	<?php if ( 'icon' !== $type ) : ?>
		<div class="wp-share-button__count">-</div>
	<?php endif; ?>
	<a class="wp-share-button__button" href="https://www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" data-pin-custom="true">
		<span class="wp-share-button__icon wp-share-button__icon--pinterest">
			<?php
			$svg_path = get_template_directory() . '/vendor/inc2734/wp-share-buttons/src/assets/img/pinterest.svg';
			if ( file_exists( $svg_path ) ) {
				include( $svg_path );
			}
			?>
		</span>
		<span class="wp-share-button__label"><?php esc_html_e( 'Pinterest', 'inc2734-wp-share-buttons' ); ?></span>
	</a>
</div>
<script>!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://assets.pinterest.com/js/pinit_main.js";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pinterest-btn-js");</script>
