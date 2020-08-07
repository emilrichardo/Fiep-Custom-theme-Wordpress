<?php        
    $acordion_datos = get_field('acordion_datos');
    $counter = 1;
    
?>

<?php if( have_rows('acordion_datos') ): $accordion++; ?>

<div id="accordion<?php echo $accordion; ?>" class="mt-5 mb-5">
<?php while ( have_rows('acordion_datos') ) : the_row(); $collapse++; 
$titulo_acordion = get_sub_field('titulo_acordion');
$contenido_acordion = get_sub_field('contenido_acordion');

?>

	<div class="card">
		<div class="card-header bg-white" id="heading<?php echo $collapse; ?>">
			<h5 class="mb-0 mt-0">
			<button class="btn " data-toggle="collapse" data-target="#collapse<?php echo $collapse; ?>" aria-expanded="true" aria-controls="collapse<?php echo $collapse; ?>">
				<?php echo $titulo_acordion; ?>
			</button>
			</h5>
		</div>

		<div id="collapse<?php echo $collapse; ?>" class="collapse bg-light" aria-labelledby="heading<?php echo $collapse; ?>" data-parent="#accordion<?php echo $accordion; ?>">
			<div class="card-body">
				<?php echo $contenido_acordion; ?>
			</div>
		</div>
	</div>

<?php endwhile; ?>
</div>
<?php endif; ?>


