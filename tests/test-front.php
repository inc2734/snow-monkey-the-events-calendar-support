<?php

use Snow_Monkey\Plugin\TheEventsCalendarSupport\App\Controller\Front;

class Front_Test extends WP_UnitTestCase {

	public function test_integration_loads_with_snow_monkey_and_the_events_calendar() {
		$this->assertSame( 'snow-monkey', get_template() );
		$this->assertTrue( class_exists( 'Tribe__Events__Main' ) );
		$this->assertNotFalse( has_filter( 'tribe_events_template_paths' ) );
		$callbacks = $GLOBALS['wp_filter']['tribe_events_template_paths']->callbacks;
		$found     = false;
		foreach ( $callbacks as $priority ) {
			foreach ( $priority as $callback ) {
				if ( is_array( $callback['function'] ) && $callback['function'][0] instanceof Front ) {
					$found = true;
				}
			}
		}
		$this->assertTrue( $found, 'The integration controller must be registered during theme setup.' );
	}

	public function test_event_content_expands_only_the_supported_template_parts() {
		add_filter( 'inc2734_wp_view_controller_expand_get_template_part', '__return_false', 10 );
		$this->assertTrue( apply_filters( 'inc2734_wp_view_controller_expand_get_template_part', false, array( 'slug' => 'templates/view/content', 'name' => 'tribe_events' ) ) );
		$this->assertTrue( apply_filters( 'inc2734_wp_view_controller_expand_get_template_part', false, array( 'slug' => 'templates/view/content', 'name' => 'the-events-calendar-content' ) ) );
		$this->assertFalse( apply_filters( 'inc2734_wp_view_controller_expand_get_template_part', false, array( 'slug' => 'templates/view/content', 'name' => 'post' ) ) );
	}

	public function test_calendar_template_path_is_added_without_duplicates() {
		$path  = SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/templates';
		$paths = apply_filters( 'tribe_events_template_paths', array( '/existing', $path ) );
		$this->assertContains( '/existing', $paths );
		$this->assertSame( 1, count( array_keys( $paths, $path, true ) ) );
	}

	public function test_event_queries_receive_the_plugin_template_directory() {
		global $wp_query;
		$wp_query->set( 'post_type', Tribe__Events__Main::POSTTYPE );
		$path = SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/templates';
		$this->assertContains( $path, apply_filters( 'snow_monkey_template_part_root_hierarchy', array() ) );
		$wp_query->set( 'post_type', 'post' );
		$this->assertNotContains( $path, apply_filters( 'snow_monkey_template_part_root_hierarchy', array() ) );
	}

	public function test_event_breadcrumbs_include_archive_and_event_links() {
		$event = tribe_events()->set_args(
			array(
				'title'      => 'Compatibility event',
				'status'     => 'publish',
				'timezone'   => 'UTC',
				'start_date' => gmdate( 'Y-m-d H:i:s', time() + WEEK_IN_SECONDS ),
				'end_date'   => gmdate( 'Y-m-d H:i:s', time() + WEEK_IN_SECONDS + HOUR_IN_SECONDS ),
			)
		)->create();
		$this->assertInstanceOf( WP_Post::class, $event );
		$event_id = $event->ID;
		// Programmatic event writes are normally committed on shutdown.
		tribe( \TEC\Events\Custom_Tables\V1\Updates\Controller::class )->commit_updates();
		$this->go_to( '/?post_type=tribe_events&p=' . $event_id );
		$this->assertSame( $event_id, get_queried_object_id() );
		$GLOBALS['wp_query']->set( 'post_type', Tribe__Events__Main::POSTTYPE );
		$items = apply_filters( 'snow_monkey_breadcrumbs', array( array( 'title' => 'Home', 'link' => home_url( '/' ) ) ) );
		$this->assertSame( get_post_type_archive_link( Tribe__Events__Main::POSTTYPE ), $items[1]['link'] );
		$this->assertSame( 'Compatibility event', $items[2]['title'] );
		$this->assertSame( get_permalink( $event_id ), $items[2]['link'] );
	}

	public function test_stylesheet_is_enqueued_and_contains_the_calendar_clear_rule() {
		do_action( 'wp_enqueue_scripts' );
		$handle = 'snow-monkey-the-events-calendar-support';
		$this->assertTrue( wp_style_is( $handle, 'enqueued' ) );
		$this->assertSame( SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_URL . '/dist/css/app.min.css', wp_styles()->registered[ $handle ]->src );
		$css = file_get_contents( SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/dist/css/app.min.css' );
		$this->assertMatchesRegularExpression( '/\[id=["\']?tribe-events-content["\']?\]\s*\{\s*clear\s*:\s*both/', $css );
	}
}
