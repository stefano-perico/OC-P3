<?php


class ArticlesManager extends Modele
{

    public function addArticle(Article $article)
    {
        $sql = $this->getBdd()->prepare('INSERT INTO articles (titre, contenu) VALUES (:titre , :contenu)');
        $sql->bindValue(':titre', $article->getTitre());
        $sql->bindValue(':contenu', $article->getContenu());
        $sql->execute();
    }
    public function delete($id)
    {
        $this->getBdd()->exec('DELETE FROM articles WHERE id = '.$id);
    }

    public function getArticle($id)
    {
        $id = (int) $id;

        $sql = $this->getBdd()->prepare('SELECT id, titre, contenu, dateCreation FROM articles WHERE id ='.$id);
        $sql->execute(array($id));
        if ($sql->rowCount() == 1)
        {
            $donnees = $sql->fetch();
            $article = new Article($donnees);
            return $article;
        }
        else {
            header("HTTP/1.0 404 Not Found");
            header('Location:index.php?p=404');
        }

    }

    public function getAllArticles()
    {
        $articles = [];

        $sql = $this->getBdd()->query('SELECT id, titre, contenu, dateCreation FROM articles ORDER BY dateCreation');

        while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
        {
            $articles[] = new Article($donnees);
        }

        return $articles;
    }

    public function get3Articles()
    {
        $articles = [];

        $sql = $this->getBdd()->query('SELECT id, titre, contenu, dateCreation FROM articles ORDER BY dateCreation LIMIT 3');

        while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
        {
            $articles[] = new Article($donnees);
        }

        return $articles;
    }

    public function update(Article $article)
    {
        $sql = $this->getBdd()->prepare('UPDATE articles SET titre = :titre, contenu = :contenu WHERE id = :id');
        $sql->bindValue(':id', $article->getId(), PDO::PARAM_INT);
        $sql->bindValue(':titre', $article->getTitre());
        $sql->bindValue(':contenu', $article->getContenu());
        $sql->execute();
    }

}