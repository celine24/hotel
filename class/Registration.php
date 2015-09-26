<?php

class Registration {

	private 
	$_errors = [],
	$_lastname,
	$_firstname,
	$_email,
	$_password;


	/**	
	* Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
	*/
	const INVALID_LASTNAME = 'Le nom de famille est invalide.';
	const INVALID_FIRSTNAME = 'Le prénom est invalide.';
	const INVALID_EMAIL = 'L\'adresse email est invalide.';
	const INVALID_PASSWORD = 'Le mot de passe est invalide.';

	public function __construct(array $data) 
	{	
		$this->setLastName($data['lastname']);
		$this->setFirstname($data['firstname']);
		$this->setEmail($data['email']);
		$this->setPassword($data['password']);
	}

	/**	
	* SETTERS
	*/
	public function setId($id)
	{
		$this->_id = (int) $id;
	}

	public function setLastName($lastname)
    {		   
		if ((!is_string($lastname)) OR (!preg_match("/^[a-z ,.'-]+$/i", $lastname)))
		{
			$this->_errors[] = self::INVALID_LASTNAME;
		}
		else
		{
			$this->_lastname = $lastname;
		}
	}

	public function setFirstname($firstname)
    {		   
		if ((!is_string($firstname)) OR (!preg_match("/^[a-z ,.'-]+$/i", $firstname)))
		{
			$this->_errors[] = self::INVALID_FIRSTNAME;
		}
		else
		{
			$this->_firstname = $firstname;
		}
	}

	public function setEmail($email) 
	{
		if ((!is_string($email)) AND (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)))
		{
			$this->_errors[] = self::INVALID_EMAIL;
		}
		else
		{
			$this->_email = $email;
		}
	}

	public function setPassword($password) 
	{
		if (!is_string($password))
		{
			$this->_errors[] = self::INVALID_PASSWORD;
		}
		else
		{
			$this->_password = $password;
		}
	}

	
	/**	
	* GETTERS - pour récupérer la valeur des attributs
	*/ 
	public function getErrors()
	{
		return $this->_errors;
	}
	
	public function getLastName()
	{
		return $this->_lastname;
    }  

    public function getFirstName()
	{
		return $this->_firstname;
    }  

    public function getEmail()
    {
      return $this->_email;
    }
		
	public function getPassword()
    {
      return $this->_password;
    }

}