<?php

return array(

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
			'error_num' => 2,
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
			),

		'update_error' => array(
			'error_num' => 101,
			'error_msg' => 'There was a problem updating your contact',
			'error_customer' => 'An error has occured'
			),

		'get_error' => array(
			'error_num' => 102,
			'error_msg' => 'There was a problem getting your contact',
			'error_customer' => 'An error has occured'
			),

		'lookup_lastname_error' => array(
			'error_num' => 103,
			'error_msg' => 'There was a problem looking up last name',
			'error_customer' => 'An error has occured'
			),

		'lookup_lastname_noresults' => array(
			'error_num' => 104,
			'error_msg' => 'your search did not return any results',
			'error_customer' => 'An error has occured'
			),

		'lookup_udf_noresults' => array(
			'error_num' => 105,
			'error_msg' => 'your search did not return any results',
			'error_customer' => 'An error has occured'
			),

		'unsubscribe_error' => array(
			'error_num' => 106,
			'error_msg' => 'there was a problem unsubscribing your contacts',
			'error_customer' => 'An error has occured'
			),

		'unsubscribe_group_error' => array(
			'error_num' => 107,
			'error_msg' => 'there was a problem unsubscribing your contact',
			'error_customer' => 'An error has occured'
			),

		'udf_empty' => array(
			'error_num' => 108,
			'error_msg' => 'UDF is empty',
			'error_customer' => 'An error has occured'
			),

		'set_udf_error' => array(
			'error_num' => 109,
			'error_msg' => 'There as an error setting the UDF',
			'error_customer' => 'An error has occured'
			),

		'get_group_interactions_empty' => array(
			'error_num' => 110,
			'error_msg' => 'There are no interactions within this group',
			'error_customer' => 'An error has occured'
			),

		'delete_group_interactions_error' => array(
			'error_num' => 111,
			'error_msg' => 'there was a problem deleting records',
			'error_customer' => 'An error has occured'
			)



	)




)

?>