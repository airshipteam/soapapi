<?php namespace airshipwebservices\soapapi {
	
	class AirshipWifiInteraction extends Airship{

		public $wifiinteraction_hotspot_name     = false;
		public $wifiinteraction_mac_name         = false;
		public $wifiinteraction_device_mime_type = false;
		public $wifiinteraction_interaction_type = false;
		public $wifiinteraction_contact_id       = false;
		public $wifiinteraction_created_datetime = false;
		
		public  $wsdl;             // Alphanumeric
		
		public function __construct()
			{
				parent::__construct();
				$this->wsdl = 'WifiInteraction.wsdl';
			}


		/*
		* 	PREPARE INPUT
		*
		*	@description 		prepares input array and checks we havea valid soap connection
		*
		*	@param 	string 		action
		*
		*	@return int 		mixed
		*/

		protected function prepareInput($action)
		{

			if(!$this->checkWSDL($this->server.$this->wsdl))
			    return $this->response = $this->_errorHandler->return_error('server.connection_error');

			return true;

		}

		/*
		* 	VALIDATE RESPONSE
		*
		*	@description 		Validate response of return from SOAP
		*
		*/

		protected function validateResponse($action)
		{
			return $this->_validator->validateResponse($this->response, $action.'_response');
		}

		/*
		* 	CREATE WIFI INTERACTION
		*
		*	@description 		A wrapper function for Airship's createWifiInteraction SOAP API
		*
		*	@param 	string   	wifiinteraction_hotspot_name
		*	@param 	string 		wifiinteraction_mac_name
		*	@param 	string 		wifiinteraction_device_mime_type
		*	@param 	string 		wifiinteraction_interaction_type
		*	@param 	integer     wifiinteraction_contact_id
		*
		*	@return int 		mixed
		*/
		
		public function createWifiInteraction()
		{

			if($this->prepareInput('createWifiInteraction') !== true)
		    	return $this->response;
			
			//Make The Call
    		$this->response = $this->soapCall('createWifiInteraction', 
					$this->username, 
					$this->password, 
					$this->wifiinteraction_hotspot_name,
					$this->wifiinteraction_mac_name,
					$this->wifiinteraction_device_mime_type,
					$this->wifiinteraction_interaction_type,
					$this->wifiinteraction_contact_id
    			);


			return $this->validateResponse('create_wifi_interaction');
		    				
		}


		/*
		* 	CREATE WIFI INTERACTION HISTORY
		*
		*	@description 		A wrapper function for Airship's createWifiInteractionHistory SOAP API
		*
		*	@param 	string   	wifiinteraction_hotspot_name
		*	@param 	string 		wifiinteraction_mac_name
		*	@param 	string 		wifiinteraction_device_mime_type
		*	@param 	string 		wifiinteraction_interaction_type
		*	@param 	integer     wifiinteraction_contact_id
		*	@param 	string      wifiinteraction_created_datetime
		*
		*	@return int 		mixed
		*/
		
		public function createWifiInteractionHistory()
		{

			if($this->prepareInput('createWifiInteractionHistory') !== true)
		    	return $this->response;
			
			//Make The Call
    		$this->response = $this->soapCall('createWifiInteractionHistory', 
					$this->username, 
					$this->password, 
					$this->wifiinteraction_hotspot_name,
					$this->wifiinteraction_mac_name,
					$this->wifiinteraction_device_mime_type,
					$this->wifiinteraction_interaction_type,
					$this->wifiinteraction_contact_id,
					$this->wifiinteraction_created_datetime
    			);

			return $this->validateResponse('create_wifi_interaction_history');
		    				
		}


	}

}