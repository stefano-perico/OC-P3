<div class="container bg-3">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Articles">Articles</a></li>
        <li><a data-toggle="tab" href="#Commentaires">Commentaires</a></li>
    </ul>

    <div class="tab-content">
        <div id="Articles" class="tab-pane fade in active">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($articles as $article) :
                    /**
                     * On créer un boucle "foreach" qui appel et affiche les articles obtenue par le biais
                     * de la fonction getArticles situé dans "Modele.php".
                     * Le flux HTML créé est mis en tampon.
                     **/
                    ?>
                    <tr>
                        <td><?= $article->getId(); ?></td>
                        <td><?= $article->getTitre(); ?></td>
                        <td>
                            <a
                                href="<?= "?admin=editer&id=" . $article->getId() ?>"
                                type="button"
                                class="btn btn-default"
                            >Editer</a>
                            <a
                                onclick="return confirm('Voulez vous vraiment supprimer cette article');"
                                href="?admin=supprimer&id=<?=  $article->getId() ?>"
                                type="button"
                                class="btn btn-danger"
                                >Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach;
                /**
                 * Une fois la boucle terminée, la fonction PHP ob_get_clean permet de récupérer
                 * dans une variable le flux de sortie mis en tampon depuis l'appel à ob_start.
                 * La variable se nomme ici $contenu, ce qui permet de définir l'élément spécifique
                 * associé.
                 **/
                ?>
                </tbody>
            </table>
            <a type="button" class="btn btn-success" href="?admin=editer">Ajouter un article</a>
        </div>

        <div id="Commentaires" class="tab-pane fade">
            <div class="panel-group" id="accordion">
                <?php foreach ($commentaires as $commentaire): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $commentaire->getId() ; ?>">
                                    <?= $commentaire->getPseudo() ; ?> <small>Le <?= $commentaire->getDateCreation() ; ?></small>
                                </a>
                                <a
                                    onclick="return confirm('Voulez vous vraiment moderer ce commentaire ?');"
                                    href="?admin=moderer&id=<?= $commentaire->getId() ?>"
                                    type="button"
                                    class="btn btn-danger"
                                >Moderer</a>
                            </h4>
                        </div>
                        <div id="collapse<?= $commentaire->getId() ; ?>" class="panel-collapse collapse">
                            <div class="panel-body"><?= $commentaire->getContenu() ; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

