<?php
/**
 * Template part for displaying post in post listing.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Sinatra
 * @author      Sinatra Team <hello@sinatrawp.com>
 * @since       1.0.0
 */

?>

<?php do_action( 'sinatra_before_article' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sinatra-article' ); ?><?php sinatra_schema_markup( 'article' ); ?>>
		
		<?php 
			// the query
			$grid_content = new WP_Query( array(
				'post-type' => 'post',
				'posts_per_page' => 3,
				'meta_key' => '_thumbnail_id',					
				'category__not_in' => 'uncategorized',
				'ignore_sticky_posts' => 1		
    			
			)); 
			?>			

			<h2 class="h1   ">Publicaciones</h2>

			<?php if ( $grid_content->have_posts() ) : ?>
				<div class="si-flex-row">				
				<?php while ( $grid_content->have_posts() ) : $grid_content->the_post();
				
				?>
			
				<div class="col-xs-12 col-md-4 mb-5">	
					<div class="si-entry-content-wrapper card-news">					
						<?php 
						if ( sinatra_option( 'blog_horizontal_post_categories' ) ) {
							get_template_part( 'template-parts/entry/entry-category' );					}
						get_template_part( 'template-parts/entry/entry-thumbnail' );
						echo get_the_date();
						get_template_part( 'template-parts/entry/entry-header' );	
						?>	

<?php 
/* Social Share Buttons template for Wordpress
 * By Daan van den Bergh 
 */ 

$postUrl = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>

			<section class="sharing-box content-margin content-background clearfix">
				<h5 class="sharing-box-name">Don't be selfish. Share the knowledge!</h5>
				<div class="share-button-wrapper">
					<a target="_blank" class="share-button share-twitter" href="https://twitter.com/intent/tweet?url=<?php echo $postUrl; ?>&text=<?php echo the_title(); ?>&via=<?php the_author_meta( 'twitter' ); ?>" title="Tweet this">Tweet this</a>
					<a target="_blank" class="share-button share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" title="Share on Facebook">Share on Facebook</a>        
				</div>
			</section>

					</div>		
				</div>		
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>

			<?php else : ?>
			<p><?php __('No News'); ?></p>
			</div>
			<?php endif; ?>

	

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action( 'sinatra_after_article' ); ?>

