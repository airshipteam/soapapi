<?php namespace airshipwebservices\soapapi {

	use SoapClient;

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

		/*
		* 	SOAP CALL
		*
		*	@description 		make the soap call.
		*		
		*	@return BOOL 		BOOL
		*/

		protected function soapCall($call, $p1 = false, $p2 = false, $p3 = false, $p4 = false, $p5 = false, $p6 = false, $p7 = false, $p8 = false, $p9 = false, $p10 = false, $p11 = false, $p12 = false){
		
			try {
				$this->soap_client = new SoapClient($this->server . $this->wsdl, array("exceptions" => 1));
	    		return $this->soap_client->$call($p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12);
    		}catch(\SoapFault $e) {
				return $this->_errorHandler->return_error('airship.soap_fault', $e->getMessage());
	    	}

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
			return true; // Getting rid of this check as it seems to be an unnecessary extra call for each soap call that is made.
			// $handle = curl_init($url);
			// curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
			// $response = curl_exec($handle);
			// $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
			// curl_close($handle);
			// if($httpCode != 200){
			//     return false;
			// }
			// return true;
		}

	    
	}

}