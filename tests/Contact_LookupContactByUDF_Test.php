<?php
use  airshipwebservices\soapapi\AirshipContact;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Contact_LookupContactByUDF_Test extends PHPUnit_Framework_TestCase {

	public function __construct(){
		parent::__construct();
	}

	/*
	|--------------------------------------------------------------------------
	| Update Contact
	|--------------------------------------------------------------------------
	|
	| Test update contact method
 	|
	*/

			/*
			* 	LOOKUP CONTACT BY UDF
			*
			*	@description 		Tests successful lookup contact by UDF function
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testGetContactUDF(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'))
								 ->getMock();

		        // Soap is going to return our contact ID of 11158955
				$soap_return_obj = 11158955;
			
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

				// Do the test
				$this->assertEquals( $return_obj, $this->mockSoap->lookupContactByUDF('2176', 'plumber') );

			} 

			/*
			* 	TEST LOOKUP CONTACT BY UDF - NOT UNIQUE UDF
			*
			*	@description 		Test lookup contact by UDF call with a non unqiue UDF
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testGetContactUDF_not_unique(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'))
								 ->getMock();

		        // Soap is going to return an error as UDF is not unique
				$soap_return_obj = new stdClass();
				$soap_return_obj->status = false;
				$soap_return_obj->error_number = 1;
				$soap_return_obj->error_message = 'SOAP Fault';
				$soap_return_obj->error_customer = 'An error has occured';
				$soap_return_obj->soap_fault = 'UDF ID: 2176 is not a unique UDF';

				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'soapCall' )
						 		 ->will( $this->returnValue($soap_return_obj) );

				// We'll pretend that we've got a valid soap connection
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'prepareInput' )
						 		 ->will( $this->returnValue(true) );


				// We expect to get an unsuccessful response with the contact id
				$return_obj = $soap_return_obj;

				// Simulate validation and format the response  
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'validateResponse' )
						 		 ->will( $this->returnValue($return_obj) );

				// Do the test
				$this->assertEquals( $return_obj, $this->mockSoap->lookupContactByUDF('2176', 'plumber') );

			} 

	
}