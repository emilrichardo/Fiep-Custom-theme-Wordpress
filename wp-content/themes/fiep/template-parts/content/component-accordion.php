
<style>

/* Style the buttons that are used to open and close the accordion panel */
.accordion {
  background-color: #fff;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  text-align: left;
  border: none;
  outline: none;
  transition: 0.4s;
  margin-bottom: 5px;
  border: 1px solid rgba(0,0,0,.125);
  border-radius: 5px;
  /* border: none; */
}

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.active, .accordion:hover,
button:focus {
  background-color: #ccc;
  background: #cccccc7d;
  border: none;
}

/* Style the accordion panel. Note: hidden by default */
.panel {
  padding: 0 18px;
  background-color: white;
  display: none;
  overflow: hidden;
  background-color: #F8F9FA;

}

.accordion:after {
  content: '\02795'; /* Unicode character for "plus" sign (+) */
  font-size: 13px;
  color: #777;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2796"; /* Unicode character for "minus" sign (-) */
}
	
</style>

<?php        
    $acordion_datos = get_field('acordion_datos');
    $counter = 1;
    
?>


<?php

// check if the repeater field has rows of data
if( have_rows('acordion_datos') ):
	
 	
 	// loop through the rows of data for the tab header
    while ( have_rows('acordion_datos') ) : the_row();
		
		$header = get_sub_field('titulo');
		$content = get_sub_field('cuerpo');

	?>
	
		<button class="accordion"><?php echo $header; ?></button>
		<div class="panel">
		  <p><?php echo $content; ?></p>
		</div>    
		
	<?php endwhile; ?>
<?php endif; ?>



