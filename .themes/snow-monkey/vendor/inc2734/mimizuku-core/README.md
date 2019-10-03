# Mimizuku Core

[![Build Status](https://travis-ci.org/inc2734/mimizuku-core.svg?branch=master)](https://travis-ci.org/inc2734/mimizuku-core)
[![Latest Stable Version](https://poser.pugx.org/inc2734/mimizuku-core/v/stable)](https://packagist.org/packages/inc2734/mimizuku-core)
[![License](https://poser.pugx.org/inc2734/mimizuku-core/license)](https://packagist.org/packages/inc2734/mimizuku-core)

## Install
```
$ composer require inc2734/mimizuku-core
```

## How to use
```
<?php
new \Inc2734\Mimizuku_Core\Core();
```

### Using layout/view Controller
```
<?php
// e.g. singular.php
use Inc2734\Mimizuku_Core\App\Controller\Controller;

Controller::layout( 'wrapper' );
Controller::render( 'content', get_post_type() );
```
