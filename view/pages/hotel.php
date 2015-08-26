<?php require_once('../header.php');

//gestion des erreurs lors de la connexion à la base de données
try
{
	//instanciation de PDO
	$db = new PDO('mysql:host=localhost;dbname=booking', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$db->exec("SET NAMES 'UTF8'");
}
catch(Exception $e)
{
	echo 'Echec lors de la connexion : ' . $e->getMessage() . '<br>';
	exit;
}

require('../../model/HotelManager.php');
require('../../model/ReservationManager.php');

$id = $_GET['id'];

$manager = new HotelManager($db);
$hotel = $manager->getHotel($id);

$reservation = new ReservationManager($db);
$type_list = $reservation->getTypes();
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
		<form>
			<input type="hidden" class="form-control" id="booking_date" value="<?php echo date("d-F-Y");?>">
			<input type="hidden" class="form-control" id="hotel_id" value="<?php echo $hotel[0]['id']; ?>">
			<div class="form-group">
		    	<label for="nom">Nom</label>
		    	<input type="text" class="form-control" id="lastname" placeholder="Nom">
		  	</div>
		  	<div class="form-group">
		    	<label for="prenom">Prénom</label>
		    	<input type="text" class="form-control" id="firstname" placeholder="Prénom">
		  	</div>
		    <div class="form-group">
		    	<label for="email">Adresse Email</label>
		    	<input type="email" class="form-control" id="email" placeholder="Email">
		  	</div>
		  	<div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			</div>
			<div class="form-group">
			    <label for="exampleInputFile">Type de Chambre</label>
			    <select id="exampleInputFile">
			    	<?php foreach ($type_list as $type):?>
			    		<option name="type" value="<?php echo $type['id'];?>"><?php echo $type['type'];?></option>
			    	<?php endforeach;?>
			    <p class="help-block">Example block-level help text here.</p>
				</select>
			</div>
			<div class="checkbox">
			    <label>
			      <input type="checkbox"> Check me out
			</label>
			</div>
			<button type="submit" class="btn btn-default">Réserver</button>
		</form>
	</div>
</div>

<?php require_once('../footer.php');?>
