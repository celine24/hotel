<?php

//affichage des infos pour chaque hotel (liste + dates pour formulaire)
$manager = new HotelManager($db);
$hotels_list = $manager->getHotel();
$dates = new Hotel();
$dates_list = $dates->dateList();
$french_dates = $dates->frenchDateList();


$reservationManager = new ReservationManager($db);

//si on a utilisé le formulaire de réservation
if(isset($_POST['reserve'])) {
	$reservation = new Reservation(
		[
	      'client_id' => $_POST['client_id'],
	      'hotel_id' => $_POST['hotel_id'],
	      'booking_date_start' => $_POST['booking_date_start'],
	      'booking_date_end' => $_POST['booking_date_end'],
    	]
	);

	if ($reservation->isValid())
	{
		//on demande l'enregistrement de la réservation dans la base avec les infos fournies
		$add_reservation = $reservationManager->addReservation($reservation);

		//si la réservation a réussi : 
		if ($add_reservation === true) 
		{
			$success_msg =  'Félicitations ! Votre réservation a bien été prise en compte. ';
		}
		else 
		{
			$error_msg = 'Une erreur est survenue. Votre réservation n\'a pas été enregistrée.';
			$errors = $reservationManager->getErrors();
		}
	}
	else 
	{
		$error_msg = 'Votre réservation n\'a pas été enregistrée.';
		$errors = $reservation->getErrors();		
	}
	
}