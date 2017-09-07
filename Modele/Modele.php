<?php
/**
* Partie Modèle d'une architecture MVC encapsule la logique métier (« business logic ») ainsi que l'accès aux données. Il peut s'agir d'un ensemble
* De fonctions (Modèle procédural) ou de classes (Modèle orienté objet).
**/

abstract class Modele {

  // Objet PDO d'accès à la BD
  private $bdd;
  private $serveur = "localhost";
  private $database = "blog_p3";
  private $login = "root";
  private $pass = "";

  // création d'une fonction ce connecte à la base de donnée
  // Instancie et renvoie l'objet PDO associé
  protected function getBdd() {
    if($this->bdd == null){
      $this->bdd = new PDO('mysql:host='.$this->serveur.';dbname='.$this->database.';charset=utf8', $this->login, $this->pass,
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      /** connexion à la base de donnnée 'mysql:host=''adresse de la base de donnée' ; 'dbname=' le nom de la table à laquelle on veux accéder
      ; 'charset=utf8' est l'encodage de caractére de la page, 'root' est le nom d'utilisateur, '' est le mot de passe.
      **/
    }
    return $this->bdd;
  }


}
