<?php    
    $fecha = get_field('fecha');   
    $lugar = get_field('lugar');   
    $tema = get_field('tema');   
    $enlace = get_field('enlace');   
?>

<div class="row ">
    <div class="col-12 col-md-8">
    <?php if($fecha) :?>
    <h3 class="h2">Fecha: <?php echo $fecha; ?></h3>   
    <?php endif; ?>

    <?php if($lugar) :?>   
        <h4 class="h5">A través de <?php echo $lugar; ?></h4>
        <hr>
    <?php endif; ?>

    <?php if($tema) :?>
        <div class="alert alert-warning mt-3">
            <h4 class="h5">Tema: <br> <?php echo $tema; ?></h4>
         </div>   
        
    <?php endif; ?>

    <?php  
    get_template_part(  'template-parts/content/card-persona' ); 
    ?>  
    <?php if($enlace) :?>   
            <h4 class="h5">Accede a la conferencia desde el siguiente enlace:  
            <a href="<?php echo $enlace; ?>" class="btn btn-primary ">Ingresar a conferencia</a> </h4>

            
        <?php endif; ?>

   
    
    </div>
    <div class="col-12 col-md-4">
        
        <?php the_post_thumbnail( 'large' ); ?>
    </div>
</div>



    
