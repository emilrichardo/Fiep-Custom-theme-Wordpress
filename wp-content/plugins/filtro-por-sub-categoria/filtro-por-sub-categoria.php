<?php
/*
Plugin Name: Filtro por Sub Categoria
Plugin URI: 
Description: 
Version: 
Author: 
Author URI: 
License: 
License URI: 
*/
function subCategoria_register_widget() {
register_widget( 'subCategoria_widget' );
}
add_action( 'widgets_init', 'subCategoria_register_widget' );

class subCategoria_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
		// widget ID
		'subCategoria_widget',
		// widget name
		__('Filtro por Sub Categoria', ' subCategoria_widget_domain'),
		// widget description
		array( 'description' => __( 'Filtro por Sub Categoria', 'subCategoria_widget_domain' ), )
		);
	}
	
	public function widget( $args, $instance ) {
		//Levanta el tipo de entrada
		$postType = get_post_type_object(get_post_type());
		// echo esc_html($postType->labels->singular_name) . '<br>';
		echo '<hr>';
		if ($postType) {
			if(esc_html($postType->labels->singular_name) == "Curso"){
				//Entradas Custom  'Curso'
				// echo 'estas en cursos';
				
				// $get_all_posts = get_posts( array(
					// 'post_type'     => esc_attr( $postType ),
					// 'post_status'   => 'publish',
					// 'numberposts'   => -1
				// ) );
				
				// //First Empty Array to store the terms
				// $post_terms = array();
				
				// //2. Loop through the posts array and retrieve the terms attached to those posts
				// foreach( $get_all_posts as $all_posts ){
					// /**
					 // * 3. Store the new terms objects within `$post_terms`
					 // */
					// $post_terms[] = get_the_terms( $all_posts->ID, esc_attr( $taxonomy ) );

				// }
				
				
	
			}
			else
			{
				//Entradas comunes 
				
				$title = apply_filters( 'widget_title', $instance['title'] );
				echo $args['before_widget'];
				//if title is present
				if ( ! empty( $title ) )
				echo $args['before_title'] . $title . $args['after_title'];
				//output
				
				
				echo $args['after_widget'];
				$term = get_queried_object();
					$children = get_terms( $term->taxonomy, array(
						'parent'    => $term->term_id,
						'hide_empty' => false,
					) );
				if ( $children ) { 
					//Sub categorias
					foreach( $children as $subcat )
					{	
						if($subcat->count != 0){
							echo '<a class="btn ml-1 mt-1 btn-sm btn-outline-primary" href="' . esc_url(get_term_link($subcat, $subcat->taxonomy)) . '">' . $subcat->name . ' <span class="badge badge-			light">'.$subcat->count.'</span></a>';	
						}
					}
				}
				else
				{
					//Si es una sub categoria recupera la categoria padre y sus hijas
					if($term->parent != 0){
							$parent = get_term( $term->parent );
							$children = get_terms( $term->taxonomy, array(
							'parent'    => $parent->term_id,
							'hide_empty' => false
						) );
					
						if ($children ){
							echo '<a class="btn ml-1 mt-1 btn-sm btn-outline-primary" href="' . esc_url(get_term_link($parent, $parent->taxonomy)) . '"> Todos </a><br>';	
							foreach( $children as $subcat )
							{
								if($subcat->count != 0){
									if($term->term_id == $subcat->term_id){
										echo '<a class="btn ml-1 mt-1 btn-sm btn-primary" href="' . esc_url(get_term_link($subcat, $subcat->taxonomy)) . '">' . $subcat->name . ' <span class="badge badge-light">'.$subcat->count.'</span></a>';
									}else{
										echo '<a class="btn ml-1 mt-1 btn-sm btn-outline-primary" href="' . esc_url(get_term_link($subcat, $subcat->taxonomy)) . '">' . $subcat->name . ' <span class="badge badge-light">'.$subcat->count.'</span></a>';	
									}	
								}
							}
							
						}
					}
				}
					
			}
		}
	}
	
	
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
			$title = $instance[ 'title' ];
		else
			$title = __( 'Default Title', 'subCategoria_widget_domain' );
	}
	
}





?>