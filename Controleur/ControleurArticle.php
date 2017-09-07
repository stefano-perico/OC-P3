<?php


class ControleurArticle {


  protected $article;
  protected $commentaire;


  public function __construct(){
    $this->article = new ArticlesManager();
    $this->commentaire = new CommentairesManager();
  }

  // Affiche les détails sur un article
  public function article($idArticle){
    $article = $this->article->getArticle($idArticle);
    $commentaires = $this->commentaire->getCommentsWithChild($idArticle);
    $vue = new Vue ("vueArticle");
    $vue->generer(array('article' => $article , 'commentaires' => $commentaires));
  }

  public function allArticles()
  {
      $articles = $this->article->getAllArticles();
      $vue = new Vue("vueArticles");
      $vue->generer(array('articles' => $articles));
  }

  // Ajoute un commentaire à un article
 public function commenter($pseudo, $contenu, $idArticle, $idParent = null) {
   // Sauvegarde du commentaire
    $commentaire = new Commentaires
        ([
            'pseudo' => $pseudo,
            'contenu' => $contenu,
            'idArticle' => $idArticle,
            'idParent' => $idParent
        ]);
    $this->commentaire->addCommentaire($commentaire);
     Message::setFlash('Votre commentaire a bien été <strong>ajouté</strong>', 'success');
   // Actualisation de l'affichage de l'article
    $this->article($idArticle);
 }

    public function signaler($idCommentaire, $idArticle){
        $commentaire = new Commentaires
        ([
            'id' => $idCommentaire,
            'signaler' => 1
        ]);
        $this->commentaire->update($commentaire);
        Message::setFlash('Le commentaire a été <strong>signalé</strong>', 'info');
        $this->article($idArticle);
    }



}
