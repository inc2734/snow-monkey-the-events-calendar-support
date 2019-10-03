<?php
/**
 * @package snow-monkey-the-events-calendar-support
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Controller\Controller;

global $wp_query;
$_post_type = $wp_query->get( 'post_type' );

Controller::layout( get_theme_mod( 'singular-post-layout' ) );
Controller::render( 'content', $_post_type );
