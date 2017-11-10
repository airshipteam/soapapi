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
		'get_contact_social' => array(
			'error_num' => 120,
			'error_msg' => 'there was a problem getting social data for this contact',
			'error_customer' => 'An error has occured'
		),
		'get_contact_photo' => array(
			'error_num' => 130,
			'error_msg' => 'there was a problem getting photo data for this contact',
			'error_customer' => 'An error has occured'
		),
		'set_contact_photo' => array(
			'error_num' => 140,
			'error_msg' => 'there was a problem setting photo data for this contact',
			'error_customer' => 'An error has occured'
		),
		'set_contact_social' => array(
			'error_num' => 150,
			'error_msg' => 'there was a problem setting social data for this contact',
			'error_customer' => 'An error has occured'
		),
		'contact_validation' => array(
			'error_num' => 160,
			'error_msg' => 'there was a problem validating the passed data',
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
			),
		'send_forced_eflyer_error' => array(
			'error_num' => 210,
			'error_msg' => 'There was a problem sending your eflyer',
			'error_customer' => 'An error has occured'
			),
		'send_new_tflyer_error' => array(
			'error_num' => 220,
			'error_msg' => 'There was a problem sending your tflyer',
			'error_customer' => 'An error has occured'
			),
		'send_new_eflyer_broadcast_error' => array(
			'error_num' => 230,
			'error_msg' => 'There was a problem sending your eflyer',
			'error_customer' => 'An error has occured'
			),
		'schedule_new_tflyer_error' => array(
			'error_num' => 240,
			'error_msg' => 'There was a problem scheduling your tflyer',
			'error_customer' => 'An error has occured'
			),
		'schedule_new_tflyer_count' => array(
			'error_num' => 250,
			'error_msg' => 'There was a problem getting your count',
			'error_customer' => 'An error has occured'
			),
		'cancel_scheduled_sms' => array(
			'error_num' => 260,
			'error_msg' => 'There was a problem cancelling your broadcast',
			'error_customer' => 'An error has occured'
		),

	),

	/*
	|--------------------------------------------------------------------------
	| Statistics API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Airship Contact API
 	|
	*/

	'statistics' => array(

		'unit_list' => array(
			'error_num' => 300,
			'error_msg' => 'There was a problem getting your request',
			'error_customer' => 'An error has occured'
			),
		'group_list' => array(
			'error_num' => 310,
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
			),
		'get_wifi_interactions_error' => array(
			'error_num' => 402,
			'error_msg' => 'There was an error getting wifi interactions',
			'error_customer' => 'An error has occured'
			),
		'assign_interaction_unit_error' => array(
			'error_num' => 403,
			'error_msg' => 'There was an error assigning wifi interaction unit',
			'error_customer' => 'An error has occured'
			),
		
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
		),
		'get_booking_sources_error' => array(
			'error_num' => 550,
			'error_msg' => 'There was an error getting booking sources',
			'error_customer' => 'An error has occured'
		),
		'update_booking_error' => array(
			'error_num' => 560,
			'error_msg' => 'There was an error updating the booking',
			'error_customer' => 'An error has occured'
		),
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

		'create_feedback_error' => array(
			'error_num' => 601,
			'error_msg' => 'There was an error creating this feedback',
			'error_customer' => 'An error has occured'
		),

		'no_params_set' => array(
			'error_num' => 602,
			'error_msg' => 'No search params were sent to feedback request. Stopped to prevent all feedback being returned',
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

	),


	/*
	|--------------------------------------------------------------------------
	| Admin API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Airship Admin API
 	|
	*/

	'admin' => array(

		'get_error' => array(
			'error_num' => 800,
			'error_msg' => 'There was an error retrieving your details',
			'error_customer' => 'There was an error retrieving your details'
			),

		'get_users_error' => array(
			'error_num' => 810,
			'error_msg' => 'There was an error retrieving user details',
			'error_customer' => 'There was an error retrieving user details'
			)


	),

	

	/*
	|--------------------------------------------------------------------------
	| UNIQUE CODE API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Airship UNIQUE CODE API
 	|
	*/

	'uniquecode' => array(

		'redeem_unique_code_error' => array(
			'error_num' => 900,
			'error_msg' => 'There was a problem redeeming the code',
			'error_customer' => 'There was a problem redeeming the code'
			),
		'unique_code_get_data_error' => array(
			'error_num' => 910,
			'error_msg' => 'There was a problem getting the code data',
			'error_customer' => 'There was a problem getting the code data'
			),
		'contact_get_unique_codes_error' => array(
			'error_num' => 920,
			'error_msg' => 'There was a problem getting the code data',
			'error_customer' => 'There was a problem getting the code data'
			),
		'add_unique_code_contact_error' => array(
			'error_num' => 930,
			'error_msg' => 'There was a problem adding uniquecode to contact',
			'error_customer' => 'There was a problem adding uniquecode to contact'
			),

	),
	/*
	|--------------------------------------------------------------------------
	| UNSUBSCRIBE UNIT API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Airship UNSUBSCRIBE UNIT API
 	|
	*/

	'uniquecode' => array(

		'not_units_returned' => array(
			'error_num' => 1000,
			'error_msg' => 'There was a problem getting units',
			'error_customer' => 'Server error'
		)

	),

	/*
	|--------------------------------------------------------------------------
	| SEARCH  API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Airship UNSUBSCRIBE UNIT API
 	|
	*/

	'search' => array(

		'search_contact_udf_response' => array(
			'error_num' => 1100,
			'error_msg' => 'There was a problem searching the contact UDF',
			'error_customer' => 'Server error'
		)

	),


	/*
	|--------------------------------------------------------------------------
	| UNSUBSCRIBE UNIT API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Airship UNSUBSCRIBE UNIT API
 	|
	*/

	'unitunsubscribe' => array(

		'not_units_returned' => array(
			'error_num' => 1200,
			'error_msg' => 'An error has occured retrieving last interacted unit',
			'error_customer' => 'Server error'
		)

	),


	/*
	|--------------------------------------------------------------------------
	| UnitManager API
	|--------------------------------------------------------------------------
	|
	| Errors that can be returned when trying to access the Airship Admin API
 	|
	*/

	'unitmanager' => array(

		'get_unit_bespoke_map_error' => array(
			'error_num' => 1300,
			'error_msg' => 'There was an error retrieving the unit map',
			'error_customer' => 'There was an error retrieving the unit map'
			),

		'get_unit_error' => array(
			'error_num' => 1310,
			'error_msg' => 'There was an error retrieving the unit',
			'error_customer' => 'There was an error retrieving the unit'
			),

	),
);


