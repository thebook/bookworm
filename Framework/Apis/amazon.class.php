<?php

/**
* A class for searching and generating aamazon results
*/
class amazon extends alpha_tree_api
{

	function __construct($params)
	{
		parent::__construct($params);
		$this->paramaters['service_name']   = 'AWSECommerceService';
		$this->paramaters['access_key']     = $params['amazon_access_key'];
		$this->paramaters['secret_key']     = $params['amazon_secret_key'];
		$this->paramaters['associates_id']  = $params['amazon_associates_id'];
		$this->paramaters['amazon_host']    = 'ecs.amazonaws.'. $this->_set_country_domain($params['region']);
	}

	public function create ()
	{
		$paramaters        = $_POST['paramaters'];	
		// Get search function
		$search            = "_search_for_{$paramaters['search_for']}_by_{$paramaters['search_by']}";
		// Get filter function 
		$filter_by         = "_filter_{$paramaters['search_for']}_by_{$paramaters['filter_name']}";
		// Get search parmaters
		$search_paramaters = $this->{$search}($paramaters['typed']);
		// Get response 
		$response          = $this->_make_the_call($search_paramaters);
		// Filter Response
		$response          = $this->{$filter_by}($response);

		echo json_encode($response);

		exit;
	}

	protected function _make_the_call ($paramaters)
	{
		$paramaters     = $this->_insert_credentials($paramaters);
		ksort($paramaters);
		$paramaters     = $this->_convert_array_into_url_paramaters($paramaters);
		$hash_signature = $this->_create_signature($paramaters);
		$request_url    = "http://{$this->paramaters['amazon_host']}/onca/xml?$paramaters&Signature=$hash_signature";
			
		return $this->_curl_call($request_url);
	}

	protected function _curl_call ($request)
	{
		$curl_request = curl_init();
	    curl_setopt($curl_request, CURLOPT_URL, $request);
	    curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl_request, CURLOPT_TIMEOUT, 15);
	    curl_setopt($curl_request, CURLOPT_SSL_VERIFYHOST, 0);

	    $response   = curl_exec($curl_request);

	   	return $amazon_xml = simplexml_load_string($response);
	}

	protected function _search_for_books_by_keywords ($search_words)
	{
		return array(
			'Operation'     => 'ItemSearch',
			'Keywords'      => "$search_words",
			'SearchIndex'   => 'Books',
			'ResponseGroup' => 'Offers, ItemAttributes, Images',
			'Condition'     => 'Used'
		);
	}

	protected function _search_for_books_by_isbn ($search_number)
	{
		return array(
			'Operation'     => 'ItemLookup', 
			'IdType'        => 'ISBN',
			'ItemId'        => "$search_number",
			'SearchIndex'   => 'Books',
			'ResponseGroup' => 'Offers, ItemAttributes, Images',
			'Condition'     => 'Used'
		);
	}

	protected function _filter_books_by_tiny ($xml)
	{
		$return_array = array();

		foreach ($xml->Items->Item as $item => $attributes) : 
			
			$return_array[] = 
				array(
					'item_links'         => $attributes->ItemLinks,
					'image'              => $attributes->MediumImage,
					'image_sets'         => $attributes->ImageSet,
					'author'             => $attributes->ItemAttributes->Author,
					'binding'            => $attributes->ItemAttributes->Binding,
					'ISBN'               => $attributes->ItemAttributes->ISBN,
					'dimensions'         => $attributes->ItemAttributes->ItemDimensions,
					'price'              => $attributes->ItemAttributes->ListPrice,
					'number_in_stock'    => $attributes->ItemAttributes->NumberOfItems,
					'pages'              => $attributes->ItemAttributes->NumberOfPages,
					'package_dimensions' => $attributes->ItemAttributes->PackageDimensions,
					'title'              => $attributes->ItemAttributes->Title,
					'lowest_new_price'   => $attributes->OfferSummary->LowestNewPrice,
					'lowest_used_price'  => $attributes->OfferSummary->LowestUsedPrice,
					'ASIN' 				 => $attributes->ASIN
				);

		endforeach;

		return (array)$return_array;
	}

	protected function _insert_credentials ($array_to_insert_credentials_in)
	{
		$array_to_insert_credentials_in['Service']           = $this->paramaters['service_name'];
		$array_to_insert_credentials_in['AWSAccessKeyId']    = $this->paramaters['access_key'];
		$array_to_insert_credentials_in['AssociateTag']      = $this->paramaters['associates_id'];
		$array_to_insert_credentials_in['Timestamp']         = $this->_create_timestamp();
		
		return $array_to_insert_credentials_in;
	}

	protected function _set_country_domain ($country_domain)
	{
		$possible_domains = array('de', 'com', 'co.uk', 'ca', 'fr', 'co.jp', 'it', 'cn', 'es');
		
		return (in_array($country_domain, $possible_domains)? $country_domain : 'com' );
	}

	protected function _create_signature ($paramaters_string, $uri = '/onca/xml', $method = 'GET')
	{
		$the_string_to_hash_tag = "$method\n{$this->paramaters['amazon_host']}\n$uri\n$paramaters_string";
		$the_string_to_hash_tag = base64_encode(hash_hmac('sha256', $the_string_to_hash_tag, $this->paramaters['secret_key'], true ));
		
		return str_replace('%7E', '~', rawurlencode( $the_string_to_hash_tag ));
	}

	protected function _create_timestamp ()
	{
		return gmdate('Y-m-d\TH:i:s\Z');
	}

	protected function _convert_array_into_url_paramaters ($array_to_convert)
	{
		$sorting_array = array();

		foreach ($array_to_convert as $option_name => $option_value) :
			
			$option_name     = str_replace('%7E', '~', rawurlencode($option_name));
			$option_value    = str_replace('%7E', '~', rawurlencode($option_value));
			$sorting_array[] = "$option_name=$option_value";

		endforeach;

		return implode('&', $sorting_array );
	}
}

?>