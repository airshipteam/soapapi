<?php namespace airshipwebservices\soapapi {
	

	class ErrorHandler {

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

			$error = explode('.',$error_id);
			$return = new \stdClass();
			$return->status = false;
			if(isset($this->errors[$error[0]][$error[1]])){
				$return->error_number =  $this->errors[$error[0]][$error[1]]['error_num'];
				$return->error_message = $this->errors[$error[0]][$error[1]]['error_msg'];
				$return->error_customer = $this->errors[$error[0]][$error[1]]['error_msg'];
				if($soapfault !== false){// return a SOAP fault if we have one.
					$return->soap_fault = $soapfault;
					if($this->createCustomerSOAPerror($soapfault)){ // check to see if soap fault is customer facing
						$return->error_customer = $soapfault;
					}else{
						$return->error_customer = 'An error has occured';
					}
				}
			}else{ // no error message, so return a default
				$return->error_number =  $this->errors[$error['default']][$error['default']]['error_num'];
				$return->error_message = $this->errors[$error['default']][$error['default']]['error_msg'];
				$return->error_customer = $this->errors[$error['default']][$error['default']]['error_customer'];
			}
			return $return;


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