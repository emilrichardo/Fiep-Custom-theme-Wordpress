<?php
/**
 * Template Name: Charlas
 * 
 * 100% wide page template without vertical spacing.
 * 
 * @package     Sinatra
 * @author      Sinatra Team <hello@sinatrawp.com>
 * @since       1.0.0
 */
?>

<?php get_header(); ?>


<!-- cursos -->


<div class="container">

<div class="row justify-content-center my-5">
	<div class="col-md-10">
	<?php
			//do_action( 'sinatra_before_singular' );

			do_action( 'sinatra_content_singular' );

			//do_action( 'sinatra_after_singular' );
			?>
	</div>
</div>
	

	

</div><!-- END .si-container -->






<?php
get_footer();
