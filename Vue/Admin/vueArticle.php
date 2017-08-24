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
</div>

