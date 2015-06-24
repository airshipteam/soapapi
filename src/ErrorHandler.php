<?php namespace airshipwebservices\soapapi {
	

	class ErrorHandler {

		public function __construct()
		{
			$this->errors = include 'Errors.php';
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
				if($soapfault !== false){// return a SOAP fault if we have one.
					$return->soap_fault = $soapfault;
				}
			}else{ // no error message, so return a default
				$return->error_number =  $this->errors[$error['default']][$error['default']]['error_num'];
				$return->error_message = $this->errors[$error['default']][$error['default']]['error_msg'];
			}
			return $return;


		}
		

	}

}