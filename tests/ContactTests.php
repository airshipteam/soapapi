<?php
use  airshipwebservices\soapapi\AirshipContact;
 
class ContactTests extends PHPUnit_Framework_TestCase {

	public function __construct(){
		parent::__construct();

		$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipContact' )
						 ->setMethods( array('soapCall') )
						 ->getMock();

		
	}
 
	public function testCreateContact(){

		$soap_return_obj = 123456;
		
		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'soapCall' )
				 		 ->will( $this->returnValue($soap_return_obj) );

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

		$return_obj = new stdClass();
		$return_obj->status = true;
		$return_obj->response = 123456;

		$this->assertEquals( $return_obj, $this->mockSoap->createContact() );
	} 

	
}