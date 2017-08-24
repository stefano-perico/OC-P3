<?php
/**
 * Created by PhpStorm.
 * User: Stefano
 * Date: 31/07/2017
 * Time: 17:24
 */
require_once('Autoloader.php');

class CommentairesManager extends Modele
{
    public function addCommentaire(Commentaires $commentaire)
    {
        $sql = $this->getBdd()->prepare('INSERT INTO commentaires (pseudo, contenu, idArticle, idParent) VALUES (:pseudo, :contenu, :idAticle, :idParent)');
        $sql->bindValue(':pseudo', $commentaire->getPseudo());
        $sql->bindValue(':contenu', $commentaire->getContenu());
        $sql->bindValue(':idAticle', $commentaire->getIdArticle());
        $sql->bindValue(':idParent', $commentaire->getidParent());
        $sql->execute();
    }

    public function delete(Commentaires $commentaire)
    {
        $this->getBdd()->exec('DELETE FROM commentaires WHERE id = '.$commentaire->getId());
    }

    public function getAllCommentaires($idArticle)
    {
        $commentaires = [];

        $sql = $this->getBdd()->prepare('SELECT * FROM commentaires WHERE idArticle=:idArticle ORDER BY dateCreation DESC ');
        $sql->execute(array('idArticle' => $idArticle));

        while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
        {
            $commentaires[] = new Commentaires($donnees);
        }

        return $commentaires;
    }

    public function update(Commentaires $commentaires)
    {
        $sql = $this->getBdd()->prepare('UPDATE commentaires SET signaler = :signaler, moderer =:moderer WHERE id =:id');
        $sql->bindValue('signaler', $commentaires->getSignaler());
        $sql->bindValue('moderer', $commentaires->getModerer());
        $sql->bindValue('id', $commentaires->getId());
        $sql->execute();
    }

    public function getCommentairesSignale(){
        $commentaires = [];
        $sql = $this->getBdd()->prepare('SELECT * FROM commentaires WHERE signaler=1');
        $sql->execute();
        while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
        {
            $commentaires[] =  new Commentaires($donnees);
        }
        return $commentaires;
    }

    public function getCommentsWithChild($idArticle)
    {
     $commentaires = $this->getAllCommentaires($idArticle); // récupération de tous les commentaires

     $comments_by_id = []; // création d'un tableau qui contiendra les commentaires indexés par leurs ID.
        foreach ($commentaires as $commentaire)
        {
            $comments_by_id[$commentaire->getId()] = $commentaire ; // On stock dans $comments_by_id chaques commentaires en utilisant comme index l'id du commentaire
        }
        foreach ($commentaires as $k => $commentaire)
        {
            if($commentaire->getIdParent() != 0) // si IdParent est different de 0, c'est qu'on c'est un enfant.
            {
                $comments_by_id[$commentaire->getIdParent()]->children[] = $commentaire; // On modifie le commentaire parent en lui donnant une nouvelle variable 'children' et on y met les commentaires enfants
                unset($commentaires[$k]);
            }
        }
        return $commentaires;
    }


}