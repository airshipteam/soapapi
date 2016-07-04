<?php namespace airshipwebservices\soapapi {
	
	class AirshipLoyalty extends Airship{

		public $scheme_id;
		public $source_id;
		public $membership_number;
		public $interaction_value;
		public $interaction_type;
		public $interaction_datetime;
		public $equal_args;
		public $greater_equal_args;
		public $less_equal_args;
		public $in_sql_args;
		public $result_options;

		public function __construct()
			{
				parent::__construct();
				$this->wsdl = 'Loyalty.wsdl';
			}


		/*
		* 	Format Inputs
		*
		*	@description 		formats input array 
		*		
		*	@return BOOL 		BOOL
		*/

		protected function formatInput(){

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

		/**
		 * Adds or Removes points from a Scheme Member
		 * @return \stdClass
         */
		public function createLoyaltySchemeInteraction()
		{

			if($this->prepareInput('create_loyalty_scheme_interaction') !== true)
		    	return $this->response;
			
			//Make The Call
    		$this->response = $this->soapCall('createLoyaltySchemeInteraction',
				$this->username,
				$this->password,
				$this->scheme_id,
				$this->source_id,
				$this->membership_number,
				$this->interaction_datetime,
				$this->interaction_value,
				$this->interaction_type
			);
			return $this->validateResponse('create_loyalty_scheme_interaction');
		    				
		}

		/**
		 * Add a loyalty Source for this account. e.g. Website
		 * @param $sourceName
		 * @return \stdClass
         */
		public function addLoyaltySource($sourceName)
		{
			$this->response = $this->soapCall('addLoyaltySource', $this->username, $this->password, $sourceName);

			return $this->validateResponse('add_loyalty_source');
		}

		/**
		 * Get the sources already created for this account
		 * @return \stdClass
         */
		public function getLoyaltySources()
		{
			$this->response = $this->soapCall('getLoyaltySources', $this->username, $this->password);

			return $this->validateResponse('get_loyalty_sources');
		}

		/**
		 * Create a Loyalty Scheme for this account. e.g. Business Rewards Scheme
		 * @param $schemeName
		 * @return \stdClass
         */
		public function createLoyaltyScheme($schemeName)
		{
			$this->response = $this->soapCall('createLoyaltyScheme', $this->username, $this->password, $schemeName);

			return $this->validateResponse('create_loyalty_scheme');

		}

		/**
		 * Once you have created a scheme you have to assign it some sources created with addLoyaltySource
		 * @param $scheme_id
		 * @param array $source_ids
		 * @return \stdClass
         */
		public function assignLoyaltySchemeSources($scheme_id, array $source_ids)
		{
			$this->response = $this->soapCall('assignLoyaltySchemeSources', $this->username, $this->password, $scheme_id, $source_ids);
			return $this->validateResponse('assign_loyalty_scheme_sources');

		}

		/**
		 * When you create a membership number for a contact use this to check its unique
		 * @param $membershipNumber
		 * @return \stdClass
         */
		public function isMembershipNumberInUse($membershipNumber)
		{
			$this->response = $this->soapCall('isMembershipNumberInUse', $this->username, $this->password, $membershipNumber);

			return $this->validateResponse('is_membership_number_in_use');
		}

		/**
		 * You can use this call to see what members have reached a certain milestone
		 * @param $schemeId
		 * @param $amountGreaterThan
		 * @return \stdClass
         */
		public function getLoyaltySchemeMemberBalances($schemeId, $amountGreaterThan)
		{
			$this->response = $this->soapCall('getLoyaltySchemeMemberBalances', $this->username, $this->password, $schemeId,  $amountGreaterThan);

			return $this->validateResponse('get_loyalty_scheme_member_balances');
		}

		/**
		 * Get all shcemes for this account
		 * @return \stdClass
         */
		public function getLoyaltySchemes()
		{
			$this->response = $this->soapCall('getLoyaltySchemes', $this->username, $this->password);

			return $this->validateResponse('get_loyalty_schemes');

		}


	}

}