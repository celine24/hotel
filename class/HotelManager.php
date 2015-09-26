<?php

class HotelManager {

	private $_db; //instance de PDO

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb (PDO $db)
	{
		$this->_db = $db;
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

	//fonctions affichage dates
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

	public function frenchDateList() // pour afficher la liste au format français
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