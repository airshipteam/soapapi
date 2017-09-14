<?php
use  airshipwebservices\soapapi\AirshipUniqueCodes;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class UniqueCodes_addUniqueCodeContact_Test extends PHPUnit\Framework\TestCase {

	public function __construct(){
		parent::__construct();
	}

	/*
	|--------------------------------------------------------------------------
	| Add Uniquecode to Contact
	|--------------------------------------------------------------------------
	|
	| Tests the API call to add uniquecode to a contact
 	|
	*/
	/**
	* TEST UNIQUECODE ADDUNIQUECODECONTACT
	* Tests successful addUniqueCodeContact function
	*		
	* @return Boolean
	*/ 
	public function testAddUniqueCodeContact(){	

		$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipUniqueCodes' )
						 ->setMethods( array('soapCall', 
											'prepareInput',
											'validateResponse') )
						 ->getMock();
	
		$return = 0;
		
		$this->mockSoap->expects( $this->once() )
				 	   ->method( 'soapCall' )
				 	   ->will( $this->returnValue($return) );

		// We'll pretend that we've got a valid soap connection
		$this->mockSoap->expects( $this->once() )
				 	   ->method( 'prepareInput' )
				 	   ->will( $this->returnValue(true) );

		// We expect to get a successful response with the contact id
		$return_obj = new stdClass();
		$return_obj->status = true;
		$return_obj->response = $return;
	
		// Simulate validation and format the response  
		$this->mockSoap->expects( $this->once() )
				 	   ->method( 'validateResponse' )
				 	   ->will( $this->returnValue($return_obj) );

		$ucgid = 604;
		$uniquecodes = "02970011";
		$contact_id = 18947799;	

		$this->assertEquals( $return_obj, $this->mockSoap->addUniqueCodeContact( $ucgid, $uniquecodes, $contact_id ) );
	}	
}

