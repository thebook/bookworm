<?php

/**
* the cration of a users clas 
*/
class account extends alpha
{
	var $account_table;
	var $address_table;

	function __construct()
	{	
		parent::__construct('account');
		$this->account_table = 'account';
		$this->address_table = 'address';

		$table = new table_creator;
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->account_table,
			'primary_key' => 'id',
			'fields'      => array(
				array(
					'column_name'    => 'id',
					'data_type'      => 'INT',
					'auto_increment' => true,
					'unique'         => false				 									 				
				),
				array(
					'column_name' => 'email',
					'unique'      => true,				
					'data_type'   => 'varchar(30)' 
				),
				array(
 					'column_name' => 'first_name',
					'data_type'   => 'varchar(22)' 
				),
				array(
					'column_name'=> 'second_name',
					'data_type'  => 'varchar(22)' 
				),
				array(
					'column_name' => 'password',									
					'data_type'   => 'varchar(30)' 
				),
				array(
					'column_name' => 'credit',
					'data_type'   => 'varchar(11)'
				),
				array(
					'column_name' => 'donate',
					'data_type'   => 'varchar(11)'
				),
				array(
					'column_name' => 'last_withdraw',
					'data_type'   => 'date'
				),
				array(
					'column_name' => 'recieve_newsletter',
					'data_type'   => 'varchar(1)'
				),
				array(
					'column_name' => 'university',			
					'data_type'   => 'varchar(55)',
					'null'        => true
				),
				array(
					'column_name' => 'year',
					'data_type'   => 'varchar(7)',
					'null'        => true
				),
				array(
					'column_name' => 'subject',
					'data_type'   => 'varchar(30)',
					'null'        => true
				),
				array(
					'column_name' => 'history',		
					'data_type'   => 'blob',
					'null'        => true
				),
				array(
					'column_name' => 'price_promise',	
					'data_type'   => 'blob',
					'null'        => true
				),
				array(
					'column_name' => 'unaccepted_book',
					'data_type'   => 'blob',
					'null'        => true
				),
			)
		));
		
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->address_table,
			'primary_key' => 'id',
			'fields'      => array(
				array(
					'column_name'    => 'id',
					'data_type'      => 'INT',
					'auto_increment' => true,
					'unique'         => false				 									 				
				),
				array(
					'column_name' => 'user',
					'data_type'   => 'varchar(30)',
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

	public function get_file ()
	{
		$file = file_get_contents('http://localhost:30102/wp-content/themes/recyclabook/inventory/inv.txt');
		return $file;
	}

	public function get_does_admin_user_exist ($name, $password)
	{
		$user = 'recyclabook';
		$pass = 'thinkbigger1';
		return ( $name === $user and $password === $pass ? true : false );
	}

	public function get_account_by_id ($account_id) {
		$table = new table_creator;
		$account = $table->get_row($this->account_table, 'id', $account_id);
		if ( $account !== false ) :
			$account['history']         = json_decode($account['history']);
			$account['unaccepted_book'] = json_decode($account['unaccepted_book']);
			$account['price_promise']   = json_decode($account['price_promise']);
		endif;
		return $account;

	}

	public function get_account ($account_email)
	{
		$table = new table_creator;
		$account = $table->get_row($this->account_table, 'email', $account_email);

		if ( $account === false ) : 
			return null;
		endif;

		foreach ($account as $data_name => $data) :
			$account[$data_name]    = preg_replace("/[\\\\]+'/", "'", $data );
		endforeach;

		$account['history']         = json_decode($account['history']);
		$account['unaccepted_book'] = json_decode($account['unaccepted_book']);
		$account['price_promise']   = json_decode($account['price_promise']);

		return $account;
	}

	public function get_table ()
	{
		$table = new table_creator;
		return $table->get_all_rows($this->account_table);
	}

	public function get_address ($account_email)
	{
		$table = new table_creator;
		return $table->get_rows($this->address_table, 'user', $account_email);
	}

	public function get_addresses ()
	{
		$table = new table_creator;
		return $table->get_all_rows($this->address_table);
	}

	public function get_account_value ($account_id, $value_to_get )
	{
		$account = $this->get_account($account_id);
		return $account[$value_to_get];
	}

	public function get_is_email_in_use ($email)
	{
		$table = new table_creator;
		return $table->check_if_value_is_in_column($this->account_table, "email", $email);
	}

	public function set_account ($update)
	{
		$table = new table_creator;

		( isset($update['history']) )        and $update['history']         = json_encode($update['history']);
		( isset($update['unaccepted_book'])) and $update['unaccepted_book'] = json_encode($update['unaccepted_book']);
		( isset($update['price_promise'])  ) and $update['price_promise']   = json_encode($update['price_promise']);
		
		foreach ($update as $data_name => $data) :
			$update[$data_name] = mysql_real_escape_string($data);
		endforeach;

		$table->update_row($this->account_table, $update, 'email', $update['email']); 
	}

	public function set_account_value ($email, $value_name, $value)
	{
		$table = new table_creator;

		if ( is_array($value) ) :
			$value = json_encode($value);
		endif;

		$table->update_row($this->account_table, array($value_name => $value ), 'email', $email); 
	}

	public function set_new_account ($array_of_information)
	{
		$table = new table_creator;
		$table->add_row_to_table($this->account_table, $array_of_information );
	}

	public function set_address ($update)
	{	
		$table = new table_creator;
		$table->update_row($this->address_table, $update, 'user', $update['user']); 	
	}

	public function set_remove_address_by_id ($address_id)
	{
		$table = new table_creator;
		$table->delete_row($this->address_table, 'id', $address_id );
	}

	public function set_remove_addresses_by_id ($ids)
	{
		foreach ( $ids as $id ) :
			$this->set_remove_address_by_id($id);
		endforeach;
	}

	public function set_new_address ($array_of_information)
	{
		$table = new table_creator;
		$table->add_row_to_table($this->address_table, $array_of_information);
	}

	public function set_price_promise ($email, $price_promise)
	{	
		$table = new table_creator;
		$table->update_row($this->account_table, array('price_promise' => json_encode($price_promise) ), 'email', $email);
	}
}
	
?>