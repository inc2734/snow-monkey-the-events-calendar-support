<?php
/**
 * Plugin name: Snow Monkey The Events Calendar Integrator
 * Description: With this plugin, Snow Monkey can use The Events Calendar plugin.
 * Version: 0.2.1
 * Tested up to: 5.5
 * Requires at least: 5.5
 * Requires PHP: 5.6
 * Author: inc2734
 * Author URI: https://2inc.org
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: snow-monkey-the-events-calendar-support
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

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, '_plugins_loaded' ] );
	}

	public function _plugins_loaded() {
		load_plugin_textdomain( 'snow-monkey-the-events-calendar-support', false, basename( __DIR__ ) . '/languages' );

		add_action( 'init', [ $this, '_activate_autoupdate' ] );

		$theme = wp_get_theme( get_template() );
		if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
			add_action( 'admin_notices', [ $this, '_admin_notice_no_snow_monkey' ] );
			return;
		}

		if ( ! version_compare( $theme->get( 'Version' ), '11.0.0', '>=' ) ) {
			add_action( 'admin_notices', [ $this, '_admin_notice_invalid_snow_monkey_version' ] );
			return;
		}

		if ( ! class_exists( '\Tribe__Events__Main' ) ) {
			add_action( 'admin_notices', [ $this, '_admin_notice_no_the_events_calendar' ] );
			return;
		}

		add_action(
			'after_setup_theme',
			function() {
				new Controller\Front();
			}
		);
	}

	/**
	 * Activate auto update using GitHub
	 *
	 * @return void
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

	/**
	 * Admin notice for no Snow Monkey
	 *
	 * @return void
	 */
	public function _admin_notice_no_snow_monkey() {
		?>
		<div class="notice notice-warning is-dismissible">
			<p>
				<?php esc_html_e( '[Snow Monkey The Events Calendar Integrator] Needs the Snow Monkey.', 'snow-monkey-the-events-calendar-support' ); ?>
			</p>
		</div>
		<?php
	}

	/**
	 * Admin notice for invalid Snow Monkey version
	 *
	 * @return void
	 */
	public function _admin_notice_invalid_snow_monkey_version() {
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
						'v11.0.0'
					)
				);
				?>
			</p>
		</div>
		<?php
	}

	/**
	 * Admin notice for no The Events Calendar
	 *
	 * @return void
	 */
	public function _admin_notice_no_the_events_calendar() {
		?>
		<div class="notice notice-warning is-dismissible">
			<p>
				<?php esc_html_e( '[Snow Monkey The Events Calendar Integrator] Needs The Events Calendar.', 'snow-monkey-the-events-calendar-support' ); ?>
			</p>
		</div>
		<?php
	}
}

require_once( SNOW_MONKEY_THE_EVENTS_CALENDAR_SUPPORT_PATH . '/vendor/autoload.php' );
new Bootstrap();
