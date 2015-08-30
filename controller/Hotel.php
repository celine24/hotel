<?php 

class Hotel {

	//gestion des dates

	public function getToday() // pour récupérer la date du jour
	{
		$today = date("Y-m-d");
		return $today;
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