# WP Plugin View Controller

[![Build Status](https://travis-ci.org/inc2734/wp-plugin-view-controller.svg?branch=master)](https://travis-ci.org/inc2734/wp-plugin-view-controller)
[![Latest Stable Version](https://poser.pugx.org/inc2734/wp-plugin-view-controller/v/stable)](https://packagist.org/packages/inc2734/wp-plugin-view-controller)
[![License](https://poser.pugx.org/inc2734/wp-plugin-view-controller/license)](https://packagist.org/packages/inc2734/wp-plugin-view-controller)

## Install
```
$ composer require inc2734/wp-plugin-view-controller
```

## How to use
```
use Inc2734\WP_Plugin_View_Controller\Bootstrap;

$bootstrap = new Bootstrap(
	[
		'prefix' => 'prefix_',
		'path'   => __DIR__ . '/templates/',
	]
);

$bootstrap->render( $slug, $name, $args );
```

## Filter hooks
### &lt;prefix&gt;view_args
```
/**
 * @param array $args
 *  @var string $slug
 *  @var string $name
 *  @var array $vars
 * @param array
 */
add_filter(
	'<prefix>view_args',
	function( $args ) {
		return $args;
	}
);
```

### &lt;prefix&gt;view_render
```
/**
 * @param string $html
 * @param string $slug
 * @param string $name
 * @param array $vars
 * @return string
 */
add_filter(
	'<prefix>view_render',
	function( $html, $slug, $name, $vars ) {
		return $html;
	},
	10,
	4
);
```

## Action hooks
### &lt;prefix&gt;view_pre_render
```
/**
 * @param array $args
 *  @var string $slug
 *  @var string $name
 *  @var array $vars
 */
add_action(
	'<prefix>view_pre_render',
	function( $args ) {
	}
);
```

### &lt;prefix&gt;view_post_render
```
/**
 * @param array $args
 *  @var string $slug
 *  @var string $name
 *  @var array $vars
 */
add_action(
	'<prefix>view_post_render',
	function( $args ) {
	}
);
```

### &lt;prefix&gt;view_&lt;slug&gt;
```
/**
 * @param string $name
 * @param array $vars
 */
add_action(
	'<prefix>view_<slug>',
	function( $name, $vars ) {
		?>
		HTML
		<?php
	},
	10,
	2
);
```

### &lt;prefix&gt;view_&lt;slug&gt;-&lt;name&gt;
```
/**
 * @param array $vars
 */
add_action(
	'<prefix>view_<slug>-<name>',
	function( $vars ) {
		?>
		HTML
		<?php
	}
);
```
