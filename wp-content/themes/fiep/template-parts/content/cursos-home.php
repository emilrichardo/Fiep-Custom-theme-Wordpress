<?php 
    // the query
    $cursos_list = new WP_Query( array(
        'post_type'           => 'cursos',
        'post_status'         => 'publish',
        'posts_per_page'      => '6',	
        'meta_query' => array(
            array(
                'key' => 'mostrar_home',
                'value' => 'on',               
            )
        )
        
    )); 
    ?>	

<?php if ( $cursos_list->have_posts() ) : ?>
    <section class="bg-light pb-5">
    
    <div class="si-container text-center">
		<h2>Cursos en Línea</h2>
		<div class="container">
			<div class="si-flex-row ">

    <?php while ( $cursos_list->have_posts() ) : $cursos_list->the_post();
        $fecha = get_field('fecha');
        $lugar = get_field('lugar');
        $tema = get_field('tema');  
        $estado_inscripciones = get_field_object('estado_inscripciones');
        $estado_inscripciones_value = get_field('estado_inscripciones');  
        $cupos = get_field_object('cupos'); 
        $cupos_value = get_field('cupos'); 
        $certificaciones = get_field('certificaciones');
        $institucion_organizadora = get_field('institucion_organizadora');    
             
        ?>
               
         
                <div class="col-xs-12 col-md-4">                
    
                  <a href="<?php the_permalink(); ?>"> 
                        <div class="card text-left shadow">
                            <div class="card-header">
                                <?php 
                                // estado de inscripciones
                                if( $estado_inscripciones['value'] == 'proximamente' ) {                    
                                    echo wp_kses_post( '<h5 class="my-0 text-left"> <strong> <i class="fa fa-clock-o text-warning" aria-hidden="true"></i> ' . $estado_inscripciones['label'] . ': ' . $estado_inscripciones['choices'][$estado_inscripciones_value] . '</strong></h5>'  );
                                } elseif( $estado_inscripciones['value'] == 'abiertas' ){
                                    echo wp_kses_post( '<h5 class="my-0 text-left"> <strong> <i class="fa fa-check-circle-o text-success" aria-hidden="true"></i> ' . $estado_inscripciones['label'] . ' ' . $estado_inscripciones['choices'][$estado_inscripciones_value] . '</strong></h5>'  );
                                }  else {
                                    echo wp_kses_post( '<h5 class="my-0 text-left"> <strong> <i class="fa fa-times-circle text-danger" aria-hidden="true"></i> ' . $estado_inscripciones['label'] . ' ' . $estado_inscripciones['choices'][$estado_inscripciones_value] . '</strong></h5>'  );
                                } ;
                                ?>

                            </div>
                            <div class="card-body">
                                <?php  
                                get_template_part( 'template-parts/entry/entry-header' );                            
                                get_template_part( 'template-parts/entry/entry-thumbnail' );
                                                               
                                // fecha de inscripciones
                                    echo wp_kses_post('<h4 class="h6 mt-2 ">  Inicia el <strong>' . $fecha . '</strong></h3>');    
                                ?>  
                                 <?php 
                                if ($cupos){
                                    echo wp_kses_post('<h5 class="small  mt-0 mb-0 text-muted">' . $cupos['choices'][$cupos_value] . '</h5> <hr class="my-1">'); 
                                };
                                if ($certificaciones){
                                    echo wp_kses_post('<h5 class="small  mt-0 mb-0 text-muted"> ' . $certificaciones . '</h5> <hr class="my-1">');
                                };
                                if ($institucion_organizadora){
                                    echo wp_kses_post('<h5 class="small  mt-0 mb-0 text-muted"> Organizado por: ' . $institucion_organizadora . '</h5> <hr class="my-1">');
                                };         
                                        
                                ?>
                                      <a href="<?php the_permalink(); ?>" class="btn btn-block btn-primary mt-3">Ver curso</a>            
                                     
                             </div>                  
                        </div>
                    </a>					
				</div>
            
        
                
 

    <?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<?php else : ?>
<p><?php __('No News'); ?></p>


             </div>
		</div>
    </div>

    
<?php endif; ?>
</section>

