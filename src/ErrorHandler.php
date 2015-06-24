<?php namespace airshipwebservices\soapapi {
	

	class ErrorHandler {

		public function __construct()
		{
					include 'Errors.php';

		}

		// All error messages and codes
		

		/**
		 * RETURN ERROR
		 *
		 * @description Return errors to the user eloquently
		 * @param  Sring
		 */

		public function return_error($error_id)
		{

			$error = explode('.',$error_id);
			$return = new \stdClass();
			$return->status = false;
			if(isset($this->errors[$error[0]][$error[1]])){
				$return->error_number =  $this->errors[$error[0]][$error[1]]['error_num'];
				$return->error_message = $this->errors[$error[0]][$error[1]]['error_msg'];
			}else{
				$return->error_number =  $this->errors[$error['default']][$error['default']]['error_num'];
				$return->error_message = $this->errors[$error['default']][$error['default']]['error_msg'];
			}
			return $return;


		}
		

	}

}