<?php

class RegistrationManager {

	private $_db; //instance de PDO

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
		$password = $registration->getPassword();
		$hash_password = $this->cryptPassword($password);
		$sql = 'INSERT INTO clients SET lastname = :lastname, firstname = :firstname, email = :email, password = :password';
		$stmnt = $this->_db->prepare($sql);
		$stmnt->bindValue(':lastname', $registration->getLastName());
	    $stmnt->bindValue(':firstname', $registration->getFirstName());
	    $stmnt->bindValue(':email', $registration->getEmail());
	    $stmnt->bindValue(':password', $hash_password);
		if ($stmnt->execute()) 
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
	    	echo 'Aucun utilisateur enregistré.';
	    	return false;
	    }
	    else 
	    {
	    	$password = $connection->getPassword();
	    	$hash_password = $this->cryptPassword($password);
	    	if ($this->cryptPassword($password) != $result[0]['password']) 
	    	{
	    		echo 'Le mot de passe que vous avez entré est incorrect !';
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
				        $connected = true
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
}