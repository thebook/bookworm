<?php

/**
*  root book class 
*/
class book extends alpha
{
	var $book_table;
	var $reserved_table;
	var $section_definition;
	var $level_maximum;
	var $number_maximum;
	var $unwanted_table;
	var $unwanted_section_definition;
	var $unwanted_level_maximum;
	var $unwanted_number_maximum;

	function __construct()
	{	
		parent::__construct('book');
		$this->section_definition = array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's' );
		$this->level_maximum  = 5;
		$this->number_maximum = 40;

		$this->unwanted_section_definition = array('x');
		$this->unwanted_level_maximum  = 5;
		$this->unwanted_number_maximum = 40;

		$this->book_table = 'book';
		$this->reserved_table = 'reserved_section';
		$this->unwanted_table = 'unwanted';

		$table = new table_creator;
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->book_table,
			'primary_key' => 'item_sku',
			'fields'      => array(
				array( 
					'column_name'    => 'item_sku',
					'data_type'      => 'INT',
					'auto_increment' => true,
				),
				array( 
					'column_name'    => 'section',
					'data_type'      => 'varchar(10)'
				),
				array( 
					'column_name'    => 'level',
					'data_type'      => 'varchar(10)'
				),
				array( 
					'column_name'    => 'number',
					'data_type'      => 'tinyint'
				),
				array( 
					'column_name' => 'external_product_id',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'external_product_id_type',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'item_name',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'manufacturer',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'product_description',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'update_delete',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'standard_price',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'quantity',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'condition_type',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'condition_note',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'generic_keywords1',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'generic_keywords2',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'generic_keywords3',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'generic_keywords4',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'generic_keywords5',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'main_image_url',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'fulfillment_center_id',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'package_height',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'package_width',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'package_length',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'package_dimensions_unit_of_measure',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'package_weight',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'package_weight_unit_of_measure',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'author',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'binding',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'publication_date',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'edition',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'expedited_shipping',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'will_ship_internationally',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'unknown_subject',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'language_value',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'volume_base',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'illustrator',
					'data_type'   => 'varchar(200)'
				)
			)
		));

		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->unwanted_table,
			'primary_key' => 'item_sku',
			'fields'      => array(
				array( 
					'column_name'    => 'item_sku',
					'data_type'      => 'INT',
					'auto_increment' => true,
				),
				array( 
					'column_name'    => 'section',
					'data_type'      => 'varchar(10)'
				),
				array( 
					'column_name'    => 'level',
					'data_type'      => 'varchar(10)'
				),
				array( 
					'column_name'    => 'number',
					'data_type'      => 'tinyint'
				),
				array( 
					'column_name' => 'external_product_id',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'external_product_id_type',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'item_name',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'manufacturer',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'product_description',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'update_delete',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'standard_price',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'quantity',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'condition_type',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'condition_note',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'generic_keywords1',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'generic_keywords2',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'generic_keywords3',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'generic_keywords4',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'generic_keywords5',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'main_image_url',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'fulfillment_center_id',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'package_height',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'package_width',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'package_length',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'package_dimensions_unit_of_measure',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'package_weight',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'package_weight_unit_of_measure',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'author',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'binding',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'publication_date',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'edition',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'expedited_shipping',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'will_ship_internationally',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'unknown_subject',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'language_value',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'volume_base',
					'data_type'   => 'varchar(200)'
				),
				array( 
					'column_name' => 'illustrator',
					'data_type'   => 'varchar(200)'
				)
			)
		));

		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->reserved_table,
			'fields'      => array(
				array( 
					'column_name'    => 'section',
					'data_type'      => 'varchar(5)'
				),
				array( 
					'column_name'    => 'level',
					'data_type'      => 'varchar(5)'
				)
			)
		));
	}

	public function get_book_table ()
	{
		$table = new table_creator;
		return $table->get_all_rows($this->book_table);
	}


	public function get_book_table_exported_as_tab_delimited_file ()
	{
		$creator = new table_creator;
		$limit   = 1000;
		$rows    = (int)$creator->get_number_of_rows_from_table($this->book_table);
		$laps    = 0;
		$number_of_rows_to_get = array(
			'low_range'  => 1,
			'high_range' => $limit
		);
		$table   = array();

		if ( $rows/$limit > 1 ) :
			$laps  = Floor($rows/$limit)+1;
		else : 
			$table = $creator->get_all_rows($this->book_table);
		endif;

		for ( $index = 0; $index < $laps; $index++ ) :
			$row_selection                       = $creator->get_rows_from_one_point_to_another($this->book_table, 'item_sku', $number_of_rows_to_get['low_range'], $number_of_rows_to_get['high_range'] );
			$table                               = array_merge( $table, $row_selection );
			$number_of_rows_to_get['low_range']  = $number_of_rows_to_get['high_range'];
			$number_of_rows_to_get['high_range'] = ( $index < $laps-1 ? $number_of_rows_to_get['high_range'] + $limit : $number_of_rows_to_get['high_range'] + ( $rows - ( $laps*$limit ) ) );
		endfor;

		$count          = 0;
		$zeros          = '';
		$missing_zeros  = 0;
		$date           = date('G_i_d_m_y');
		$books          = "TemplateType=BookLoader\tVersion=2012.1008\tThis row for Amazon.com use only.  Do not modify or delete.\t\t\t\t\tOffer - These attributes are required to make your item buyable for customers on the site\t\t\t\tDiscovery - These attributes have an effect on how customers can find your product on the site using browse or search\t\t\t\t\tImage - These attributes provide links to images for a product\t\"Fulfillment - Use these columns if you are participating in \"\"Fulfillment by Amazon\"\"\"\t\t\t\t\t\t\tUngrouped - These attributes create rich product listings for your buyers.\t\t\t\t\t\t\t\t\t\r\n";
		$books         .= "SKU\tProduct ID\tProduct ID Type\tTitle\tPublisher\tProduct Description\tUpdate Delete\tPrice\tQuantity\tItem Condition\tItem Note\tSearch Terms1\tSearch Terms2\tSearch Terms3\tSearch Terms4\tSearch Terms5\tMain Image URL\tFulfilment Center ID\tPackage Height\tPackage Width\tPackage Length\tPackage Dimensions Unit Of Measure\tPackage Weight\tPackage Weight Unit Of Measure\tAuthor\tBinding\tPublication Date\tEdition\tExpedited Shipping\tWill Ship Internationally\tSubject\tLanguage\tVolume\tIllustrator\r\n";
		$books         .= "item_sku\texternal_product_id\texternal_product_id_type\titem_name\tmanufacturer\tproduct_description\tupdate_delete\tstandard_price\tquantity\tcondition_type\tcondition_note\tgeneric_keywords1\tgeneric_keywords2\tgeneric_keywords3\tgeneric_keywords4\tgeneric_keywords5\tmain_image_url\tfulfillment_center_id\tpackage_height\tpackage_width\tpackage_length\tpackage_dimensions_unit_of_measure\tpackage_weight\tpackage_weight_unit_of_measure\tauthor\tbinding\tpublication_date\tedition\texpedited_shipping\twill_ship_internationally\tunknown_subject\tlanguage_value\tvolume_base\tillustrator\r\n";

		foreach ( $table as $book ) :
			$count  = 0;
			$books .= "{$book['section']}{$book['level']}-{$book['number']}\t";

			if ( strlen($book['external_product_id']) < 10 ) :
				$missing_zeros = 10 - strlen($book['external_product_id']);
				$zeros = '';
				for ( $index = 0; $index < $missing_zeros; $index++ ) :
					$zeros .= '0';
				endfor;
			endif;

			$books .= (strlen($book['external_product_id']) < 10  ? "$zeros{$book['external_product_id']}\t" : "{$book['external_product_id']}\t" );
			
			unset($book['section'], $book['level'], $book['number'], $book['item_sku'], $book['external_product_id'] );

			foreach ( $book as $property_name => $property ) :
				$count++;
				( $property_name === 'author' and empty($property) ) and $property = 'n/a';
				$books .= ( $count < 32 ? "$property\t" : "$property" );
			endforeach;

			$books .= "\r\n";
		endforeach;
		
		$file = fopen( TEMPLATEPATH . "/inventory/$date.txt", 'w+');
		fwrite($file, $books);
		fclose($file);

		return TEMPLATEURI ."/inventory/$date.txt";
	}

	public function get_unwanted_book_table ()
	{
		$table = new table_creator;
		return $table->get_all_rows($this->unwanted_table);
	}

	public function set_clear_table ()
	{
		$table = new table_creator;
		return $table->delete_all_table_rows($this->book_table);	
	}
	
	public function get_unwanted_book_table_columns () {
		$table = new table_creator;
		return $table->show_all_columns_in_a_table($this->unwanted_table);	
	}

	public function get_book_table_columns () {
		$table = new table_creator;
		return $table->show_all_columns_in_a_table($this->book_table);
	}

	public function set_book_value ($book_sku, $value_name, $value)
	{
		$table = new table_creator;
		$table->update_row($this->book_table, array( $value_name => $value ), 'item_sku', $book_sku );
	}

	public function set_books ($books)
	{
		foreach ($books as $book) :
			$this->set_book($book);
		endforeach;
	}

	public function set_book ($book)
	{
		$table   = new table_creator;
		
		if ( isset($book['prices']) ) :
			unset($book['prices']); 
		endif;

		$default = array(
			'section'					=> 1,
			'level'					    => 1,
			'number'					=> 1,
			'external_product_id'       => '',
			'external_product_id_type'  => 'ASIN',
			'item_name'                 => '',
			'manufacturer'              => '',
			'product_description'       => '',
			'update_delete'             => '',
			'standard_price'            => '',
			'quantity'                  => 1,
			'condition_type'            => 4,
			'condition_note'            => '',
			'generic_keywords1'         => '',
			'generic_keywords2'         => '',
			'generic_keywords3'         => '',
			'generic_keywords4'         => '',
			'generic_keywords5'         => '',
			'main_image_url'            => '',
			'fulfillment_center_id'     => '',
			'package_height'            => '',
			'package_width'             => '',
			'package_length'            => '',
			'package_dimensions_unit_of_measure' => '',
			'package_weight'            => '',
			'package_weight_unit_of_measure' => '',
			'author'                    => 'N/A',
			'binding' 	                => '',
			'publication_date'          => '',
			'edition'                   => '',
			'expedited_shipping'        => 3,
			'will_ship_internationally' => 4,
			'unknown_subject'           => '',
			'language_value'            => '',
			'volume_base'               => '',
			'illustrator'               => '',
		);

		foreach ($default as $book_property => $default_value) :
			( !isset($book[$book_property]) ) and $book[$book_property] = $default_value;
		endforeach;

		$table->add_row_to_table($this->book_table, $book);
	}
}
	
?>