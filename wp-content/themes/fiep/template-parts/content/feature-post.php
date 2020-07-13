<?php
$featured_post = get_field('featured_post');
$permalink = get_permalink( $featured_post->ID );
$thumbnail = get_the_post_thumbnail( $featured_post->ID );
if( $featured_post ): ?>

<section class="feature-home">
	<div class="si-container">
		<div class="si-flex-row ">
		<div class="col-xs-12 col-md-6">
				<div class="module-text">
					<h3 class="h1"><?php echo esc_html( $featured_post->post_title ); ?></h3>
					<h5><?php echo esc_html( $featured_post->post_excerpt ); ?></h5>	
					<a class="si-btn btn-large mt-3" href="<?php echo esc_url( $permalink ); ?>">Más sobre Fiep</a>
				</div>				
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="img-feature">
					<?php echo get_the_post_thumbnail( $featured_post->ID, 'large' ); ?>
				</div>				
			</div>
			
		</div>
	</div>
</section>	
<?php endif; ?>


<section id="estructura" class="bg-dark text-light py-5">
    <div class="container">
        <div class="heading py-1 text-center">
            <h5>Estructura Actual de F.I.E.P. Argentina</h5>
            <h2 class="h1">Comité Ejecutivo Nacional</h2>
        </div>
       
        
        <div class="row justify-content-between">
            <div class="col-6 col-md-3">
                <div class="card-people">
                    <div class="img-profile">
                        <img class="rounded" src="http://fiep.local/wp-content/uploads/2020/07/DelegadoNacional.jpg" alt="">
                    </div>
                    <div class="text-card">
                        <h6>Delegado Nacional</h6>   
                        <h4>Mg. Néstor Colazo</h4>                       
                    </div>
                </div>
            </div><!-- card-profile-colun -->
            <div class="col-6 col-md-3">
                <div class="card-people">
                    <div class="img-profile">
                        <img class="rounded" src="http://fiep.local/wp-content/uploads/2020/07/AdjuntoNacional.jpg" alt="">
                    </div>
                    <div class="text-card">
                        <h6>Delegado Adjunto Nacional</h6>   
                        <h4>Prof. Alejandro Orbelli</h4>                       
                    </div>
                </div>
            </div><!-- card-profile-colun -->
            <div class="col-6 col-md-3">
                <div class="card-people">
                    <div class="img-profile">
                        <img class="rounded" src="http://fiep.local/wp-content/uploads/2020/07/SecretariaNacional.jpg" alt="">
                    </div>
                    <div class="text-card">
                        <h6>Secretaria Nacional</h6>   
                        <h4>Lic. Liliana Pettinari</h4>                       
                    </div>
                </div>
            </div><!-- card-profile-colun -->
            <div class="col-6 col-md-3">
                <div class="card-people">
                    <div class="img-profile">
                        <img class="rounded" src="http://fiep.local/wp-content/uploads/2020/07/TesoreroNacional.jpg" alt="">
                    </div>
                    <div class="text-card">
                        <h6>Tesorero Nacional</h6>   
                        <h4>Prof. Julio Morales</h4>                       
                    </div>
                </div>
            </div><!-- card-profile-colun -->
            
        </div>
        <hr>

        <div class="mt-5 text-center">
             <a href="#" class="btn btn-outline-light btn-lg ml-md-5">Estructura completa</a>
            <a href="#" class="btn btn-outline-light btn-lg">Representantes Provinciales</a>
        </div>

        

    </div>
</section>    