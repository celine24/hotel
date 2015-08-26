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