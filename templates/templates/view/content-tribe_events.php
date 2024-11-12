<?php
/**
 * @package snow-monkey-the-events-calendar-support
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$eyecatch_position = get_theme_mod( get_post_type() . '-eyecatch' );
$display_eyecatch  = 'content-top' === $eyecatch_position;

// @see templates/view/content.php
$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	array(
		'_display_adsense'                     => false,
		'_display_article_bottom_widget_area'  => true,
		'_display_article_top_widget_area'     => true,
		'_display_bottom_share_buttons'        => false,
		'_display_contents_bottom_widget_area' => true,
		'_display_comments'                    => false,
		'_display_entry_footer'                => false,
		'_display_entry_header'                => false,
		'_display_eyecatch'                    => $display_eyecatch,
		'_display_profile_box'                 => false,
		'_display_tags'                        => false,
		'_display_top_share_buttons'           => false,
		'_post_type'                           => \Tribe__Events__Main::POSTTYPE,
	)
);

the_post();

Helper::get_template_part(
	'template-parts/content/entry/entry',
	$args['_post_type'],
	$args
);
