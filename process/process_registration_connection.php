<?php

$registrationManager = new RegistrationManager($db);

//si on a utilisé le formulaire d'inscription
if (isset($_POST['register']))
{
	$registration = new Registration(
		[
		    'lastname' => htmlspecialchars($_POST['lastname']),
		    'firstname' => htmlspecialchars($_POST['firstname']),
		    'email' => htmlspecialchars($_POST['email']),
		    'password' => htmlspecialchars($_POST['password']),
	    ]
	);

	$errors = $registration->getErrors();
	if(!empty($errors))
	{
		$error_msg =  'Votre compte ne peut être créé :';
		$errors = $registration->getErrors();
	}
	else
	{
		//on demande l'enregistrement de l'utilisateur dans la base avec les infos fournies
		$add_user = $registrationManager->addUser($registration);

		//si l'enregistrement a réussi : 
		if ($add_user === true) 
		{
			$success_msg = 'Félicitations, votre compte a bien été créé ! Identifiez-vous pour pouvoir réserver dans l\'hôtel de vos rêves :)'; 
		}
		else 
		{
			$error_msg =  'Une erreur est survenue. Votre compte n\'a pas été créé.';
			$errors = $registrationManager->getErrors();
		}
	}
}

//si on a utilisé le formulaire de connexion
if (isset($_POST['connection']))
{
	$connection = new Connection(
		[
		    'email' => htmlspecialchars($_POST['email']),
		    'password' => htmlspecialchars($_POST['password']),
	    ]
	);

	$errors = $connection->getErrors();
	if(!empty($errors))
	{
		$error_msg =  'Vous n\'avez pas été identifié :';
		$errors = $connection->getErrors();
	}
	else
	{
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
				$success_msg = 'Vous avez bien été authentifié :) Vous pouvez désormais réserver dans l\'hôtel de vos rêves !';
			}
			else
			{
				$error_msg = 'Une erreur est survenue. Vous n\'avez pas été authentifié.';
				$errors = $registrationManager->getErrors();
			}
		}
	}
}