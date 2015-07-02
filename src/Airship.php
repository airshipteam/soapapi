<?php namespace airshipwebservices\soapapi {

	class Airship {

		public $server;  // Holder for Airship Server
		public $username;// Holder for Airship Username
		public $password;// Holder for Airship Password
		public $response;  // Holder for Airship API query response

		protected $_errorHandler;
		protected $_successHandler;
		protected $_validator;
		protected $soap_client;

		public function __construct()
		{
			ini_set("soap.wsdl_cache_enabled", "0");

			$this->_errorHandler = new ErrorHandler();
			$this->_successHandler = new SuccessHandler();
			$this->_validator = new Validator();
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
			    return false;
			}
			return true;
		}

	    
	}

}