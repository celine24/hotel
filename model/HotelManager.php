<?php

class HotelManager {

	private $_db; //instance de PDO

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb (PDO $dbh)
	{
		$this->_db = $dbh;
	}

	public function getHLHotels() // pour récupérer la liste des hotels mis en avant (en page d'accueil)
	{
		$sql= 'SELECT H.id, H.name, H.adress, H.postcode, C.name as city_name, H.picture, H.highlight FROM hotels AS H INNER JOIN cities AS C ON C.id = H.city_id WHERE H.highlight = 1';
		$stmnt=$this->_db->prepare($sql);
		$stmnt->execute();
		while ($row = $stmnt->fetch(PDO::FETCH_ASSOC))
		{
			$result[] = $row;
		}
		return $result;
	}

	public function getHotel($id ='')
	{
		if (empty($id)) //si on a pas d'id, on retourne la liste de tous les hotels
		{
			$sql= 'SELECT H.id, H.name, H.adress, H.postcode, C.name as city_name, H.number_rooms, H.description, H.picture FROM hotels AS H INNER JOIN cities AS C ON C.id = H.city_id';
			$stmnt=$this->_db->prepare($sql);
		}
		elseif (is_numeric($id)) //si on a un id (chiffre), on retourne l'hotel correspondant
		{
			$sql= 'SELECT H.id, H.name, H.adress, H.postcode, C.name as city_name, H.number_rooms, H.description, H.picture FROM hotels AS H INNER JOIN cities AS C ON C.id = H.city_id WHERE h.id= :id';
			$stmnt=$this->_db->prepare($sql);
			$stmnt->bindParam(':id', $id);
		}
		$stmnt->execute();
		while ($row = $stmnt->fetch(PDO::FETCH_ASSOC))
		{
			$result[] = $row;
		}
		return $result;
	}

}