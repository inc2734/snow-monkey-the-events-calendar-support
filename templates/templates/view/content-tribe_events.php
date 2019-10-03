<?php
/**
 * @package snow-monkey-the-events-calendar-support
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

global $wp_query;
$_post_type = $wp_query->get( 'post_type' );

$eyecatch_position = get_theme_mod( get_post_type() . '-eyecatch' );
?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
	<article <?php post_class(); ?>>
		<?php
		if ( 'title-on-page-header' !== $eyecatch_position ) {
			Helper::get_template_part( 'template-parts/content/entry/header/header', $_post_type );
		}
		?>

		<div class="c-entry__body">
			<?php Helper::get_template_part( 'template-parts/content/entry/content/content', $_post_type ); ?>
		</div>
	</article>
<?php endwhile; ?>

<?php
if ( comments_open() || pings_open() || get_comments_number() ) {
	comments_template( '', true );
}
