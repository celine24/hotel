<?php

class ReservationManager {

	private 
	$_errors = [],
	$_db; //instance de PDO

	/**	
	* Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
	*/
	const INVALID_ROOM_ID = 'Nous sommes désolés, il n\'a plus de chambres disponibles dans cet hôtel pour la période demandée.';

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

	public function addReservation(Reservation $reservation) 
	{
		$room_id = $this->addRoom($reservation);
		if (isset($room_id))
		{

			$sql = 'INSERT INTO reservations SET client_id = :client_id, hotel_id = :hotel_id, booking_date = NOW(), booking_date_start = :booking_date_start, booking_date_end = :booking_date_end, room_id = :room_id';
			$stmnt = $this->_db->prepare($sql);
			$stmnt->bindValue(':client_id', $reservation->getClientId());
		    $stmnt->bindValue(':hotel_id', $reservation->getHotelId());
		    $stmnt->bindValue(':booking_date_start', $reservation->getBookingDateStart());
		    $stmnt->bindValue(':booking_date_end', $reservation->getBookingDateEnd());
		    $stmnt->bindValue(':room_id', $this->addRoom($reservation));
		    if ($stmnt->execute())
		    {
		    	return true;
		    }
		}
	}

	//retourne la liste des réservations pour un même hotel
	public function getList(Reservation $reservation) 
	{
		$sql = 'SELECT hotel_id, booking_date_start, booking_date_end, room_id FROM reservations WHERE hotel_id = :hotel_id';
		$stmnt = $this->_db->prepare($sql);
	    $stmnt->bindValue(':hotel_id', $reservation->getHotelId());
	    $stmnt->execute(); 
	    while ($row = $stmnt->fetch(PDO::FETCH_ASSOC))
		{
			$result[] = $row;
		}	
		if (isset($result))
		{
			return $result;	
		}
		
	}
	
	public function addRoom(Reservation $reservation)
	{
		$list = $this->getList($reservation);

		//s'il y au moins déjà une chambre réservée pour cet hotel :
		if (isset($list))
		{
			foreach ($list as $reservation)
			{
				$results[] = $reservation['room_id'];
			}
			//on prend l'id maximum et on lui ajoute 1 pour générer le nouvel id
			$room_id = max($results) + 1;

			$hotel_id = $reservation['hotel_id'];
			$rooms = $this->getNbrRooms($hotel_id);
			//tant que l'id de la chambre est inférieur ou égal au nbre total de chambres :
			while ($room_id <= $rooms) 
			{
				return $room_id;
			}
			//sinon, c'est que l'hotel est complet
			$this->_errors[] = self::INVALID_ROOM_ID;
		}
		//s'il n'y a aucune chambre réservée pour l'hotel :
		else
		{
			$room_id = 1;
			return $room_id;
		}
	}

	public function getNbrRooms($hotel_id) 
	{
		//en fonction de l'hotel_id, on récupère le nombre de chambres total de l'hotel
		$db = $this->_db;
		$hotel = new HotelManager($db);
		$hotel_rooms = $hotel->getHotel($hotel_id);
		$rooms = $hotel_rooms[0]['number_rooms'];
		return $rooms;
	}

	public function getErrors()
	{
		return $this->_errors;
	}
}