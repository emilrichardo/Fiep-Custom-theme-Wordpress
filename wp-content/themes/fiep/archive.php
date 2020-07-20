<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sinatra
 * @author  Sinatra Team <hello@sinatrawp.com>
 * @since   1.0.0
 */

?>

<?php get_header(); ?>

<div class="si-container">

	<?php do_action( 'sinatra_sidebar' ); ?>
	
	<div id="primary" class="content-area">

		<?php do_action( 'sinatra_before_content' ); ?>

		<main id="content" class="site-content" role="main"<?php sinatra_schema_markup( 'main' ); ?>>

		<?php get_template_part( 'template-parts/content/content-archive', sinatra_get_article_feed_layout() ); ?>	

		</main><!-- #content .site-content -->

		<?php do_action( 'sinatra_after_content' ); ?>

	</div><!-- #primary .content-area -->

	

</div><!-- END .si-container -->

<?php
get_footer();
