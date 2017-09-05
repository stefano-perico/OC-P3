<?php

class ControleurAdmin extends ControleurArticle
{

    public function vueLogin()
    {
        $vue = new Vue("Admin/vueLogin");
        $vue->genererAdmin(array(null));
    }

    public function vueArticle($idArticle){
        $article = $this->article->getArticle($idArticle);
        $vue = new Vue ("Admin/vueArticle");
        $vue->genererAdmin(array('article' => $article));
    }

    public function accueilAdmin()
    {
        $articles = $this->article->getAllArticles();
        $commentaires = $this->commentaire->getCommentairesSignale();
        $vue = new Vue ("Admin/vueAccueil");
        $vue->genererAdmin(array('articles' => $articles, 'commentaires' => $commentaires));
    }

    public function vueCreation()
    {
        $vue = new Vue ("Admin/vueCreerArticle");
        $vue->genererAdmin(array(null));
    }

    public function editerArticle($id)
    {
        $article = $this->article->getArticle($id);
        $vue = new Vue ("Admin/vueEdition");
        $vue->genererAdmin(array('article' => $article));
    }

    public function creerArticle($titre, $contenu) {
        // Sauvegarde de l'article
        $article = new Article
        ([
            'titre' => $titre,
            'contenu' => $contenu,
        ]);
        $this->article->addArticle($article);
        Message::setFlash('Création de l\'article <strong>réussie</strong>', 'success');
    }

    public function suprArticle($id){
        $this->article->delete($id);
        Message::setFlash('L\'article a été <strong>supprimé</strong>', 'danger');
        $this->accueilAdmin();
    }

    public function modererCommentaire($id){
        $commentaire = new Commentaires([
            'id' => $id,
            'signaler' => 0,
            'moderer' => 1
        ]);
        $this->commentaire->update($commentaire);
        Message::setFlash('Le commentaire avec l\' id : '. $commentaire->getId() .' a été  <strong>moderé</strong>', 'info');
        header('Location: index.php?admin');
        exit();
    }

    public function logged()
    {
        return isset($_SESSION['admin']);
    }

    public function login($login, $pass)
    {
        $adminM = new AdminManager();
        $adminM->login($login, $pass);
        header('Location: index.php?admin');
    }

    public function forbidden()
    {
        header('HTTP/1.0 404 Forbidden');
        die('Acces interdit');
    }


    public function modifierArticle($idArticle, $titreArticle, $contenuArticle)
    {
        $article = new Article([
            'id' => $idArticle,
            'titre' => $titreArticle,
            'contenu' => $contenuArticle
        ]);
        $this->article->update($article);
        Message::setFlash('Mise à jour <strong>réussie</strong>', 'success');
        header('Location: index.php?admin=article&id='.$idArticle);
        exit();
    }

}

