<?php namespace airshipwebservices\soapapi {
	
	use SoapClient;

	class AirshipContact extends Airship{
		
		public $contact   = array();          // Array
		public $groups    = array();          // Array
		public $udfs      = array();          // Array

		public $wsdl;             // Alphanumeric

		public function __construct()
			{
				$this->wsdl = 'Contact.wsdl';
				$this->_errorHandler = new ErrorHandler();
				$this->_successHandler = new SuccessHandler();
			}


		/*
		* 	CREATE
		*
		*	@description 		A wrapper function for PowerText's createContact SOAP API
		*
		*	@param 	object   	contact
		*	@param 	array 		groups
		*	@param 	array 		UDFs
		*
		*	@return int 		mixed
		*/
		

		public function createContact()
		{
			$possibleFields = array(
				'title',
				'gender',
				'firstname',
				'lastname',
				'buildingname',
				'buildingnumstreet',
				'locality',
				'city',
				'postcode',
				'county',
				'country',
				'membershipnumber',
				'membershiptype',
				'mobilenumber',
				'landnumber',
				'email',
				'dob',
				'sourceid',
				'allowsms',
				'allowcall',
				'allowemail',
				'allowsnailmail',
			);

			//format mobile number
			if(isset($this->contact['mobilenumber'])){
				$this->contact['mobilenumber'] = $this->formatMobileNumber($this->contact['mobilenumber']);
			}

			//Airship doesn't like empty properties to be sent
			$contact = array();
			foreach ($possibleFields as $field) {
				if (isset($this->contact[$field])) {
					$contact[$field] = $this->contact[$field];
				}
			}

			try {

				// Check connection to Airship API
				if(!$this->checkWSDL($this->server.$this->wsdl)){
				    return $this->_errorHandler->return_error('server.connection_error');
				}

	    		$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		$this->response = $this->soap_client->createContact($this->username, $this->password, $contact, $this->groups, $this->udfs);
				if($this->response >=1){ // success
					return $this->_successHandler->return_success($this->response);
				}else { // error
				    return $this->_errorHandler->return_error('contact.create_error');
				}
	    	}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}


		/*
		* 	UPDATE
		*
		*	@description 		A wrapper function for PowerText's updateContact SOAP API
		*
		*	@param 	object   	contact
		*	@param 	array 		groups
		*	@param 	array 		UDFs
		*
		*	@return int 		mixed
		*/
		

		public function updateContact()
		{
			$possibleFields = array(
				'contactid',
				'title',
				'gender',
				'firstname',
				'lastname',
				'buildingname',
				'buildingnumstreet',
				'locality',
				'city',
				'postcode',
				'county',
				'country',
				'membershipnumber',
				'membershiptype',
				'mobilenumber',
				'landnumber',
				'email',
				'dob',
				'sourceid',
				'allowsms',
				'allowcall',
				'allowemail',
				'allowsnailmail',
			);

			//format mobile number
			if(isset($this->contact['mobilenumber'])){
				$this->contact['mobilenumber'] = $this->formatMobileNumber($this->contact['mobilenumber']);
			}

			//Airship doesn't like empty properties to be sent
			$contact = array();
			foreach ($possibleFields as $field) {
				if (isset($this->contact[$field])) {
					$contact[$field] = $this->contact[$field];
				}
			}

			try {

				// Check connection to Airship API
				if(!$this->checkWSDL($this->server.$this->wsdl)){
				    return $this->_errorHandler->return_error('server.connection_error');
				}

	    		$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		$this->response = $this->soap_client->updateContact($this->username, $this->password, $contact, $this->groups, $this->udfs);
				if($this->response >=1){ // success
					return $this->_successHandler->return_success($this->response);
				}else { // error
				    return $this->_errorHandler->return_error('contact.update_error');
				}
	    	}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}



		/*
		* 	GET
		*
		*	@description 		A wrapper function for PowerText's getContact SOAP API
		*
		*	@param 	integer   	contactid
		*
		*	@return int 		mixed
		*/
		

		public function getContact($contactid)
		{
			
			try {

				// Check connection to Airship API
				if(!$this->checkWSDL($this->server.$this->wsdl)){
				    return $this->_errorHandler->return_error('server.connection_error');
				}

	    		$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		$this->response = $this->soap_client->getContact($this->username, $this->password, $contactid);
				if(isset($this->result->contactData->contactid)){ // success
					return $this->_successHandler->return_success($this->response);
				}else { // error
				    return $this->_errorHandler->return_error('contact.get_error');
				}
	    	}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}


		/*
		* 	GET CONTACT EMAIL
		*
		*	@description 		A wrapper function for PowerText's getContactEmail SOAP API
		*
		*	@param 	integer   	contactid
		*
		*	@return int 		mixed
		*/
		

		public function getContactEmail($email)
		{
			
			try {

				// Check connection to Airship API
				if(!$this->checkWSDL($this->server.$this->wsdl)){
				    return $this->_errorHandler->return_error('server.connection_error');
				}

	    		$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		$this->response = $this->soap_client->getContactEmail($this->username, $this->password, $email);
				if(isset($this->result->contactData->contactid)){ // success
					return $this->_successHandler->return_success($this->response);
				}else { // error
				    return $this->_errorHandler->return_error('contact.get_error');
				}
	    	}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}


		/**
		 * powertext validation for +44 and 0044 fails
		 * powertext formats mobile numbers starting with 0 as 44
		 * @param  string $number mobile phone number
		 * @return string        mobile phone number
		 */
		protected function formatMobileNumber($number)
		{
			//convert from +44 to 44 to pass powertext validation
	        if (substr($number,0,1) == '+') {
	            return str_replace('+', '', $number);
	            
	        }
	        //convert from 00 to 44 to pass powertext validation
	        if (substr($number,0,4) == '0044') {
	            $this->mobilenumber = substr($number,2);
	            return true;
	        }

	        return $number;
		}


	}

}