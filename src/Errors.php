<?php

$this->errors =  array(

	/*
	|--------------------------------------------------------------------------
	| List of Errors that can be returned to client on failure of various API calls
	|--------------------------------------------------------------------------
	*/


	/*
	|--------------------------------------------------------------------------
	| Airship SOAP errors
	|--------------------------------------------------------------------------
	|
	| Fallback error
 	|
	*/


	'airship' => array(

		'soap_fault' => array(
			'error_num' => 1,
			'error_msg' => 'SOAP Fault'
			)

	),


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
			'error_num' => 2,
			'error_msg' => 'Could not connect to Airship Server'
			)

	),


	/*
	|--------------------------------------------------------------------------
	| Contact API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Airship Contact API
 	|
	*/

	'contact' => array(

		'create_error' => array(
			'error_num' => 50,
			'error_msg' => 'There was a problem creating your contact'
			)

	)




)

?>