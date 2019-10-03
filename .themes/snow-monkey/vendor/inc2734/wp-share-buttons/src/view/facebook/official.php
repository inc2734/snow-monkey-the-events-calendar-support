<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_OGP\Bootstrap;

$ogp = new Bootstrap();

$fb_locale = 'en_US';
if ( 'ja' === get_locale() ) {
	$fb_locale = 'ja_JP';
}

$query_args = [];
$query_args['version'] = 'v3.1';
if ( $ogp->get_app_id() ) {
	$query_args['appId'] = $ogp->get_app_id();
}

$data_share = apply_filters( 'inc2734_wp_share_buttons_facebook_official_button_share', 'false' );
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/<?php echo esc_js( $fb_locale ); ?>/sdk.js#xfbml=1&<?php echo esc_js( http_build_query( $query_args ) ); ?>';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like" data-href="<?php echo esc_url( $ogp->get_url() ); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="<?php echo esc_attr( $data_share ); ?>"></div>
