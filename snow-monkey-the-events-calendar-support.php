<?php
/**
 * Plugin name: Snow Monkey The Events Calendar Integrator
 * Description: With this plugin, Snow Monkey can use The Events Calendar plugin.
 * Version: 0.2.1
 * Tested up to: 5.5
 * Requires at least: 5.5
 * Requires PHP: 5.6
 * Requires Snow Monkey: 11.1.0
 * Requires The Events Calendar: 5.3.0
 * Author: inc2734
 * Author URI: https://2inc.org
 *
 * @package snow-monkey-the-events-calendar-support
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Snow_Monkey\Plugin\TheEventsCalendarSupport;

use Snow_Monkey\Plugin\TheEventsCalendarSupport\App\Controller;
use Framework\Helper;

define( 'SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

class Bootstrap {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, '_plugins_loaded' ] );
	}

	/**
	 * Plugins loaded.
	 */
	public function _plugins_loaded() {
		load_plugin_textdomain( 'snow-monkey-the-events-calendar-support', false, basename( __DIR__ ) . '/languages' );

		add_action( 'init', [ $this, '_activate_autoupdate' ] );

		$theme = wp_get_theme( get_template() );
		if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
			add_action(
				'admin_notices',
				function() {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<?php esc_html_e( '[Snow Monkey The Events Calendar Integrator] Needs the Snow Monkey.', 'snow-monkey-the-events-calendar-support' ); ?>
						</p>
					</div>
					<?php
				}
			);
			return;
		}

		$data = get_file_data(
			__FILE__,
			[
				'RequiresSnowMonkey' => 'Requires Snow Monkey',
			]
		);

		if (
			isset( $data['RequiresSnowMonkey'] ) &&
			version_compare( $theme->get( 'Version' ), $data['RequiresSnowMonkey'], '<' )
		) {
			add_action(
				'admin_notices',
				function() use ( $data ) {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<?php
							echo esc_html(
								sprintf(
									// translators: %1$s: version
									__(
										'[Snow Monkey The Events Calendar Integrator] Needs the Snow Monkey %1$s or more.',
										'snow-monkey-the-events-calendar-support'
									),
									'v' . $data['RequiresSnowMonkey']
								)
							);
							?>
						</p>
					</div>
					<?php
				}
			);
		}

		if ( ! class_exists( '\Tribe__Events__Main' ) ) {
			add_action(
				'admin_notices',
				function() {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<?php esc_html_e( '[Snow Monkey The Events Calendar Integrator] Needs The Events Calendar.', 'snow-monkey-the-events-calendar-support' ); ?>
						</p>
					</div>
					<?php
				}
			);
			return;
		}

		$data = get_file_data(
			__FILE__,
			[
				'RequiresTheEventsCalendar' => 'Requires The Events Calendar',
			]
		);

		$the_events_calendar = __DIR__ . '/../the-event-calendar/the-events-calendar.php';
		if ( file_exists( $the_events_calendar ) ) {
			$the_events_calendar_data = get_file_data(
				__DIR__ . '/../the-event-calendar/the-events-calendar.php',
				[
					'Version' => 'Version',
				]
			);
		}

		if (
			isset( $data['RequiresTheEventsCalendar'] ) &&
			isset( $the_events_calendar_data ) &&
			version_compare( $the_events_calendar_data['Version'], $data['RequiresTheEventsCalendar'], '<' )
		) {
			add_action(
				'admin_notices',
				function() use ( $data ) {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<?php
							echo esc_html(
								sprintf(
									// translators: %1$s: version
									__(
										'[Snow Monkey The Events Calendar Integrator] Needs The Events Calendar %1$s or more.',
										'snow-monkey-the-events-calendar-support'
									),
									'v' . $data['RequiresTheEventsCalendar']
								)
							);
							?>
						</p>
					</div>
					<?php
				}
			);
		}

		add_action(
			'after_setup_theme',
			function() {
				new Controller\Front();
			}
		);
	}

	/**
	 * Activate auto update using GitHub.
	 */
	public function _activate_autoupdate() {
		new \Inc2734\WP_GitHub_Plugin_Updater\Bootstrap(
			plugin_basename( __FILE__ ),
			'inc2734',
			'snow-monkey-the-events-calendar-support',
			[
				'homepage' => 'https://snow-monkey.2inc.org',
			]
		);
	}
}

require_once( SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/vendor/autoload.php' );
new Bootstrap();
