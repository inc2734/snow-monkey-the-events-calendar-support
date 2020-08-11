# WP Adsense

[![Build Status](https://travis-ci.com/inc2734/wp-adsense.svg?branch=master)](https://travis-ci.com/inc2734/wp-adsense)
[![Latest Stable Version](https://poser.pugx.org/inc2734/wp-adsense/v/stable)](https://packagist.org/packages/inc2734/wp-adsense)
[![License](https://poser.pugx.org/inc2734/wp-adsense/license)](https://packagist.org/packages/inc2734/wp-adsense)

## Install
```
$ composer require inc2734/wp-adsense
```

## How to use
```
use Inc2734\WP_Adsense;

WP_Adsense\Helper::the_adsense_code( $code, $size );
```

## Filter hooks

### inc2734_wp_adsense_the_adsense_code
```
/**
 * Customize the adsense code
 *
 * @param string $code
 * @return string
 */
add_filter(
	'inc2734_wp_adsense_the_adsense_code',
	function( $code ) {
		return $code;
	}
);
```
