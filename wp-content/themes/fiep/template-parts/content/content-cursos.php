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
    $duracion_del_curso = get_field('duracion_del_curso');

    $cupos = get_field_object('cupos');
    $cupos_value = get_field('cupos');
    $certificaciones = get_field('certificaciones');
    $institucion_organizadora = get_field('institucion_organizadora');
?>

    <div class="row justify-content-between">
        <div class="col-12 col-md-7 order-first">
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
            ?>
        </div>
        <div class="col-12 col-md-7">
        <?php
            echo wp_kses_post('<div class="alert alert-warning mt-5"><p class="h6"> <strong>Temática:</strong> <br>' . $tematica . '</p></div>');
            get_template_part(  'template-parts/content/card-persona' );
            //descripcion
            if ( $descripcion ) :
                ?>
                <div class="row justify-content-center align-items-center mb-5 ">
                    <!-- <div class="col- 12 col-md-12  mt-md-5 mb-5"><?php echo get_the_post_thumbnail($post_id , 'large', array( 'class' => 'w-100 rounded' )) ;?> </div> -->
                    <div class="col-12 col-md-12"><h3 class="h5 mt-0"><?php echo wp_kses_post( $descripcion ); ?></h3></div>
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

        <div class="col-12 col-md-4 order-first order-md-last">
            <?php
            if ($estado_inscripciones['value'] == 'abiertas' ) {
                get_template_part( 'template-parts/content/card-cursos' );
            }else{
                $producto = get_field('producto_tienda'); 
                if($producto != null && count($producto) != 0){
                    $product = wc_get_product( $producto[0]->ID );
                    // echo '<div class="text-center">'. $product->get_image() . '</div><br>';
                    echo '<div class="card mb-5 shadow"><div class="card-body"><div class="text-center">'. $product->get_image() .'</div><br></div></div>';
                }
            }
            if ($duracion_del_curso){
                echo wp_kses_post('<h5 class="small  mt-0 mb-0 text-muted"> Duracion:&nbsp;' . $duracion_del_curso . '</h5> <hr class="my-1">');
            }
            if ($cupos){
                echo wp_kses_post('<h5 class="small  mt-0 mb-0 text-muted">' . $cupos['choices'][$cupos_value] . '</h5> <hr class="my-1">');
            };
            if ($certificaciones){
                echo wp_kses_post('<h5 class="small  mt-0 mb-0 text-muted"> ' . $certificaciones . '</h5> <hr class="my-1">');
            };
            if ($institucion_organizadora){
                echo wp_kses_post('<h5 class="small  mt-0 mb-0 text-muted"> Organizado por: ' . $institucion_organizadora . '</h5> <hr class="my-1">');
            };


            if ($estado_inscripciones['value'] == 'cerradas'):
                
            ?>
            
            <div class="alert alert-danger text-center h1">
                <i class="fa fa-frown-o text-danger " aria-hidden="true"></i>
                <p class="h5">Lo lamentamos, las inscripciones se encuentran cerradas. <br> <strong>Lo esperamos la próxima.</strong> </p>
            </div>
            <?php
            else:
                if($estado_inscripciones['value'] == 'proximamente'):
            ?>
                <div class="alert alert-warning text-center h1">
                    <i class="fa fa-clock-o text-warning" aria-hidden="true"></i>
                    <p class="h6">Podrás inscribirte a este curso partir del: <br> <strong><?php echo $fecha_apertura ;?> </strong> </p>
                </div>
            <?php
                endif;
            endif;
            ?>

           
            <?php
            echo wp_kses_post('<div class="mt-5"><p class="h6"> <strong>¿A quién está dirigido?</strong> <br>' . $dirigido . '</p></div>');
            ;?>
        </div>
    </div>









