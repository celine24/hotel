<?php

DatabaseConnexion {

	protected $host;
    protected $user;
    protected $password;
    protected $db_name;

    public function __construct()
    {
        $this->getConfig();
    }

    public function getConfig()
    {
        $db = require __DIR__ . '/config.php';
        foreach ($db as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


    $db = new PDO('"mysql:host=' . $host . ';dbname=' . $db_name . '","' . $user . '","' . $password .'"');


    //setters
    public function setHost($host)
    {
        $this->host = $host;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setDb_name($db_name)
    {
        $this->db_name = $db_name;
    }

    //Getters
    public function getHost()
    {
        return $this->host;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->password;
    }
    
    public function getDb_name()
    {
        return $this->db_name;
    }
}

