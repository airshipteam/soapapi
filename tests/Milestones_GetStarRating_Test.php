<?php
use  airshipwebservices\soapapi\AirshipMilestones;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Milestones_GetStarRating_Test extends PHPUnit\Framework\TestCase {

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
	public function testStarRatingMilestones(){	

		$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipMilestones' )
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

		$contact_id = 12040469;	
		$this->assertEquals( $return_obj, $this->mockSoap->getStarRating( $contact_id ) );
	}	
}

