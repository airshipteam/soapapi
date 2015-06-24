<?php namespace airshipwebservices\soapapi {

	class Airship {

		public $server;
		public $username;
		public $password;

		public $result;//some object that's being returned or false if there is an error
		public $error;//holder for the error message

		protected $soap_client;

		public function __construct()
		{
			ini_set("soap.wsdl_cache_enabled", "0");
			$this->_errorHandler = new ErrorHandler();
		}


		/**
		 * AUTHENTICATE
		 *
		 * @description Set the user's SOAP credentials. 
		 * @param  URL
		 * @param  String
		 * @param  Sring
		 */

		public function authenticate($server, $username,  $password)
		{
			$this->server = $server;
			$this->username = $username;
			$this->password = $password;
		}

		/**
		 * ERROR HANDLER
		 *
		 * @description Return errors to the user eloquently
		 * @param  Sring
		 */

		protected function error_handler()
		{



		}


		/**
		 * CHECK WSDL
		 *
		 * @description Check that the WSDL URL we are about to use is alive and well. 
		 * Otherwise the server will create a fatal error and our script will fail. 
		 * @param  URL
		 * @return BOOLEAN
		 */

		protected function checkWSDL($url)
		{
			$handle = curl_init($url);
			curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
			$response = curl_exec($handle);
			$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
			curl_close($handle);
			if($httpCode != 200){
			    $this->error_code = 'Could not connect to Airship Server';
			    return $this->_errorHandler->return_error('server.connection_error');
			}
			return true;
		}

	    
	}

}