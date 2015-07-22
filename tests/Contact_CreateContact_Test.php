<?php
use  airshipwebservices\soapapi\AirshipContact;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Contact_CreateContact_Test extends PHPUnit_Framework_TestCase {

	public function __construct(){
		parent::__construct();
	}

	/*
	|--------------------------------------------------------------------------
	| Create Contact
	|--------------------------------------------------------------------------
	|
	| Test create contact method
 	|
	*/

			/*
			* 	TEST CREATE CONTACT
			*
			*	@description 		Tests successful createContact function
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testCreateContact(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'
													))
								 ->getMock();

				// Build our contact and assign the groups and UDFs
				$this->mockSoap->contact['title']           = 'Mr';
				$this->mockSoap->contact['gender']          = 'M';
				$this->mockSoap->contact['firstname']       = 'Peter';
				$this->mockSoap->contact['lastname']        = 'Tecks';
				$this->mockSoap->contact['email']           = 'peter@tecks.com';
				$this->mockSoap->contact['mobilenumber']    = '07706000000';
				$this->mockSoap->contact['allowsms']        = 'Y';
				$this->mockSoap->contact['allowemail']      = 'Y';

				$this->mockSoap->groups[]                   = 1234;
				$this->mockSoap->udfs[]                     = array("udfnameid"=>79, 
				                                                    "data"=>"Test Co", 
				                                                    "type"=>"Text");

		        // Soap is going to return our contact ID of 123456
				$soap_return_obj = 123456;
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
				$return_obj->response = 123456;

				// Simulate validation and format the response  
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'validateResponse' )
						 		 ->will( $this->returnValue($return_obj) );
				
				// Do the test
				$this->assertEquals( $return_obj, $this->mockSoap->createContact() );

			} 

			/*
			* 	TEST CREATE CONTACT SOAP DOWN
			*
			*	@description 		Tests the create contact function when SOAP server is down.
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testCreateContact_SOAP_down(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods(null)
								 ->getMock();

				// Build our contact and assign the groups and UDFs
				$this->mockSoap->contact['title']           = 'Mr';
				$this->mockSoap->contact['gender']          = 'M';
				$this->mockSoap->contact['firstname']       = 'Peter';
				$this->mockSoap->contact['lastname']        = 'Tecks';
				$this->mockSoap->contact['email']           = 'peter@tecks.com';
				$this->mockSoap->contact['mobilenumber']    = '07706000000';
				$this->mockSoap->contact['allowsms']        = 'Y';
				$this->mockSoap->contact['allowemail']      = 'Y';

				$this->mockSoap->groups[]                   = 1234;
				$this->mockSoap->udfs[]                     = array("udfnameid"=>79, 
				                                                    "data"=>"Test Co", 
				                                                    "type"=>"Text");

				// We expect to get an unsuccessful response with the server down
				$return_obj = new stdClass();
				$return_obj->status = false;
				$return_obj->error_number = 50;
				$return_obj->error_message = 'Could not connect to Airship Server';
				$return_obj->error_customer = 'An error has occured';

				// Do the test
				$this->assertEquals( $return_obj, $this->mockSoap->createContact() );

			} 

			/*
			* 	TEST CREATE CONTACT NO CONTACT DETAILS
			*
			*	@description 		Tests the create contact function when no contact is specified
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testCreateContact_no_contact(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'
													))
								 ->getMock();

		        // Soap is going to return an error as no details have been given
				$soap_return_obj = new stdClass();
				$soap_return_obj->status = false;
				$soap_return_obj->error_number = 1;
				$soap_return_obj->error_message = 'SOAP Fault';
				$soap_return_obj->error_customer = 'An error has occured';
				$soap_return_obj->soap_fault = 'An error has occured';

				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'soapCall' )
						 		 ->will( $this->returnValue($soap_return_obj) );

				// We'll pretend that we've got a valid soap connection
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'prepareInput' )
						 		 ->will( $this->returnValue(true) );

				// We expect to get an unsuccessful response 
				$return_obj = new stdClass();
				$return_obj->status = false;
				$return_obj->error_number = 1;
				$return_obj->error_message = 'SOAP Fault';
				$return_obj->error_customer = 'An error has occured';
				$return_obj->soap_fault = 'An error has occured';

				// Simulate validation and format the response  
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'validateResponse' )
						 		 ->will( $this->returnValue($return_obj) );

				// Do the test
				$this->assertEquals( $return_obj, $this->mockSoap->createContact() );

			} 


			/*
			* 	TEST CREATE CONTACT INVALID EMAIL ADDRESS
			*
			*	@description 		Tests the create contact function when an invalid emaila ddress is supplied
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testCreateContact_invalid_email(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'
													))
								 ->getMock();

				// Build our contact and assign the groups and UDFs
				$this->mockSoap->contact['title']           = 'Mr';
				$this->mockSoap->contact['gender']          = 'M';
				$this->mockSoap->contact['firstname']       = 'Peter';
				$this->mockSoap->contact['lastname']        = 'Tecks';
				$this->mockSoap->contact['email']           = 'peter@tecks.';
				$this->mockSoap->contact['mobilenumber']    = '07706000000';
				$this->mockSoap->contact['allowsms']        = 'Y';
				$this->mockSoap->contact['allowemail']      = 'Y';

				$this->mockSoap->groups[]                   = 1234;
				$this->mockSoap->udfs[]                     = array("udfnameid"=>79, 
				                                                    "data"=>"Test Co", 
				                                                    "type"=>"Text");

		        // Soap is going to return an error as the email address is invalid
				$soap_return_obj = new stdClass();
				$soap_return_obj->status = false;
				$soap_return_obj->error_number = 1;
				$soap_return_obj->error_message = 'SOAP Fault';
				$soap_return_obj->error_customer = 'Email address is invalid';
				$soap_return_obj->soap_fault = 'Email address is invalid';

				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'soapCall' )
						 		 ->will( $this->returnValue($soap_return_obj) );

				// We'll pretend that we've got a valid soap connection
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'prepareInput' )
						 		 ->will( $this->returnValue(true) );

				

				// We expect to get an unsuccessful response 
				$return_obj = new stdClass();
				$return_obj->status = false;
				$return_obj->error_number = 1;
				$return_obj->error_message = 'SOAP Fault';
				$return_obj->error_customer = 'Email address is invalid';
				$return_obj->soap_fault = 'Email address is invalid';

				// Simulate validation and format the response  
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'validateResponse' )
						 		 ->will( $this->returnValue($return_obj) );

				// Do the test
				$this->assertEquals( $return_obj, $this->mockSoap->createContact() );

			}

	
}