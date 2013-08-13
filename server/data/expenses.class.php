<?php

/**
*  root book class 
*/
class expense extends alpha
{
	var $table;

	function __construct()
	{	
		parent::__construct('expense');
		$this->table = 'expense';

		$table = new table_creator;
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->table,
			'primary_key' => 'id',
			'fields'      => array(
				array( 
					'column_name'    => 'id',
					'data_type'      => 'INT',
					'auto_increment' => true,
				),
				array( 
					'column_name' => 'book',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'book_asin',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'amount',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'date',
					'data_type'   => 'date'
				)
			)
		));
	}

	public function get_table ()
	{
		$table = new table_creator;
		return $table->get_all_rows($this->table);
	}

	public function set_row_value ($id, $value_name, $value)
	{
		$table = new table_creator;
		$table->update_row($this->table, array( $value_name => $value ), 'id', $id );
	}

	public function set_rows ($rows) {
		foreach ($rows as $row) :
			$this->set_row($row);
		endforeach;
	}

	public function set_row ($array_of_information)
	{
		$table   = new table_creator;
		$table->add_row_to_table($this->table, $array_of_information);
	}
}
	
?>