<?php

class Connection {

	private 
	$_errors = [],
	$_email,
	$_password;


	/**	
	* Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
	*/
	const INVALID_EMAIL = 'L\'email est invalide.';	
	const INVALID_PASSWORD = 'Le mot de passe est invalide.';

	public function __construct(array $data) 
	{	
		$this->setEmail($data['email']);
		$this->setPassword($data['password']);
	}

	/**	
	* SETTERS
	*/

	public function setEmail($email) 
	{
		if ((!is_string($email)) OR (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)))
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

    public function getEmail()
    {
      return $this->_email;
    }
		
	public function getPassword()
    {
      return $this->_password;
    }



}