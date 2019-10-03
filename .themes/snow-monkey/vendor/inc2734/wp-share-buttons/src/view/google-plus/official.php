<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */
?>

<?php if ( 'ja' === get_locale() ) : ?>
<script>window.___gcfg = { lang: '<?php echo esc_js( get_locale() ); ?>' };</script>
<?php endif; ?>
<script>!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://apis.google.com/js/platform.js";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"google-plus-js");</script>
<g:plusone size="tall" href="<?php the_permalink( $post_id ); ?>"></g:plusone>
