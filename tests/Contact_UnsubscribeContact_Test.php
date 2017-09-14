<?php
use  airshipwebservices\soapapi\AirshipContact;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Contact_UnsubscribeContact_Test extends PHPUnit_Framework_TestCase {

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
			* 	TEST UNSUBSCRIBE CONTACT
			*
			*	@description 		Tests successful unsubscribe Contact function
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testUnsubscribeContact(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'))
								 ->getMock();

		        // Soap is going to return 100 as success
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
				$this->assertEquals( $return_obj, $this->mockSoap->unsubscribeContact(array('peter@tecks.co.uk', '07706298287')));

			} 

			/*
			* 	TEST GET CONTACT - EMPTY ARRAY
			*
			*	@description 		Tests unsuccessful unsubscribe contact function contact array blank
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testGetContact_empty_array(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'))
								 ->getMock();

		        // Soap is going to return an error
				$soap_return_obj = new stdClass();
				$soap_return_obj->status = false;
				$soap_return_obj->error_number = 1;
				$soap_return_obj->error_message = 'SOAP Fault';
				$soap_return_obj->error_message = 'An error has occured';
				$soap_return_obj->soap_fault = 'No Data to Unsubscribe';

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
				$this->assertEquals( $return_obj, $this->mockSoap->getContact(array()) );

			} 



			/*
			* 	TEST GET CONTACT - non array
			*
			*	@description 		Tests unsuccessful unsubscribe contact function contact non array given
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testGetContact_non_array(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'))
								 ->getMock();

		        // Soap is going to return an error
				$soap_return_obj = new stdClass();
				$soap_return_obj->status = false;
				$soap_return_obj->error_number = 1;
				$soap_return_obj->error_message = 'SOAP Fault';
				$soap_return_obj->error_message = 'An error has occured';
				$soap_return_obj->soap_fault = 'No Data to Unsubscribe';

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
				$this->assertEquals( $return_obj, $this->mockSoap->getContact('peter.tecks@tecks.com') );

			} 

	
}