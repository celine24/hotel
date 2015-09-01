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
	const INVALID_LASTNAME = 1;
	const INVALID_FIRSTNAME = 2;
	const INVALID_EMAIL = 3;
	const INVALID_USERNAME = 4;	
	const INVALID_PASSWORD = 5;

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
		if (!is_string($lastname))
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
		if (!is_string($firstname))
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