
<!-- First Container -->
<div class="container-fluid bg-1 text-center ">
    <h3 class="margin">Qui suis-je?</h3>
    <img src="img/Jean_Forteroche.png" class="img-responsive img-circle margin" style="display:inline" alt="Photo_Jean_Forteroche" width="350" height="350">
    <h3>Un acteur et un écrivain</h3>
    <p>Retrouvez chaque semaine un nouveau chapitre de mon livre en ligne sur mon blog !</p>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
    <h3 class="margin">Billet simple pour l'Alaska</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
</div>

<div class="container-fluid bg-3 text-center">
    <h3 class="margin">Mes derniers chapitres</h3><br>
        <div class="row">
        <?php foreach ($articles as $article) : ?>
                <div class="col-sm-4">
                    <a href="<?= $article->getUrl() ;?>"><h3><?= $article->getTitre(); ?></h3></a>
                    <h5><span class="glyphicon glyphicon-time"></span> Posté le <?= $article->getDateCreation(); ?>.</h5>
                    <p><?= $article->getExtrait(); ?></p>
                </div>
        <?php endforeach; ?>
        </div>
</div>