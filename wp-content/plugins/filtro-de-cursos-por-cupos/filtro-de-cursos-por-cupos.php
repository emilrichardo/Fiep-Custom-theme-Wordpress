<?php
/*
Plugin Name: Filtro de cursos por cupos
Plugin URI: 
Description: 
Version: 
Author: 
Author URI: 
License: 
License URI: 
*/

function cuposCursos_register_widget() {
    register_widget( 'cuposCursos_widget' );
    }
    add_action( 'widgets_init', 'cuposCursos_register_widget' );

    class cuposCursos_widget extends WP_Widget {
        function __construct() {
            parent::__construct(
            // widget ID
            'cuposCursos_widget',
            // widget name
            __('Filtro de cursos por cupos', ' cuposCursos_widget_domain'),
            // widget description
            array( 'description' => __( 'Filtro de cursos por cupos', 'cuposCursost_domain' ), )
            );
        }
        
        
        public function widget( $args, $instance ) {
            //Levanta el tipo de entrada
            $postType = get_post_type_object(get_post_type());
            global $wp;
            if ($wp->request=="cursos") {
                    echo '<h5 class="ml-2"><strong><i>Cupos</i></strong></h5>';
                    $parameter = $_GET['cupos'];
                    
                    $cursos = get_posts([
                        'post_type' => 'cursos',
                        'post_status' => 'any',
                        'numberposts' => -1
                        // 'order'    => 'ASC'
                      ]);
    
                    $result = array();
                    foreach($cursos as $val) {
                        $object = get_field_object('cupos', $val->ID);
                        
                        $value = get_field('cupos', $val->ID);  
                        $valor = trim($object['choices'][$value]);
                        
                        if(!in_array($valor, $result)){
                            array_push($result, $valor);
                            if($parameter != $value ){
                                // echo '<a class="btn ml-1 mt-1 btn-sm btn-primary" href="'. esc_url( home_url( '/cursos/?cupos=' . $value) ) . '">' . $value . '</a>';
                                echo '<a class="btn ml-1 mt-1 btn-sm btn-outline-primary" href="' . esc_url( home_url( '/cursos/?cupos=' . $value) ) . '">' . ucfirst ( $value ) . ' </a>';	
                            }
                        }
                    }
            }
        }
        
        
        public function form( $instance ) {
            if ( isset( $instance[ 'title' ] ) )
                $title = $instance[ 'title' ];
            else
                $title = __( 'Default Title', 'cuposCursos_widget_domain' );
        }
        
    }
    
    
    
    //  Cupos vacantes
    // limitados : Cupos limitados
    // ultimos : Últimos cupos
    
    ?>