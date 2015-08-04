<?php namespace airshipwebservices\soapapi {
	
	class AirshipStatistics extends Airship{
		
		public  $wsdl;             // Alphanumeric
		protected $contactWrite  = array();          // Array
		

		public function __construct()
			{
				parent::__construct();
				$this->wsdl = 'Stat.wsdl';
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
		* 	UNIT LIST
		*
		*	@description 		A wrapper function for PowerText's unitList SOAP API
		*
		*	@param 	object   	contact
		*	@param 	array 		groups
		*	@param 	array 		UDFs
		*
		*	@return int 		mixed
		*/
		
		public function unitList()
		{

			if($this->prepareInput('unit_list') !== true)
		    	return $this->response;
			
			//Make The Call
    		$this->response = $this->soapCall('unitList', $this->username, $this->password);
			return $this->validateResponse('unit_list');
		    				
		}


	}

}