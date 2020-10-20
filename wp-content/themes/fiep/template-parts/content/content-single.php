<?php
/**
 * Template for Single post
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sinatra
 * @author  Sinatra Team <hello@sinatrawp.com>
 * @since   1.0.0
 */

?>

<?php do_action( 'sinatra_before_article' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sinatra-article' ); ?><?php sinatra_schema_markup( 'article' ); ?>>

	<?php
		$categoria = get_the_category( $post->ID );
		$padre = get_the_category_by_ID( $categoria[0]->category_parent);
		
		if ( 'quote' === get_post_format() ) {
			get_template_part( 'template-parts/entry/format/media', 'quote' );
		}

		$sinatra_single_post_elements = sinatra_get_single_post_elements();

		if ( ! empty( $sinatra_single_post_elements ) ) {
			foreach ( $sinatra_single_post_elements as $sinatra_element ) {

				if ( 'content' === $sinatra_element ) { 
					do_action( 'sinatra_before_single_content' );	
					
					//Valida que el evento tenga producto 
					$producto = get_field('producto_tienda'); 

					if(($padre == 'Webinar' || $categoria[0]->name == 'Webinar') && ($producto != null && count($producto) != 0)){
						get_template_part( 'template-parts/content/evento-webinar' , $sinatra_element );
						?> 
						<div class="col-12 col-md-7">
							<?php get_template_part( 'template-parts/entry/entry', $sinatra_element ); ?>
						</div>
						<?php
					}else{
						get_template_part( 'template-parts/entry/entry', $sinatra_element );
					}
					do_action( 'sinatra_after_single_content' );
				} else {
					get_template_part( 'template-parts/entry/entry', $sinatra_element );
				}
			}
		}
	?>
</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action( 'sinatra_after_article' ); ?>
