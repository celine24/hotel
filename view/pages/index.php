<?php 
require_once('../header.php');
require_once('../../process/process_index.php');
?>

<div class="starter-template">
    <h1>Le meilleur des Hôtels en France</h1>
    <p class="lead">Faites votre choix parmi notre sélection et réservez partout en France !<br> Passez des vacances inoubliables grâce à hotels-francais.com.</p>
</div>

<div class="row">
    <ul class="bxslider">
        <?php foreach($HLhotels_list as $hotel):?>
        <a href="list.php#<?php echo $hotel['id']; ?>">
            <li class="hf-index-hotel">
                <p class="lead">
                    <?php echo $hotel['city_name']; ?><br>
                    <small><?php echo $hotel['name']; ?></small>
                </p>
                <p>
                    <img alt="<?php echo $hotel['name']; ?>" src="<?php echo $hotel['picture']; ?>" />
                </p>
            </li>
        </a>
        <?php endforeach;?>
    </ul>
</div>
<?php require_once('../footer.php');?>