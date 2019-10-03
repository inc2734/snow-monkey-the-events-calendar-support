<?php
/**
 * @package inc2734/wp-like-me-box
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<div class="wp-like-me-box">
	<?php
	$thumbnail = '';
	if ( get_post_thumbnail_id() ) {
		$thumbnail = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large' );
	}
	$thumbnail = apply_filters( 'inc2734_wp_like_me_box_thumbnail', $thumbnail );
	?>
	<div class="wp-like-me-box__figure" style="background-image: url(
		<?php echo esc_url( $thumbnail ); ?>
	)"></div>
	<div class="wp-like-me-box__body">
		<h3 class="wp-like-me-box__title">
			<?php esc_html_e( 'If you like this article,', 'inc2734-wp-like-me-box' ); ?><br>
			<?php esc_html_e( 'Let\'s press like button', 'inc2734-wp-like-me-box' ); ?>
		</h3>

		<div class="wp-like-me-box__like">
			<?php
			$facebook_page_url = sprintf(
				'https://www.facebook.com/%1$s/',
				apply_filters( 'inc2734_wp_like_me_box_facebook_page_name', $facebook_page_name )
			);
			?>
			<iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo urlencode( esc_url( $facebook_page_url ) ); ?>&amp;width=106&amp;layout=button_count&amp;action=like&amp;size=small&amp;show_faces=false&amp;share=false&amp;height=21" width="106" height="21" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
		</div>

		<div class="wp-like-me-box__lead">
			<?php esc_html_e( 'We will deliver up-to-date information for you', 'inc2734-wp-like-me-box' ); ?>
		</div>
	</div>
</div>
