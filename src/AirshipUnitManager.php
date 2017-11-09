<?php namespace airshipwebservices\soapapi {
	
	class AirshipUnitManager extends Airship{
		
		public  $as_username;         // string
		public  $as_password;         // string
		public  $wsdl;             // Alphanumeric		

		public function __construct()
			{
				parent::__construct();
				$this->wsdl = 'UnitManager.wsdl';
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
		* 	GET SYTSEM AUTH
		*
		*	@description 		A wrapper function for Airship's GET SYSTEM AUTH SOAP API
		*
		*	@param 	string   	username
		*	@param 	array 		password
		*
		*	@return int 		mixed
		*/
		
		public function getUnitBespokeMap($unit_id)
		{

			if($this->prepareInput('get_unit_bespoke_map') !== true)
		    	return $this->response;
			
			//Make The Call
    		$this->response = $this->soapCall('get_unit_bespoke_map', $this->username, $this->password, $unit_id);
			return $this->validateResponse('get_unit_bespoke_map');
		    				
		}


	}

}