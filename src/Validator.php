<?php namespace airshipwebservices\soapapi {
	

	class Validator extends Airship{ 

		public function __construct()
			{

				$this->_errorHandler = new ErrorHandler();
				$this->_successHandler = new SuccessHandler();

			}

		/**
		 * Validation for create contact response
		 *
		 * @var array
		 */
		protected $create_contact_response = array(
									'rules' => array(
										'numeric'=>true,
										'min'=>1
										), 
									'error' => 'contact.create_error'
								);

		/**
		 * Validation for update contact response
		 *
		 * @var array
		 */
		protected $update_contact_response = array(
									'rules' => array(
										'numeric'=>true,
										'min'=>1
										), 
									'error' => 'contact.create_error'
								);

		/**
		 * Validation for get contact response
		 *
		 * @var array
		 */
		protected $get_contact_response = array(
									'rules' => array(
										'required'=>'contactData'
										), 
									'error' => 'contact.get_error'
								);

		/**
		 * Validation for get contact email response
		 *
		 * @var array
		 */
		protected $get_contact_email_response = array(
									'rules' => array(
										'required'=>'contactData'
										), 
									'error' => 'contact.get_error'
								);

		/**
		 * Validation for get contact response
		 *
		 * @var array
		 */
		protected $lookup_contact_by_lastname_response = array(
									'rules' => array(
										'isarray'=>true
										), 
									'error' => 'contact.lookup_lastname_error'
								);


		/**
		 * Possible fields fore create contact
		 *
		 * @var array
		 */
		protected $create_contact_fields = array(
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

		/**
		 * Possible fields fore update contact
		 *
		 * @var array
		 */
		protected $update_contact_fields = array(
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

		/**
		 * Check possible fields
		 * Return an array only of fields that Airhsip Likes. 
		 *
		 * @var array
		 */


		public function checkPossibleFields(array $array, $rules_type)
		{
			$return = array();
			foreach ($this->$rules_type as $field) {
				if (isset($array[$field])) {
					$return[$field] = $array[$field];
				}
			}

			return $return;

		}

		/**
		 * Validate RESULT
		 * Validate result of SOAP. 
		 *
		 * @var array
		 */


		public function validateResponse($response, $rules_type)
		{




			if(isset($response->error_number)){
				return $response;
			}


			$rules = $this->$rules_type;

			foreach($rules['rules'] as $key => $rule){

				if($key == 'numeric' && $rule === true ){
					if(!is_numeric($response))
					    return $this->_errorHandler->return_error($rules['error']);
				}

				if($key == 'min'){

					if(!($response > $rule))
					    return $this->_errorHandler->return_error($rules['error']);
				}

				if($key == 'required'){
					if(!isset($response->$rule) )
					    return $this->_errorHandler->return_error($rules['error']);
				}

				if($key == 'isarray'){
					if(!is_array($response) )
					    return $this->_errorHandler->return_error($rules['error']);

					if(is_array($response) && empty($response))
					    return $this->_errorHandler->return_error('contact.lookup_lastname_noresults');
				}

			}

			return $this->_successHandler->return_success($response);


		}
		

	}

}