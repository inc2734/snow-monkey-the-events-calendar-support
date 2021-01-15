<?php
/**
 * @package snow-monkey-the-events-calendar-support
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Snow_Monkey\Plugin\TheEventsCalendarSupport\App\Controller;

class Front {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'snow_monkey_template_part_root_hierarchy', [ $this, '_snow_monkey_template_part_root_hierarchy' ] );
		add_filter( 'tribe_events_template_paths', [ $this, '_template_paths' ] );
		add_action( 'wp_enqueue_scripts', [ $this, '_wp_enqueue_scripts' ] );
		add_filter( 'snow_monkey_breadcrumbs', [ $this, '_snow_monkey_breadcrumbs' ] );

		add_action(
			'tribe_tec_template_chooser',
			function() {
				add_filter( 'page_template', [ $this, '_page_template' ], 10000 );
			}
		);
	}

	/**
	 * Filters the path of the queried template by type.
	 *
	 * @param string $template Path to the template. See locate_template().
	 * @return string
	 */
	public function _page_template( $template ) {
		remove_filter( 'page_template', [ $this, '_page_template' ], 10000, 3 );

		if ( \Tribe__Events__Main::POSTTYPE !== get_post_type() ) {
			return $template;
		}

		return is_singular()
			? SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/templates/singular.php'
			: SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/templates/src/views/default-template.php';
	}

	/**
	 * Add template paths for the Snow Monkey.
	 *
	 * @param array $hierarchy Array of template paths.
	 * @return array
	 */
	public function _snow_monkey_template_part_root_hierarchy( $hierarchy ) {
		global $wp_query;
		$post_type = $wp_query->get( 'post_type' );

		if ( \Tribe__Events__Main::POSTTYPE === $post_type ) {
			$hierarchy[] = SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/templates';
			$hierarchy   = array_unique( $hierarchy );
		}

		return $hierarchy;
	}

	/**
	 * Add template paths for The Events Calendar.
	 *
	 * @param array $paths Array of template paths.
	 * @return array
	 */
	public function _template_paths( $paths ) {
		$paths[] = SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/templates';
		$paths   = array_unique( $paths );
		return $paths;
	}

	/**
	 * Enqueue assets.
	 */
	public function _wp_enqueue_scripts() {
		wp_enqueue_style(
			'snow-monkey-the-events-calendar-support',
			SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_URL . '/dist/css/app.min.css',
			[],
			filemtime( SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/dist/css/app.min.css' )
		);
	}

	/**
	 * Set breadcrumbs for pages of The Events Calendar.
	 *
	 * @param array $items Array of items.
	 * @return array
	 */
	public function _snow_monkey_breadcrumbs( $items ) {
		global $wp_query;
		$post_type = $wp_query->get( 'post_type' );

		if ( \Tribe__Events__Main::POSTTYPE === $post_type ) {
			$queried_object = get_queried_object();

			$items[1] = [
				'title' => __( 'Events', 'snow-monkey-the-events-calendar-support' ),
				'link'  => get_post_type_archive_link( \Tribe__Events__Main::POSTTYPE ),
			];

			if ( isset( $queried_object->ID ) ) {
				$items[2] = [
					'title' => get_the_title( $queried_object->ID ),
					'link'  => get_permalink( $queried_object->ID ),
				];
			}
		}
		return $items;
	}
}
