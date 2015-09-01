<?php require_once('../header.php');

$manager = new HotelManager($db);
$hotels_list = $manager->getHotel();

$reservationManager = new ReservationManager($db);

$dates = new Hotel();
$dates_list = $dates->dateList();
$french_dates = $dates->frenchDateList();

if(isset($_POST['reserve'])) {
	$reservation = new Reservation(
		[
	      'client_id' => $_POST['client_id'],
	      'hotel_id' => $_POST['hotel_id'],
	      'booking_date_start' => $_POST['booking_date_start'],
	      'booking_date_end' => $_POST['booking_date_end'],
    	]
	);
	$reservationManager->addReservation($reservation);
	var_dump ($reservation);
}

foreach($hotels_list as $hotel):?>

<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
		 	<h2><?php echo $hotel['name']; ?>
		 		<span class="pull-right label label-default"><?php echo $hotel['city_name']; ?></span>
		 	</h2>
		</div>
	    <div class="panel-body">
	    	<img src="<?php echo $hotel['picture']; ?>" alt="" class="col-xs-12 col-sm-3 pull-left thumbnail" />
		    <blockquote class="col-xs-12 col-sm-9 pull-right">“ <?php echo $hotel['description']; ?> ”</blockquote>
			<address class="text-center col-xs-12 col-md-2">
				<strong><?php echo 'Hotel ' . $hotel['name']; ?></strong><br>
				<?php echo $hotel['adress']; ?><br>
				<?php echo $hotel['postcode'] . ' ' . $hotel['city_name']; ?><br>
			</address>
		    <?php require('booking_form.php');?>
		</div>
	
	</div>
</div>
<?php endforeach;

require_once('../footer.php');?>
