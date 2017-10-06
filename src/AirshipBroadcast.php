<?php namespace airshipwebservices\soapapi {
	
	class AirshipBroadcast extends Airship{
		
		public  $htmlContent;          // string
		public  $textContent;          // string
		public  $fromAddress;          // string
		public  $subject;          // string
		public  $unitID;          // string
		public  $recipients     = array();          // array
		public  $eflyerID;
		public  $wsdl;             // Alphanumeric
		public  $smsContent;             // Alphanumeric
		public  $fromName;             // Alphanumeric
		public  $searchCriteria = [];
		public  $scheduleDateTime; //datetime
		public  $limit          = []; //integer
		public  $broadcastID; // integer

		public function __construct()
			{
				parent::__construct();
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

    		$this->response = $this->soapCall('sendNewEflyer', $this->username, $this->password, $this->unitID, $this->fromAddress, $this->recipients, $this->subject, $this->htmlContent, $this->textContent);
			return $this->validateResponse('send_new_eflyer');
		    				
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
		
		public function sendNewEflyerBroadcast()
		{

			if($this->prepareInput('send_new_eflyer_broadcast') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('sendNewEflyerBroadcast', $this->username, $this->password, $this->unitID, $this->fromAddress, $this->fromName, $this->recipients, $this->subject, $this->htmlContent, $this->textContent);
			return $this->validateResponse('send_new_eflyer_broadcast');
		    				
		}

		/*
		* 	SEND FORCED EFLYER
		*
		*	@description 		A wrapper function for Airship's send forced eflyer SOAP API
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
		
		public function sendForcedEflyer()
		{

			if($this->prepareInput('send_forced_eflyer') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('sendForcedEflyer', $this->username, $this->password, $this->eflyerID, $this->recipients);
			return $this->validateResponse('send_forced_eflyer');
		    				
		}

		/*
		* 	SEND FORCED EFLYER
		*
		*	@description 		A wrapper function for Airship's send forced eflyer SOAP API
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
		
		public function sendNewTflyer()
		{

			if($this->prepareInput('send_new_tflyer') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('sendNewTflyer', $this->username, $this->password, $this->unitID, $this->recipients,$this->smsContent);
			return $this->validateResponse('send_new_tflyer');
		    				
		}

		public function scheduleNewTflyer()
		{
			if($this->prepareInput('schedule_new_tflyer') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('scheduleNewTflyer', $this->username, $this->password, $this->unitID, $this->searchCriteria,$this->smsContent, $this->scheduleDateTime,$this->limit);
			return $this->validateResponse('schedule_new_tflyer');

		}

		public function scheduleNewTflyerCount()
		{
			if($this->prepareInput('schedule_new_tflyer_count') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('scheduleNewTflyerCount', $this->username, $this->password, $this->unitID, $this->searchCriteria);
			return $this->validateResponse('schedule_new_tflyer_count');

		}


		public function cancelScheduledSMS()
		{
			if($this->prepareInput('cancel_scheduled_sms') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('cancelScheduledSMS', $this->username, $this->password, $this->unitID, $this->broadcastID);
			return $this->validateResponse('cancel_scheduled_sms');

		}

	

	}

}