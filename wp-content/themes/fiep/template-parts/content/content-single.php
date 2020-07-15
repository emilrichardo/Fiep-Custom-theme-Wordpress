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
	if ( 'quote' === get_post_format() ) {
		get_template_part( 'template-parts/entry/format/media', 'quote' );
	}

	$sinatra_single_post_elements = sinatra_get_single_post_elements();
	
	$fecha = get_field('fecha');
	$lugar = get_field('lugar');
	$tema = get_field('tema');
	
	

	if ( ! empty( $sinatra_single_post_elements ) ) {
		foreach ( $sinatra_single_post_elements as $sinatra_element ) {

			if ( 'content' === $sinatra_element ) {
				do_action( 'sinatra_before_single_content' );
				echo '<h3 class="text-center">' . $fecha . '</h3>';
				echo '<h4 class="text-center">' . $lugar . '</h4>';
				echo '<h4 class="text-center">' . $tema . '</h4>';
				get_template_part( 'template-parts/entry/entry', $sinatra_element );
				do_action( 'sinatra_after_single_content' );
			} else {
				get_template_part( 'template-parts/entry/entry', $sinatra_element );
			}
		}
	}
	?>

                        
                    
</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action( 'sinatra_after_article' ); ?>
