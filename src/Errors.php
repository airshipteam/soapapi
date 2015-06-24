<?php

$this->errors =  array(

	/*
	|--------------------------------------------------------------------------
	| List of Errors that can be returned to client on failure of various API calls
	|--------------------------------------------------------------------------
	*/


	/*
	|--------------------------------------------------------------------------
	| Default
	|--------------------------------------------------------------------------
	|
	| Fallback error
 	|
	*/


	'default' => array(

		'default' => array(
			'error_num' => 0,
			'error_msg' => 'An error has occured'
			)

	),

	/*
	|--------------------------------------------------------------------------
	| Server
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Airship server
 	|
	*/

	'server' => array(

		'connection_error' => array(
			'error_num' => 1,
			'error_msg' => 'Could not connect to Airship Server'
			)

	)




)

?>