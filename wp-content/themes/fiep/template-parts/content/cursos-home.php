

<?php
$cursos_home = get_field('cursos_home');
$image = get_field('imagen_cursos');
if( $cursos_home): ?>
<section class="cursos">

	<div class="si-container text-center">
		<h2>Próximamente Cursos en Línea</h2>
		<div class="container">
			<div class="si-flex-row justify-content-center">
            <?php foreach( $cursos_home as $post ):
            // Setup this post for WP functions (variable must be named $post).
            setup_postdata($post);  ?>
         
                <div class="col-xs-12 col-md-4">
                  <a href="<?php the_permalink(); ?>"> 
                        <div class="card-cursos">
                        <div class="img-feature">
                        <img src="<?php echo  the_field('imagen_de_curso'); ?>" alt="">
                        </div>
                            <h5 class="h5"><?php the_title(); ?></h5>                       
                        </div>
                    </a>					
				</div>
             <?php endforeach; ?>
             </div>
		</div>
    </div>
    <img class="image-cursos" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
</section>
    <?php 
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>



<?php endif; ?>




