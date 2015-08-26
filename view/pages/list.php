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

$manager = new HotelManager($db);
$hotels_list = $manager->getHotel();

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
			<address class="text-center col-xs-12 col-md-7">
				<strong><?php echo 'Hotel ' . $hotel['name']; ?></strong><br>
				<?php echo $hotel['adress']; ?><br>
				<?php echo $hotel['postcode'] . ' ' . $hotel['city_name']; ?><br>
			</address>
		    <div class="col-xs-12 col-md-1 text-center">
		    	<a class="btn btn-info btn-lg" href="hotel.php?id=<?php echo $hotel['id']; ?>" role="button">Réserver</a>
		    </div>
		</div>
	
	</div>
</div>
<?php endforeach;

require_once('../footer.php');?>
