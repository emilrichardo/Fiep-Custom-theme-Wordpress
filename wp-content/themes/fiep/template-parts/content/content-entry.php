<article id="post-<?php the_ID(); ?>" <?php post_class( 'sinatra-article' ); ?><?php sinatra_schema_markup( 'article' ); ?>>
	<?php if ( have_posts() ) : ?>
		<div class="si-flex-row">				
			<?php while ( have_posts() ) : the_post();
				$titulo = get_field('titulo');
				$tema = get_field('tema');
				
			?>
			
			<div class="col-xs-12 col-md-4 mb-1">	
				<div class="si-entry-content-wrapper card-news">					
					<?php 
						if ( sinatra_option( 'blog_horizontal_post_categories' ) ) {
						get_template_part( 'template-parts/entry/entry-category' );					}
						get_template_part( 'template-parts/entry/entry-thumbnail' );
						echo get_the_date();
						if(empty($titulo)){
							get_template_part( 'template-parts/entry/entry-header' );
						}else{
							echo '<header class="entry-header">'.
								'<h3 class="entry-title h5" itemprop="headline">'.
									'<a href="' . sinatra_entry_get_permalink().'" title="¡'. $titulo.'!" rel="bookmark">¡'. $titulo .'!</a>'.
								'</h3>'.
							'</header>';
						}
						//echo $tema;	

					?>	

<?php 
/* Social Share Buttons template for Wordpress
 * By Daan van den Bergh 
 */ 

					$postUrl = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>

			
					</div>		
				</div>		
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>

			<?php else : ?>
			<p><?php __('No News'); ?></p>
			</div>
			<?php endif; ?>

	

</article><!-- #post-<?php the_ID(); ?> -->

