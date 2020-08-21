<?php 
	do_action( 'sinatra_before_article' ); 
	$postType = get_post_type_object(get_post_type());
	global $wp;
?>


            
            
<?php if($wp->request=="cursos"):
	?>
	<?php get_template_part(  'template-parts/content/content-all-cursos' );?>  
<?php else : ?>
	<?php get_template_part(  'template-parts/content/content-entry' );?> 
<?php endif; ?>
<?php do_action( 'sinatra_after_article' ); ?>