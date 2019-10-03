<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */

$query = [
	'url' => get_permalink( $post_id ),
];
?>
<div id="wp-share-buttons-google-plus-<?php echo esc_attr( $post_id ); ?>"
	class="wp-share-button wp-share-button--<?php echo esc_attr( $type ); ?> wp-share-button--google-plus"
>
	<?php if ( 'icon' !== $type ) : ?>
		<div class="wp-share-button__count">-</div>
	<?php endif; ?>
	<a class="wp-share-button__button" href="<?php echo esc_url( 'https://plus.google.com/share?' . http_build_query( $query, '', '&amp;' ) ); ?>" target="_blank">
		<span class="wp-share-button__icon wp-share-button__icon--google-plus"></span>
		<span class="wp-share-button__label"><?php esc_html_e( 'Google+', 'inc2734-wp-share-buttons' ); ?></span>
	</a>
</div>
