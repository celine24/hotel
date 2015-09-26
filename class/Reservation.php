<?php
class Reservation {
	
	private 
	$_errors = [],
	$_client_id,
	$_hotel_id,
	$_booking_date_start,
	$_booking_date_end;

	/**	
	* Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
	*/
	const INVALID_CLIENT_ID = 'Le client n\'a pas été reconnu.';
	const INVALID_HOTEL_ID = 'L\'hôtel dans lequel vous souhaitez réserver n\'existe pas.';
	const INVALID_BOOKING_DATE_START = 'La date d\'arrivée est invalide.';	
	const INVALID_BOOKING_DATE_END = 'La date de départ est invalide.';
	const INVALID_BOOKING_DATES = 'La date de votre départ doit être supérieure à la date de votre arrivée.';

	public function __construct(array $data) 
	{	
		$this->setClientId($data['client_id']);
		$this->setHotelId($data['hotel_id']);
		$this->setBookingDateStart($data['booking_date_start']);
		$this->setBookingDateEnd($data['booking_date_end']);
	}

	/**	
	* SETTERS
	*/
	public function setId($id)
	{
		$this->_id = (int) $id;
	}

	public function setClientId($client_id)
    {		   
		if ((!is_int($client_id)) AND ($client_id < 0))
		{
			$this->_errors[] = self::INVALID_CLIENT_ID;
		}
		else
		{
			$this->_client_id = $client_id;
		}
	}

	public function setHotelId($hotel_id)
    {		   
		if ((!is_int($hotel_id)) AND ($hotel_id < 0))
		{
			$this->_errors[] = self::INVALID_HOTEL_ID;
		}
		else
		{
			$this->_hotel_id = $hotel_id;
		}
	}

	public function setBookingDateStart($booking_date_start) 
	{
		list($day, $month, $year) = explode(' ', $booking_date_start);
		$english_month = $this->dateConvert($month);
		if (!checkdate($english_month, $day, $year)) 
		{
			$this->_errors[] = self::INVALID_BOOKING_DATE_START;
		}
		else
		{
			$booking_date_start = $year . '-' . $english_month . '-' . $day;
			$this->_booking_date_start = $booking_date_start;
		}
	}

	public function setBookingDateEnd($booking_date_end) 
	{
		list($day, $month, $year) = explode(' ', $booking_date_end);
		$fig_month = $this->dateConvert($month); // convertit le mois français en chiffre
		if (!checkdate($fig_month, $day, $year)) // vérifie que la date est au bon format
		{
			$this->_errors[] = self::INVALID_BOOKING_DATE_END;
		}
		else
		{
			$booking_date_end = $year . '-' . $fig_month . '-' . $day;
			$booking_date_start = $this->getBookingDateStart();
			if ($booking_date_start >= $booking_date_end) // vérifie que la date de départ est bien supérieure à la date d'arrivée
			{
				$this->_errors[] = self::INVALID_BOOKING_DATES;
			}
			else
			{
				$this->_booking_date_end = $booking_date_end;
			}
		}
	}
	
	/**	
	* GETTERS - pour récupérer la valeur des attributs
	*/ 
	public function getErrors()
	{
		return $this->_errors;
	}
	
	public function getId()
	{
		return $this->_id;
    }  

    public function getHotelId()
	{
		return $this->_hotel_id;
    }  

    public function getClientId()
    {
      return $this->_client_id;
    }
	
	public function getBookingDate()
    {
      return $this->_booking_date;
    }
	
	public function getBookingDateStart()
    {
      return $this->_booking_date_start;
    }

    public function getBookingDateEnd()
    {
      return $this->_booking_date_end;
    }

    //FONCTIONS
    public function dateConvert($month) {
		switch ($month) {
		    case 'Janvier':
		        return '01';
		        break;
		    case 'Février':
		        return '02';
		        break;
		    case 'Mars':
		        return '03';
		        break;
		    case 'Avril':
		        return '04';
		        break;
		    case 'Mai':
		        return '05';
		        break;
		    case 'Juin':
		        return '06';
		        break;
		    case 'Juillet':
		        return '07';
		        break;
		    case 'Août':
		        return '08';
		        break;
		    case 'Septembre':
		        return '09';
		        break;
		    case 'Octobre':
		        return '10';
		        break;
		    case 'Novembre':
		        return '11';
		        break;
		    case 'Décembre':
		        return '12';
		        break;
		}
	}	

	//permet de savoir si la réservation est valide
	public function isValid()
	{
		return !(
			empty($this->_client_id) || 
			empty($this->_hotel_id) || 
			empty($this->_booking_date_start) || 
			empty($this->_booking_date_end)
		);
	}

}