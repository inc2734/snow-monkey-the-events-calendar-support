<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<a data-pocket-label="pocket" data-pocket-count="button" class="pocket-btn" data-lang="en" data-save-url="<?php the_permalink( $post_id ); ?>"></a>
<script>!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
