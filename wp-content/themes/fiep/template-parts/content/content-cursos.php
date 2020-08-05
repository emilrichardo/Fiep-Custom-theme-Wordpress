<?php 
    $subtitulo = get_field('subtitulo');
    $descripcion = get_field('descripcion');
    $institucion_organizadora = get_field('institucion_organizadora');
    $fecha = get_field('fecha');
    $tematicas = get_field('tematicas');
    $programa = get_field('programa');
    $inscripciones = get_field('incripciones');
    $certificaciones = get_field('certificaciones');
    


if(get_field('disertantes')){

    while(has_sub_field('disertantes')) { ?>
        <div class="div"><?php echo get_sub_field('nombre'); ?></div>
        <div class="div"><?php echo get_sub_field('profesion'); ?></div>
        <div class="div"><?php echo get_sub_field('pais'); ?></div>
        <div class="div"><?php echo get_sub_field('resumen'); ?></div>
        <div class="div"><?php echo get_sub_field('email'); ?></div>
        <img src="<?php echo get_sub_field('foto'); ?>" alt="">    
        <?php      
        }
}


    
if(get_field('auspiciantes')){

while(has_sub_field('auspiciantes')) { ?>
    <div class="div"><?php echo get_sub_field('nombre_auspiciante'); ?></div>
    <img src="<?php echo get_sub_field('logo_de_auspiciante'); ?>" alt="">    
    <?php      
    }
}
?>

<div class="div"><?php echo $subtitulo; ?> </div>
<div class="div"><?php echo $descripcion; ?> </div>
<div class="div"><?php echo $institucion_organizadora; ?> </div>
<div class="div"><?php echo $fecha; ?> </div>
<div class="div"><?php echo $tematicas; ?> </div>
<div class="div"><?php echo $programa; ?> </div>
<div class="div"><?php echo $inscripciones; ?> </div>
<div class="div"><?php echo $certificaciones; ?> </div>