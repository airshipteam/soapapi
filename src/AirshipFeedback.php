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
	protected function prepareInput(){
		if(!$this->checkWSDL($this->server.$this->wsdl))
			    return $this->response = $this->_errorHandler->return_error('server.connection_error');

		return true;
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
	 * CREATE FEEDBACK
	 * Will create feedback
	 * NB - No tests for this method. Feel free to add them if making any change to this method!
	 *
	 * @param array $params
	 * @return array
	 */		
	public function createFeedback( $params ){

		if($this->prepareInput('create_feedback') !== true)
	    	return $this->response;  	

		$this->response = $this->soapCall( 'createFeedback', $this->username, $this->password, $params['contact_id'], $params['unit_id'], $params['source_id'], $params['type_id'], $params['ratings'], $params['comments']);

	    return $this->validateResponse( 'create_feedback' );
	}

	/**
	 * CREATE FEEDBACK WITH DATETIME
	 * Will create feedback with the ability to set the created datetime.
	 * NB - No tests for this method. Feel free to add them if making any change to this method!
	 *
	 * @param array $params
	 * @return array
	 */		
	public function createFeedbackHistory( $params ){

		if($this->prepareInput('create_feedback') !== true)
	    	return $this->response;  	

		$this->response = $this->soapCall( 'createFeedbackHistory', $this->username, $this->password, $params['contact_id'], $params['unit_id'], $params['source_id'], $params['type_id'], $params['created_datetime'], $params['ratings'], $params['comments']);

	    return $this->validateResponse( 'create_feedback' );
	}

	/**
	* SEARCH FEEDBACK
	* Will search feedback 
	*
	* @param int $feedback_id
	* @param array $options
	* @return mixed
	*/		
	public function searchFeedback( $params ){
		
		if ( count($params) === 0 )
			return $this->_errorHandler->return_error('feedback.no_params_set');

		if($this->prepareInput('search_feedback') !== true)
	    	return $this->response;    
	    
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









