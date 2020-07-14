


<?php $comite = new WP_Query( 
    array( 
        'post_type' => 'personas', 
        'posts_per_page' => 4, 
        'grupos' => 'comite',
        'order'   => 'ASC'
    ) 
); 
?>


<section id="estructura" class="bg-dark text-light py-5">
    <div class="container">
    <?php if ( $comite->have_posts() ) : ?>
        <div class="heading py-1 text-center">
            <h5>Estructura Actual de F.I.E.P. Argentina</h5>
            <h2 class="h1 text-white">Comité Ejecutivo Nacional</h2>
        </div>      
       
        
        <div class="row justify-content-between">
            <?php while ( $comite->have_posts() ) : $comite->the_post(); ?>
            <?php 
                $cargo = get_field('cargo');
                $foto = get_field('foto_de_perfil');
            ?>
            <div class="col-6 col-md-3">
                <div class="card-people">
                    <div class="img-profile shadow">
                         <img class="rounded" src="<?php echo $foto['url']; ?>" alt="<?php echo $foto['alt']; ?>" />                       
                    </div>
                    <div class="text-card">
                        <h6><?php echo $cargo; ?></h6>   
                        <h4><?php echo get_the_title(); ?></h4>                       
                    </div>
                </div>
            </div><!-- card-profile-colun -->     
            <?php endwhile; ?>
			<?php wp_reset_postdata(); ?>

			<?php else : ?>
			<p><?php __('No News'); ?></p>
        </div>
        <hr>

       
        <?php endif; ?>

    </div>
</section>   



<?php $representantes = new WP_Query( 
    array( 
        'post_type' => 'personas', 
        'posts_per_page' => -1, 
        'grupos' => 'representantes',
        'order'   => 'ASC'
    ) 
); 
?>


<section id="representantes" class="bg-light  py-5">
    <div class="container">
    <?php if ( $representantes->have_posts() ) : ?>
        <div class="heading py-1 text-center">
            
            <h2 class="h3">Representantes Provinciales</h2>
        </div>      
       
        
        <div class="row  mt-1">
            <?php while ( $representantes->have_posts() ) : $representantes->the_post(); ?>
            <?php 
                $lugar = get_field('lugar');
                $foto = get_field('foto_de_perfil');
                $email = get_field('email');
            ?>
            <div class="col-12 col-md-4">
                <div class="card-people">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                        <div class="img-profile shadow">
                            <img class="rounded" src="<?php echo $foto['url']; ?>" alt="<?php echo $foto['alt']; ?>" />                       
                        </div>
                        </div>
                        <div class="col-md-8">
                            <div class="text-card">
                                <small><?php echo $lugar; ?></small>   
                                <h5 class="mt-0 mb-0"><?php echo get_the_title(); ?></h5>                       
                                <small class="mt-0"><?php echo $email; ?></small>                       
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div><!-- card-profile-colun -->     
            <?php endwhile; ?>
			<?php wp_reset_postdata(); ?>

			<?php else : ?>
			<p><?php __('No News'); ?></p>
        </div>
        <hr>

       
        <?php endif; ?>

    </div>
</section>   
