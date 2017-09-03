<?php
/**
 * Created by PhpStorm.
 * User: stefa
 * Date: 10/08/2017
 * Time: 18:32
 */
require_once('Autoloader.php');

class RouteurAdmin
{
    private $ctrlAdmin;

    public function __construct() {
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
                    $idArticle = intval($this->getParametre($_GET, 'id'));
                    if ($idArticle != 0)
                    {
                        $this->ctrlAdmin->vueArticle($idArticle);
                    }
                    else
                        throw new Exception("Identifiant de l'article non valide");
                }
                elseif($_GET['admin'] == 'editer')
                {
                    if (isset($_GET['id'])) {
                        $idArticle = intval($this->getParametre($_GET, 'id'));
                        if ($idArticle != 0) {
                            $this->ctrlAdmin->editerArticle($idArticle);
                        }
                        else
                            throw new Exception("Identifiant de l'article non valide");
                    }
                    else
                    {
                        $this->ctrlAdmin->vueCreation();
                    }
                }
                elseif ($_GET['admin'] == 'modifier')
                {
                    $idArticle = $this->getParametre($_GET, 'id');
                    $titreArticle = $this->getParametre($_POST, 'titre');
                    $contenuArticle = $this->getParametre($_POST, 'contenu');
                    $this->ctrlAdmin->modifierArticle($idArticle, $titreArticle, $contenuArticle);
                }
                elseif($_GET['admin'] == 'envoyer')
                {
                    $titre = $this->getParametre($_POST,'titre');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $this->ctrlAdmin->creerArticle($titre, $contenu);
                }
                elseif ($_GET['admin'] == 'supprimer')
                {
                    $idArticle = $this->getParametre($_GET, 'id');
                    $this->ctrlAdmin->suprArticle($idArticle);
                }
                elseif ($_GET['admin'] == 'moderer')
                {
                    $idCommentaire = $this->getParametre($_GET, 'id');
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

    // Affiche une erreur
    private function erreur($msgErreur){
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    // Recherche un paramètre dans un tableau
    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return ($tableau[$nom]);
        }
        else
            throw new Exception("Paramètre '$nom' absent");
    }

}