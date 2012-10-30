<?php 

// Incude the slide options array
include('options-meta.php');

/**
 * A class which puts out a number of slide metaboxes matching that of the meta_count_slider option,
 * to do this it appends the current index number of the slide at the end of the options names, so that all the inputs 
 * are saved correctly
 */
class slide_opt
{	
	/**
	 * The post "meta" option array
	 * @var array
	 */
	var $m;
	/**
	 * The slide "options" array, this is the blueprint of options to whose names the current slide index is appended
	 * the file contaning them is included at the top ( check out for better closure ) 
	 * @var array
	 */
	var $o;

	/**
	 * Sets the $m"eta" and $o"ption" variables if $pop is set to true
	 * $pop should be set to "true" if you intend to use the $this->pop() function when generating the metaboxes, 
	 * it should be set to "false" if you are only using the $this->literate() function, since it is used for ajax calling 
	 * purposes and you wont get a "$post "objectl
	 * @param string  $meta The name of the meta option array
	 * @param boolean $pop  Will be using $this->pop() function ?
	 */
	function __construct( $meta, $pop = true ) 
	{	
		if ( $pop ) {
			global $post;

			$this->m = get_post_meta( $post->ID, $meta, true );
			$this->o = lf_slide_meta();
		}											
	}

	/**
	 * The slide version of the ussual pop() function, gets the number of slides from the an input which holds the number
	 * and generates a metabox for each
	 * @param  array $a The options "array" which is modified to have a number equaling the index appended at names and ids 
	 * @return array    Returns the modified array which is then run though the standard pop()
	 */
	public function pop()
	{
		$s = ( isset( $this->m['meta_count_slider'] ) ? $this->m['meta_count_slider'] : 1 );

		for ($si=1; $si < $s + 1; $si++) { 
			
			$o = $this->literate( $this->o, $si );

			pop( $o );
		}
	}

	/**
	 * Literates through an array of option definitions and appends a index number at the end of each name or id reference
	 * @param  array $a The option "array"
	 * @param  int   $i The number to append ( "index" )
	 * @return array    Modified array
	 */
	public function literate( $a, $i )
	{
		
		// new opt array
		$o = $a;
		// metabox id
		$o['id']    = $o['id'] . $i;
		// metabox title
		$o['title'] = $o['title'] . " $i";

		// Literate though each option paramaters and append an index number where necessary
		foreach ($o['options']['opt'] as $index => $v) 
		{	
			// Update the option name paramater to have an appended index 
			$o['options']['opt'][$index]['o'][4] = $v['o'][4] . "_$i";

			// If a hider paramater is set we update it 
			if ( isset( $v['o'][8] ) )
			{
				$o['options']['opt'][$index]['o'][8][0] = $v['o'][8][0] . "_$i"; 
			}
		}		
		// Return the modified options
		return $o;
	}


	/**
	 * Creates two buttons a counter input and shows last saved value, and calls the remove.js init function
	 * @param  string $u  The "url" from which to get the generated meta boxes via ajax
	 * @param  string $r  The "remove" button id
	 * @param  string $co The "counter" input id and name
	 * @return html     
	 */
	public function buttons( $u, $r, $co ) 
	{ ?>

		<?php global $post; echo $post->ID; ?>
	
		<?php $cc = ( isset( $this->m[$co] ) ? $this->m[$co] : 1 ); ?>

		<tr>
			<td>
				<input onclick="javascript:remove.c('<?php echo get_template_directory_uri() .$u; ?>')" type="button" value="Add Slide" class="lf-admin-post-meta-td-button">
		
				<input onclick="javascript:remove.remove('.postbox');" type="button" value="Remove" id="<?php echo $r; ?>" class="lf-admin-post-meta-td-button">
			</td>
		</tr>

		<input type="hidden" name="main_meta[<?php echo $co; ?>]" id="<?php echo $co; ?>" value="<?php echo $cc; ?>">

		<p  id="<?php echo $co; ?>-counter"><?php echo $cc; ?></p>

		<script>remove.index('#<?php echo $co; ?>', '#<?php echo $r; ?>');</script>

	<?php }

}
?>