<?php namespace airshipwebservices\soapapi {
	
	class AirshipUniqueCodes extends Airship{
		
		public  $wsdl;             // Alphanumeric		

		public function __construct()
			{
				parent::__construct();
				$this->wsdl = 'UniqueCodes.wsdl';
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

		protected function prepareInput($action){

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
		* 	REDEEM UNIQUE CODE
		*
		*	@description 		A wrapper function for Airship's redeemUniqueCode SOAP API
		*
		*	@param 	string   	Unique Code
		*	@param 	INT 		UCGID
		*	@param 	datetime 	Redeem time
		*	@param 	unit ID 	Unit ID
		*
		*	@return int 		mixed
		*/
		
		public function redeemUniqueCode($uniquecode, $ucgid, $redeemtime, $unitid)
		{

			if($this->prepareInput('redeem_unique_code') !== true)
		    	return $this->response;
			
			//Make The Call
    		$this->response = $this->soapCall('redeemUniqueCode', $this->username, $this->password, $uniquecode, $ucgid, $redeemtime, $unitid);
			return $this->validateResponse('redeem_unique_code');
		    				
		}

		public function uniqueCodeGetData($uniquecode, $ucgid)
		{

			if($this->prepareInput('unique_code_get_data') !== true)
				return $this->response;

			//Make The Call
			$this->response = $this->soapCall('uniqueCodeGetData', $this->username, $this->password, $uniquecode, $ucgid);

			return $this->validateResponse('unique_code_get_data');

		}

		public function contactGetUniqueCodes($contactid)
		{

			if($this->prepareInput('contact_get_unique_codes') !== true)
				return $this->response;

			//Make The Call
			$this->response = $this->soapCall('contactGetUniqueCodes', $this->username, $this->password, $contactid);

			return $this->validateResponse('contact_get_unique_codes');

		}
		

	}

}