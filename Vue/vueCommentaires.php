<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-sm-10">
            <h4><?= htmlentities($commentaire->getPseudo()) ;?><small> Le <?= $commentaire->getDateCreation() ; ?></small></h4>
        </div>
        <div class="col-sm-2">
            <form role="form" action="?action=signaler" method="post">
                <input type="hidden" name="idCommentaire" value=<?= $commentaire->getId(); ?> />
                <input type="hidden" name="idArticle" value=<?= $article->getId(); ?> />
                <button type="submit" class="pull-right btn btn-xs btn-post" sourceindex="27"><span class="glyphicon glyphicon-exclamation-sign"></span> Signaler</button>
            </form>
        </div>
        <div class="col-sm-12">
            <p> <?= htmlentities($commentaire->getContenu()) ;?> </p>
        </div>
        <button type="button" class="pull-right btn btn-xs btn-primary btn-post"
                data-toggle="collapse" data-target='#<?= $commentaire->getId(); ?>'>
            <span class="glyphicon glyphicon-arrow-right"></span>Répondre
        </button>
        <br>
        <form id='<?= $commentaire->getId(); ?>' class="collapse" role="form" action="?action=commenter" method="post">
            <div class="form-group">
                <input class="form-control" name="pseudo" placeholder="Votre pseudo" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="3" name="contenu" placeholder="Votre commentaire" required ></textarea>
            </div>
            <input type="hidden" name="idParent" value=<?= $commentaire->getId(); ?> />
            <input type="hidden" name="idArticle" value=<?= $article->getId(); ?> />
            <button type="submit" class="btn btn-success">Envoyer</button>
        </form>
    </div>
</div>
<div style="margin-left: 50px">
    <?php if(isset($commentaire->children)): // si le commentaire a un enfant ?>
        <?php foreach ($commentaire->children as $commentaire): ?>
            <?php require('vueCommentaires.php'); ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

