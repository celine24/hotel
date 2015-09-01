<?php

class ReservationManager {

	private $_db; //instance de PDO

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb (PDO $db)
	{
		$this->_db = $db;
	}

	public function addReservation(Reservation $reservation) 
	{
		$sql = 'INSERT INTO reservations SET client_id = :client_id, hotel_id = :hotel_id, booking_date = NOW(), booking_date_start = :booking_date_start, booking_date_end = :booking_date_end';
		$stmnt = $this->_db->prepare($sql);
		$stmnt->bindValue(':client_id', $reservation->getClientId());
	    $stmnt->bindValue(':hotel_id', $reservation->getHotelId());
	    $stmnt->bindValue(':booking_date_start', $reservation->getBookingDateStart());
	    $stmnt->bindValue(':booking_date_end', $reservation->getBookingDateEnd());
	    $stmnt->execute(); 
	}
	
}