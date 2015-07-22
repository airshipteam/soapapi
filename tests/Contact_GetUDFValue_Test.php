<?php
use  airshipwebservices\soapapi\AirshipContact;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Contact_GetUDFValue_Test extends PHPUnit_Framework_TestCase {

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
			* 	TEST GET UDF VALUE
			*
			*	@description 		Tests successful getUDFValue function
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testGetUDFValue(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'))
								 ->getMock();

		        // Soap is going to return our contact ID of 123456
				$soap_return_obj = 'plumber';

				
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
				$this->assertEquals( $return_obj, $this->mockSoap->getUDFValue(1234678,1234) );

			} 

			/*
			* 	TEST GET UDF VALUE - INVALID UDF
			*
			*	@description 		Tests unsuccessful getUDFValue function UDF doesn't exist
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testGetUDFValue_invalid_UDF(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'))
								 ->getMock();

		        // Soap is going to return our contact ID of 123456
				$soap_return_obj = new stdClass();
				$soap_return_obj->status = false;
				$soap_return_obj->error_number = 1;
				$soap_return_obj->error_message = 'SOAP Fault';
				$soap_return_obj->error_message = 'An error has occured';
				$soap_return_obj->soap_fault = 'UDFID 1234 not found on this contactID 1234678.';

				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'soapCall' )
						 		 ->will( $this->returnValue($soap_return_obj) );

				// We'll pretend that we've got a valid soap connection
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'prepareInput' )
						 		 ->will( $this->returnValue(true) );

				// We expect to get a successful response with the contact id
				$return_obj = $soap_return_obj;

				// Simulate validation and format the response  
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'validateResponse' )
						 		 ->will( $this->returnValue($return_obj) );

				// Do the test
				$this->assertEquals( $return_obj, $this->mockSoap->getUDFValue(1234678,1234) );

			} 

			/*
			* 	TEST GET UDF VALUE - INVALID CONTACT ID
			*
			*	@description 		Tests unsuccessful getUDFValue function contact id doesn't exist
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testGetUDFValue_invalid_contact(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'))
								 ->getMock();

		        // Soap is going to return our contact ID of 123456
				$soap_return_obj = new stdClass();
				$soap_return_obj->status = false;
				$soap_return_obj->error_number = 1;
				$soap_return_obj->error_message = 'SOAP Fault';
				$soap_return_obj->error_message = 'An error has occured';
				$soap_return_obj->soap_fault = 'ContactID: 1234678 is invalid';

				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'soapCall' )
						 		 ->will( $this->returnValue($soap_return_obj) );

				// We'll pretend that we've got a valid soap connection
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'prepareInput' )
						 		 ->will( $this->returnValue(true) );

				// We expect to get a successful response with the contact id
				$return_obj = $soap_return_obj;

				// Simulate validation and format the response  
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'validateResponse' )
						 		 ->will( $this->returnValue($return_obj) );

				// Do the test
				$this->assertEquals( $return_obj, $this->mockSoap->getUDFValue(1234678,1234) );

			} 

	
}