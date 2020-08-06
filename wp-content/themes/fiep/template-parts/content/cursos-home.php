<?php 
    // the query
    $cursos_list = new WP_Query( array(
        'post_type'           => 'cursos',
        'post_status'         => 'publish',
        'posts_per_page'      => 6,	
        'post__in'            => get_option( 'sticky_posts' ),
       'ignore_sticky_posts' => 1,	
    )); 
    ?>	

<?php if ( $cursos_list->have_posts() ) : ?>
    <section class="cursos">
    
    <div class="si-container text-center">
		<h2>Próximamente Cursos en Línea</h2>
		<div class="container">
			<div class="si-flex-row justify-content-center">

    <?php while ( $cursos_list->have_posts() ) : $cursos_list->the_post();
        $fecha = get_field('fecha');
        $lugar = get_field('lugar');
        $tema = get_field('tema');        
        ?>
               
         
                <div class="col-xs-12 col-md-4">                
    
                  <a href="<?php the_permalink(); ?>"> 
                        <div class="card-cursos">
                        <?php 
                            get_template_part( 'template-parts/entry/entry-category' );
                            get_template_part( 'template-parts/entry/entry-thumbnail' );
                            get_template_part( 'template-parts/entry/entry-header' );
                         ?>                            
                            <h5><?php echo $fecha; ?></h5>                     
                                            
                        </div>
                    </a>					
				</div>
            
        
                
 

    <?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<?php else : ?>
<p><?php __('No News'); ?></p>


             </div>
		</div>
    </div>

    
<?php endif; ?>
</section>

