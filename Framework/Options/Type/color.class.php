<?php 

/**
* A color option generator
*/
class generate_color extends alpha_tree_generate_type
{
	public function create($options)
	{ ?>

	<?php extract($options); ?>
	
		<!-- The input -->
		<input type="hidden" id="<?php echo "$this->id-$name"; ?>" class="<?php echo $this->class;?>-text" name="<?php echo $array ."[$name]"; ?>" value="<?php echo $saved; ?>">
		<!-- Colorpicker open handle  -->
		<div style="background-color:#<?php echo $saved; ?>;" id="<?php echo "$this->id-$name"; ?>-color" class="colorpicker-open"><span class="colorpicker-handle"></span></div>
		<!-- Initializes the colorpicker instance -->
		<script>
			color.color({
				id : '#<?php echo "$this->id-$name"; ?>',
				handle: '#<?php echo "$this->id-$name"; ?>-color',
				color: '<?php echo $saved; ?>' });
		</script>

<?php }
}

?>