<?php
/*
Plugin Name: Filtro de cursos por categoria
Plugin URI: 
Description: 
Version: 
Author: 
Author URI: 
License: 
License URI: 
*/

 function categoriaCursos_register_widget() {
    register_widget( 'categoriaCursos_widget' );
    }
     add_action( 'widgets_init', 'categoriaCursos_register_widget' );

    class categoriaCursos_widget extends WP_Widget {
        function __construct() {
            parent::__construct(
            // widget ID
            'categoriasCursos_widget',
            // widget name
            __('Filtro de cursos por categoria', ' categoriasCursos_widget_domain'),
            // widget description
            array( 'description' => __( 'Filtro de cursos por categoria', 'categoriasCursos_widget_domain' ), )
            );
        }
        
        
        public function widget( $args, $instance ) {
            //Levanta el tipo de entrada
            $postType = get_post_type_object(get_post_type());
            
    
            if ($postType) {
                if(esc_html($postType->labels->singular_name) == "Curso"){
                    echo '<h5 class="ml-2"><strong><i>Categorias</i></strong></h5>';
                    $parameter = $_GET['categoria_cursos'];
                    
                    $taxonomy = "categoria_cursos";
                    $terms = get_terms( array(
                      'suppress_filters' => false,
                      'taxonomy' => $taxonomy,
                      'hide_empty' => false,
                    ) );

    
                    $result = array();
                    foreach($terms as $val) {
                        $name = $val->name;
                        $slug = $val->slug;  
                        
                        if(!in_array($slug, $result)){
                            array_push($result, $slug);
                            if($parameter == $slug ){
                                echo '<a class="btn ml-1 mt-1 btn-sm btn-primary" href="'. esc_url( home_url( '/cursos/?categoria_cursos=' . $slug) ) . '">' . $name . '</a>';
                            }else{
                                echo '<a class="btn ml-1 mt-1 btn-sm btn-outline-primary" href="' . esc_url( home_url( '/cursos/?categoria_cursos=' . $slug) ) . '">' . $name . ' </a>';	
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
                $title = __( 'Default Title', 'categoriasCursos_widget_domain' );
        }
        
    }
    
    
    ?>