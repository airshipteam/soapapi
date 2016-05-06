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
	 * @return array
	 */
	protected function prepareInput($action){
		if(!$this->checkWSDL($this->server.$this->wsdl))
			return $this->response = $this->_errorHandler->return_error('server.connection_error');

		return true;
	}

	/**
	 * VALIDATE RESPONSE
	 * Validate response of return from SOAP
	 *
	 * @return array
	 */
	protected function validateResponse( $action ){
		return $this->_validator->validateResponse( $this->response, $action.'_response' );
	}

	/**
	 * CREATE BOOKINGS
	 * Will create a booking 
	 * NB - No tests for this method. Feel free to add them if making any change to this method!
	 *
	 * @param array $params
	 * @return array
	 */		
	public function createBooking( $params ){

		if($this->prepareInput('create_booking') !== true)
	    	return $this->response;  	

	    // Do we have booking area? 
	    if( isset($params['booking_areas']) )
		    $this->response = $this->soapCall( 'createBooking', $this->username, $this->password, $params['booking'], $params['booking_areas'] );
		else
			$this->response = $this->soapCall( 'createBooking', $this->username, $this->password, $params['booking'] );

	    return $this->validateResponse( 'create_booking' );
	}

	/**
	 * GET BOOKINGS
	 * Will get bookings dependant on parameters passed	
	 *
	 * @param array $params
	 * @return array
	 */		
	public function getBookings( $params ){
		if ( count($params) === 0 )
			return $this->_errorHandler->return_error('booking.no_params_set');

		if($this->prepareInput('get_bookings') !== true)
	    	return $this->response;  	    
	    
	    $bookings_params = array();

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
	* @return array
	*/		
	public function getBookingNotes( $booking_id ){		
		if($this->prepareInput('get_booking_notes') !== true)
	    	return $this->response;  
	    //Make The Call
		$this->response = $this->soapCall( 'getBookingNotes', $this->username, $this->password, $booking_id );
		return $this->validateResponse( 'get_booking_notes' ); 
	}

	/**
	* GET BOOKING TYPES
	* Will get booking types for a given account
	*	
	* @return array
	*/		
	public function getBookingTypes(){
		if($this->prepareInput('get_booking_types') !== true)
	    	return $this->response;  

	    $this->response = $this->soapCall( 'getBookingTypes', $this->username, $this->password );
	    return $this->validateResponse( 'get_booking_types' );
	}	

	/**
	* GET BOOKING SOURCES
	* Will get booking sources for a given account
	*	
	* @return array
	*/		
	public function getBookingSources(){
		if($this->prepareInput('get_booking_sources') !== true)
	    	return $this->response;  

	    $this->response = $this->soapCall( 'getBookingSources', $this->username, $this->password );
	    return $this->validateResponse( 'get_booking_sources' );
	}	

	/**
	* UPDATE BOOKING 
	* Will update a booking
	*	
	* @return array
	*/		
	public function updateBooking($booking){
		if($this->prepareInput('update_booking') !== true)
	    	return $this->response;  	

	    // Do we have booking area? 
		    $this->response = $this->soapCall( 'updateBooking', $this->username, $this->password, $booking->booking, $booking->booking_areas );

	    return $this->validateResponse( 'update_booking' );
	}	
}





