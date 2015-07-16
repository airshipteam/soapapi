<?php
use  airshipwebservices\soapapi\AirshipContact;

/*
* Run with vendor/bin/phpunit tests/ContactTests
*/
 
class ContactTests extends PHPUnit_Framework_TestCase {

	public function __construct(){
		parent::__construct();
	}

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
											'prepareInput'))
						 ->getMock();

        // Soap is going to return our contact ID of 123456
		$soap_return_obj = 123456;
		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'soapCall' )
				 		 ->will( $this->returnValue($soap_return_obj) );

		// We'll pretend that we've got a valid soap connection
		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'prepareInput' )
				 		 ->will( $this->returnValue(true) );

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

		// We expect to get a successful response with the contact id
		$return_obj = new stdClass();
		$return_obj->status = true;
		$return_obj->response = 123456;

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

	
}