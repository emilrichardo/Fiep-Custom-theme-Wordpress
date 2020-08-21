<?php
/*
Plugin Name: Quitar filtos cursos
Plugin URI: 
Description: 
Version: 
Author: 
Author URI: 
License: 
License URI: 
*/
function quitarfiltroCursos_register_widget() {
    register_widget( 'quitarfiltroCursos_widget' );
    }
     add_action( 'widgets_init', 'quitarfiltroCursos_register_widget' );


     class quitarfiltroCursos_widget extends WP_Widget {
        function __construct() {
            parent::__construct(
            // widget ID
            'quitarfiltroCursos_widget',
            // widget name
            __('Quitar filtros cursos', ' quitarfiltroCursos_widget_domain'),
            // widget description
            array( 'description' => __( 'Quitar filtros cursos', 'quitarfiltroCursos_widget_domain' ), )
            );
        }
        
        
        public function widget( $args, $instance ) {
            //Levanta el tipo de entrada
            $postType = get_post_type_object(get_post_type());
            global $wp;
            if ($wp->request=="cursos") {
                    $categoria_cursos = $_GET['categoria_cursos'];
                    $estado_inscripciones = $_GET['estado_inscripciones'];
                    $cupos = $_GET['cupos'];
                    $texto = '';
                    if($categoria_cursos != ''){
                        $texto = $categoria_cursos;
                    }
                    if($estado_inscripciones != ''){
                        $texto = $estado_inscripciones;
                    }
                    if($cupos != '' ){
                        $texto = $cupos;
                    }
                    if($texto != ''){
                        echo '<a class="btn ml-1 mt-1 btn-sm btn-primary" href="'. esc_url( home_url( '/cursos') ) . '">'.ucfirst ( $texto ) .' <i class="fa fa-close"></i></a><br>';
                    }
                   
                
            }
        }
        
        
        public function form( $instance ) {
            if ( isset( $instance[ 'title' ] ) )
                $title = $instance[ 'title' ];
            else
                $title = __( 'Default Title', 'quitarfiltroCursos_widget_domain' );
        }
        
    }
    
    
    ?>