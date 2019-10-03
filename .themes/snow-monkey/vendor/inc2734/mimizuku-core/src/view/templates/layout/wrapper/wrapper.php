<?php
/**
 * @package mimizuku
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\Mimizuku_Core\Helper;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php get_template_part( 'vendor/inc2734/mimizuku-core/src/view/template-parts/head' ); ?>

<body <?php body_class(); ?>>
<?php do_action( 'mimizuku_prepend_body' ); ?>

<?php Helper::get_header(); ?>

<main role="main">
	<?php $_view_controller->view(); ?>
</main>

<?php Helper::get_sidebar(); ?>

<?php Helper::get_footer(); ?>

<?php wp_footer(); ?>
</body>
</html>
