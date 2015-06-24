<?php

return  array(

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
			'error_msg' => 'An error has occured',
			'error_customer' => 'An error has occured'
			)

	),


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
			'error_msg' => 'SOAP Fault',
			'error_customer' => 'An error has occured'
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
			'error_num' => 50,
			'error_msg' => 'Could not connect to Airship Server',
			'error_customer' => 'An error has occured'
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
			'error_num' => 100,
			'error_msg' => 'There was a problem creating your contact',
			'error_customer' => 'An error has occured'
			)

	)




)

?>