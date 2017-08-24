<?php
/**
 * Created by PhpStorm.
 * User: stefa
 * Date: 17/08/2017
 * Time: 16:31
 */
require_once('Autoloader.php');
class AdminManager extends Modele
{
    private $_db;

    public function __construct()
    {
        $this->_db = $this->getBdd();
    }


    /**
     * @param $login
     * @param $pass
     * @return bool
     */
    public function login($login, $pass)
    {
        $sql = $this->_db->prepare('SELECT * FROM users WHERE login =:login');
        $sql->execute(['login' => $login]);
        $donnees = $sql->fetch();
        if ($donnees)
        {
            $user = new Admin($donnees);
            if ($user->getPassword() === sha1($pass))
            {
                $_SESSION['admin'] = $user->getId();
                return true;
            }
        }
        return false;
    }


}