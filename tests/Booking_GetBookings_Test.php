<?php
use  airshipwebservices\soapapi\AirshipBooking;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Booking_GetBookings_Test extends PHPUnit\Framework\TestCase {

	public function __construct(){
		parent::__construct();
	}

	/*
	|--------------------------------------------------------------------------
	| Get Bookings
	|--------------------------------------------------------------------------
	|
	| Test get bookings contact method
 	|
	*/
	/**
	* TEST GET BOOKINGS
	* Tests successful getContact function
	*		
	* @return Boolean
	*/ 
	public function testGetBookings(){

		$contact_id = 12040469;		

		$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipBooking' )
						 ->setMethods( array('soapCall', 
											'prepareInput',
											'validateResponse') )
						 ->getMock();

	    // Soap is going to return bookings of our contact ID of 12040469
		$soap_return_obj = new stdClass();
		$soap_return_obj->booking = new stdClass();
		$soap_return_obj->booking->booking_id = 614708;
		$soap_return_obj->booking->booking_contact_id = $contact_id;
		$soap_return_obj->booking->booking_unit_id = 121;
        $soap_return_obj->booking->booking_type_id = 2;
        $soap_return_obj->booking->booking_stage_value = 1;
        $soap_return_obj->booking->booking_enquiry_datetime = '2015-03-21 21:00:06';
        $soap_return_obj->booking->booking_enquiry_source_id = 2;
        $soap_return_obj->booking->booking_party_datetime = '2015-06-10 20:00:00';
        $soap_return_obj->booking->booking_party_size = 8;
        $soap_return_obj->booking->booking_deposit_paid = '0.00';
        $soap_return_obj->booking->booking_hpbr_food = '0.00';
        $soap_return_obj->booking->booking_hpbr_drink = '0.00';
        $soap_return_obj->booking->booking_hpbr_entertainment = '0.00';
        $soap_return_obj->booking->booking_data_element_03 = 'milk';
        $soap_return_obj->booking->booking_data_element_20 = 'lobster';

		$soap_return_obj->booking_areas = array();
		$soap_return_obj->booking_areas[0] = 109;
		$soap_return_obj->booking_areas[1] = 108;
		
		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'soapCall' )
				 		 ->will( $this->returnValue($soap_return_obj) );

		// We'll pretend that we've got a valid soap connection
		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'prepareInput' )
				 		 ->will( $this->returnValue(true) );


		// We expect to get a successful response with the contact id
		$return_obj = new stdClass();
		$return_obj->status = true;
		$return_obj->response = $soap_return_obj;
	
		// Simulate validation and format the response  
		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'validateResponse' )
				 		 ->will( $this->returnValue($return_obj) );

		// Set params for the call
		$params = array();
		$params['EqualsArgs'] = array();
		$params['EqualsArgs']['booking_contact_id'] = $contact_id; // exact match args

		$params['InSQLArgs'] = array();
		$params['InSQLArgs']['booking_unit_id'] = '121';

		$params['GreaterThanArgs'] = array();
		$params['LessThanArgs'] = array();
		$params['myResultOptions'] = array(
			'result_limit' => '1',
			'result_offset' => '0'
		);

		// Do the test
		$this->assertEquals( $return_obj, $this->mockSoap->getBookings( $params ) );
	} 

	/**
	 * TEST GET BOOKINGS NO PARAMS
	 * Tests failed call due to no params
	 *		
	 * @return Boolean
	 */ 
	public function testGetBookingsNoParams(){	
		$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipBooking' )
						 ->setMethods( array('soapCall', 
											'prepareInput',
											'validateResponse') )
						 ->getMock();

		$params = array();
		$no_params_error = new stdClass();
		$no_params_error->status = false;
		$no_params_error->error_number = 500;
		$no_params_error->error_message = 'No search params were sent to booking request. Stopped to prevent all bookings being returned';
		$no_params_error->error_customer = 'An error has occured';

		$this->assertEquals( $no_params_error, $this->mockSoap->getBookings( $params ) );
	}	
}