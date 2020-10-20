<?php    
    $fecha = get_field('fecha');   
    $lugar = get_field('lugar');   
    $titulo = get_field('titulo');   
    $tema = get_field('tema');   
    $enlace = get_field('enlace_gratuito');  
    $disertantes = get_field('disertantes');  
    $acordion_datos = get_field('acordion_datos');
?>

<section class="webinar mb-5">
    <div class="row mb-5 justify-content-between">
        <div class="col-12 col-md-7">
        
        <?php if($fecha) :?>
            <h5 class="text-left"> <strong> <i class="fa fa-clock-o text-warning" aria-hidden="true"></i> Webinar: <?php echo $fecha; ?> &nbsp;  <?php echo $lugar;?></strong></h5>
        <?php endif; ?>        
        
        <?php if($titulo) :?>
            <div class="mb-5">
                <h4 class="h1 mt-2 "> <strong><?php echo $titulo; ?></strong> </h4>                
            </div>   
        <?php endif; ?>
       
        <?php if($enlace) :?> 
            <div class="enlace mt-5 alert alert-warning py-5">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                    <h4 class="h6 mt-0">
                         <strong>Enlace de <?php echo $lugar; ?></strong>   <br>  
                         Accede a la conferencia desde el siguiente enlace: 
                        </h4>
              
                    </div>
                    <div class="col-12 col-md-6">
                    <a href="<?php echo $enlace; ?>" target="_blank" class="btn btn-lg btn-primary ">Ingresar a conferencia <i class="fa fa-long-arrow-right ml-3" aria-hidden="true"></i></a> 
                    </div>
                </div>
                  
            </div>
          
        <?php endif; ?>

        <?php if($disertantes) :?>
            <div class="mt-2 mb-5">
                <h5>Disertantes/Speakers:</h5>
                <?php  
                get_template_part(  'template-parts/content/card-persona' ); 
                ?>                 
            </div>  
            <h3 class="h5 mt-0"><?php echo wp_kses_post( $tema ); ?></h3> 
        <?php endif;  ?>
        <hr>
        <?php 
         if ( $acordion_datos ){
            get_template_part(  'template-parts/content/component-accordion' );
         }
        ?>
    </div>
        <?php if (has_post_thumbnail( $post->ID ) ) :?>
            <div class="col-12 col-md-4">
                <?php
                    $habilitar = get_field('habilitar'); 
                    if ($habilitar) {
                        get_template_part( 'template-parts/content/card-cursos' );
                    }else{
                        ?>
                            <div class="card mb-5 shadow">
                                <div class="card-body">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                </div>
                            </div>
                        <?php
                    }
                ?>
            </div>
        <?php endif;  ?>   
    </div>
</section>




    
