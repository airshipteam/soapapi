<?php namespace airshipwebservices\soapapi {
	

	class Validator {


		/**
		 * Possible fields fore create contact
		 *
		 * @var array
		 */
		protected $create_contact_response = array(
									'numeric'=>true,
									'min'=>1
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
			foreach ($this->$rules_type.'_fields' as $field) {
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

			if(isset($reponse->error_number)){
				return true;
			}
			]
			$return = true;

			if(isset($this->$rules_type.'_response'['numeric']) && $this->$rules_type.'_response'['numeric'] === true){

				if(!is_numeric($response))
					$return = false;

			}

			if(isset($this->$rules_type.'_response'['min']) && $this->$rules_type.'_response'['min'] != ''){

				if(!($response > $this->$rules_type.'_response'['min'])){
					$return = false;
				}

			}


			return $return;

		}
		

	}

}