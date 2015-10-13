<?php
use  airshipwebservices\soapapi\AirshipMilestones;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Milestones_ContactMilestones_Test extends PHPUnit_Framework_TestCase {

	public function __construct(){
		parent::__construct();
	}

	/*
	|--------------------------------------------------------------------------
	| Get Contact Milestones
	|--------------------------------------------------------------------------
	|
	| Tests the API call to return milestones for a contact
 	|
	*/
	/**
	* TEST CONTACT MILESTONES
	* Tests successful getContactMilestones function
	*		
	* @return Boolean
	*/ 
	public function testContactMilestones(){	

		$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipMilestones' )
						 ->setMethods( array('soapCall', 
											'prepareInput',
											'validateResponse') )
						 ->getMock();

		$promoter_obj = new stdClass();
		$promoter_obj->milestoneid = 1;
		$promoter_obj->milestonename = 'Known Promoter';
		$promoter_obj->milestoneid = 'n';
		$promoter_obj->milestoneid = '0000-00-00 00:00:00';

		$detractor_obj = new stdClass();
		$detractor_obj->milestoneid = 2;
		$detractor_obj->milestonename = 'Known Detractor';
		$detractor_obj->milestoneid = 'y';
		$detractor_obj->milestoneid = '0000-00-00 00:00:00';

		$return = array(
			$promoter_obj,
			$detractor_obj
		);

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

		$contact_id = 12040469;	
		$this->assertEquals( $return_obj, $this->mockSoap->getContactMilestones( $contact_id ) );
	}	
}

