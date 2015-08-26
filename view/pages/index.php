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
$HLhotels_list = $manager->getHLHotels();
?>

<div class="starter-template">
    <h1>Le meilleur des Hôtels en France</h1>
    <p class="lead">Faites votre choix parmi notre sélection et réservez partout en France !<br> Passez des vacances inoubliables grâce à hotels-francais.com.</p>
</div>

<div class="row">

	<?php foreach($HLhotels_list as $hotel):?>
	<div class="col-md-4 col-sm-6 col-xs-12">
		<a href="hotel.php?id=<?php echo $hotel['id']; ?>">
			<div class="hf-index-hotel">
				<p class="lead">
					<?php echo $hotel['city_name']; ?><br>
					<small><?php echo $hotel['name']; ?></small>
				</p>
				<p>
					<img class="thumbnail" alt="" src="<?php echo $hotel['picture']; ?>" />
				</p>
			</div>
		</a>
	</div>
	<?php endforeach;?>
</div>

<?php require_once('../footer.php');?>