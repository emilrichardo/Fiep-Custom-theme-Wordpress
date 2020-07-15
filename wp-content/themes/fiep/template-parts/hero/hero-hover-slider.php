<?php
/**
 * The template for displaying Hero Hover Slider.
 *
 * @package     Sinatra
 * @author      Sinatra Team <hello@sinatrawp.com>
 * @since       1.0.0
 */

$sinatra_hero_categories = ! empty( $sinatra_hero_categories ) ? implode( ', ', $sinatra_hero_categories ) : '';



// Setup Hero posts.
$sinatra_args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 1,	
	//'post__in'            => get_option( 'sticky_posts' ),
    'ignore_sticky_posts' => 1,
	
	'tax_query'           => array( // phpcs:ignore
		array(			
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-quote' ),
			'operator' => 'NOT IN',
		),
	),

	
);

$sinatra_hero_categories = sinatra_option( 'hero_hover_slider_category' );

if ( ! empty( $sinatra_hero_categories ) ) {
	$sinatra_args['category_name'] = implode( ', ', $sinatra_hero_categories );
}

$sinatra_args = apply_filters( 'sinatra_hero_hover_slider_query_args', $sinatra_args );

$sinatra_posts = new WP_Query( $sinatra_args );

// No posts found.
if ( ! $sinatra_posts->have_posts() ) {
	return;
}

$sinatra_hero_bgs_html   = '';
$sinatra_hero_items_html = '';

$sinatra_hero_elements = (array) sinatra_option( 'hero_hover_slider_elements' );
$sinatra_hero_readmore = isset( $sinatra_hero_elements['read_more'] ) && $sinatra_hero_elements['read_more'] ? ' si-hero-readmore' : '';

while ( $sinatra_posts->have_posts() ) :
	$sinatra_posts->the_post();

	// Background images HTML markup.
	$sinatra_hero_bgs_html .= '<div class="hover-slide-bg cover-header" data-background="' . get_the_post_thumbnail_url( get_the_ID(), 'full' ) . '"></div>';
	

	// Post items HTML markup.
	ob_start();
	?>
	<div class="col-xs-<?php echo esc_attr( 12 / $sinatra_args['posts_per_page'] ); ?> hover-slider-item-wrapper<?php echo esc_attr( $sinatra_hero_readmore ); ?>">

		<div class="hover-slide-item">
			<div class="slide-inner">				

				<?php
				//campos congreso
				$fecha = get_field('fecha');
				$lugar = get_field('lugar');
				$tema = get_field('tema');

				if($fecha) { echo '<p class="tag">' . $fecha . '<small> - </small>' . $lugar .'</p>'; } ?>

				<?php if ( get_the_title() ) { ?>
					<h3 class="h1"><a href="<?php echo esc_url( sinatra_entry_get_permalink() ); ?>"><?php the_title(); ?></a></h3>					
				<?php } ?>
			
				<?php if($fecha) { echo '<h4 class="h3	text-white">' . $tema . '</h4>';}?>

				<?php if ( isset( $sinatra_hero_elements['meta'] ) && $sinatra_hero_elements['meta'] ) { ?>
					<div class="entry-meta">
						<div class="entry-meta-elements">
							<?php
							sinatra_entry_meta_author();

							sinatra_entry_meta_date(
								array(
									'show_modified'   => false,
									'published_label' => '',
								)
							);
							?>
						</div>
					</div><!-- END .entry-meta -->
				<?php } ?>

				<?php if ( $sinatra_hero_readmore ) { ?>
					<a href="<?php the_permalink(); ?>" class="read-more si-btn btn-small btn-outline btn-uppercase" role="button"><span>Más información</span></a>
				<?php } ?>

			</div><!-- END .slide-inner -->
		</div><!-- END .hover-slide-item -->
	</div><!-- END .hover-slider-item-wrapper -->
	<?php
	$sinatra_hero_items_html .= ob_get_clean();
endwhile;

// Restore original Post Data.
wp_reset_postdata();

// Hero container.
$sinatra_hero_container = sinatra_option( 'hero_hover_slider_container' );
$sinatra_hero_container = 'full-width' === $sinatra_hero_container ? 'si-container si-container__wide' : 'si-container';

// Hero overlay.
$sinatra_hero_overlay = absint( sinatra_option( 'hero_hover_slider_overlay' ) );
?>

<div class="si-hover-slider slider-overlay-<?php echo esc_attr( $sinatra_hero_overlay ); ?>">
	<div class="hover-slider-backgrounds">

		<?php echo wp_kses_post( $sinatra_hero_bgs_html ); ?>

	</div><!-- END .hover-slider-items -->

	<div class="si-hero-container <?php echo esc_attr( $sinatra_hero_container ); ?>">
		<div class="si-flex-row hover-slider-items">

			<?php echo wp_kses_post( $sinatra_hero_items_html ); ?>

		</div><!-- END .hover-slider-items -->
	</div>

	<div class="si-spinner visible">
		<div></div>
		<div></div>
	</div>
</div><!-- END .si-hover-slider -->
