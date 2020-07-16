<?php
$featured_post = get_field('featured_post');
$permalink = get_permalink( $featured_post->ID );
$thumbnail = get_the_post_thumbnail( $featured_post->ID );
if( $featured_post ): ?>

<section class="feature-home">
	<div class="si-container">
		<div class="row align-items-center ">
		<div class="col-xs-12 col-md-7">
				<div class="module-text">
					<h3 class="h1"><?php echo esc_html( $featured_post->post_title ); ?></h3>
					<h5><?php echo esc_html( $featured_post->post_excerpt ); ?></h5>	
					<a class="si-btn btn-large mt-3" href="<?php echo esc_url( $permalink ); ?>">Más sobre Fiep</a>
				</div>				
			</div>
			<div class="col-xs-12 col-md-5">
				<div class="img-feature shadow">
					<?php echo get_the_post_thumbnail( $featured_post->ID, 'large' ); ?>
				</div>				
			</div>
			
		</div>
	</div>
</section>	
<?php endif; ?>


