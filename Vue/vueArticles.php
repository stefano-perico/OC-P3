<div class="container-fluid bg-3 text-center">
    <h3 class="margin">Tous les chapitres</h3><br>
    <div class="row">
        <?php foreach ($articles as $article) : ?>
            <div class="col-sm-4">
                <a href="<?= $article->getUrl() ;?>"><h3><?= $article->getTitre(); ?></h3></a>
                <h5><span class="glyphicon glyphicon-time"></span> Posté le <?= $article->getDateCreation(); ?></h5>
                <p><?= $article->getExtrait(); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>