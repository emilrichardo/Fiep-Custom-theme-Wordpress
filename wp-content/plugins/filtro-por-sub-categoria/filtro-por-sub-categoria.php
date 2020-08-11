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
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		//if title is present
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		//output
		
		//echo __( '', 'subCategoria_widget_domain' );
		echo $args['after_widget'];
		$term = get_queried_object();
		$children = get_terms( $term->taxonomy, array(
        'parent'    => $term->term_id,
        'hide_empty' => false,
	) );
	echo '<hr>';
    if ( $children ) { 
		
        foreach( $children as $subcat )
        {	
			if($subcat->count != 0){
				echo '<a class="btn ml-1 mt-1 btn-sm btn-outline-primary" href="' . esc_url(get_term_link($subcat, $subcat->taxonomy)) . '">' . $subcat->name . ' <span class="badge badge-			light">'.$subcat->count.'</span></a>';	
			}
		}
    }
	else
	{
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
	
	
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
			$title = $instance[ 'title' ];
		else
			$title = __( 'Default Title', 'subCategoria_widget_domain' );
	}
	
}





?>