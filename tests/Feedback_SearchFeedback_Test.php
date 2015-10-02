<?php
use  airshipwebservices\soapapi\AirshipBooking;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class Feedback_SearchFeedback_Test extends PHPUnit_Framework_TestCase {

	public function __construct(){
		parent::__construct();
	}

	/*
	|--------------------------------------------------------------------------
	| Search Feedback
	|--------------------------------------------------------------------------
	|
	| Test search feedback
 	|
	*/
	/**
	* TEST SEARCH FEEDBACK
	* Tests successful search Feedback function
	*		
	* @return Boolean
	*/ 
	public function testSearchFeedback(){
		$contact_id = 12040469;

		$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipFeedback' )
						 ->setMethods( array('soapCall', 
											'checkConnection',
											'validateResponse') )
						 ->getMock();

		// We expect the connection to return true
 		$connection_reponse = array( 'success' => true, 'message' => false );
		$this->mockSoap->expects( $this->once() )
			 ->method( 'checkConnection' )
			 ->will( $this->returnValue($connection_reponse) );

		 // Soap is going to return bookings of our contact ID of 12040469
		$soap_return_obj = new stdClass();
		$soap_return_obj->feedback = new stdClass();
		$soap_return_obj->feedback->feedback_id = 614708;
		$soap_return_obj->feedback->feedback_contact_id = $contact_id;
		$soap_return_obj->feedback->feedback_unit_id = 121;
		$soap_return_obj->feedback->feedback_source_id = 4;
        $soap_return_obj->feedback->feedback_type_id = 1;        
      	$soap_return_obj->feedback->feedback_created_datetime = '2015-09-18 11:46:54';

       	$ratings = new stdClass();
      	$ratings->feedback_rating_category_id = 3;
        $ratings->feedback_rating_text = 'Very Satisfied';
        $ratings->feedback_note_text = 'Hot and Spicy just how I like my curries';

         $soap_return_obj->feedback_ratings = array( $ratings );

      	$comments = new stdClass();
      	$comments->feedback_note_type = 'contact';
        $comments->feedback_note_text = 'The outside is a bit dated';        

      	$soap_return_obj->feedback_comments = array( $comments );

      	$this->mockSoap->expects( $this->once() )
				 		 ->method( 'soapCall' )
				 		 ->will( $this->returnValue($soap_return_obj) );

		// We expect to get a successful response with the contact id
		$return_obj = new stdClass();
		$return_obj->status = true;
		$return_obj->response = array( $soap_return_obj );

		// Simulate validation and format the response  
		$this->mockSoap->expects( $this->once() )
				 		 ->method( 'validateResponse' )
				 		 ->will( $this->returnValue($return_obj) );

		// Set params for the call
		$params = array();
		$params['EqualsArgs'] = array();
		$params['EqualsArgs']['booking_contact_id'] = $contact_id; // exact match args

		$params['InSQLArgs'] = array();
		$params['InSQLArgs']['booking_unit_id'] = '121';

		$params['GreaterThanArgs'] = array();
		$params['LessThanArgs'] = array();
		$params['myResultOptions'] = array(
			'result_limit' => '10',
			'result_offset' => '0'
		);

		$this->assertEquals( $return_obj, $this->mockSoap->getFeedback( $params ) );
	}
}