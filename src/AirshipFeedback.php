<?php namespace airshipwebservices\soapapi;
	
class AirshipFeedback extends Airship{

	/*************
	* 
	* LITERALS
	*
	**************/

	/**
	 * WSDL for SOAP contact 
	 *
	 * @var string
	 */ 		
	protected $wsdl = 'Feedback.wsdl';

	/**
	 * The parameter names for the getBookings call
	 *
	 * @var array
	 */ 		
	protected $feedback_param_names = array(
		'EqualsArgs',
		'GreaterThanArgs',
		'LessThanArgs',
		'InSQLArgs',
		'myResultOptions'
	);

	/*************
	* 
	* METHODS
	*
	**************/

	/**
	 * CONSTRUCTOR
	 * Get an instance of the class
	 *
	 * @return null
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	 * CHECK WSDL
	 * Checks we have a valid soap connection
	 * 
	 * @return mixed
	 */
	protected function checkConnection(){
		if(!$this->checkWSDL($this->server.$this->wsdl))
		 	return array(
		 			'success' => false,
		 			'message' => $this->_errorHandler->return_error('server.connection_error')
		 	);
		
		return array( 'success' => true, 'message' => false );
	}

	/**
	 * VALIDATE RESPONSE
	 * Validate response of return from SOAP
	 *	
	 * @return mixed
	 */
	protected function validateResponse( $action ){
		return $this->_validator->validateResponse( $this->response, $action.'_response' );
	}

	/**
	* GET FEEDBACK
	* Will get feedback for a contact id
	*
	* @param int $feedback_id
	* @param array $options
	* @return mixed
	*/		
	public function getFeedback( $params ){
		if ( count($params) === 0 )
			return array(
		 			'success' => false,
		 			'message' => $this->_errorHandler->return_error('feedback.no_params_set')->error_message
		 	);

		$connection = $this->checkConnection();
		if($connection['success'] !== true)
	    	return $connection['message'];	    
	    
	    $feedback_params = array();

	    foreach( $this->feedback_param_names as $param_name ){
	    	$feedback_params[$param_name] = array();
	   		if( isset($params[$param_name])  && count($params[$param_name]) > 0)
				foreach( $params[$param_name] as $field => $value ){
					$feedback_params[$param_name][$field] = $value;
				}	
	    }		
		
		//Make The Call
		$this->response = $this->soapCall(	'searchFeedback', 
											$this->username, 
											$this->password,
											$feedback_params['EqualsArgs'],
											$feedback_params['GreaterThanArgs'],
											$feedback_params['LessThanArgs'],
											$feedback_params['InSQLArgs'],
											$feedback_params['myResultOptions']
										);
		
		return $this->validateResponse( 'search_feedback' );	
	}
}









