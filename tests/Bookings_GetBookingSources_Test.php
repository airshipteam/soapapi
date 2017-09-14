<?php
use  airshipwebservices\soapapi\AirshipBooking;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Booking_GetBookingSources_Test extends PHPUnit_Framework_TestCase {

	public function __construct(){
		parent::__construct();
	}

	/*
	|--------------------------------------------------------------------------
	| Get Booking Sources
	|--------------------------------------------------------------------------
	|
	| Successful call to get booking sources
 	|
	*/
	/**
	 * TEST GET BOOKING SOURCES
	 * Tests successful getBookingSources function
	 *		
	 * @return Boolean
	 */ 
	public function testGetBookingSources(){

		$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipBooking' )
						 ->setMethods( array('soapCall', 
											'prepareInput',
											'validateResponse') )
						 ->getMock();

		// We expect the connection to return true
		$this->mockSoap->expects( $this->once() )
			 ->method( 'prepareInput' )
			 ->will( $this->returnValue(true) );

		$soap_return = array();
		$soap_return[0] = new stdClass();
		$soap_return[0]->status = '1';
		$soap_return[0]->response = array( 'booking_enquiry_source_id' => '10', 'booking_enquiry_source_name' => '3rd Party' );
		
		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'soapCall' )
				 		 ->will( $this->returnValue( $soap_return ) );

		// Simulate validation and format the response  
		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'validateResponse' )
				 		 ->will( $this->returnValue( $soap_return ) );

		$this->assertEquals( $soap_return, $this->mockSoap->getBookingTypes() );
	}
}