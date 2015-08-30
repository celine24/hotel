<?php

class ReservationManager {

	private $_db; //instance de PDO

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb (PDO $dbh)
	{
		$this->_db = $dbh;
	}

	public function addReservation(Reservation $reservation) 
	{
		$sql = 'INSERT INTO reservations SET client_id = :client_id, hotel_id = :hotel_id, booking_date = NOW(), booking_date_start = :booking_date_start, booking_date_end = :booking_date_end';
		$stmnt = $this->db->prepare($sql);
		$stmnt->bindValue(':titre', $news->titre());
	    $stmnt->bindValue(':auteur', $news->auteur());
	    $stmnt->bindValue(':contenu', $news->contenu());
	    
	    $stmnt->execute(); 
	}















	public function getTypes() // pour récupérer la liste des différents types de chambres disponibles
	{
		$sql= 'SELECT id, type FROM types';
		$stmnt=$this->_db->prepare($sql);
		$stmnt->execute();
		while ($row = $stmnt->fetch(PDO::FETCH_ASSOC))
		{
			$result[] = $row;
		}
		return $result;
	}

	
}