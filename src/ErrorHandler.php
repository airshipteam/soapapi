<?php namespace airshipwebservices\soapapi {
	

	class ErrorHandler {

		// All error messages and codes
		protected $errors = include 'Errors.php';
		

		/**
		 * RETURN ERROR
		 *
		 * @description Return errors to the user eloquently
		 * @param  Sring
		 */

		protected function return_error($error_id)
		{

			$return = new stdClass();
			$return->status = false;
			$return->error = $errors[$error_id];
			return $return;


		}
		

	}

}