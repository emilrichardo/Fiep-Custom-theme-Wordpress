<?php        
    $auspiciantes = get_field('auspiciantes');    
?>

<?php // check if the repeater field has rows of data
if( $auspiciantes ):?>
<div class="card border">
    <div class="card-body">
    <h3>Auspiciantes</h3>
    <div class="row">
        <?php // loop through the rows of data
        while ( have_rows('auspiciantes') ) : the_row();
        $foto = get_sub_field('logo_de_auspiciante');
        $nombre= get_sub_field('nombre_auspiciante');
       
        ?>   
        <div class="col-auto">
            <div class="ausp ">
                <div class="logo-aus">
                    <img style="max-width:120px;" class=" mr-3" src="<?php  echo esc_html( $foto ) ;?>" alt="">
                    <div class="text-profile">
                        <?php  echo wp_kses_post('<h5 class="mt-0">' . $nombre  . '</h5>') ;?>
                       
                    </div>                
                
                </div>
            </div>
        </div> 
    

    
        
        <?php  
        endwhile;
        ?>

        </div>
        </div>
        </div>

            <?php 
            endif;
        ?>
   

    