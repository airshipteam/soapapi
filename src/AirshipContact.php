<?php namespace airshipwebservices\soapapi; {
	
	use SoapClient;

	class AirshipContact extends Airship{

		public $contact_id;
		public $uid;
		public $title;
		
		public $firstname;
		public $lastname;
		public $gender;//one of M or F
		public $dob;//format 1975-12-25

		public $landnumber;
		public $email;
		public $mobilenumber;
		public $buildingname;
		public $buildingnumstreet;
		public $city;
		public $locality;
		public $county;
		public $postcode;
		public $country;

		public $membershiptype;
		public $membershipnumber;
		
		public $allowsms; //one of Y or N
		public $allowemail;//one of Y or N
		public $allowsnailmail; 
		public $allowcall; 

		public $source_id;

		public $groups;//array
		public $udfs;//array

		public function authenticate($server, $username, $password)
		{
			parent::__construct($server, $username, $password);

		}

		public function create()
		{
			$possibleFields = array(
				'title',
				'firstname',
				'lastname',
				'mobilenumber',
				'landnumber',
				'email',
				'buildingname',
				'buildingnumstreet',
				'city',
				'locality',
				'county',
				'postcode',
				'country',
				'membershiptype',
				'membershipnumber',
				'allowsms',
				'allowemail',
				'allowsnailmail',
				'allowcall',
				'sourceid',
				'dob',
				'gender'
			);

			$this->mobilenumber = $this->formatMobileNumber($this->mobilenumber);

			//powertext doesn't like empty properties to be sent
			$contact = array();
			foreach ($possibleFields as $field) {
				
				if (isset($this->{$field})) {
					
					$contact[$field] = $this->{$field};
				}
			}

			try {
	    		$this->soap_client = new SoapClient($this->server . 'Contact.wsdl', array("exceptions" => 1));
	    		$this->result = $this->soap_client->createContact($this->username, $this->password, $contact, $this->groups, $this->udfs);
				if($this->result >=1){
					//all good so return the contactid
					return $this->result;
				}else {
		    		return false;
				}
	    	}
	    	catch(\SoapFault $e) { 
	    		return $e->getMessage(); // return powertext error
	    	}

		}


	

		

		/*
		* 	update contact
		*
		* 	@author 			Julian Cole
		*	@description 		A wrapper function for PowerText's updateContact SOAP API
		*
		*	@param 	object   	contact
		*	@param 	array 		groups
		*	@param 	array 		UDFs
		*
		*	@return int 		Boolean
		*/



		public function update($contact,$groups,$udfs)
		{
		
			try{
				$this->soap_client = new SoapClient($this->server . 'Contact.wsdl', array("trace" => 1,"exceptions" => 0));
		    	$this->result = $this->soap_client->updateContact($this->username, $this->password,$contact,$groups,$udfs);

		    	if($this->result instanceof SoapFault){
		    		return $this->handleSoapErrors();
				}
		    	if($this->result == 100) {
					return TRUE;
				}
				
				return FALSE;
			}
	    	catch(Exception $e){
	    		return FALSE;
	    	}
		
		}

		public function get($id)
		{
			try {
		    	$this->soap_client = new SoapClient($this->server . 'Contact.wsdl', array("trace" => 1,"exceptions" => 0));
		    	
		    	$this->result = $this->soap_client->getContact($this->username, $this->password, $id);

		    	if ($this->result instanceof SoapFault) {
		    		
		    		$this->handleSoapErrors();
		    		$this->result = FALSE;
				} 
				elseif (!property_exists($this->result, 'contactData')) {
					$this->result = FALSE;
				}
				else{
					if($this->result->contactData->contactid >= 1) {
					
						//and add the udfs
		    			if(property_exists($this->result, 'udfs')){
		    				$this->result->contactData->udfs = $this->result->udfs;
		    			}
		    			else{
		    				$this->result->contactData->udfs = array();
		    			}
					
					}
					else {

						$this->result = FALSE;
					}
				}				

			}
	    	catch(Exception $e){
	    		$this->result = FALSE;
	    	}

			return $this->result;
		}

		/**
		 * returns the contact id if found else false
		 * @param  str $email email address
		 * @return [type]        [description]
		 */
		public function get_contact_id_by_email($email)
		{
			try{
		    	$this->soap_client = new SoapClient($this->server . 'Contact.wsdl', array("trace" => 1,"exceptions" => 0));
		    	
		    	$this->result = $this->soap_client->getContactEmail($this->username, $this->password, $email);

		    	if($this->result instanceof SoapFault){
		    		return $this->handleSoapErrors();
				}

				if(!property_exists($this->result, 'contactData')){
					return FALSE;
				}
		    	
		    	if($this->result->contactData->contactid >= 1) {
					return $this->result->contactData->contactid;
				}
				return FALSE;
				
			}
	    	catch(Exception $e){

	    		return FALSE;
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