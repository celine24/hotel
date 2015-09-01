<?php require_once('../header.php');




$id = $_GET['id'];

$manager = new HotelManager($db);
$hotel = $manager->getHotel($id);

$reservationManager = new ReservationManager($db);
$type_list = $reservationManager->getTypes();



$dates = new Hotel();
$dates_list = $dates->dateList();
$french_dates = $dates->frenchDateList();

if(isset($_POST['reserve'])) {
	$reservation = new Reservation(
		[
	      'client_id' => $_POST['client_id'],
	      'room_id' => $_POST['room_id'],
	      'hotel_id' => $_POST['hotel_id'],
	      'booking_date_start' => $_POST['booking_date_start'],
	      'booking_date_end' => $_POST['booking_date_end'],
    	]
	);
	$reservationManager->addReservation($reservation);
	var_dump ($reservation);
}

?>

<div class="row">
	<h1 class="col-sm-12">
		<?php echo $hotel[0]['name']; ?>
		<span class="pull-right label label-default"><?php echo $hotel[0]['city_name']; ?></span>
	</h1>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-6 pull-left">
		<img src="<?php echo $hotel[0]['picture']; ?>" alt="<?php echo $hotel[0]['name']; ?>" class="col-xs-12 col-sm-12 thumbnail" />
		<blockquote class="col-xs-12 col-sm-12 text-left">“ <?php echo $hotel[0]['description']; ?> ”</blockquote>
		<address class="text-center col-xs-12 col-sm-12">
			<strong><?php echo 'Hotel ' . $hotel[0]['name']; ?></strong><br>
			<?php echo $hotel[0]['adress']; ?><br>
			<?php echo $hotel[0]['postcode'] . ' ' . $hotel[0]['city_name']; ?><br>
		</address>
	</div>
	<div class="col-xs-12 col-sm-6 pull-left">
		<h2>Réservation</h2>
		
	</div>
</div>

<?php require_once('../footer.php');?>
