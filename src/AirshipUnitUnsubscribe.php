<?php namespace airshipwebservices\soapapi {

    class AirshipUnitUnsubscribe extends Airship{

        public  $wsdl;             // Alphanumeric
        protected $contactWrite  = array();          // Array


        public function __construct()
        {
            parent::__construct();
            $this->wsdl = 'UnitUnsubscribe.wsdl';
        }



        /*
        * 	PREPARE INPUT
        *
        *	@description 		prepares input array and checks we havea valid soap connection
        *
        *	@param 	string 		action
        *
        *	@return int 		mixed
        */

        protected function prepareInput($action)
        {

            if(!$this->checkWSDL($this->server.$this->wsdl))
                return $this->response = $this->_errorHandler->return_error('server.connection_error');

            return true;

        }

        /*
        * 	VALIDATE RESPONSE
        *
        *	@description 		Validate response of return from SOAP
        *
        */

        protected function validateResponse($action)
        {
            return $this->_validator->validateResponse($this->response, $action.'_response');
        }


        /**
         * Returns all units that a contact belongs to a group on that unit
         * @param $contactId
         * @return \stdClass
         */
        public function getUnitSubscriptions($contactId)
        {

            if($this->prepareInput('get_unit_subscriptions') !== true)
                return $this->response;

            //Make The Call
            $this->response = $this->soapCall('getUnitSubscriptions', $this->username, $this->password, $contactId);
            return $this->validateResponse('get_unit_subscriptions');

        }



    }

}