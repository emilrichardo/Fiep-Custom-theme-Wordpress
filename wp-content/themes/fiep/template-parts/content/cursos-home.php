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
<section class="cursos">
<div class="si-container">
	<div id="primary" class="content-area">
		<main id="content" class="site-content" role="main" itemtype="http://schema.org/WebPageElement" itemprop="mainContentOfPage">		
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'sinatra-article' ); ?><?php sinatra_schema_markup( 'article' ); ?>>
            <h2 class="h1 blog-title text-white">Cursos Online</h2>
                <div class="si-flex-row">
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
                    $duracion_del_curso = get_field('duracion_del_curso');  
                    ?>			
                    	
                    <div class="col-xs-12 col-md-4 mb-5">	
                        <div class="card h-100">
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
                            <div class="">
                                    <?php get_template_part( 'template-parts/entry/entry-thumbnail-cursos-home' ); ?>
                            </div>
                            <div class="card-footer">
                                <header class="entry-header">
                                    <h3 class="entry-title h5" itemprop="headline">
                                    <?php get_template_part( 'template-parts/entry/entry-header' );	?>
                                    
                                </header>
                                <?php 
                                    echo wp_kses_post('<h4 class="h6 mt-2 ">  Inicia el <strong>' . $fecha . '</strong></h3>');    
                                    if ($duracion_del_curso){
                                        echo wp_kses_post('<h5 class="small  mt-0 mb-0 text-muted"> Duracion:&nbsp;' . $duracion_del_curso . '</h5>'); 
                                    }
                                ?>
                                <section class="sharing-box content-margin content-background clearfix">								
                                    <div class="share-button-wrapper text-right">	</div>
                                </section>
                            </div>
                        </div>
                        		
                    </div>	
                    <?php $postUrl = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>
                    
                    <?php endwhile; ?>
                </div>
            </article><!-- #post-98 -->
        </main><!-- #content .site-content -->
    </div><!-- #primary .content-area -->
</div>
</section>



<?php wp_reset_postdata(); ?>

<?php else : ?>
<p><?php __('No News'); ?></p>
<?php endif; ?>
