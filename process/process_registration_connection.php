<?php

$registrationManager = new RegistrationManager($db);

//si on a utilisé le formulaire d'inscription
if (isset($_POST['register']))
{
	$registration = new Registration(
		[
		    'lastname' => $_POST['lastname'],
		    'firstname' => $_POST['firstname'],
		    'email' => $_POST['email'],
		    'password' => $_POST['password'],
	    ]
	);

	//on demande l'enregistrement de l'utilisateur dans la base avec les infos fournies
	$add_user = $registrationManager->addUser($registration);

	//si l'enregistrement a réussi : 
	if ($add_user === true) 
	{
		header('Location: index.php'); 
	}
	else 
	{
		$error_msg =  'Une erreur est survenue. Votre compte n\'a pas été créé.';
	}
}

//si on a utilisé le formulaire de connexion
if (isset($_POST['connection']))
{
	$connection = new Connection(
		[
		    'email' => $_POST['email'],
		    'password' => $_POST['password'],
	    ]
	);


	//on fait appel à la méthode de connexion si l'utilisateur n'est pas déjà connecté
	if($user_session->isConnected()) 
	{
		$error_msg =  'Vous êtes déjà authentifié.';
	}
	else 
	{
		$user_connection = $registrationManager->login($connection);

	//si la connexion a réussi : 
		if ($user_connection === true) 
		{
			header('Location: index.php');
		}
		else
		{
			$error_msg = 'Une erreur est survenue. Vous n\'avez pas été authentifié.';
		}
	}
}