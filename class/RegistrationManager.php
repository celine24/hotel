<?php

class RegistrationManager {

	private 
	$_errors = [],
	$_db; //instance de PDO

	/**	
	* Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
	*/
	const INVALID_LOGIN = 'Aucun utilisateur enregistré dans la base avec ce pseudo.';
	const INVALID_PASSWORD = 'Le mot de passe que vous avez entré est incorrect.';
	const INVALID_EMAIL = 'Un compte associé à cet email a déjà été créé.';

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb (PDO $db)
	{
		$this->_db = $db;
	}

	public function addUser(Registration $registration) 
	{
		$email = $registration->getEmail();
		$check = $this->checkEmail($email);
		if ($check === true)
		{
			$password = $registration->getPassword();
			$hash_password = $this->cryptPassword($password);
			$sql = 'INSERT INTO clients SET lastname = :lastname, firstname = :firstname, email = :email, password = :password';
			$stmnt = $this->_db->prepare($sql);
			$stmnt->bindValue(':lastname', $registration->getLastName());
		    $stmnt->bindValue(':firstname', $registration->getFirstName());
		    $stmnt->bindValue(':email', $email);
		    $stmnt->bindValue(':password', $hash_password);
			if ($stmnt->execute()) 
			{ 
			   return true;
			}
		} 
	}

	public function checkEmail($email) 
	{
		$sql = 'SELECT email FROM clients WHERE email = :email';
		$stmnt = $this->_db->prepare($sql);
	    $stmnt->bindValue(':email', $email);
		$stmnt->execute(); 
	    while ($row = $stmnt->fetch(PDO::FETCH_ASSOC))
	    {
	    	$result = $row;
	    } 
	    if (isset($result)) 
	    { 
	    	$this->_errors[] = self::INVALID_EMAIL;
	    }
	    else 
	    {
	    	return true;
	    }
	    
	}

	public function login(Connection $connection)
	{
		$sql = 'SELECT id, lastname, firstname, email, password FROM clients WHERE email = :email';
		$stmnt = $this->_db->prepare($sql);
		$stmnt->bindValue(':email', $connection->getEmail());
	    $stmnt->execute(); 
	    while ($row = $stmnt->fetch(PDO::FETCH_ASSOC))
	    {
	    	$result[] = $row;
	    }
	    if (empty($result)) 
	    {
	    	$this->_errors[] = self::INVALID_LOGIN;
	    	return false;
	    }
	    else 
	    {
	    	$password = $connection->getPassword();
	    	$hash_password = $this->cryptPassword($password);
	    	if ($this->cryptPassword($password) != $result[0]['password']) 
	    	{
	    		$this->_errors[] = self::INVALID_PASSWORD;
	    		return false;
			}
			else 
			{
				$session = New Session (
                	[
                		$_SESSION['user']['id'] = $result[0]['id'],
				        $_SESSION['user']['lastname'] = $result[0]['lastname'],
				        $_SESSION['user']['firstname'] = $result[0]['firstname'],
				        $_SESSION['user']['email'] = $result[0]['email'],
				        $_SESSION['user']['connected'] = true
                	]
                );
				return true;
			}
	    }
	}

	public function cryptPassword($password)
	{
		$hash_password = crypt($password, 'hrtfupytwxzr');
		return $hash_password;
	}

	public function getErrors()
	{
		return $this->_errors;
	}
}