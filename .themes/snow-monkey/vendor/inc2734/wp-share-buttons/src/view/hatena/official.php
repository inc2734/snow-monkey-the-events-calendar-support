<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */

$permalink = get_permalink( $post_id );
$target = str_replace( [ 'https://', 'http://' ], '', $permalink );
if ( 0 === strpos( $permalink, 'https://' ) ) {
	$target = 's/' . $target;
}
?>

<a href="http://b.hatena.ne.jp/entry/<?php echo esc_attr( $target ); ?>" class="hatena-bookmark-button" data-hatena-bookmark-layout="basic-label-counter" data-hatena-bookmark-lang="ja" title="<?php esc_html_e( 'Bookmark', 'inc2734-wp-share-buttons' ); ?>">
	<img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="<?php esc_html_e( 'Bookmark', 'inc2734-wp-share-buttons' ); ?>" width="20" height="20" style="border: none;" />
</a>
<script>!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://b.st-hatena.com/js/bookmark_button.js";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"hatena-btn-js");</script>
