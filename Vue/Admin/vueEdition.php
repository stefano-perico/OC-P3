<div class="container bg-3">
    <div class="col-sm-12">
        <h3>Page d'édition des articles</h3>
        <br>
        <form role="form" action="?admin=envoyer&id=<?= $article->getId(); ?>" method="post">
            <div class="form-group">
                <input class="form-control" name="titre" placeholder="Votre titre" value="<?= $article->getTitre(); ?>" required>
            </div>
            <div class="form-group">
                <textarea class="form-control wysiwyg" rows="30" name="contenu" placeholder="Votre text" required ><?= $article->getContenu(); ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Envoyer</button>
        </form>
    </div>
</div>

