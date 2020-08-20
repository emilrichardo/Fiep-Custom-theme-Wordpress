<?php
/*
Plugin Name: Filtro de cursos por estado
Plugin URI: 
Description: 
Version: 
Author: 
Author URI: 
License: 
License URI: 
*/
function estadoCursos_register_widget() {
    register_widget( 'estadoCursos_widget' );
    }
    add_action( 'widgets_init', 'estadoCursos_register_widget' );



class estadoCursos_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
		// widget ID
		'estadoCursos_widget',
		// widget name
		__('Filtro de cursos por estado', ' estadoCursos_widget_domain'),
		// widget description
		array( 'description' => __( 'Filtro de cursos por estado', 'estadoCursos_widget_domain' ), )
		);
	}
    
    
	public function widget( $args, $instance ) {
		//Levanta el tipo de entrada
		$postType = get_post_type_object(get_post_type());
        

		if ($postType) {
            if(esc_html($postType->labels->singular_name) == "Curso"){
                echo '<h5 class="ml-2"><strong><i>Inscripciones</i></strong></h5>';
                $parameter = $_GET['estado_inscripciones'];
                
                $cursos = get_posts([
                    'post_type' => 'cursos',
                    'post_status' => 'any',
                    'numberposts' => -1
                    // 'order'    => 'ASC'
                  ]);

                $result = array();
                foreach($cursos as $val) {
                    $curso = $cursos[0];
                    $object = get_field_object('estado_inscripciones', $val->ID);
                    $value = get_field('estado_inscripciones', $val->ID);  
                    $valor = trim($object['choices'][$value]);
                    
                    if(!in_array($valor, $result)){
                        array_push($result, $valor);
                        if($parameter == $valor ){
                            echo '<a class="btn ml-1 mt-1 btn-sm btn-primary" href="'. esc_url( home_url( '/cursos/?estado_inscripciones=' . $valor) ) . '">' . $valor . '</a>';
                        }else{
                            echo '<a class="btn ml-1 mt-1 btn-sm btn-outline-primary" href="' . esc_url( home_url( '/cursos/?estado_inscripciones=' . $valor) ) . '">' . $valor . ' </a>';	
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
			$title = __( 'Default Title', 'estadoCursos_widget_domain' );
	}
	
}


?>