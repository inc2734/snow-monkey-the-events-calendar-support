# WP Like Me Box

[![Build Status](https://travis-ci.org/inc2734/wp-like-me-box.svg?branch=master)](https://travis-ci.org/inc2734/wp-like-me-box)
[![Latest Stable Version](https://poser.pugx.org/inc2734/wp-like-me-box/v/stable)](https://packagist.org/packages/inc2734/wp-like-me-box)
[![License](https://poser.pugx.org/inc2734/wp-like-me-box/license)](https://packagist.org/packages/inc2734/wp-like-me-box)

## Install
```
$ composer require inc2734/wp-like-me-box
```

## How to use
```
<?php
// When Using composer auto loader
new Inc2734\WP_Like_Me_Box\Like_Me_Box();
```

## Shortcode
```
[wp_like_me_box facebook_page_name="xxxxx"]
```

## Filter hooks

### inc2734_wp_like_me_box_thumbnail

```
/**
 * Customize thumbnail url
 *
 * @param $thumbnail
 * @return $thumbnail
 */
add_filter(
	'inc2734_wp_like_me_box_thumbnail',
	function( $thumbnail ) {
		return $thumbnail;
	}
);
```

### inc2734_wp_like_me_box_facebook_page_name

```
/**
 * Customize facebook page name
 *
 * @param $facebook_page_name
 * @return $facebook_page_name
 */
add_filter(
	'inc2734_wp_like_me_box_facebook_page_name',
	function( $facebook_page_name ) {
		return $facebook_page_name;
	}
);
```
