<?php namespace airshipwebservices\soapapi {
	
	class AirshipEpos extends Airship{
		
		public  $purchase_history_transaction_lines = array(); //array
		public  $purchase_history_transaction_reference; //string e.g:'Hallamshire'
		public  $purchase_history_contact_id; //string e.g:'2099954'
		public  $purchase_history_unit_id; //string e.g:'67'
		public  $purchase_history_transaction_timestamp; //string e.g:`date +%s`
		public  $purchase_history_id; //string '19'
		public 	$purchase_contact_id; //string '2099954'
		public 	$purchase_transaction_reference; //string 'Greystoke'

		public function __construct()
			{
				parent::__construct();
				$this->wsdl = 'EPOS.wsdl';
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

		protected function prepareInput($action)
		{

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
		* 	CREATE PURCHASE HISTORY
		*
		*	@description 		A wrapper function for Airship's create purchase history SOAP API
		*
		*	@param 	array   	$purchase_history_transaction_lines
		*	@param 	string 		$purchase_history_transaction_reference
		*	@param 	string 		$purchase_history_contact_id
		*	@param 	string 		$purchase_history_unit_id
		*	@param 	string 		$purchase_history_transaction_timestamp
		*
		*	@return int 		$purchase_history_id
		*/
		
		public function createPurchaseHistory()
		{

			if($this->prepareInput('create_purchase_history') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('createPurchaseHistory', $this->username, $this->password, $this->purchase_history_transaction_lines, $this->purchase_history_transaction_reference, $this->purchase_history_contact_id, $this->purchase_history_unit_id, $this->purchase_history_transaction_timestamp);
			return $this->validateResponse('create_purchase_history');
		    				
		}

		/*
		* 	UPDATE PURCHASE HISTORY
		*
		*	@description 		A wrapper function for Airship's update purchase history SOAP API
		*
		*	$param 	string 		$purchase_history_id
		*	@param 	string 		$purchase_history_transaction_reference
		*	@param 	string 		$purchase_history_contact_id
		*	@param 	string 		$purchase_history_unit_id
		*	@param 	string 		$purchase_history_transaction_timestamp
		*
		*	@return int 		number of rows updated
		*/
		
		public function updatePurchaseHistory()
		{

			if($this->prepareInput('update_purchase_history') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('updatePurchaseHistory', $this->username, $this->password, $this->purchase_history_id, $this->purchase_history_transaction_reference, $this->purchase_history_contact_id, $this->purchase_history_unit_id, $this->purchase_history_transaction_timestamp);
			return $this->validateResponse('update_purchase_history');
		    				
		}

		/*
		* 	DELETE PURCHASE HISTORY
		*
		*	@description 		A wrapper function for Airship's delete purchase history SOAP API
		*
		*	$param 	string 		$purchase_history_id
		*
		*	@return int 		number of rows deleted
		*/
		
		public function deletePurchaseHistory()
		{

			if($this->prepareInput('delete_purchase_history') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('deletePurchaseHistory', $this->username, $this->password, $this->purchase_history_id);
			return $this->validateResponse('delete_purchase_history');
		    				
		}

		/*
		* 	GET PURCHASE HISTORY PURCHASE
		*
		*	@description 		A wrapper function for Airship's get purchase history SOAP API
		*
		*	$param 	string 		$purchase_history_id
		*
		*	@return object 		PurchaseHistoryObject
		*/
		
		public function getPurchaseHistoryPurchase()
		{

			if($this->prepareInput('get_purchase_history_purchase') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('getPurchaseHistoryPurchase', $this->username, $this->password, $this->purchase_history_id);
			return $this->validateResponse('get_purchase_history_purchase');
		    				
		}

		/*
		* 	GET PURCHASE HISTORY CONTACT
		*
		*	@description 		A wrapper function for Airship's get purchase history contact SOAP API
		*
		*	$param 	string 		$purchase_contact_id
		*
		*	@return object 		PurchaseHistoryObject
		*/
		
		public function getPurchaseHistoryContact()
		{

			if($this->prepareInput('get_purchase_history_contact') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('getPurchaseHistoryContact', $this->username, $this->password, $this->purchase_contact_id);
			return $this->validateResponse('get_purchase_history_contact');
		    				
		}

		/*
		* 	GET PURCHASE HISTORY UNIT
		*
		*	@description 		A wrapper function for Airship's get purchase history unit SOAP API
		*
		*	$param 	string 		$purchase_unit_id
		*
		*	@return object 		PurchaseHistoryObject
		*/
		
		public function getPurchaseHistoryUnit()
		{

			if($this->prepareInput('get_purchase_history_unit') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('getPurchaseHistoryUnit', $this->username, $this->password, $this->purchase_unit_id);
			return $this->validateResponse('get_purchase_history_unit');
		    				
		}

		/*
		* 	GET PURCHASE HISTORY REFERENCE
		*
		*	@description 		A wrapper function for Airship's get purchase history unit SOAP API
		*
		*	$param 	string 		$purchase_transaction_reference
		*
		*	@return object 		PurchaseHistoryObject
		*/
		
		public function getPurchaseHistoryReference()
		{

			if($this->prepareInput('get_purchase_history_reference') !== true)
		    	return $this->response;

    		$this->response = $this->soapCall('getPurchaseHistoryReference', $this->username, $this->password, $this->purchase_transaction_reference);
			return $this->validateResponse('get_purchase_history_reference');
		    				
		}

	}

}