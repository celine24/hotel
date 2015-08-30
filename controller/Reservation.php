<?php
class Reservation {
	
	private 
	$_errors = [],
	$_id,
	$_lastname,
	$_firstname,
	$_email,
	$_type,
	$_booking_date,
	$_booking_date_start,
	$_booking_date_end;

	public function __construct($values = []) 
	{
		if (!empty($values)) // Si on a spécifié des valeurs, alors on hydrate l'objet.
		{
			$this->hydrate($values);
		}

		/*$this->setId($data['id']);
		$this->setLastName($data['lastname']);
		$this->setFirstName($data['firstname']);
		$this->setEmail($data['email']);
		$this->setType($data['type']);
		$this->setBookingDate($data['booking_date']);
		$this->setBookingDateStart($data['booking_date_start']);
		$this->setBookingDateEnd($data['booking_date_end']);
		*/
	}

	//setters

	public function setId($id)
	{
		$this->_id = (int) $id;
	}

	public function setLastName($lastname)
    {		   
		if (!is_string($lastname) AND empty ($lastname))
		{
			$this->_errors[] = self::INVALID_LASTNAME;
		}
		else
		{
			$this->_lastname = $lastname;
		}
	}

	public function setFirstName($firstname)
    {		   
		if (!is_string($firstname) AND empty ($firstname))
		{
			$this->_errors[] = self::INVALID_FIRSTNAME;
		}
		else
		{
			$this->_firstname = $firstname;
		}
	}

	public function setEmail($email)
    {		   
		if (!is_string($email) AND empty ($email))
		{
			$this->_errors[] = self::INVALID_EMAIL;
		}
		else
		{
			$this->_email = $email;
		}
	}

	public function setType($type)
	{
		if (!is_int($type) AND empty ($type))
		{
			$this->_errors[] = self::INVALID_TYPE;
		}
		else
		{
			$this->_type = $type;
		}
	}

	public function setBookingDate(DateTime $booking_date) // pour récupérer la date du jour
	{
		$this->_booking_date = $booking_date;
	}

	public function setBookingDateStart(DateTime $booking_date_start) 
	{
		if (!is_int($booking_date_start) AND empty ($booking_date_start))
		{
			$this->_errors[] = self::INVALID_TYPE;
		}
		else
		{
			$this->_booking_date_start = $booking_date_start;
		}
	}

	public function setBookingDateEnd(DateTime $booking_date_end) // pour récupérer la date du jour
	{
		if (!is_int($booking_date_end) AND empty ($booking_date_end))
		{
			$this->_errors[] = self::INVALID_TYPE;
		}
		else
		{
			$this->_booking_date_end = $booking_date_end;
		}
	}

	//getters - pour récupérer la valeur des attributs

	public function getErrors()
	{
		return $this->_errors;
	}
	
	public function getId()
	{
		return $this->_id;
    }  

    public function getLastName()
    {
		return $this->_lastname;
    }
  
    public function getFirstName()
    {
      return $this->_firstname;
    }
	
	public function getEmail()
    {
      return $this->_email;
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


	//gestion des dates

	public function getToday() // pour récupérer la date du jour
	{
		$today = date("Y-m-d");
		return $today;
	}


	//fonctions

	public function hydrate($data) // assigne les valeurs spécifiées aux attributs correspondants
	{
		foreach ($data as $attribute => $value)
		{
			$method = 'set'.ucfirst($attribute);
      
			if (is_callable([$this, $method]))
			{
				$this->$method($value);
			}
		}
	}

	/**
	* Méthode permettant de savoir si la news est valide.
	* @return bool
	*/
	public function isValid()
	{
		return !(empty($this->auteur) || empty($this->titre) || empty($this->contenu));
	}



	public function dateList() // pour récupérer la liste des dates
	{
		$i = 0;
		while ($i <= 30) {
			$tomorrow = mktime(0,0,0, (int) date('m'), (int) date('d') + $i++, (int) date('Y') );
			$date = date('Y-m-d', $tomorrow);
			$result[] = $date;
		}
		return $result;
	}

	public function displayDateList() // pour afficher la liste au format français
	{
		$list = $this->dateList();
		foreach ($list as $day) {
			$date = explode( '-', $day);
			$year = $date[0];
			$month = $date[1];
			$day = $date[2];
			$frenchMonth = $this->dateConvert($month);
			$result[] = $day . ' ' . $frenchMonth . ' ' . $year;
		}
		return $result;
	}

	public function dateConvert($month) {
		switch ($month) {
		    case '01':
		        return 'Janvier';
		        break;
		    case '02':
		        return 'Février';
		        break;
		    case '03':
		        return 'Mars';
		        break;
		    case '04':
		        return 'Avril';
		        break;
		    case '05':
		        return 'Mai';
		        break;
		    case '06':
		        return 'Juin';
		        break;
		    case '07':
		        return 'Juillet';
		        break;
		    case '08':
		        return 'Août';
		        break;
		    case '09':
		        return 'Septembre';
		        break;
		    case '10':
		        return 'Octobre';
		        break;
		    case '11':
		        return 'Novembre';
		        break;
		    case '12':
		        return 'Décembre';
		        break;
		}
	}	

}