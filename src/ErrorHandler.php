<?php namespace airshipwebservices\soapapi {
	

	class ErrorHandler {

		protected $return;
		protected $error;

		public function __construct()
		{
			$this->errors = include 'Errors.php'; // error message config
			$this->customer_soap_errors = include 'CustomerErrors.php'; // soap errors that are customer facing
		}		

		/**
		 * RETURN ERROR
		 *
		 * @description Return errors to the user eloquently
		 * @param  String
		 */

		public function return_error($error_id, $soapfault = false)
		{

			$this->error = explode('.',$error_id);
			$this->return = new \stdClass();
			$this->return->status = false;
			$this->setErrorVariables();
			$this->setSoapError($soapfault);
			return $this->return;

		}

		/**
		 * SET SOAP ERROR
		 *
		 * @description SET error variables specific to code
		 * @param  String
		 */

		protected function setSoapError($soapfault)
		{
			if($soapfault !== false){// return a SOAP fault if we have one.
				$this->return->soap_fault = $soapfault;
				if($this->createCustomerSOAPerror($soapfault)){ // check to see if soap fault is customer facing
					$this->return->error_customer = $soapfault;
				}else{
					$this->return->error_customer = 'An error has occured';
				}
			}
		}

		/**
		 * SET ERROR CODE VARIABLES
		 *
		 * @description SET error variables specific to code
		 * @param  String
		 */

		protected function setErrorCodeVariables()
		{
			$this->return->error_number =  $this->errors[$this->error[0]][$this->error[1]]['error_num'];
			$this->return->error_message = $this->errors[$this->error[0]][$this->error[1]]['error_msg'];
			$this->return->error_customer = $this->errors[$this->error[0]][$this->error[1]]['error_customer'];
		}

		/*
		 * SET ERROR DEFAULT ERROR VARIABLES
		 *
		 * @description Use default error variables, incase we don't know what the error is.
		 * @param  String
		 */

		protected function setDefaultErrorVariables(){
			$this->return->error_number =  $this->errors['default']['default']['error_num'];
			$this->return->error_message = $this->errors['default']['default']['error_msg'];
			$this->return->error_customer = $this->errors['default']['default']['error_customer'];

		}

		/**
		 * SET ERROR VARIABLES
		 *
		 * @description SET error variables
		 * @param  String
		 */

		protected function setErrorVariables()
		{
			if(isset($this->errors[$this->error[0]][$this->error[1]])){
				$this->setErrorCodeVariables();
			}else{
				$this->setDefaultErrorVariables();
			}
				
			
		}

		/**
		 * CREATE CUSTOMER SOAP ERROR
		 *
		 * @description If this is a SOAP error returned by airship, check if it's customer facing, and if not then show a default.
		 * @param  String
		 */


		private function createCustomerSOAPerror($soapfault)
		{
			foreach($this->customer_soap_errors as $acceptable_error){

				if (strpos(strtolower($soapfault),strtolower($acceptable_error)) !== false) {
				    return true;
				}

			}
			return false;
		}
		

	}

}