<?php

class ReservationManager {

	private 
	$_errors = [],
	$_db; //instance de PDO

	/**	
	* Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
	*/
	const INVALID_ROOM_ID = 'Nous sommes désolés, il n\'y a plus de chambres disponibles dans cet hôtel pour la période demandée.';

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

	//ajoute une réservation quand celle-ci est valide
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
		    $stmnt->bindValue(':room_id', $room_id);
		    if ($stmnt->execute())
		    {
		    	return true;
		    }
		}
	}

	//retourne la liste des réservations pour un même hotel
	public function getList(Reservation $reservation) 
	{
		$sql = 'SELECT hotel_id, booking_date, booking_date_start, booking_date_end, room_id FROM reservations WHERE hotel_id = :hotel_id';
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
	
	//attribue une chambre selon la demande du client
	public function addRoom(Reservation $reservation)
	{
		$list = $this->getList($reservation);

		//s'il y au moins déjà une chambre réservée pour cet hotel :
		if (isset($list))
		{
			foreach ($list as $saved_reservation)
			{
				$results[] = $saved_reservation['room_id'];

					//si toutes les chambres de l'hotel ont déjà été attribuées, on vérifie lesquelles sont libres en fonction des dates
					$date_start = $reservation->getBookingDateStart();
					$date_end = $reservation->getBookingDateEnd();

					$saved_room_id = $saved_reservation['room_id'];
					$saved_date_start = $saved_reservation['booking_date_start'];
					$saved_date_end = $saved_reservation['booking_date_end'];

					//si la date d'arrivée demandée est inférieure à la date de départ d'une réservation enregistrée
					if ($date_start < $saved_date_end)
					{
						//si la date de départ demandée est supérieure à la date d'arrivée d'une réservation enregistrée
						if($date_end > $saved_date_start)
						{
							//on récupère les chambres indisponibles grâce au room_id 
							$unavailable_rooms[] = $saved_room_id;
						}
					}	
			}
			//on prend l'id maximum et on lui ajoute 1 pour générer le nouvel id
			$room_id = max($results) + 1;

			$hotel_id = $saved_reservation['hotel_id'];
			$rooms = $this->getNbrRooms($hotel_id);
			//tant que l'id de la chambre est inférieur ou égal au nbre total de chambres :
			while ($room_id <= $rooms) 
			{
				return $room_id;
			}

			//s'il y a bien 1 ou des chambre(s) indisponible(s)
			if (!empty($unavailable_rooms))
			{
				$i = 0;
				//tant que $i est inférieur au nombre total de chambres
				while ($i < $rooms)
				{
					$i++;
					$nbr_rooms[] = $i;
				}

				//sur toutes les chambres de l'hotel, on retire les chambres indisponibles pour ne garder que les disponibles
				$available_rooms = array_diff($nbr_rooms, $unavailable_rooms);
				
				//s'il y a au moins 1 chambre disponible
				if (!empty($available_rooms))
				{
					//on retourne l'id de la première chambre du tableau
					$room_id = current($available_rooms);
					return $room_id;	
				}
				else
				{
					//si toujours aucune chambre libre on retourne l'erreur : 
					$this->_errors[] = self::INVALID_ROOM_ID;
				}
			}
			else
			{
				$room_id = 1;
				return $room_id;
			}
			
		}
		//s'il n'y a aucune chambre réservée pour l'hotel :
		else
		{
			$room_id = 1;
			return $room_id;

			var_dump($room_id);
		}
	}

	//récupère le nombre total de chambres d'un hotel en fonction de son id
	public function getNbrRooms($hotel_id) 
	{
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