<?php 
    $subtitulo = get_field('subtitulo');
    $fecha = get_field('fecha');
    $descripcion = get_field('descripcion');
    $institucion_organizadora = get_field('institucion_organizadora');   
    $estado_inscripciones = get_field_object('estado_inscripciones');
    $estado_inscripciones_value = get_field('estado_inscripciones');
    $fecha_apertura = get_field('fecha_de_apertura');
    $tematica = get_field('tematicas');
    $dirigido = get_field('dirigido_a');
    $programa = get_field('programa');     
    $disertantes = get_field('disertantes');
    $acordion_datos = get_field('acordion_datos');
    $auspiciantes = get_field('auspiciantes'); 
?>

    <div class="row justify-content-between">
        <div class="col-12 col-md-7">
        <?php  
            // estado de inscripciones
            if( $estado_inscripciones['value'] == 'proximamente' ) {                    
                echo wp_kses_post( '<h5 class="text-left"> <strong> <i class="fa fa-clock-o text-warning" aria-hidden="true"></i> ' . $estado_inscripciones['label'] . ': ' . $estado_inscripciones['choices'][$estado_inscripciones_value] . '</strong></h5>'  );
            } elseif( $estado_inscripciones['value'] == 'abiertas' ){
                echo wp_kses_post( '<h5 class="text-left"> <strong> <i class="fa fa-check-circle-o text-success" aria-hidden="true"></i> ' . $estado_inscripciones['label'] . ' ' . $estado_inscripciones['choices'][$estado_inscripciones_value] . '</strong></h5>'  );
            }  else {
                echo wp_kses_post( '<h5 class="text-left"> <strong> <i class="fa fa-times-circle text-danger" aria-hidden="true"></i> ' . $estado_inscripciones['label'] . ' ' . $estado_inscripciones['choices'][$estado_inscripciones_value] . '</strong></h5>'  );
            } ;
            // fecha de inscripciones
            echo wp_kses_post('<h4 class="h2 mt-0 ">  Inicia el <strong>' . $fecha . '</strong></h3>');             
            echo wp_kses_post('<div class="alert alert-warning mt-5"><p class="h6"> <strong>Temática:</strong> <br>' . $tematica . '</p></div>');  
            get_template_part(  'template-parts/content/card-persona' );
            //descripcion
            if ( $descripcion ) :
                ?>
                <div class="row justify-content-center align-items-center mb-5 ">        
                    <div class="col- 12 col-md-12  mt-md-5 mb-5"><?php echo get_the_post_thumbnail($post_id , 'large', array( 'class' => 'w-100 rounded' )) ;?> </div>
                    <div class="col-12 col-md-12"><h4 class="h5 mt-0"><?php echo esc_html( $descripcion ); ?></h3></div>
                </div>
                
                <?php
            endif;  

            if ( $acordion_datos ) :
                ?>                
                
                <?php get_template_part(  'template-parts/content/component-accordion' );
                ?>  
                
                <?php
            endif; 

            if ( $auspiciantes ) :
                ?>                
                
                <?php get_template_part(  'template-parts/content/card-auspiciantes' );
                ?>  
                
                <?php
            endif; 
            
            

           

            if ( $programa ) :
                ?>
                <h4>Programa:</h4>
                
                <?php echo wp_kses_post ($programa) ;
                ?>  
                
                <?php
            endif; 
        ?>  


        </div>
        <div class="col-12 col-md-4">
            <?php 
            if ($estado_inscripciones['value'] == 'abiertas' ) : 
                get_template_part( 'template-parts/content/card-cursos' );             
            elseif ($estado_inscripciones['value'] == 'cerradas'):
            ?>
            <div class="alert alert-danger text-center h1">
                <i class="fa fa-frown-o text-danger " aria-hidden="true"></i>
                <p class="h5">Lo lamentamos, las inscripciones para este curso se encuentran cerradas. <br> <strong>Lo esperamos la próxima.</strong> </p>
            </div>
            <?php 
            else :
            ?>
            <div class="alert alert-warning text-center h1">
                <i class="fa fa-clock-o text-warning" aria-hidden="true"></i>
                <p class="h6">Podrás inscribirte a este curso partir del: <br> <strong><?php echo $fecha_apertura ;?> </strong> </p>                
            </div>
            <?php 
            endif; 
            ?>            
            <?php             
            echo wp_kses_post('<div class="mt-5"><p class="h6"> <strong>¿A quién está dirigido?</strong> <br>' . $dirigido . '</p></div>');
            ;?>
        </div>
    </div>
      








