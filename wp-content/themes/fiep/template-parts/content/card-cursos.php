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
                    
                    //echo var_dump($currencies);
                    global $WOOCS;
                    global $woocommerce;
                    $currencies = $WOOCS->get_currencies();
                    //echo  $product->get_price();
                    //$value = apply_filters('woocs_exchange_value', $product->get_price());
                    //echo $woocommerce->customer->country;
                    // $currencies = $WOOCS->get_currencies();
                    // $value = $product->get_price() * $currencies[$WOOCS->current_currency]['rate'];
                    // $value = number_format($value, 2, $WOOCS->decimal_sep, '');
                    // echo $value;
                    
                    //echo '<h3 class="mt-3"> ' . $currencies[$WOOCS->current_currency]['name'] . $currencies[$WOOCS->current_currency]['symbol'] . ' ' . $product->get_price() . '</h3>';
                    echo '<h3 class="mt-3"> ' . $currencies[$WOOCS->current_currency]['name'] . $currencies[$WOOCS->current_currency]['symbol'] . ' ' . $product->get_price() . '</h3>';
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