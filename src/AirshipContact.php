<?php namespace airshipwebservices\soapapi {
	
	class AirshipContact extends Airship{
		
		public  $contact   = array();          // Array
		public  $groups    = array();          // Array
		public  $udfs      = array();          // Array
		public  $consents      = array();          // Array
		public  $wsdl;             // Alphanumeric
		protected $contactWrite  = array();          // Array
		

		public function __construct()
			{
				parent::__construct();
				$this->wsdl = 'Contact.wsdl';
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
    		$this->response = $this->soapCall('createContact', $this->username, $this->password, $this->contactWrite, $this->groups, $this->udfs, $this->consents);
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
		    
    		$this->response = $this->soapCall('updateContact', $this->username, $this->password, $this->contactWrite, $this->groups, $this->udfs, $this->consents);
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

    		$this->response = $this->soapCall('lookupContactByLastname', $this->username, $this->password, $unitid, $name);
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

    		$this->response = $this->soapCall('setUDFValue', $this->username, $this->password, $contactid, $udfid, $udfvalue, $sourceid);
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
		 * GET CONTACT SOCIAL 
		 * Will get social details for a contact
		 *
		 * @param  string $contact_id
		 * @return object
		 */
		public function getContactSocial( $contact_id ){
			if($this->prepareInput('get_contact_social') !== true)
		    	return $this->response;

		    $this->response = $this->soapCall( 'getContactSocial', $this->username, $this->password, $contact_id );
		    return $this->validateResponse( 'get_contact_social' );
		}

		/**
		 * GET CONTACT PHOTO 
		 * Will get photo details for a contact
		 *
		 * @param  string $contact_id
		 * @return object
		 */
		public function getContactPhoto( $contact_id ){
			if($this->prepareInput('get_contact_photo') !== true)
		    	return $this->response;

		    $this->response = $this->soapCall( 'getContactPhoto', $this->username, $this->password, $contact_id );
		    return $this->validateResponse( 'get_contact_photo' );
		}

		/**
		 * SET CONTACT PHOTO 
		 * Will set photo details for a contact
		 *
		 * @param  array $params
		 * @return object
		 */
		public function setContactPhoto( $photo_data ){
			if($this->prepareInput('set_contact_photo') !== true)
		    	return $this->response;

		    $this->response = $this->soapCall( 'setContactPhoto', $this->username, $this->password, $photo_data );
		    return $this->validateResponse( 'set_contact_photo' );
		}

		/**
		 * SET CONTACT SOCIAL 
		 * Will set social details for a contact
		 *
		 * @param  array $params
		 * @return object
		 */
		public function setContactSocial( $social_data ){
			if($this->prepareInput('set_contact_social') !== true)
		    	return $this->response;

		    $this->response = $this->soapCall( 'setContactSocial', $this->username, $this->password, $social_data );
		    return $this->validateResponse( 'set_contact_social' );
		}

		/**
		 * powertext validation for +44 and 0044 fails
		 * powertext formats mobile numbers starting with 0 as 44
		 * @param  string $number mobile phone number
		 * @return string        mobile phone number
		 */
		protected function formatMobileNumber()
		{
			//convert from +44 to 44 to pass powertext validation
	        if (substr($this->contact['mobilenumber'],0,1) == '+') 
	            $this->contact['mobilenumber'] = str_replace('+', '', $this->contact['mobilenumber']);
	        
	        //convert from 00 to 44 to pass powertext validation
	        if (substr($this->contact['mobilenumber'],0,4) == '0044') 
	            $this->contact['mobilenumber'] = substr($this->contact['mobilenumber'],2);

            $this->contact['mobilenumber'] = str_replace(' ', '', $this->contact['mobilenumber']);

		}

		/**
		 * Removes a contact from all groups on units passed
		 * @param $contactId
		 * @param array $unitIds
		 * @return \stdClass
         */
		public function unsubscribeContactUnits($contactId, array $unitIds)
		{
			if($this->prepareInput('unsubscribe_contact') !== true)
				return $this->response;

			//Make The Call
			$this->response = $this->soapCall('unsubscribeContactUnits', $this->username, $this->password,$contactId, $unitIds);

			return $this->validateResponse('unsubscribe_contact');
		}


		/**
		 * All notes for a contact
		 * @param $contactId
		 * @return \stdClass
         */
		public function getContactNotes($contactId)
		{
			if($this->prepareInput('get_contact_notes') !== true)
				return $this->response;

			//Make The Call
			$this->response = $this->soapCall('getContactNotes', $this->username, $this->password,$contactId);

			return $this->validateResponse('get_contact_notes');
		}

		/**
		 * Add a note to a contacts records
		 * @param $contactNoteParams
		 * @return \stdClass
         */
		public function addContactNote($contactNoteParams)
		{
			if($this->prepareInput('add_contact_notes') !== true)
				return $this->response;

			//Make The Call
			$this->response = $this->soapCall('addContactNote', $this->username, $this->password,$contactNoteParams);


			return $this->validateResponse('add_contact_notes');
		}


		/**
		 * Get the status of contact attributes
		 * @param $contactId
		 * @return \stdClass
         */
		public function getContactStatus($contactId)
		{
			//Make The Call
			$this->response = $this->soapCall('getContactStatus', $this->username, $this->password,$contactId);

			return $this->validateResponse('get_contact_status');
		}

		/**
		 * Validate a contact
		 * @param $contactId
		 * @return \stdClass
         */
		public function contactValidation()
		{

			if($this->prepareInput('contact_validation') !== true)
		    	return $this->response;

		    //Make The Call
    		$this->response = $this->soapCall('contactValidation', $this->username, $this->password, $this->contactWrite, $this->udfs);
			return $this->validateResponse('contact_validation');

		}

		/**
		 * Get contact consent
		 * @param $contactId
		 * @return \stdClass
         */
		public function getContactConsent( $contact_id )
	    {
	        $this->response = $this->soapCall( 'getContactConsent', $this->username, $this->password, $contact_id );
	        return $this->validateResponse( 'get_contact_consent' );
	    }



	}

}