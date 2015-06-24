<?php namespace airshipwebservices\soapapi {

	class Airship {

		public $server;
		public $username;
		public $password;

		public $result;//some object that's being returned or false if there is an error
		public $error;//holder for the error message


		protected $soap_client;


		public function __construct($server, $username, $password)
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

	    
	}

}