<div class="container bg-3">
    <h3 class="margin text-center">Tous les chapitres</h3><br>
    <div class="row">
        <?php foreach ($articles as $article) : ?>
            <div class="col-sm-12 well">
                <a href="<?= $article->getUrl() ;?>"><h3><?= $article->getTitre(); ?></h3></a>
                <h5><span class="glyphicon glyphicon-time"></span> Posté le <?= $article->getDateCreation(); ?></h5>
                <br>
                <p><?= $article->getExtrait(); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>