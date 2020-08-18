<?php    
    // $precio = get_field('precio_de_curso'); 
    // $agregar = get_field('agregar'); 
    $precio = get_field('precio'); 
    $agregar = get_field('boton_agregar'); 
    
?>

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
                echo wp_kses_post ('<div class="mb-0">' . get_template_part( 'template-parts/entry/entry-header' ) . '</div>') ;   
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