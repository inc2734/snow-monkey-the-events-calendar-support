<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<div id="wp-share-buttons-copy-<?php echo esc_attr( $post_id ); ?>"
	class="wp-share-button wp-share-button--<?php echo esc_attr( $type ); ?> wp-share-button--copy"
	data-title="<?php echo esc_attr( $title ); ?>"
	data-url="<?php echo esc_attr( get_permalink( $post_id ) ); ?>"
	data-hashtags="<?php echo esc_attr( $hashtags ); ?>"
>
	<?php if ( 'icon' !== $type ) : ?>
		<div class="wp-share-button__count">-</div>
	<?php endif; ?>
	<span class="wp-share-button__button">
		<span class="wp-share-button__icon wp-share-button__icon--copy"></span>
		<span class="wp-share-button__label"><?php esc_html_e( 'Copy', 'inc2734-wp-share-buttons' ); ?></span>
	</span>
</div>
