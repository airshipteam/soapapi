<?php namespace airshipwebservices\soapapi {
	

	class Validator {

		/**
		 * Possible fields fore create contact
		 *
		 * @var array
		 */
		protected $create_contact = array(
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
		

	}

}