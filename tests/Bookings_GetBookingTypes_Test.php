<?php
use  airshipwebservices\soapapi\AirshipBooking;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Booking_GetBookingTypes_Test extends PHPUnit\Framework\TestCase {

	public function __construct(){
		parent::__construct();
	}

	/*
	|--------------------------------------------------------------------------
	| Get Booking Types
	|--------------------------------------------------------------------------
	|
	| Successful call to get booking types
 	|
	*/
	/**
	 * TEST GET BOOKING TYPES
	 * Tests successful getBookingTypes function
	 *		
	 * @return Boolean
	 */ 
	public function testGetBookingTypes(){

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
		$soap_return[0]->booking_type_id = '1';
		$soap_return[0]->booking_type_name = 'foobar';
		
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