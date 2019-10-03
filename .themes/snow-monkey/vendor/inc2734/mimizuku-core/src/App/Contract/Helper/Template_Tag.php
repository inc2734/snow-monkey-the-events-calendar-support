<?php
/**
 * @package mimizuku-core
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\Mimizuku_Core\App\Contract\Helper;

use Inc2734\Mimizuku_Core\App\Model;
use Inc2734\WP_Adsense;
use Inc2734\WP_View_Controller;

trait Template_Tag {

	/**
	 * Display the site logo or the site title
	 *
	 * @return void
	 */
	public static function the_site_branding() {
		?>
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php endif; ?>
		<?php
	}

	/**
	 * Return pure post content
	 *
	 * @return string
	 */
	public static function get_pure_post_content() {
		$post = get_post();

		if ( ! $post || ! isset( $post->post_content ) ) {
			return;
		}

		if ( post_password_required( $post ) ) {
			return;
		}

		$extended = get_extended( $post->post_content );
		$content  = $extended['main'];
		return $content;
	}

	/**
	 * Return pure trim excerpt
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_trim_excerpt/
	 *
	 * @return string
	 */
	public static function pure_trim_excerpt() {
		$raw_excerpt = '';

		$text = static::get_pure_post_content();
		$text = strip_shortcodes( $text );
		$text = str_replace( ']]>', ']]&gt;', $text );

		$excerpt_length = apply_filters( 'excerpt_length', 55 );
		$excerpt_more   = apply_filters( 'excerpt_more', ' [&hellip;]' );

		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

		return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
	}

	/**
	 * Display google adsense
	 *
	 * @param $code
	 * @param $size
	 * @return void
	 */
	public static function display_adsense_code( $code, $size = null ) {
		WP_Adsense\Helper::the_adsense_code( $code, $size );
	}

	/**
	 * Load footer template
	 *
	 * @param string $name
	 * @return void
	 */
	public static function get_footer_template( $name = 'footer' ) {
		WP_View_Controller\Helper::get_footer_template( $name );
	}

	/**
	 * This function like get_footer()
	 *
	 * @param string $name
	 * @return void
	 */
	public static function get_footer( $name = null ) {
		WP_View_Controller\Helper::get_footer( $name );
	}

	/**
	 * Load header template
	 *
	 * @param string $name
	 * @return void
	 */
	public static function get_header_template( $name = 'header' ) {
		WP_View_Controller\Helper::get_header_template( $name );
	}

	/**
	 * This function like get_header()
	 *
	 * @param string $name
	 * @return void
	 */
	public static function get_header( $name = null ) {
		WP_View_Controller\Helper::get_header( $name );
	}

	/**
	 * Load sidebar template
	 *
	 * @param string $name
	 * @return void
	 */
	public static function get_sidebar_template( $name = 'sidebar' ) {
		WP_View_Controller\Helper::get_sidebar_template( $name );
	}

	/**
	 * This function like get_sidebar()
	 *
	 * @param string $name
	 * @return void
	 */
	public static function get_sidebar( $name = null ) {
		WP_View_Controller\Helper::get_sidebar( $name );
	}

	/**
	 * A template tag that is get_template_part() using variables
	 *
	 * @param string $slug
	 * @param string $name
	 * @param array $vars
	 * @return void
	 */
	public static function get_template_part( $slug, $name = null, array $vars = [] ) {
		WP_View_Controller\Helper::get_template_part( $slug, $name, $vars );
	}

	/**
	 * Load wrapper template
	 *
	 * @param string $name
	 * @param array $args
	 * @return void
	 */
	public static function get_wrapper_template( $name = 'wrapper', array $args = [] ) {
		WP_View_Controller\Helper::get_wrapper_template( $name, $args );
	}

	/**
	 * Returns array of page templates for layout selector in customizer
	 *
	 * @return array
	 *           @var string Template slug  e.g. right-sidebar
	 *           @var string Template name  e.g. Right Sidebar
	 */
	public static function get_page_templates() {
		static $wrappers = [];
		if ( $wrappers ) {
			return $wrappers;
		}

		$page_templates = new Model\Page_Templates();
		$wrappers = $page_templates->get();
		return $wrappers;
	}

	/**
	 * Return true when the sidebar is registerd and active
	 *
	 * @param string $sidebar_id
	 * @return boolean
	 */
	public static function is_active_sidebar( $sidebar_id ) {
		return is_active_sidebar( $sidebar_id ) && is_registered_sidebar( $sidebar_id );
	}
}
