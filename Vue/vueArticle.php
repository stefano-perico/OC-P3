<div class="container bg-3">
    <h2 class="text-center"> <?= $article->getTitre(); ?></h2>
    <h5 class="text-center"><span class="glyphicon glyphicon-time"></span> Posté le <?= $article->getDateCreation(); ?>.</h5>
    <article class="container col-sm-12">
        <br>
        <div class="jumbotron">
            <p><?= $article->getContenu(); ?></p>
        </div>
        <br><br>
    </article>
    <div class="col-sm-12">
        <h4>Laisser un commentaire :</h4>
         <!-- envoyer un commentaite sur le bdd -->
        <form role="form" action="?action=commenter" method="post">
            <div class="form-group">
                <input class="form-control" name="pseudo" placeholder="Votre pseudo" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="3" name="contenu" placeholder="Votre commentaire" required ></textarea>
            </div>
            <input type="hidden" name="idArticle" value=<?= $article->getId(); ?> />
            <button type="submit" class="btn btn-success">Envoyer</button>
        </form>
        <br><br>
        <h3><small>Commentaires</small></h3>
        <hr>
        <br>
        <?php  foreach ($commentaires as $commentaire): ?>
            <?php require ('vueCommentaires.php'); ?>
        <?php endforeach; ?>
    </div>
</div>

