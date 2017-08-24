<?php

require_once('Autoloader.php');

class Routeur {

  private $ctrlAccueil;
  private $ctrlArticle;


  public function __construct() {
    $this->ctrlAccueil = new ControleurAccueil();
    $this->ctrlArticle = new ControleurArticle();

  }

  // Route une requête entrante : exécution l'action associée
    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'article') {
                    $idArticle = intval($this->getParametre($_GET, 'id'));
                    if ($idArticle != 0) {
                        $this->ctrlArticle->article($idArticle);

                    }
                    else
                        throw new Exception("Identifiant de l'article non valide");
                }
                elseif ($_GET['action'] == 'tous_les_articles')
                {
                    $this->ctrlArticle->allArticles();
                }
                else if ($_GET['action'] == 'commenter') {
                    if(!empty($_POST['pseudo']) AND !empty($_POST['contenu'])){
                        if (isset($_POST['idParent'])){
                            $pseudo = $this->getParametre($_POST, 'pseudo');
                            $contenu = $this->getParametre($_POST, 'contenu');
                            $idArticle = $this->getParametre($_POST, 'idArticle');
                            $idParent = $this->getParametre($_POST, 'idParent');
                            $this->ctrlArticle->commenter($pseudo, $contenu, $idArticle, $idParent);
                        }else{
                            $pseudo = $this->getParametre($_POST,'pseudo');
                            $contenu = $this->getParametre($_POST,'contenu');
                            $idArticle = $this->getParametre($_POST,'idArticle');
                            $this->ctrlArticle->commenter($pseudo, $contenu, $idArticle);
                        }
                    }
                  }
                elseif ($_GET['action'] == 'signaler') {
                  $idCommentaire = intval($this->getParametre($_POST, 'idCommentaire'));
                  $idArticle = intval($this->getParametre($_POST, 'idArticle'));
                  if($idCommentaire != 0){
                    $this->ctrlArticle->signaler($idCommentaire, $idArticle);
                  }
                  else
                      throw new Exception("Identifiant de l'article non valide");
                }

                else
                    throw new Exception("Action non valide");
            }
            else {  // aucune action définie : affichage de l'accueil
                $this->ctrlAccueil->accueil();
            }
        }
        catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }


  // Affiche une erreur
  private function erreur($msgErreur){
    $vue = new Vue("Erreur");
    $vue->generer(array('msgErreur' => $msgErreur));
  }

  // Recherche un paramètre dans un tableau
    private function getParametre($tableau, $nom) {
      if (isset($tableau[$nom])) {
        return htmlspecialchars($tableau[$nom]);
      }
      else
        throw new Exception("Paramètre '$nom' absent");
    }

}
