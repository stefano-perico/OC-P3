<?php

class user
{
    private $_id;
    private $_login;
    private $_password;

    const URL_ACCUEIL = 'index.php?admin';

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId() { return $this->_id; }

    /**
     * @return mixed
     */
    public function getLogin() { return $this->_login; }

    /**
     * @return mixed
     */
    public function getPassword() { return $this->_password; }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @param mixed $nom
     */
    public function setLogin($nom)
    {
        $this->_login = $nom;
    }

    /**
     * @param mixed $pass
     */
    public function setPassword($pass)
    {
        $this->_password = $pass;
    }

}