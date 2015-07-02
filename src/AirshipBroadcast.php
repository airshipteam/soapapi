<?php namespace airshipwebservices\soapapi {
	
	class AirshipBroadcast extends Airship{
		
		public  $htmlContent;          // string
		public  $textContent;          // string
		public  $fromAddress;          // string
		public  $unitID;          // string
		public  $recipients  = array();          // array
		public  $wsdl;             // Alphanumeric
		

		public function __construct()
			{
				$this->wsdl = 'Broadcast.wsdl';
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
		* 	SEND NEW EFLYER
		*
		*	@description 		A wrapper function for Airship's send new eflyer SOAP API
		*
		*	@param 	int   	unit ID
		*	@param 	string 		from address
		*	@param 	array 		recipients
		*	@param 	string 		subject
		*	@param 	string 		html content
		*	@param 	string 		text content
		*	@param 	int 		broadcastID
		*
		*	@return int 		mixed
		*/
		
		public function sendNewEflyer()
		{

			if($this->prepareInput('send_new_eflyer') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('sendNewEflyer', $this->username, $this->password, $this->unitID, $this->fromAddress, $this->recipients, $this->htmlContent, $this->textContent);
			return $this->validateResponse('send_new_eflyer');
		    				
		}


		


	}

}