<?php


class Routeur {

    private $ctrlAccueil;
    private $ctrlArticle;
    private $ctrlAdmin;

    public function __construct() {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlArticle = new ControleurArticle();
        $this->ctrlAdmin = new ControleurAdmin();
    }

    public function loginAdmin()
    {
        if ($_GET['admin'] == 'connexion')
        {
            $login = $this->getParametre($_POST, 'login');
            $pass = $this->getParametre($_POST, 'pass');
            $this->ctrlAdmin->login($login, $pass);
        }
        elseif (isset($_SESSION['admin']))
        {
            $this->routerAdmin();
        }
        else
        {
            $this->ctrlAdmin->vueLogin();
        }
    }

    public function routerAdmin(){
        if (!isset($_SESSION['admin']))
        {
            $this->ctrlAdmin->forbidden();
        }
        else
        {
            if ($_GET['admin'])
            {
                if ($_GET['admin'] == 'article')
                {
                    $idArticle = intval($this->getParametreAdmin($_GET, 'id'));
                    if ($idArticle != 0)
                    {
                        $this->ctrlAdmin->vueArticle($idArticle);
                    }
                    else
                        throw new Exception("Identifiant de l'article non valide");
                }
                elseif($_GET['admin'] == 'editer')
                {
                    $idArticle = intval($this->getParametreAdmin($_GET, 'id'));
                    if ($idArticle != 0) {
                        $this->ctrlAdmin->editerArticle($idArticle);
                    } else
                        throw new Exception("Identifiant de l'article non valide");
                }
                elseif ($_GET['admin'] == 'creer')
                {
                    $this->ctrlAdmin->vueCreation();
                }
                elseif ($_GET['admin'] == 'modifier')
                {
                    $idArticle = $this->getParametreAdmin($_GET, 'id');
                    $titreArticle = $this->getParametreAdmin($_POST, 'titre');
                    $contenuArticle = $this->getParametreAdmin($_POST, 'contenu');
                    $this->ctrlAdmin->modifierArticle($idArticle, $titreArticle, $contenuArticle);
                }
                elseif($_GET['admin'] == 'envoyer')
                {
                    $titre = $this->getParametreAdmin($_POST,'titre');
                    $contenu = $this->getParametreAdmin($_POST, 'contenu');
                    $this->ctrlAdmin->creerArticle($titre, $contenu);
                }
                elseif ($_GET['admin'] == 'supprimer')
                {
                    $idArticle = $this->getParametreAdmin($_GET, 'id');
                    $this->ctrlAdmin->suprArticle($idArticle);
                }
                elseif ($_GET['admin'] == 'moderer')
                {
                    $idCommentaire = $this->getParametreAdmin($_GET, 'id');
                    echo $idCommentaire;
                    $this->ctrlAdmin->modererCommentaire($idCommentaire);

                }
            }
            else
            {
                $this->ctrlAdmin->accueilAdmin();
            }
        }
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

    private function getParametreAdmin($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return ($tableau[$nom]);
        }
        else
            throw new Exception("Paramètre '$nom' absent");
    }

}
