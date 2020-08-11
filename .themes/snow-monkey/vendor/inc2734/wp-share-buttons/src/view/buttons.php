<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<div id="wp-share-buttons-<?php echo esc_attr( $post_id ); ?>" class="wp-share-buttons wp-share-buttons--<?php echo esc_attr( $type ); ?>">
	<ul class="wp-share-buttons__list">
		<li class="wp-share-buttons__item">
			[wp_share_buttons_facebook type="<?php echo esc_attr( $type ); ?>" post_id="<?php echo esc_attr( $post_id ); ?>"]
		</li>
		<li class="wp-share-buttons__item">
			[wp_share_buttons_twitter type="<?php echo esc_attr( $type ); ?>" post_id="<?php echo esc_attr( $post_id ); ?>" title="<?php echo esc_attr( $title ); ?>"]
		</li>
		<li class="wp-share-buttons__item">
			[wp_share_buttons_hatena type="<?php echo esc_attr( $type ); ?>" post_id="<?php echo esc_attr( $post_id ); ?>"]
		</li>
		<li class="wp-share-buttons__item">
			[wp_share_buttons_feedly type="<?php echo esc_attr( $type ); ?>" post_id="<?php echo esc_attr( $post_id ); ?>"]
		</li>
		<li class="wp-share-buttons__item">
			[wp_share_buttons_line type="<?php echo esc_attr( $type ); ?>" post_id="<?php echo esc_attr( $post_id ); ?>"]
		</li>
		<li class="wp-share-buttons__item">
			[wp_share_buttons_pocket type="<?php echo esc_attr( $type ); ?>" post_id="<?php echo esc_attr( $post_id ); ?>" title="<?php echo esc_attr( $title ); ?>"]
		</li>
		<li class="wp-share-buttons__item">
			[wp_share_buttons_pinterest type="<?php echo esc_attr( $type ); ?>" post_id="<?php echo esc_attr( $post_id ); ?>"]
		</li>
		<li class="wp-share-buttons__item">
			[wp_share_buttons_feed type="<?php echo esc_attr( $type ); ?>" post_id="<?php echo esc_attr( $post_id ); ?>"]
		</li>
		<li class="wp-share-buttons__item">
			[wp_share_buttons_copy type="<?php echo esc_attr( $type ); ?>" post_id="<?php echo esc_attr( $post_id ); ?>" title="<?php echo esc_attr( $title ); ?>"]
		</li>
	</ul>
</div>
