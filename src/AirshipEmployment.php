<?php namespace airshipwebservices\soapapi {

    class AirshipEmployment extends Airship{


        public function __construct()
        {
            parent::__construct();
            $this->wsdl = 'Employment.wsdl';
        }


        /*
        * 	Format Inputs
        *
        *	@description 		formats input array
        *
        *	@return BOOL 		BOOL
        */

        protected function formatInput(){

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

        protected function prepareInput($action){

            $this->formatInput();

            if(!empty($this->contact))
                $this->contactWrite = $this->_validator->checkPossibleFields($this->contact, $action.'_fields');

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
         * @param $name
         * @return \stdClass
         */
        public function addSector($name)
        {
            $this->response = $this->soapCall('addSector', $this->username, $this->password, $name);
            return $this->validateResponse('add_sector');
        }

        /**
         * @param $name
         * @return \stdClass
         */
        public function addCompany($name)
        {
            $this->response = $this->soapCall('addCompany', $this->username, $this->password, $name);
            return $this->validateResponse('add_company');
        }

        /**
         * @param $title
         * @return \stdClass
         */
        public function addJobTitle($title)
        {
            $this->response = $this->soapCall('addJobTitle', $this->username, $this->password, $title);
            return $this->validateResponse('add_job_title');
        }

        /**
         * @param $term
         * @return \stdClass
         */
        public function searchSectorsLikeName($term)
        {
            $this->response = $this->soapCall('searchSectorsLikeName', $this->username, $this->password, $term);
            return $this->validateResponse('search_sectors_like_name');
        }

        /**
         * @param $term String
         * @return \stdClass
         */
        public function searchCompaniesLikeName($term)
        {
            $this->response = $this->soapCall('searchCompaniesLikeName', $this->username, $this->password, $term);
            return $this->validateResponse('search_companies_like_name');
        }

        /**
         * @param $term
         * @return \stdClass
         */
        public function searchJobTitlesLikeName($term)
        {
            $this->response = $this->soapCall('searchJobTitlesLikeName', $this->username, $this->password, $term);
            return $this->validateResponse('search_job_title_like_name');
        }

        /**
         * @param array $params
         * @return \stdClass
         */
        public function createEmploymentHistory(array $params)
        {
            $this->response = $this->soapCall('createEmploymentHistory', $this->username, $this->password, $params);
            return $this->validateResponse('create_employment_history');
        }

        /**
         * @param $contactId
         * @param array $params
         * @return \stdClass
         */
        public function updateEmploymentHistory($contactId, array $params)
        {
            $this->response = $this->soapCall('updateEmploymentHistory', $this->username, $this->password, $contactId, $params);
            return $this->validateResponse('update_employment_history');
        }

        /**
         * @param $contactId
         * @return \stdClass
         */
        public function getContactEmploymentHistory($contactId)
        {
            $this->response = $this->soapCall('getContactEmploymentHistory', $this->username, $this->password, $contactId);
            return $this->validateResponse('get_contact_employment_history');
        }

    }

}