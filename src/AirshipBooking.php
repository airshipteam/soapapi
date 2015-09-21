<?php namespace airshipwebservices\soapapi;
	
class AirshipBooking extends Airship{

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
	protected $wsdl = 'Bookings.wsdl';	

	/**
	 * The parameter names for the getBookings call
	 *
	 * @var array
	 */ 		
	protected $booking_param_names = array(
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
	 * @return 
	 */
	protected function validateResponse( $action ){
		return $this->_validator->validateResponse( $this->response, $action.'_response' );
	}

	/**
	 * GET BOOKINGS
	 * Will get bookings dependant on parameters passed	
	 *
	 * @param array $params
	 * @return null
	 */		
	public function getBookings( $params ){
		if ( count($params) === 0 )
			return array(
		 			'success' => false,
		 			'message' => $this->_errorHandler->return_error('booking.no_params_set')->error_message
		 	);

		$connection = $this->checkConnection();
		if($connection['success'] !== true)
	    	return $connection['message'];	    
	    
	    $booking_params = array();

	    foreach( $this->booking_param_names as $param_name ){
	    	$bookings_params[$param_name] = array();
	   		if( isset($params[$param_name])  && count($params[$param_name]) > 0)
				foreach( $params[$param_name] as $field => $value ){
					$bookings_params[$param_name][$field] = $value;
				}	
	    }		
		
		//Make The Call
		$this->response = $this->soapCall(	'getBookings', 
											$this->username, 
											$this->password,
											$bookings_params['EqualsArgs'],
											$bookings_params['GreaterThanArgs'],
											$bookings_params['LessThanArgs'],
											$bookings_params['InSQLArgs'],
											$bookings_params['myResultOptions']
										);
		
		return $this->validateResponse( 'get_bookings' );	    				
	}

	/**
	* GET BOOKING NOTES
	* Will get booking notes for a given booking id
	*
	* @param int $booking_id
	* @return null
	*/		
	public function getBookingNotes( $booking_id ){		
		$connection = $this->checkConnection();
		if($connection['success'] !== true)
	    	return $connection['message'];

	    //Make The Call
		$this->response = $this->soapCall( 'getBookingNotes', $this->username, $this->password, $booking_id );
		return $this->validateResponse( 'get_booking_notes' ); 
	}

	/**
	* GET BOOKING TYPES
	* Will get booking types for a given account
	*	
	* @return null
	*/		
	public function getBookingTypes(){
		$connection = $this->checkConnection();
		if($connection['success'] !== true)
	    	return $connection['message'];

	    $this->response = $this->soapCall( 'getBookingTypes', $this->username, $this->password );
	    return $this->validateResponse( 'get_booking_types' );
	}	
}





