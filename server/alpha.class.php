<?php

/**
* alpha class the root
*/
class alpha
{
	function __construct($class)
	{
		add_action("wp_ajax_nopriv_get_$class", array($this, 'get_' ) );
		add_action("wp_ajax_get_$class", array($this, 'get_' ) );

		add_action("wp_ajax_nopriv_set_$class", array($this, 'set_' ) );
		add_action("wp_ajax_set_$class", array($this, 'set_' ) );
	}

	public function set_ ()
	{
		$this->_recieve_specified_ajax_request_and_call_class_method_with_the_prefix('set_', 'post');
	}

	public function get_ () 
	{
		$this->_recieve_specified_ajax_request_and_call_class_method_with_the_prefix('get_', 'get');
	}

	private function _recieve_specified_ajax_request_and_call_class_method_with_the_prefix ($prefix, $request_type)
	{	
		$request = array(
			'get'  => $_GET,
			'post' => $_POST
		);
		$report = array(
			'error' => true,
			'text'  => false,
			'return'=> false
		);
		$request = $request[$request_type];

		if (isset($request['method'])) : 

			$method     = $prefix.$request['method'];
			$paramaters = (isset($request['paramaters'])? $request['paramaters'] : false );

			try {
				
				$reflection = new ReflectionMethod($this, $method);

				if ($reflection->isPublic()) :
					
					if ($paramaters) :
						$array_of_paramaters = array();

						foreach ($paramaters as $paramater) :
							$array_of_paramaters[] = $paramater;
						endforeach;

						$report['return'] = call_user_func_array(array($this, $method), $array_of_paramaters);
					else :
						$report['return'] = call_user_func(array($this, $method));
					endif;

					$report['error'] = false;
					$report['text']  = "Method : \"$method\" has been sucessfuly called";

				else : 
					$report['text'] = "Method : \"$method\" is not public in this class, as such will not be called";
				endif;

			} catch (Exception $exception) { 
				$report['text'] = $exception->getMessage();
			}
		else :
			$report['text'] = "Method name was not given as such it was not called";
		endif;

		echo json_encode($report);

		exit;
	}
}

?>