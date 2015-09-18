<?php
use  airshipwebservices\soapapi\AirshipBooking;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Booking_GetBookingNotes_Test extends PHPUnit_Framework_TestCase {

	public function __construct(){
		parent::__construct();
	}

	/*
	|--------------------------------------------------------------------------
	| Get Booking Notes
	|--------------------------------------------------------------------------
	|
	| Successful call to get booking notes
 	|
	*/
	/**
	 * TEST GET BOOKING NOTES
	 * Tests successful getBookingNotes function
	 *		
	 * @return Boolean
	 */ 
	public function testGetBookingNotes(){
		$booking_id = 614708;		

		$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipBooking' )
						 ->setMethods( array('soapCall', 
											'checkConnection',
											'validateResponse') )
						 ->getMock();

		// We expect the connection to return true
 		$connection_reponse = array( 'success' => true, 'message' => false );
		$this->mockSoap->expects( $this->once() )
			 ->method( 'checkConnection' )
			 ->will( $this->returnValue($connection_reponse) );

		$soap_return_obj = new stdClass();
		$soap_return_obj->booking_note = new stdClass();
		$soap_return_obj->booking_note->booking_note_id = '142968';
		$soap_return_obj->booking_note->booking_note_booking_id = '614708';
		$soap_return_obj->booking_note->booking_note_pt_user_id = '0';
		$soap_return_obj->booking_note->booking_note_text = 'This is a test note for booking id 61470';
		$soap_return_obj->booking_note->booking_note_created_datetime = '2015-09-18 11:00:00';

		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'soapCall' )
				 		 ->will( $this->returnValue( array($soap_return_obj) ) );

		// We expect to get a successful response with the contact id
		$return_obj = new stdClass();
		$return_obj->status = true;
		$return_obj->response = array( $soap_return_obj );
	
		// Simulate validation and format the response  
		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'validateResponse' )
				 		 ->will( $this->returnValue($return_obj) );

		$this->assertEquals( $return_obj, $this->mockSoap->getBookingNotes( $booking_id ) );
	}

	/**
	 * TEST INVALID BOOKING ID
	 * Tests invalid booking id
	 *		
	 * @return Boolean
	 */ 
	public function testInvlaidBookingId(){
		$booking_id = 999999999999999;		

		$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipBooking' )
						 ->setMethods( array('soapCall', 
											'checkConnection',
											'validateResponse') )
						 ->getMock();

		// We expect the connection to return true
 		$connection_reponse = array( 'success' => true, 'message' => false );
		$this->mockSoap->expects( $this->once() )
			 ->method( 'checkConnection' )
			 ->will( $this->returnValue($connection_reponse) );

		$soap_return_obj = new stdClass();
		$soap_return_obj->status = false;
		$soap_return_obj->error_number = 1;
		$soap_return_obj->error_message = 'SOAP Fault';
		$soap_return_obj->error_customer = 'An error has occured';
		$soap_return_obj->soap_fault = 'invalid booking_id';

		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'soapCall' )
				 		 ->will( $this->returnValue( $soap_return_obj ) );

		// Simulate validation and format the response  
		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'validateResponse' )
				 		 ->will( $this->returnValue($soap_return_obj) );

		$this->assertEquals( $soap_return_obj, $this->mockSoap->getBookingNotes( $booking_id ) );
	}
}