<?php
/**
 * @package snow-monkey-the-events-calendar-support
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Snow_Monkey\Plugin\TheEventsCalendarSupport\App\Controller;

class Front {

	public function __construct() {
		add_filter( 'snow_monkey_template_part_root_hierarchy', [ $this, '_snow_monkey_template_part_root_hierarchy' ], 10, 3 );
		add_filter( 'tribe_events_template_paths', [ $this, '_tribe_events_template_paths' ] );
		add_filter( 'inc2734_wp_view_controller_render_type', [ $this, '_inc2734_wp_view_controller_render_type' ] );
		add_filter( 'snow_monkey_view', [ $this, '_snow_monkey_view' ] );
		add_action( 'wp_enqueue_scripts', [ $this, '_wp_enqueue_scripts' ] );
		add_filter( 'snow_monkey_breadcrumbs', [ $this, '_snow_monkey_breadcrumbs' ] );

		add_action(
			'tribe_tec_template_chooser',
			function( $template ) {
				add_filter( "page_template", [ $this, '_page_template'], 10000, 3 );
			}
		);
	}

	public function _page_template( $template, $type, $templates ) {
		remove_filter( "page_template", [ $this, '_page_template'], 10000, 3 );

		if ( \Tribe__Events__Main::POSTTYPE !== get_post_type() ) {
			return $template;
		}

		return is_singular()
			? SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/templates/singular.php'
			: SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/templates/src/views/default-template.php';
	}

	public function _snow_monkey_template_part_root_hierarchy( $hierarchy, $slug, $name ) {
		global $wp_query;
		$post_type = $wp_query->get( 'post_type' );

		if ( 'tribe_events' === $post_type ) {
			$hierarchy[] = SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/templates';
			$hierarchy   = array_unique( $hierarchy );
		}

		return $hierarchy;
	}

	public function _tribe_events_template_paths( $paths ) {
		if ( ! in_array( SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/templates', $paths ) ) {
			$paths = array_merge(
				[
					SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/templates',
				],
				$paths
			);
		}
		$paths = array_unique( $paths );
		return $paths;
	}

	public function _inc2734_wp_view_controller_render_type( $render_type ) {
		if ( ! is_singular( \Tribe__Events__Main::POSTTYPE ) ) {
			return $render_type;
		}
		return 'direct';
	}

	public function _snow_monkey_view( $view ) {
		global $wp_query;
		$post_type = $wp_query->get( 'post_type' );

		if ( \Tribe__Events__Main::POSTTYPE !== $post_type ) {
			return $view;
		}

		if ( is_singular() ) {
			return $view;
		}

		return [
			'slug' => 'templates/view/the-events-calendar-content',
			'name' => '',
		];
	}

	public function _wp_enqueue_scripts() {
		wp_enqueue_style(
			'snow-monkey-the-events-calendar-support',
			SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_URL . '/dist/css/app.min.css',
			[],
			filemtime( SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/dist/css/app.min.css' )
		);
	}

	public function _snow_monkey_breadcrumbs( $items ) {
		global $wp_query;
		$post_type = $wp_query->get( 'post_type' );

		if ( \Tribe__Events__Main::POSTTYPE === $post_type ) {
			$items[1] = [
				'title' => __( 'Events', 'snow-monkey-the-events-calendar' ),
				'link'  => get_post_type_archive_link( \Tribe__Events__Main::POSTTYPE ),
			];
		}
		return $items;
	}
}
