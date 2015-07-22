<?php
use  airshipwebservices\soapapi\AirshipContact;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Contact_UpdateContact_Test extends PHPUnit_Framework_TestCase {

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
			* 	TEST UPDATE CONTACT
			*
			*	@description 		Tests successful updateContact function
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testUpdateContact(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput'))
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

				// Build our contact and assign the groups and UDFs
				$this->mockSoap->contact['contactid']       = 123456;
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

				// We expect to get a successful response with the contact id
				$return_obj = new stdClass();
				$return_obj->status = true;
				$return_obj->response = 100;

				// Do the test
				$this->assertEquals( $return_obj, $this->mockSoap->updateContact() );

			} 

			/*
			* 	TEST UPDATE CONTACT CONTACT DOESN'T EXIST
			*
			*	@description 		Tests unsuccessful updateContact function - COntact id doesn't exist
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testUpdateContact_no_contact(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput'))
								 ->getMock();

		        // Soap is going to return an error as the contact ID we are passing in doesn't exist
				$soap_return_obj = new stdClass();
				$soap_return_obj->status = false;
				$soap_return_obj->error_number = 1;
				$soap_return_obj->error_message = 'SOAP Fault';
				$soap_return_obj->error_customer = 'An error has occured';
				$soap_return_obj->soap_fault = 'ContactID: 111588955 is invalid';

				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'soapCall' )
						 		 ->will( $this->returnValue($soap_return_obj) );

				// We'll pretend that we've got a valid soap connection
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'prepareInput' )
						 		 ->will( $this->returnValue(true) );

				// Build our contact and assign the groups and UDFs
				$this->mockSoap->contact['contactid']       = 123456;
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

				// We expect to get an unsuccessful response as contact id doesn't exist
				$return_obj = new stdClass();
				$return_obj->status = false;
				$return_obj->error_number = 1;
				$return_obj->error_message = 'SOAP Fault';
				$return_obj->error_customer = 'An error has occured';
				$return_obj->soap_fault = 'ContactID: 111588955 is invalid';

				// Do the test
				$this->assertEquals( $return_obj, $this->mockSoap->updateContact() );

			} 

	
}