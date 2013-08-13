<?php

/**
* ticket root class
*/
class ticket extends alpha
{
	var $freepost_table;
	var $cheque_table;
	var $donate_table;
	var $rag_table;
	var $return_table;

	function __construct()
	{	
		parent::__construct('ticket');
		$this->construct_freepost_table();
		$this->construct_cheque_table();
		$this->construct_donate_table();
		$this->construct_return_table();
		$this->construct_rag_table();
	}

	public function construct_donate_table ()
	{
		$this->donate_table = 'donate';
		$table = new table_creator;
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->donate_table,
			'fields'      => array(
				array(
					'column_name' => 'section',
					'data_type'   => 'varchar(5)',
				),
				array(
					'column_name' => 'level',
					'data_type'   => 'varchar(5)',
				),
				array(
					'column_name' => 'number',
					'data_type'   => 'smallint',
				),
				array(
					'column_name' => 'item_name',
					'data_type'   => 'varchar(100)',
				),
				array(
					'column_name' => 'author',
					'data_type'   => 'varchar(100)',
				),
				array(
					'column_name' => 'user',
					'data_type'   => 'INT'
				),
				array(
					'column_name' => 'email',
					'data_type'   => 'varchar(30)'
				),
				array(
					'column_name' => 'first_name',
					'data_type'   => 'varchar(22)'
				),
				array(
					'column_name' => 'second_name',
					'data_type'   => 'varchar(22)'
				)
			)
		));
	}

	public function construct_rag_table ()
	{
		$this->rag_table = 'rag';
		$table = new table_creator;
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->rag_table,
			'primary_key' => 'id',
			'fields'      => array(
				array(
					'column_name'    => 'id',
					'data_type'      => 'INT',
					'auto_increment' => true,
					'unique'         => false				 									 				
				),
				array(
					'column_name'    => 'email',
					'data_type'      => 'varchar(30)'
				),
				array(
					'column_name'    => 'first_name',
					'data_type'      => 'varchar(22)'
				),
				array(
					'column_name'    => 'second_name',
					'data_type'      => 'varchar(22)'
				),
				array(
					'column_name'    => 'university',
					'data_type'      => 'varchar(55)'
				),
				array(
					'column_name'    => 'amount',
					'data_type'      => 'varchar(11)'
				),
				array(
					'column_name' => 'date',
					'data_type'   => 'date'
				)
			)
		));	
	}

	public function construct_return_table ()
	{
		$this->return_table = 'return';
		$table = new table_creator;
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->return_table,
			'fields'      => array(
				array(
					'column_name' => 'section',
					'data_type'   => 'varchar(5)',
				),
				array(
					'column_name' => 'level',
					'data_type'   => 'varchar(5)',
				),
				array(
					'column_name' => 'number',
					'data_type'   => 'smallint',
				),
				array(
					'column_name' => 'item_name',
					'data_type'   => 'varchar(100)',
				),
				array(
					'column_name' => 'author',
					'data_type'   => 'varchar(100)',
				),
				array(
					'column_name' => 'user',
					'data_type'   => 'INT'
				),
				array(
					'column_name' => 'email',
					'data_type'   => 'varchar(30)'
				),
				array(
					'column_name' => 'first_name',
					'data_type'   => 'varchar(22)'
				),
				array(
					'column_name' => 'second_name',
					'data_type'   => 'varchar(22)'
				),
				array(
					'column_name' => 'address',
					'data_type'   => 'varchar(200)',
				),
				array(
					'column_name' => 'post_code',
					'data_type'   => 'varchar(7)',
				),
				array(
					'column_name' => 'town',
					'data_type'   => 'varchar(30)',
				),
				array(
					'column_name' => 'area',
					'data_type'   => 'varchar(50)',
				)
			)
		));
	}

	public function construct_freepost_table ()
	{
		$this->freepost_table = 'freepost';
		$table = new table_creator;
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->freepost_table,
			'primary_key' => 'id',
			'fields'      => array(
				array(
					'column_name'    => 'id',
					'data_type'      => 'INT',
					'auto_increment' => true,
					'unique'         => false				 									 				
				),
				array(
					'column_name'    => 'email',
					'data_type'      => 'varchar(30)'
				),
				array(
					'column_name'    => 'first_name',
					'data_type'      => 'varchar(22)'
				),
				array(
					'column_name'    => 'second_name',
					'data_type'      => 'varchar(22)'
				),
				array(
					'column_name' => 'address',
					'data_type'   => 'varchar(200)',
				),
				array(
					'column_name' => 'post_code',
					'data_type'   => 'varchar(7)',
				),
				array(
					'column_name' => 'town',
					'data_type'   => 'varchar(30)',
				),
				array(
					'column_name' => 'area',
					'data_type'   => 'varchar(50)',
				),
				array(
					'column_name' => 'date',
					'data_type'   => 'date'
				)
			)
		));
	}

	public function construct_cheque_table ()
	{	
		$this->cheque_table = 'cheque';
		$table = new table_creator;
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->cheque_table,
			'primary_key' => 'id',
			'fields'      => array(
				array(
					'column_name'    => 'id',
					'data_type'      => 'INT',
					'auto_increment' => true,
					'unique'         => false				 									 				
				),
				array(
					'column_name'    => 'email',
					'data_type'      => 'varchar(30)'
				),
				array(
					'column_name'    => 'first_name',
					'data_type'      => 'varchar(22)'
				),
				array(
					'column_name'    => 'second_name',
					'data_type'      => 'varchar(22)'
				),
				array(
					'column_name' => 'address',
					'data_type'   => 'varchar(200)',
				),
				array(
					'column_name' => 'post_code',
					'data_type'   => 'varchar(7)',
				),
				array(
					'column_name' => 'town',
					'data_type'   => 'varchar(30)',
				),
				array(
					'column_name' => 'area',
					'data_type'   => 'varchar(50)',
				),
				array(
					'column_name' => 'date',
					'data_type'   => 'date'
				),
				array(
					'column_name' => 'amount',
					'data_type'   => 'varchar(11)'
				)
			)
		));			
	}

	public function get_freepost ()
	{
		$table = new table_creator;
		return $table->get_all_rows($this->freepost_table);
	}	

	public function get_freepost_with_user_ids ()
	{
		global $account;
		$return   = array();
		$freepost = $this->get_freepost();
		foreach ($freepost as $ticket) :
			$user = $account->get_account($ticket['email']);
			$ticket['user']       = $user['id'];
			$ticket['book_count'] = count($user['price_promise']);
			$return[] = $ticket;
		endforeach;
		return $return;
	}

	public function set_rag_donate ($array_of_information)
	{
		$table = new table_creator;
		$table->add_row_to_table($this->rag_table, $array_of_information );	
	}

	public function set_freepost ($array_of_information)
	{
		$table = new table_creator;
		$table->add_row_to_table($this->freepost_table, $array_of_information );
	}

	public function set_freepost_ticket_value ($column, $value, $ticket)
	{
		$table = new table_creator;
		$table->update_row($this->freepost_table, array( $column => $value ), 'id', $ticket );
	}

	public function set_remove_freepost ($id)
	{
		$table = new table_creator;
		$table->delete_row($this->freepost_table, 'id', $id);
	}

	public function set_remove_freeposts ($ids)
	{
		foreach ( $ids as $id ) :
			$this->set_remove_freepost($id);
		endforeach;
	}

	public function set_cheque ($array_of_information)
	{
		$table = new table_creator;
		$table->add_row_to_table($this->cheque_table, $array_of_information );	
	}
}	
?>