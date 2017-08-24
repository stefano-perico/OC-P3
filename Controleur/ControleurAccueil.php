<?php
require_once('Autoloader.php');

class ControleurAccueil {

    private $article;

    public function __construct() {
      $this->article = new ArticlesManager();
    }

    // Affiche la liste des tous les articles du blog
    public function accueil() {
      $articles = $this->article->get3Articles();
      $vue = new Vue("vueAccueil");
      $vue->generer(array('articles' => $articles));
    }

}
