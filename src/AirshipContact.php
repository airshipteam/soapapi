<?php namespace airshipwebservices\soapapi {
	
	use SoapClient;

	class AirshipContact extends Airship{
		
		public  $contact   = array();          // Array
		public  $groups    = array();          // Array
		public  $udfs      = array();          // Array
		public  $wsdl;             // Alphanumeric
		protected $contactWrite  = array();          // Array
		protected $_errorHandler;
		protected $_successHandler;
		protected $_validator;
		protected $soap_client;

		public function __construct()
			{

				$this->wsdl = 'Contact.wsdl';
				$this->_errorHandler = new ErrorHandler();
				$this->_successHandler = new SuccessHandler();
				$this->_validator = new Validator();

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
			if(isset($this->contact['mobilenumber']))
				$this->formatMobileNumber();
			
		}

		/*
		* 	SOAP CALL
		*
		*	@description 		make the soap call.
		*		
		*	@return BOOL 		BOOL
		*/

		protected function soapCall($call, $p1 = false, $p2 = false, $p3 = false, $p4 = false, $p5 = false, $p6 = false, $p7 = false, $p8 = false, $p9 = false, $p10 = false){
		
			try {
				$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		return $this->soap_client->$call($p1,$p2,$p3,$p4,$p5,$p6);
    		}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

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

			$this->formatInput();

			if(!empty($this->contact))
				$this->contactWrite = $this->_validator->checkPossibleFields($this->contact, $action.'_fields');

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

			if($this->prepareInput('create_contact') !== true)
		    	return $this->response;
			
			//Make The Call
    		$this->response = $this->soapCall('createContact', $this->username, $this->password, $this->contactWrite, $this->groups, $this->udfs);
			return $this->validateResponse('create_contact');
		    				
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
			
		    if($this->prepareInput('update_contact') !== true)
		    	return $this->response;
		    
    		$this->response = $this->soapCall('updateContact', $this->username, $this->password, $this->contactWrite, $this->groups, $this->udfs);
			return $this->validateResponse('update_contact');

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
			
			if($this->prepareInput('get_contact') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('getContact', $this->username, $this->password, $contactid);
			return $this->validateResponse('get_contact');

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

			if($this->prepareInput('get_contact_email') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('getContactEmail', $this->username, $this->password, $email);
			return $this->validateResponse('get_contact_email');
			
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
		
			// Check connection to Airship API
			if($this->prepareInput('lookup_contact_lastname') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('lookupContactByLastname', $this->username, $this->password, $unitid, $email);
			return $this->validateResponse('lookup_contact_lastname');
			
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
			
			// Check connection to Airship API
			if($this->prepareInput('lookup_contact_by_udf') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('lookupContactByUDF', $this->username, $this->password, $udfid, $udfvalue);
			return $this->validateResponse('lookup_contact_by_udf');

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
			
			// Check connection to Airship API
			if($this->prepareInput('unsubscribe_contact') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('unsubscribeContact', $this->username, $this->password, $contacts);
			return $this->validateResponse('unsubscribe_contact');

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
			
			// Check connection to Airship API
			if($this->prepareInput('unsubscribe_contact_group') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('unsubscribeContactGroup', $this->username, $this->password, $contactid, $groupid);
			return $this->validateResponse('unsubscribe_contact_group');
			
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

			if($this->prepareInput('get_udf_value') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('getUDFValue', $this->username, $this->password, $contactid, $udfid);
			return $this->validateResponse('get_udf_value');

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
			

			// Check connection to Airship API
			if($this->prepareInput('set_udf_value') !== true)
		    	return $this->response;

    		$this->response = $this->callSoap('setUDFValue'. $this->username, $this->password, $contactid, $udfid, $udfvalue, $sourceid);
			return $this->validateResponse('set_udf_value');

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
			
			// Check connection to Airship API
			if($this->prepareInput('get_interactions_in_monitored_group') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('getInteractionsInMonitoredGroup', $this->username, $this->password, $groupid);
			return $this->validateResponse('get_interactions_in_monitored_group');

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

			// Check connection to Airship API
			if($this->prepareInput('delete_interactions_in_monitored_group') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('deleteInteractionsInMonitoredGroup', $this->username, $this->password, $records);
			return $this->validateResponse('delete_interactions_in_monitored_group');
			
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
	        if (substr($number,0,1) == '+') 
	            $this->contact['mobilenumber'] = str_replace('+', '', $number);
	        
	        //convert from 00 to 44 to pass powertext validation
	        if (substr($number,0,4) == '0044') 
	            $this->contact['mobilenumber'] = substr($number,2);

	        $this->contact['mobilenumber'] = $number;
		}


	}

}