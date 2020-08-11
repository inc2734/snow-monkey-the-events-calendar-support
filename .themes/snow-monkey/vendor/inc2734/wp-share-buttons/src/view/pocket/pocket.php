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
<div id="wp-share-buttons-pocket-<?php echo esc_attr( $post_id ); ?>"
	class="wp-share-button wp-share-button--<?php echo esc_attr( $type ); ?> wp-share-button--pocket"
>
	<?php if ( 'icon' !== $type ) : ?>
		<div class="wp-share-button__count">-</div>
	<?php endif; ?>
	<a class="wp-share-button__button" href="<?php echo esc_url( 'https://getpocket.com/edit?' . http_build_query( $query, '', '&amp;' ) ); ?>" target="_blank">
		<span class="wp-share-button__icon wp-share-button__icon--pocket">
			<?php
			$svg_path = get_template_directory() . '/vendor/inc2734/wp-share-buttons/src/assets/img/pocket.svg';
			if ( file_exists( $svg_path ) ) {
				include( $svg_path );
			}
			?>
		</span>
		<span class="wp-share-button__label"><?php esc_html_e( 'Pocket', 'inc2734-wp-share-buttons' ); ?></span>
	</a>
</div>
