<?php

class Session
{
    private $_id,
            $_lastname,
            $_firstname,
            $_email,
            $_connected;

    /**
     * Si l'utilisateur est connecté, le constructeur récupère les données
     */
    public function __construct()
    {
        if (isset($_SESSION['user'])) 
        {
            $this->setId($_SESSION['user']['id']);
            $this->setLastName($_SESSION['user']['lastname']);
            $this->setFirstName($_SESSION['user']['firstname']);
            $this->setEmail($_SESSION['user']['email']);
            $this->setConnected(true);
        } 
        else 
        {
            $this->setConnected(false);
        }
    }

    /**
     * Permet de se déconnecter
     * @return bool
     */
    public function logout()
    {
        if ($this->isConnected()) {
            unset($_SESSION['user']);
            $this->setConnected(false);
            header('Location: index.php');
        }
        return true;
    }
    /**
     * @return boolean
     */
    
    /**
     * GETTERS
     */

    public function getId()
    {
        return $this->_id;
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

    public function isConnected()
    {
        return $this->_connected;
    }

    /**
     * SETTERS
     */

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function setLastName($lastname)
    {
        $this->_lastname = $lastname;
    }

    public function setFirstName($firstname)
    {
        $this->_firstname = $firstname;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function setConnected($connected)
    {
        $this->_connected = $connected;
    }
}