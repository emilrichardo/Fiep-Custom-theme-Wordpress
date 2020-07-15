<?php
/**
 * Template Name: Home
 * 
 * 100% wide page template without vertical spacing.
 * 
 * @package     Sinatra
 * @author      Sinatra Team <hello@sinatrawp.com>
 * @since       1.0.0
 */
?>

<?php get_header(); ?>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v7.0" nonce="hhQWLx64"></script>

<!-- feture post -->
<?php  get_template_part( 'template-parts/content/feature-post', sinatra_get_article_feed_layout() ); ?>



<?php  get_template_part( 'template-parts/content/comite', sinatra_get_article_feed_layout() ); ?>
<div class="mt-0 text-center bg-dark pb-5">
	<hr>
        <a href="#" class="btn btn-outline-light btn-lg ml-md-5">Estructura completa</a>
    <a href="#" class="btn btn-outline-light btn-lg">Representantes Provinciales</a>
</div>

<!-- cursos -->
<?php  get_template_part( 'template-parts/content/cursos-home', sinatra_get_article_feed_layout() ); ?>	

<div class="si-container">

	<div id="primary" class="content-area">

		<?php do_action( 'sinatra_before_content' ); ?>

		<main id="content" class="site-content" role="main"<?php sinatra_schema_markup( 'main' ); ?>>		
			<?php get_template_part( 'template-parts/content/content-grid', sinatra_get_article_feed_layout() ); ?>	
		</main><!-- #content .site-content -->

		<?php do_action( 'sinatra_after_content' ); ?>

	</div><!-- #primary .content-area -->

	<?php do_action( 'sinatra_sidebar' ); ?>

</div><!-- END .si-container -->






<?php
get_footer();
