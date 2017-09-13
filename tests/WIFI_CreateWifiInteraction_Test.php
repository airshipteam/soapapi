<?php

use  airshipwebservices\soapapi\AirshipWifiInteraction;

/*
* Run with vendor/bin/phpunit tests/
*/
 
class WIFI_CreateWifiInteraction_Test extends PHPUnit\Framework\TestCase {

	public function __construct(){
		parent::__construct();
	}

	/*
	|--------------------------------------------------------------------------
	| Create WIFI Interaction
	|--------------------------------------------------------------------------
	|
	| Test create WIFI interaction method
 	|
	*/

			/*
			* 	TEST CREATE WIFI INTERACTION 
			*
			*	@description 		Tests successful createWifiInteraction function
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testCreateWifiInteraction(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipWifiInteraction' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'))
								 ->getMock('airshipwebservices\soapapi\AirshipWifiInteraction');


				// Build our contact and assign the groups and UDFs
				$this->mockSoap->wifiinteraction_hotspot_name     = 'Airship Web Studio';
				$this->mockSoap->wifiinteraction_mac_name         = '00:A0:C9:14:C8:29';
				$this->mockSoap->wifiinteraction_device_mime_type = 'airshipapp';
				$this->mockSoap->wifiinteraction_interaction_type = 'detected';
				$this->mockSoap->wifiinteraction_contact_id       = 123456;


		        // Soap is going to return our contact ID of 123456
				$soap_return_obj = 1234;

				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'soapCall' )
						 		 ->will( $this->returnValue($soap_return_obj) );

				// We'll pretend that we've got a valid soap connection
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'prepareInput' )
						 		 ->will( $this->returnValue(true) );


				// We expect to get a successful response with the contact id
				$return_obj           = new stdClass();
				$return_obj->status   = true;
				$return_obj->response = $soap_return_obj;


				// Simulate validation and format the response  
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'validateResponse' )
						 		 ->will( $this->returnValue($return_obj) );

				// Do the test
				$this->assertEquals( $return_obj, $this->mockSoap->createWifiInteraction() );

			} 

			


			/*
			* 	TEST UPDATE CONTACT CONTACT DOESN'T EXIST
			*
			*	@description 		Tests unsuccessful updateContact function - COntact id doesn't exist
			*		
			*	@return BOOL 		BOOL
			*/
		 
			public function testCreateWifiInteractionHistory(){

				$this->mockSoap = $this->getMockBuilder( 'airshipwebservices\soapapi\AirshipWifiInteraction' )
								 ->setMethods( array('soapCall', 
													'prepareInput',
													'validateResponse'))
								 ->getMock();

				// Build our contact and assign the groups and UDFs
				$this->mockSoap->wifiinteraction_hotspot_name    = 'Airship Web Studio';
				$this->mockSoap->wifiinteraction_mac_name         = '00:A0:C9:14:C8:29';
				$this->mockSoap->wifiinteraction_device_mime_type = 'airshipapp';
				$this->mockSoap->wifiinteraction_interaction_type = 'detected';
				$this->mockSoap->wifiinteraction_contact_id       = 123456;
				$this->mockSoap->wifiinteraction_created_datetime = '2015-04-01 19:40:41';

		        // Soap is going to return our contact ID of 123456
				$soap_return_obj = 1234;
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
				$return_obj->response = 1234;

				// Simulate validation and format the response  
				$this->mockSoap->expects( $this->once() )
						 		 ->method( 'validateResponse' )
						 		 ->will( $this->returnValue($return_obj) );

				// Do the test
				$this->assertEquals( $return_obj, $this->mockSoap->createWifiInteractionHistory() );

			} 

	
}