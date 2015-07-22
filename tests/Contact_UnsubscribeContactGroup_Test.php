<?php
use  airshipwebservices\soapapi\AirshipContact;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Contact_UnsubscribeContactGroup_Test extends PHPUnit_Framework_TestCase {

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
			* 	TEST UNSUBSCRIBE CONTACT GROUP
			*
			*	@description 		Tests successful UnsubscribeContactGroup function
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testUnsubscribeContactGroup(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'))
								 ->getMock();

		        // Soap is going to return our contact ID of 123456
				$soap_return_obj = 100;


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
				$this->assertEquals( $return_obj, $this->mockSoap->unsubscribeContactGroup(123456, 1234) );

			} 

			/*
			* 	TEST UNSUBSCRIBE CONATCT GROUP - NOT IN GROUP
			*
			*	@description 		Tests unsuccessful unsubscribeContactGroup function contact doesn't exist in group
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testUnsubscribeContactGroup_contact_not_in_group(){

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
				$soap_return_obj->soap_fault = 'ContactID: 11158955 is not in GroupID: 1234';

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
				$this->assertEquals( $return_obj, $this->mockSoap->unsubscribeContactGroup(123456,1234) );

			} 


			/*
			* 	TEST UNSUBSCRIBE CONATCT GROUP - INVALID CONTACT
			*
			*	@description 		Tests unsuccessful unsubscribeContactGroup function contact doesn't exist
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testUnsubscribeContactGroup_invalid_contact(){

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
				$soap_return_obj->soap_fault = 'ContactID: 111589455 is invalid';

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
				$this->assertEquals( $return_obj, $this->mockSoap->unsubscribeContactGroup(123456,1234) );

			} 

	
}