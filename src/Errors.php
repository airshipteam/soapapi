<?php

return array(

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
			'error_msg' => 'SOAP Fault',
			'error_customer' => 'An error has occured'
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
			'error_num' => 2,
			'error_msg' => 'An error has occured',
			'error_customer' => 'An error has occured'
			),

		'empty_array' => array(
			'error_num' => 105,
			'error_msg' => 'your search did not return any results',
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
			),

	),

	/*
	|--------------------------------------------------------------------------
	| Broadcast API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Airship Contact API
 	|
	*/

	'broadcast' => array(

		'send_eflyer_error' => array(
			'error_num' => 200,
			'error_msg' => 'There was a problem sending your eflyer',
			'error_customer' => 'An error has occured'
			)


	),

	/*
	|--------------------------------------------------------------------------
	| Statistics API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Airship Contact API
 	|
	*/

	'broadcast' => array(

		'unit_list' => array(
			'error_num' => 300,
			'error_msg' => 'There was a problem getting your request',
			'error_customer' => 'An error has occured'
			)
		
	),

	/*
	|--------------------------------------------------------------------------
	| WIFI Interaction API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Airship Contact API
 	|
	*/

	'wifi' => array(

		'create_wifi_interaction' => array(
			'error_num' => 400,
			'error_msg' => 'There was a problem creating this interaction',
			'error_customer' => 'An error has occured'
			),

		'create_wifi_interaction_history' => array(
			'error_num' => 401,
			'error_msg' => 'There was a problem creating this interaction',
			'error_customer' => 'An error has occured'
			)
		
	),

	/*
	|--------------------------------------------------------------------------
	| Booking API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Booking API
 	|
	*/

	'booking' => array(
		'no_params_set' => array(
			'error_num' => 500,
			'error_msg' => 'No search params were sent to booking request. Stopped to prevent all bookings being returned',
			'error_customer' => 'An error has occured'
		),
		'get_bookings_error' => array(
			'error_num' => 510,
			'error_msg' => 'There was an error getting bookings',
			'error_customer' => 'An error has occured'
		),
		'get_booking_notes_error' => array(
			'error_num' => 520,
			'error_msg' => 'There was an error getting booking notes',
			'error_customer' => 'An error has occured'
		),
		'get_booking_types_error' => array(
			'error_num' => 530,
			'error_msg' => 'There was an error getting booking types',
			'error_customer' => 'An error has occured'
		),
		'create_booking_error' => array(
			'error_num' => 540,
			'error_msg' => 'There was an error creating a booking',
			'error_customer' => 'An error has occured'
		)
	),

	/*
	|--------------------------------------------------------------------------
	| Feedback API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Feedback API
 	|
	*/
	'feedback' => array(
		'search_feedback_error' => array(
			'error_num' => 600,
			'error_msg' => 'There was an error searching for feedback',
			'error_customer' => 'An error has occured'
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Milestones API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Milestones API
 	|
	*/
	'milestones' => array(
		'get_milestones_error' => array(
			'error_num' => 700,
			'error_msg' => 'There was an error getting milestones for a contact',
			'error_customer' => 'An error has occured'
		),
		'get_star_rating_error' => array(
			'error_num' => 710,
			'error_msg' => 'There was an error getting star ratings for a contact',
			'error_customer' => 'An error has occured'
		),

	)
);


