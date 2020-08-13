<?php    
    $fecha = get_field('fecha');   
    $lugar = get_field('lugar');   
    $tema = get_field('tema');   
    $enlace = get_field('enlace');  
    $disertantes = get_field('disertantes');  
?>

<section class="webinar mb-5">
    <div class="row mb-5 justify-content-between">
        <div class="col-12 col-md-7">
        <?php if($fecha) :?>
        <h3 class="h5 mb-1">Webinar: <?php echo $fecha; ?></h3>   
        <?php endif; ?>        

        <?php if($tema) :?>
            <div class="mb-5">
                <h4 class="h1 mt-2 "> <strong><?php echo $tema; ?></strong> </h4>                
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
                <h5>Speakers:</h5>
                <?php  
                get_template_part(  'template-parts/content/card-persona' ); 
                ?>                 
            </div>   
        <?php endif;  ?>
    </div>

        <?php if (has_post_thumbnail( $post->ID ) ) :?>
            <div class="col-12 col-md-4">
            <div class="card mb-5 shadow">
                <div class="card-body">
                    <?php    
                        $habilitar = get_field('habilitar'); 
                        if($habilitar){
                            $producto = get_field('producto_tienda'); 
                            if($producto != null && count($producto) != 0){
                                $product = wc_get_product( $producto[0]->ID );
                                echo '<div class="text-center">'. $product->get_image() . '</div><br>';
                                echo wp_kses_post ('<div class="mb-0">' . get_template_part( 'template-parts/entry/entry-header' ) . '</div>') ; 
                                echo '<h3 class="mt-3">AR$ '. $product->get_price() . '</h3>';
                                echo do_shortcode('[add_to_cart id="' . $producto[0]->ID . '" show_price="false" ]');
                            }
                        }else{
                            the_post_thumbnail( 'large' );
                        }
                    ?>
                    <style>
                        .woocommerce.add_to_cart_inline {
                                border: 0 !important;
                            }
                        .button.add_to_cart_button.button {   
                            width: 100% !important;   
                        }
                    </style>
                </div>
            </div>
        </div>
        <?php endif;  ?>   
    </div>
</section>




    
