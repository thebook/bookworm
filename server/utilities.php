<?php 

function extract_and_return_a_member_of_nested_array ($array, $who_to_extract ) {

	$return_array = array();

	foreach ($array as $member) {			
		$return_array[] = $member[$who_to_extract];
	}

	return $return_array;
}

function remove_array_members ($array_whose_members_to_remove, $array_of_key_names_to_remove)
{
	foreach ($array_of_key_names_to_remove as $key_name) {

		unset($array_whose_members_to_remove[$key_name]);

	}
	// var_export($array_whose_members_to_remove);
	return $array_whose_members_to_remove;
}

function reverse_string_at_points ( $point_to_reverse_at, $string_to_reverse ) { 

	$broken_string     = array_reverse(explode($point_to_reverse_at, $string_to_reverse ));
	$string_to_reverse = '';

	foreach ( $broken_string as $part ) : 

		$string_to_reverse .= $part . $point_to_reverse_at;

	endforeach;

	return $string_to_reverse = trim( $string_to_reverse, '-');
}

function lf_comment_edit_link ( $text ) 
{ ?>
	<?php global $comment; ?>

	<?php if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) : ?>

		<a class="lf-comment-edit" href="<?php echo get_edit_comment_link( $comment->comment_ID); ?>" title="Edit your comment"><?php echo $text; ?></a>

	<?php endif; ?>
<?php }


function timestamp () { 

	return time('YmdHis');
}

function include_fol($fol) {

	$folder = new DirectoryIterator($fol);

	foreach ($folder as $info) 
	{	
		if (!$info->isDot())
		{
			include $fol.$info->getFilename();
		}
	}

}

function filter_multi_array_value_into_single ($array, $value_to_look_for_in_multi_arrays ) { 

	$return = array();

	foreach ( $array as $key => $array_holding_the_wanted_value ) : 

		$return[] = $array_holding_the_wanted_value[$value_to_look_for_in_multi_arrays];

	endforeach;

	return $return;
}


function multi_dimensional_key_search ( $array_to_search, $value_to_search_for )  
{ 

	$track = array();

	foreach ($array_to_search as $key => $value) {
	
		if ( is_array($value) ) { 

			$track[$key] = multi_dimensional_key_search($value, $value_to_search_for);

			foreach ( $track[$key] as $return_key => $return_value ) { 

				$track[$return_key] = $return_value;
			}
			unset($track[$key]);
		}
		else { 

			( $value == $value_to_search_for ) and $track[$key] = $value;
		}
	}

	return $track;
}

function option_spitter ( $array_of_options, $saved_value ) 
{?>

	<?php foreach ( $array_of_options  as $option ) : ?>

		<option <?php selected( $saved_value, $option['value'], true ); ?> value="<?php echo $option['value']; ?>"><?php echo $option['name']; ?></option>

	<?php endforeach; ?>

<?php }            

function lf_whitespace( $string ) { 
	
	if ( $string == '' ) { 
		
		return false;
		
	}
		
	elseif ( ctype_space( $string ) ) {
		
		return false;
		
	}
		
	else { 
		
		return true;
		
	}
	
}

function _default_meta($array, $name, $default) {

	global $post;

	if ( !$post ) 
	{ 
		return $default; 
	}
	else 
	{
		$m = get_post_meta( $post->ID, $array, true );
		return (isset( $m[$name] ) ? $m[$name] : $default );
	}
}

function _default_option($array, $name, $default) {

	$option = get_option( $array );
	
	return ( $option && isset($option[$name]) ? $option[$name] : $default );

}

function _default($type, $array, $name, $default) {

	$d = '_default_'.$type;

	return $d($array, $name, $default);

}

function multi( $o ) { 

	if ( !is_array( $o ) ) return false;

	foreach ( $o['opt'] as $a ) {

		call_user_func_array( $a['f'], $a['o'] ); 
		
	} 
	
}


function scripter($script) {

	echo "<script>$script</script>";

}

function lf_head_hook() {

	do_action( 'lf_head_hook' );

}

function lf_pxc($v) {

	if ( strpos( $v, 'px' ) === false ) { $v = $v . 'px'; }

	return $v;

}

function lf_cat_posts() { ?>

	<ul>

		<?php $c = get_categories(); ?>

		<?php foreach ($c as $cat) : ?>

		<?php query_posts( 'cat=' .$cat->cat_ID ); ?>

			<span><?php echo $cat->cat_name; ?></span>

			<ul>

				<?php while ( have_posts() ) : the_post(); ?>

				<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>

				<?php endwhile; ?>

			</ul>

		<?php endforeach; ?>

	</ul>

<?php }

?>