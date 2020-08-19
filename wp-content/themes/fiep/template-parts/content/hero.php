

<?php 
    // the query
    $hero = new WP_Query( array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => 1,	
        'post__in'            => get_option( 'sticky_posts' ),
        'ignore_sticky_posts' => 1,	
    )); 
    ?>	

<?php if ( $hero->have_posts() ) : ?>
   

    <?php while ( $hero->have_posts() ) : $hero->the_post();
        $fecha = get_field('fecha');
        $lugar = get_field('lugar');
        $tema = get_field('tema');
        $image = get_the_post_thumbnail_url( $hero->ID, 'large' );
        $genially_html = get_field('genially_html');
        ?>
    <section class="hero-home">
        

        <div class="overlay-bg"  style="background-image: url('<?php echo $image ; ?>')"></div>
        <div class="inner-hero">
            <div class="row align-items-center">
                
                <div class="col-12 col-md-6">
                    <div class="caption__hero pl-3 pl-md-5 text-white py-5 ">

                    <?php 
                    if ( $fecha ) {
                        echo '<h5 class="mt-0 h4 bg-primary text-white   px-2 py-1 d-inline-block">' . $fecha . '<small> - </small>' . $lugar .'</h5>';
                    }
                    else {
                        sinatra_entry_meta_category( ' ', false );
                    }
                    ;?>

                       

                        <h2 class="h1 mt-3 mb-3 text-white"><?php the_title(); ?></h2>	
                        <h4 class="h3 mt-3 text-white"><?php echo $tema;?>	</h4>
                        <a class="btn btn-light btn-lg mt-3" href="<?php echo esc_url( sinatra_entry_get_permalink() ); ?>">Ingresar <i class="fa fa-arrow-right text-primary ml-5" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="img-hero">
                        <?php 
                            if($genially_html){
                                echo $genially_html;
                            }else{
                                echo '<img class="w-100 shadow" src="' .$image . '" alt="' .the_title(). '">';
                            }
                        ?>
                        
                    </div>
                </div>
                
            </div>
        </div>            
    </section>

    <?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<?php else : ?>
<p><?php __('No News'); ?></p>



<?php endif; ?>

            