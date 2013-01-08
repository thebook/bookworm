<?php 

/**
* A admin class
*/
class branch_users_style extends alpha_tree_users
{

	public function profile_page ()
	{ ?>

		<?php $config = $this->params['manifestation']; ?>

		<div>
			<form id="<?php echo $this->params['id'];?>" 
				  action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php" 
				  method="post" class="<?php echo $this->params['id']; ?>-form">
				
				<!-- Top Stripe -->
				<div class="<?php echo $this->params['id']; ?>-header">
					<!-- Name . Version -->
					<div class="<?php echo $this->params['id']; ?>-header-wrap">	
						<!-- Title -->
						<h1><?php echo $config['title']; ?></h1>
						<!-- Version  -->
						<span class="<?php echo $this->params['id']; ?>-label"><?php echo $config['sub_title']; ?></span>
					</div>
					<!-- Logo -->
					<a href="http://www.recyclabook.co.uk" title="">
						<!-- Image -->
						<img  class="<?php echo $this->params['id']; ?>-image" src="<?php echo FRAMEWORKURI .'/CSS/Includes/Images/login-logo.png';?>"/>
					</a>
				</div>
				
				<!-- Save Stripe -->
				<div class="<?php echo $this->params['id']; ?>-save">

					<!-- the "wp-admin/admin-ajax.php" looks for the value of an "action" named input,
						that value then is used to append to create a action hook named "wp_ajax_{append your action value here}"
						we then hook into it by adding our ajax handler function to hook -->
					<input type="hidden" name="action" value="<?php echo $config['form_action']; ?>">

					<input type="hidden" name="<?php echo $this->params['id']; ?>_nonce" value="<?php echo wp_create_nonce($this->params['class']);?>">

					<input id="<?php echo $this->params['id']; ?>_save" type="submit" class="<?php echo $this->params['id']; ?>-button" value="<?php _e('Save', 'liquidflux'); ?>"/>
					
					<input id="<?php echo $this->params['id']; ?>_reset" type="button" class="<?php echo $this->params['id']; ?>-button" value="<?php _e('Reset', 'liquidflux'); ?>"/>
					
				</div>

				<!-- Body -->
				<div class="<?php echo $this->params['id']; ?>-body">

					<?php $this->profile_managment($config['create_table']['name']); ?>

				</div>

				<script>
					// Initiates ajax saving
					ajax.save({
						form : "<?php echo $this->params['id']; ?>",
						save : "<?php echo $this->params['id']; ?>_save",
						});
					// Initiates ajax resets
					ajax.reset({
						reset  : "<?php echo $this->params['id']; ?>_reset",
						action : "<?php echo $config['form_action'];?>_reset",
						nonce  : "<?php echo wp_create_nonce($this->params['class']);?>",
						nonce_name: "<?php echo $this->params['id'];?>_nonce"
					});
				</script>
			</form>
		</div>

<?php }
	
	# get all the rows and then find their coresponding array and spit		
	public function profile_managment ($table_name)
	{ ?> 

		<?php $creator = new table_creator; ?>

		<?php $fields_to_display = $creator->get_all_rows_from_table($table_name .'_fields_data'); ?>

		<?php var_export($fields_to_display); ?>

		<?php foreach ( $fields_to_display as $field ) : ?>

			<div>
				<div></div>
				<div></div>
				<div></div>
			</div>


		<?php endforeach; ?>

<?php }
}

?>