<?php

if((isset($_GET['log']) && ($_GET['log'] == 'false'))) {
	$user_session->logout();
}

$manager = new HotelManager($db);
$HLhotels_list = $manager->getHLHotels();

?>