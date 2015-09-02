<?php header('Content-type: text/html; charset=UTF-8');



//connexion à la base de données + gestion des erreurs éventuelles
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

//chargement automatique des classes
require_once '../../autoloader.php';

//appel des session pour gérer la connexion des utilisateurs
session_start();


$user_session = new Session();
var_dump($user_session);
//$_SESSION['user'] = $user_session;
//$client = $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Hotel Booking</title>

    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom-hotel-template.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Hôtels Français</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse pull-left">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Accueil</a></li>
            <li><a href="list.php">Nos Hôtels</a></li>
          </ul>
        </div>
        <div id="navbar" class="collapse navbar-collapse pull-right">
          <ul class="nav navbar-nav">
            <?php if($user_session->isConnected()) : ?>
            <li><a href="index.php?log=false">Déconnexion</a></li>
            <?php else :?>
              <li><a href="connection.php">S'identifier</a></li>
              <li><a href="registration.php">S'enregistrer</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">

      

    


    
