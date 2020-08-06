<?php    
    $precio = get_field('precio_de_curso'); 
    $agregar = get_field('agregar'); 
    $cupos = get_field_object('cupos'); 
    $cupos_value = get_field('cupos'); 
    $certificaciones = get_field('certificaciones');
    $institucion_organizadora = get_field('institucion_organizadora'); 
?>

<div class="card mb-5 shadow">
    
    <div class="card-body">
        
        <?php    
         echo wp_kses_post ('<div class="mb-0">' . get_template_part( 'template-parts/entry/entry-header' ) . '</div>') ;   
          echo wp_kses_post('<h3 class="h2 mt-3">' . $precio . '</h3>');       
                
        ?>
        <?php echo do_shortcode( $agregar );?>
        

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
        
    </div>
</div>