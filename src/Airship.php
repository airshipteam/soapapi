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
			}

		public function authenticate($server, $username,  $password)
		{
			$this->server = $server;
			$this->username = $username;
			$this->password = $password;
		}

		protected function handleSoapErrors()
		{
			
			
		}

		protected function checkWSDL()
		{
			$handle = curl_init($url);
			curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

			$response = curl_exec($handle);
			$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
			echo $httpCode;die();

			curl_close($handle);
		}

	    
	}

}