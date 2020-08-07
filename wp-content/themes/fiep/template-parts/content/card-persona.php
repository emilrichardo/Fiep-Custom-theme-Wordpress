<?php        
    $disertantes = get_field('disertantes');
    $titulo_disertantes = get_field('titulo_disertantes');
?>

<?php // check if the repeater field has rows of data
if( $disertantes ):
    echo wp_kses_post ('<h3 class="h5 mt-3 mb-2">' . $titulo_disertantes . '</h3>'); 
?>

    <div class="row">        
        <?php // loop through the rows of data
        while ( have_rows('disertantes') ) : the_row();
        $foto = get_sub_field('foto');
        $nombre= get_sub_field('nombre');
        $profesion= get_sub_field('profesion');
        ?>   
        <div class="col-12  col-md-6">
            <div class="card card-speacker">
                <div class="card-body d-flex align-items-center">
                    <img class="rounded-circle mr-3" src="<?php  echo esc_html( $foto ) ;?>" alt="">
                    <div class="text-profile">
                        <?php  echo wp_kses_post('<h5 class="mt-0">' . $nombre  . '</h5>') ;?>
                        <?php  echo wp_kses_post('<p class="small text-muted mt-0 mb-0">' . $profesion  . '</p>') ;?>
                    </div>                
                
                </div>
            </div>
        </div> 
        
        <?php  
        endwhile;
?>

</div>

    <?php 
    endif;
?>