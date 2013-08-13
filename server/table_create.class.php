<?php 

/**
* A class for creating dtabase tables
*
* 	to-do add a add column func, and a drop column func
* 	make interface first
*/
class table_creator
{
	/**
	 * Used to init a table for a data storing purpose, if the table exists a new one wont be created,
	 * the table name is prefixed with "wp_" or any other prefix if it has been changed
	 * @param  array $passed_creation_paramaters An array of paramaters contains "table name",and other paramaters 
	 *                                           which are passed to the $this->_create_table() function
	 * @return mysql query                             Inserts a new table in the database if sucessfull
	 */
	public function check_if_table_exists_if_not_create_one ($passed_creation_paramaters)
	{
		global $wpdb;

		$is_the_table_not_in_the_database = $this->does_table_exist($passed_creation_paramaters['table_name']);

		if ( !$is_the_table_not_in_the_database ) { 

			$this->create_table($passed_creation_paramaters);
		}	
	}

	public function remove_table ($table_name)
	{
		global $wpdb;
		$wpdb->query("DROP TABLE IF EXISTS $wpdb->prefix$table_name");
	}

	/**
	 * Unecessary ? 
	 * Creates two tables, one for storing a name(or any other indeifier ) along with a id and the other for storing 
	 * extra data for that name(or indeifier) and maping them between
	 * @param  array $passed_creation_paramaters Array of paramaters contaning "table name and reference fields"
	 * @return mysql query Creates two new tables one with the after fix of "reference"
	 */
	# out of use i think should be remodled and fixed
	public function create_reference_and_information_table ($passed_creation_paramaters)
	{
		if ( $this->params->does_table_exist($passed_creation_paramaters['table_name']) &&
			 $this->params->does_table_exist($passed_creation_paramaters['table_name']."_reference") ) {

			// 
			// Create a refrence table
			$this->_create_table(
				array(
					'table_name' => $passed_creation_paramaters['table_name']."_reference",
					'fields'     => $passed_creation_paramaters['reference_fields']
			));

			// 
			// Create a information table
			$this->_create_table(
				array(
					'table_name' => $passed_creation_paramaters['table_name'],
					'fields'     => $passed_creation_paramaters['fields']
			));
		}
	}

	/**
	 * Performs a mysql search for a table like the one searched and returns true or false if found
	 * this is mainly a helper function
	 * @param  string $table_name The name of the table searched for, this will always be prefixed
	 * @return boolean Returns true if there is a table false if not
	 */
	public function does_table_exist ($table_name)
	{
		global $wpdb;

		return ( $wpdb->query("SHOW TABLES LIKE '$wpdb->prefix$table_name'") === 1 ? true : false );
	}

	/**
	 * Creates a table in the current wordpress directory using the dbDelta inbuild wordpresss function
	 * the table name is prefixed and has a primary key of an id, every time, the 'fields' keys are converted
	 * into proper mysql strins by the $this->_convert_table_fields_into_database_field_statements() method	
	 * @param  array $table_creation_paramaters An array of paramaters, including "table name and fields definitions"
	 * @return mysql query 						Inserts a new table into the current wordpress database
	 */
	public function _create_table ($table_creation_paramaters)
	{	
		require_once ABSPATH .'/wp-admin/includes/upgrade.php'; 
		
		global $wpdb; 

		$string_to_insert_into_mysql_query = "
			CREATE TABLE $wpdb->prefix{$table_creation_paramaters['table_name']} ( 
			id MEDIUMINT NOT NULL AUTO_INCREMENT,
			". $this->_convert_table_fields_into_database_field_statements($table_creation_paramaters['fields']) ."
			PRIMARY KEY (id)
			)";

		dbDelta($string_to_insert_into_mysql_query);
	}

	/**
	 * A more improved version of table create without the default if, perhaps the old table create should be removed 
	 * @param  array $paramaters An array of creation paramaters
	 * @return mysql             A query creating the table
	 */
	public function create_table ($paramaters)
	{
		require_once ABSPATH .'/wp-admin/includes/upgrade.php'; 

		global $wpdb; 

		extract($paramaters);

		$primary_key = ((isset($primary_key) and $primary_key )? "PRIMARY KEY ($primary_key), " : null );

		$create_table_query = "
		CREATE TABLE $wpdb->prefix{$table_name} (" 
		. $primary_key
		. $this->_convert_fields_into_types($fields) 
		. ")";
				
		dbDelta($create_table_query);
	}

	protected function _convert_fields_into_types ($fields_to_convert)
	{	
		$field_numbers = count($fields_to_convert);
		$return_value  = '';

		foreach ( $fields_to_convert as $field ) : 

			$return_value .= $this->_convert_field_into_type($field, $field_numbers);
			$field_numbers--;	

		endforeach;		

		return $return_value;
	}


	protected function  _convert_field_into_type ($field, $field_numbers = 1 )
	{				
		extract($field);
			
			$auto_increment = ( (isset($auto_increment) and $auto_increment)? 'AUTO_INCREMENT' : '' );
			$punctuation    = ( $field_numbers > 1 ? ',' : '' );
			$unique 		= ( (isset($unique) and $unique)? 'UNIQUE' : '' );			
			$null           = ( (isset($null) and $null)?'NULL' : 'NOT NULL' );

			return strtolower($column_name) . " $data_type $unique $null $auto_increment $punctuation ";
	}

	public function check_if_value_is_in_column ($table, $column, $value)
	{
		global $wpdb;

		return ( $wpdb->query("SELECT `$column` FROM `$wpdb->prefix$table` WHERE `$column` = '$value'") === 1 ? true : false );
	}

	/**
	 * Inserts a row to a table and takes care of the formating
	 * @param string $table_name The name of the table ( is prefixed once inisde )
	 * @param array  $to_insert  An array of values to insert, the keys are column names and the values well the values 
	 */
	public function add_row_to_table ($table_name, $to_insert)
	{
		global $wpdb;
		
		$format = $this->_take_each_string_and_return_format_array_for_row_insertion($to_insert);

		$wpdb->insert( "$wpdb->prefix$table_name", $to_insert, $format );
	}

	public function get_all_rows_from_table ($name)
	{
		global $wpdb;

		return $wpdb->get_results("SELECT * FROM $wpdb->prefix$name", ARRAY_A );
	}

	public function get_rows_from_one_point_to_another ($name, $column, $low_ammount, $high_ammount)
	{
		global $wpdb;

		return $wpdb->get_results("SELECT * FROM $wpdb->prefix$name WHERE $column BETWEEN $low_ammount AND $high_ammount", ARRAY_A );
	}

	public function get_number_of_rows_from_table ($name)
	{
		global $wpdb;
		$count = $wpdb->get_results("SELECT COUNT(*) FROM $wpdb->prefix$name", ARRAY_A );	
		return $count[0]['COUNT(*)'];
	}

	public function unserialize_strings_in_an_array ($array)
	{
		foreach ($array as $key => $member) :
			$array[$key] = $this->unserialize_or_return_regular_value($member);
		endforeach;

		return $array;
	}

	public function serialize_arrays_in_an_array ($array)
	{
		foreach ($array as $key => $member) :
			(is_array($member)) and $array[$key] = serialize($member);
		endforeach;

		return $array;
	}

	public function unserialize_or_return_regular_value ($string)
	{
		$unserialized = @unserialize($string);

		if ( $unserialized !== false or $string === 'b:0' ) :
			return $unserialized;
		else : 
			return $string;
		endif;
	}

	public function update_row ($table_name, $column_and_value_array_update, $where_column, $where_value)
	{
		global $wpdb;

		$update = '';
		$on_field_number = 0;
		$field_count  = count($column_and_value_array_update);

		foreach ( $column_and_value_array_update as $column_name => $update_value ) : 

			$on_field_number++;

			$update .= "$column_name = '$update_value'";
			( $on_field_number < $field_count ) and $update .= ', ';

		endforeach;

		$wpdb->query("UPDATE $wpdb->prefix$table_name set $update where $where_column = '$where_value' ");
	}

	public function delete_all_table_rows ($table_name)
	{
		global $wpdb;

		$wpdb->query("TRUNCATE TABLE $wpdb->prefix$table_name");
	}

	public function delete_row ($table_name, $where_column, $where_value)
	{
		global $wpdb;

		$wpdb->query("DELETE FROM $wpdb->prefix$table_name WHERE $where_column = '$where_value'");
	}

	public function get_row ($table_name, $where_column, $where_value)
	{
		global $wpdb;

		$result	= $wpdb->get_results("SELECT * FROM $wpdb->prefix$table_name WHERE $where_column = '$where_value'", ARRAY_A);
		
		return (empty($result)? false : $result[0] );
	}

	public function get_rows ($table_name, $where_column, $where_value)
	{
		global $wpdb;

		$result	= $wpdb->get_results("SELECT * FROM $wpdb->prefix$table_name WHERE $where_column = '$where_value'", ARRAY_A);

		return (empty($result)? false : $result );
	}

	public function get_all_rows ($table_name)
	{
		global $wpdb;

		$result	= $wpdb->get_results("SELECT * FROM $wpdb->prefix$table_name ", ARRAY_A);

		return (empty($result)? false : $result );
	}
	
	/**
	 * Takes an array of strings and checks if they are digits or strings and returns a %d for didigs and 
	 * %s for string for the wpdb->insert() function format
	 * @param  array $strings_to_be_checked An array of the strings to be checked
	 * @return array 						Retuns an array of %d or %s for formating 
	 */
	protected function _take_each_string_and_return_format_array_for_row_insertion ($strings_to_be_checked)
	{
		$return_array = array();

		foreach ( $strings_to_be_checked as $check_string ) : 
			
			$return_array[] = ( ctype_digit($check_string) ? '%d' : '%s' );

		endforeach;

		return $return_array;
	}

	/**
	 * Checks if a column exits, usefull for checking before adding new columns
	 * @param  string $table_name  The name of the table ( is prefixed inside )
	 * @param  string $column_name The name of the column to search for 
	 * @return boolean              Retuns true if column is found fasle if not
	 */
	public function does_column_exist ($table_name, $column_name)
	{
		global $wpdb;

		$try_to_show_fieldname_column = $wpdb->query("SHOW COLUMNS FROM `$wpdb->prefix$table_name` LIKE '$column_name' ");

		return ( $try_to_show_fieldname_column === 1 ? true : false );
	}

	/**
	 * Checks if a column exits and if not it adds it to the table
	 * @param array $paramaters An array of paramaters to be passed has "table name and field name" for column
	 */
	public function add_column_to_table ($paramaters)
	{
		if ( !$this->does_column_exist($paramaters['table_name'], $paramaters['column_name']) ) { 
			
			global $wpdb;
			
			$field_to_be_inserted = $this->_convert_field_into_type($paramaters);

			$wpdb->query("ALTER TABLE $wpdb->prefix{$paramaters['table_name']} ADD $field_to_be_inserted"); 
		}
	}

	/**
	 * Checks if a colmn exisits and removes it if it does
	 * @param  array $paramaters An array of paramaters has "table name and field name" 
	 */
	public function remove_column_from_table ($paramaters)
	{
		if ( $this->does_column_exist($paramaters['table_name'], $paramaters['field_name']) ) { 

			global $wpdb;
			
			$wpdb->query("ALTER TABLE $wpdb->prefix{$paramaters['table_name']} DROP COLUMN {$paramaters['field_name']}");
		}
	}

	/**
	 * Checks if the column with the name to be changed exists and if a column with the new name does not 
	 * exists then if creates a new column in the table 
	 * @param  array $paramaters An array of paramaters has "old name, new name and the new input type"
	 */
	public function rename_column_in_table ($paramaters)
	{
		if (  $this->does_column_exist($paramaters['table_name'], $paramaters['old_name']) &&
			 !$this->does_column_exist($paramaters['table_name'], $paramaters['field_name']) ) {  
			
			global $wpdb;

			$the_replace_column_field = $this->_convert_table_field_choices_into_database_field_statement(
				array(
					'field_name'       => $paramaters['field_name'], 
					'field_input_type' => $paramaters['field_input_type'] 
					));

			$wpdb->query("ALTER TABLE $wpdb->prefix{$paramaters['table_name']} change {$paramaters['old_name']} $the_replace_column_field");
		}
	}

	/**
	 * Gets the infomration of a column, as per the information_schema.column table in mysql and returns it 
	 * @param  string $table_name     The name of the table in which to look
	 * @param  string $column_name    The name of the column to get the information for
	 * @param  string $what_to_select What type of information to get 
	 * @return string 				  Returns the requested information
	 */
	public function get_column_information ($table_name, $column_name, $what_to_select)
	{
		global $wpdb;

		$results = $wpdb->get_results("SELECT $what_to_select FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$wpdb->prefix$table_name' AND COLUMN_NAME = '$column_name'", ARRAY_A);
		
		return $results[0][$what_to_select];
	}

	public function get_all_column_information ($table_name, $what_to_select)
	{
		global $wpdb;

		$results = $wpdb->get_results("SELECT $what_to_select FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$wpdb->prefix$table_name'", ARRAY_A);		
		$results = filter_multi_array_value_into_single($results, $what_to_select);

		return $results;
	}

	public function change_data_type_of_column ($table_name, $column_name, $new_data_type)
	{
		global $wpdb;

		$wpdb->query("ALTER TABLE $wpdb->prefix{$table_name} MODIFY $column_name $new_data_type");
	}

	public function show_all_columns_in_a_table ($table_name)
	{
		global $wpdb;

		return $wpdb->get_results("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name='$wpdb->prefix$table_name'", ARRAY_A );
	}

	/**
	 * Takes an array of field names and field input types and returns a mysql string for inserting them into the 
	 * a mysql query ( table insertion )
	 * @param  array $fields_array An array of arrays containign "field name and field input type"
	 * @return string              Mysql string
	 */
	protected function _convert_table_fields_into_database_field_statements ($fields_array)
	{	
		$return_string = '';

		foreach ($fields_array as $table_field) {
			$return_string .= $this->_convert_table_field_choices_into_database_field_statement($table_field).", ";
		}

		return $return_string;
	}
}

?>