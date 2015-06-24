<?php namespace airshipwebservices\soapapi {
	

	class SuccessHandler {

			
		/**
		 * RETURN Success
		 *
		 * @description Returns succesful result 
		 * @param  String
		 */

		public function return_success($response)
		{

			$return = new \stdClass();
			$return->status = true;
			$return->response = $response;

		}
		

	}

}