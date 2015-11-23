<?php namespace airshipwebservices\soapapi {
	
	class AirshipAdmin extends Airship{
		
		public  $as_username;         // string
		public  $as_password;         // string
		public  $wsdl;             // Alphanumeric		

		public function __construct()
			{
				parent::__construct();
				$this->wsdl = 'Admin.wsdl';
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
		
		public function getSystemAuth()
		{

			if($this->prepareInput('get_system_auth') !== true)
		    	return $this->response;
			
			//Make The Call
    		$this->response = $this->soapCall('getSystemAuth', $this->username, $this->password, $this->as_username, $this->as_password);
			return $this->validateResponse('get_system_auth');
		    				
		}


	}

}