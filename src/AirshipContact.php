<?php namespace airshipwebservices\soapapi {
	
	use SoapClient;

	class AirshipContact extends Airship{
		
		public $contact   = array();          // Array
		public $groups    = array();          // Array
		public $udfs      = array();          // Array
		private $contactWrite  = array();          // Array

		public $wsdl;             // Alphanumeric

		public function __construct()
			{
				$this->wsdl = 'Contact.wsdl';
				$this->_errorHandler = new ErrorHandler();
				$this->_successHandler = new SuccessHandler();
				$this->_validator = new Validator();
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

			$this->formatInput();
			//Airship doesn't like empty properties to be sent
			$this->contactWrite = $this->_validator->checkPossibleFields($this->contact, 'create_contact');
			// Check connection to Airship API
			if(!$this->checkWSDL($this->server.$this->wsdl))
			    return $this->_errorHandler->return_error('server.connection_error');
			
			//Make The Call
    		$this->response = $this->soapCall();

			if($this->response >=1){ // success
				return $this->_successHandler->return_success($this->response);
		    
		    return $this->_errorHandler->return_error('contact.create_error');
				
		}

		/*
		* 	Format Inputs
		*
		*	@description 		formats input array 
		*		
		*	@return BOOL 		BOOL
		*/

		protected function formatInput(){

			//format mobile number
			if(isset($this->contact['mobilenumber'])){
				$this->contact['mobilenumber'] = $this->formatMobileNumber($this->contact['mobilenumber']);
			}

		}

		/*
		* 	SOAP CALL
		*
		*	@description 		make the soap call
		*		
		*	@return BOOL 		BOOL
		*/

		protected function soapCall(){

			try {
				$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		return $this->soap_client->createContact($this->username, $this->password, $this->contactWrite, $this->groups, $this->udfs);
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

				if(isset($this->response->contactData->contactid)){ // success
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

				if(isset($this->response->contactData->contactid)){ // success
					return $this->_successHandler->return_success($this->response);
				}else { // error
				    return $this->_errorHandler->return_error('contact.get_error');
				}

	    	}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}


		/*
		* 	LOOKUP CONTACT BY LAST NAME
		*
		*	@description 		A wrapper function for PowerText's lookupContactByLastname SOAP API
		*
		*	@param 	integer   	unit ID
		*	@param 	string   	name
		*
		*	@return mixed 		response
		*/
		

		public function lookupContactByLastname($unitid, $name)
		{
			
			try {

				// Check connection to Airship API
				if(!$this->checkWSDL($this->server.$this->wsdl)){
				    return $this->_errorHandler->return_error('server.connection_error');
				}

	    		$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		$this->response = $this->soap_client->lookupContactByLastname($this->username, $this->password, $unitid, $email);

				if(is_array($this->response) && !empty($this->reponse)){ // success
					return $this->_successHandler->return_success($this->response);
				}elseif(!is_array($this->response)) { // error
				    return $this->_errorHandler->return_error('contact.lookup_lastname_error');
				}else{
				    return $this->_errorHandler->return_error('contact.lookup_lastname_noresults');
				}

	    	}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}

		/*
		* 	LOOKUP CONTACT BY UDF
		*
		*	@description 		A wrapper function for PowerText's lookupContactByUDF SOAP API
		*
		*	@param 	integer   	UDF ID
		*	@param 	string   	UDF Value
		*
		*	@return mixed 		response
		*/
		

		public function lookupContactByUDF($udfid, $udfvalue)
		{
			
			try {

				// Check connection to Airship API
				if(!$this->checkWSDL($this->server.$this->wsdl)){
				    return $this->_errorHandler->return_error('server.connection_error');
				}

	    		$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		$this->response = $this->soap_client->lookupContactByUDF($this->username, $this->password, $udfid, $udfvalue);

				if(is_numeric($this->response) && $this->response >= 1){ // success
					return $this->_successHandler->return_success($this->response);
				}else{
				    return $this->_errorHandler->return_error('contact.lookup_udf_noresults');
				}

	    	}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}


		/*
		* 	UNSUBSCRIBE CONTACT 
		*
		*	@description 		A wrapper function for PowerText's unsubscribeContact SOAP API
		*
		*	@param 	array   	Contacts
		*		
		*	@return mixed 		response
		*/
		

		public function unsubscribeContact($contacts)
		{
			
			try {

				// Check connection to Airship API
				if(!$this->checkWSDL($this->server.$this->wsdl)){
				    return $this->_errorHandler->return_error('server.connection_error');
				}

	    		$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		$this->response = $this->soap_client->unsubscribeContact($this->username, $this->password, $contacts);

				if($this->response == 100){ // success
					return $this->_successHandler->return_success($this->response);
				}else{
				    return $this->_errorHandler->return_error('contact.unsubscribe_error');
				}

	    	}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}


		/*
		* 	UNSUBSCRIBE CONTACT GROUP
		*
		*	@description 		A wrapper function for PowerText's unsubscribeContactGroup SOAP API
		*
		*	@param 	Integer   	Contact ID
		*	@param 	Integer   	Group ID
		*		
		*	@return mixed 		response
		*/
		

		public function unsubscribeContactGroup($contactid, $groupid)
		{
			
			try {

				// Check connection to Airship API
				if(!$this->checkWSDL($this->server.$this->wsdl)){
				    return $this->_errorHandler->return_error('server.connection_error');
				}

	    		$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		$this->response = $this->soap_client->unsubscribeContactGroup($this->username, $this->password, $contactid, $groupid);

				if($this->response == 100){ // success
					return $this->_successHandler->return_success($this->response);
				}else{
				    return $this->_errorHandler->return_error('contact.unsubscribe_group_error');
				}

	    	}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}


		/*
		* 	UNSUBSCRIBE UDF VALUE
		*
		*	@description 		A wrapper function for PowerText's getUDFValue SOAP API
		*
		*	@param 	Integer   	Contact ID
		*	@param 	Integer   	UDF ID
		*		
		*	@return mixed 		response
		*/
		

		public function getUDFValue($contactid, $udfid)
		{
			
			try {

				// Check connection to Airship API
				if(!$this->checkWSDL($this->server.$this->wsdl)){
				    return $this->_errorHandler->return_error('server.connection_error');
				}

	    		$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		$this->response = $this->soap_client->getUDFValue($this->username, $this->password, $contactid, $udfid);

				if(strlen($this->respons) >= 1){ // success
					return $this->_successHandler->return_success($this->response);
				}else{
				    return $this->_errorHandler->return_error('contact.udf_empty');
				}

	    	}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}


		/*
		* 	SET UDF VALUE
		*
		*	@description 		A wrapper function for PowerText's setUDFValue SOAP API
		*
		*	@param 	Integer   	Contact ID
		*	@param 	Integer   	UDF ID
		*	@param 	string   	udfvalue
		*	@param 	Integer   	sourceid
		*		
		*	@return mixed 		response
		*/
		

		public function setUDFValue($contactid, $udfid, $udfvalue, $sourceid)
		{
			
			try {

				// Check connection to Airship API
				if(!$this->checkWSDL($this->server.$this->wsdl)){
				    return $this->_errorHandler->return_error('server.connection_error');
				}

	    		$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		$this->response = $this->soap_client->setUDFValue($this->username, $this->password, $contactid, $udfid, $udfvalue, $sourceid);

				if($this->response == 100){ // success
					return $this->_successHandler->return_success($this->response);
				}else{
				    return $this->_errorHandler->return_error('contact.set_udf_error');
				}

	    	}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}


		/*
		* 	GET INTERACTIONS IN MONITORED GROUP
		*
		*	@description 		A wrapper function for PowerText's getInteractionsInMonitoredGroup SOAP API
		*
		*	@param 	Integer   	Group ID
		*		
		*	@return mixed 		response
		*/
		

		public function getInteractionsInMonitoredGroup($groupid)
		{
			
			try {

				// Check connection to Airship API
				if(!$this->checkWSDL($this->server.$this->wsdl)){
				    return $this->_errorHandler->return_error('server.connection_error');
				}

	    		$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		$this->response = $this->soap_client->getInteractionsInMonitoredGroup($this->username, $this->password, $groupid);
				if(is_array($this->response) && !empty($this->response)){ // success
					return $this->_successHandler->return_success($this->response);
				}else{
				    return $this->_errorHandler->return_error('contact.get_group_interactions_empty');
				}

	    	}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}



		/*
		* 	DELETE INTERACTIONS IN MONITORED GROUP
		*
		*	@description 		A wrapper function for PowerText's deleteInteractionsInMonitoredGroup SOAP API
		*
		*	@param 	array   	interation record
		*		
		*	@return mixed 		response
		*/
		

		public function deleteInteractionsInMonitoredGroup($records)
		{
			
			try {

				// Check connection to Airship API
				if(!$this->checkWSDL($this->server.$this->wsdl)){
				    return $this->_errorHandler->return_error('server.connection_error');
				}

	    		$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		$this->response = $this->soap_client->deleteInteractionsInMonitoredGroup($this->username, $this->password, $records);
				if($this->response == 100){ // success
					return $this->_successHandler->return_success($this->response);
				}else{
				    return $this->_errorHandler->return_error('contact.delete_group_interactions_error');
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