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
	$category = get_queried_object();			
	

	if ( ! empty( $sinatra_single_post_elements ) ) {
		foreach ( $sinatra_single_post_elements as $sinatra_element ) {

			if ( 'content' === $sinatra_element ) { 
				
				
				
				
				do_action( 'sinatra_before_single_content' );	

				$post = get_post();
				$parent = '';
				$category_detail=get_the_category($post->ID);//$post->ID
					if($category_detail[0]->parent != 0){
						$parent = get_term( $category_detail[0]->parent );
					}else{
						$parent = $category_detail[0]->slug;
					}
					
					if($parent == 'webinar'){
						get_template_part( 'template-parts/content/evento-webinar' , $sinatra_element );
					}

				
				
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
