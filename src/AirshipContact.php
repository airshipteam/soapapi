<?php namespace airshipwebservices\soapapi {
	
	use SoapClient;

	class AirshipContact extends Airship{
		
		public $contact_id;       // Numeric
		public $title;            // Mr,Mrs,Ms,Dr,Miss,Prof
		public $gender;           // M,F
		public $firstname;        // Alphanumeric (Max Length 30)
		public $lastname;         // Alphanumeric (Max Length 30)
		public $buildingname;     // Alphanumeric (Max Length 30)
		public $buildingnumstreet;// Alphanumeric (Max Length 30)
		public $locality;         // Alphanumeric (Max Length 30)
		public $city;             // Alphanumeric (Max Length 20)
		public $postcode;         // Alphanumeric (Max Length 10)
		public $county;           // Alphanumeric (Max Length 30)
		public $country;          // Alphanumeric (Max Length 30)
		public $membershipnumber; // Alphanumeric (Max Length 255)
		public $membershiptype;   // Alphanumeric (Max Length 255)
		public $mobilenumber;     // Numeric (Max Length 15)
		public $landnumber;       // Numeric (Max Length 15)
		public $email;            // Alphanumeric (Max Length 50)
		public $dob;              // YYYY-dd-mm
		public $allowsms;         // Y,N
		public $allowcall;        // Y,N
		public $allowemail;       // Y,N
		public $allowsnailmail;   // Y,N
		
		public $sourceid;         // Numeric
		public $groups;           // Array
		public $udfs;             // Array

		public $wsdl;             // Alphanumeric

		public function __construct()
			{
				$wsdl = 'Contact.wsdl';
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

			//powertext doesn't like empty properties to be sent
			$contact = array();
			foreach ($possibleFields as $field) {
				
				if (isset($this->{$field})) {
					
					$contact[$field] = $this->{$field};
				}
			}

			try {
				$this->checkWSDL($this->server.$wsdl);
	    		$this->soap_client = new SoapClient($this->server . $wsdl, array("exceptions" => 1));
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


	

		

		


	}

}