<?php namespace airshipwebservices\soapapi {
	
	use SoapClient;

	class AirshipContact extends Airship{
		
		public $contact = array();          // Array
		public $groups  = array();           // Array
		public $udfs    = array();             // Array

		public $wsdl;             // Alphanumeric

		public function __construct()
			{
				$this->wsdl = 'Contact.wsdl';
				$this->_errorHandler = new ErrorHandler();
				$this->_successHandler = new SuccessHandler();
			}
		

		public function create()
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

			//$this->mobilenumber = $this->formatMobileNumber($this->mobilenumber);

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
				if($this->response >=1){
					return $this->_successHandler->return_success($this->response);
				}else {
				    return $this->_errorHandler->return_error('server.create_error');
				}
	    	}
	    	catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

		}


	

		

		


	}

}