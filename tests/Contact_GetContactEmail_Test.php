<?php
use  airshipwebservices\soapapi\AirshipContact;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Contact_GetContactEmail_Test extends PHPUnit\Framework\TestCase {

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
			* 	TEST GET CONTACT EMAIL
			*
			*	@description 		Tests successful getContactEmail function
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testGetContactEmail(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'))
								 ->getMock();

		        // Soap is going to return our contact ID of 123456
				$soap_return_obj = new stdClass();
				$soap_return_obj->contactData = new stdClass();
				$soap_return_obj->contactData->contactid = 11158955;
				$soap_return_obj->contactData->title = 'Mr';
				$soap_return_obj->contactData->firstname = 'Peter';
				$soap_return_obj->contactData->lastname = 'Tecks';
				$soap_return_obj->contactData->dob = '1988-02-02';
				$soap_return_obj->contactData->mobilenumber = '447706298287';
				$soap_return_obj->contactData->email = 'peter@tecks.co.uk';
				$soap_return_obj->contactData->allowsms = 'N';
				$soap_return_obj->contactData->allowcall = 'N';
				$soap_return_obj->contactData->allowemail = 'Y';
				$soap_return_obj->contactData->allowsnailmail = 'N';

				$soap_return_obj->udfs = array();
				$soap_return_obj->udfs[0] = new stdClass();
				$soap_return_obj->udfs[0]->udfnameid = 360;

				$soap_return_obj->udfs[1] = new stdClass();
				$soap_return_obj->udfs[1]->udfnameid = 2174;
				$soap_return_obj->udfs[1]->data = 'work';

				$soap_return_obj->groups = array();
				$soap_return_obj->groups[] = 123456;

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
				$this->assertEquals( $return_obj, $this->mockSoap->getContactEmail('peter@tecks.co.uk') );

			} 

			/*
			* 	TEST GET CONTACT EMAIL - NO CONTACT
			*
			*	@description 		Tests unsuccessful getContactEmail function contact doesn't exist
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testGetContact_no_contact(){

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
				$soap_return_obj->soap_fault = 'ContactID: 11158 does not exist for AccountID: 42';

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
				$this->assertEquals( $return_obj, $this->mockSoap->getContact('peter@tecks.co.uk') );

			} 

	
}