<div class="container bg-3">
    <div class="col-sm-12">
        <h3>Page d'édition des articles</h3>
        <br>
        <form role="form" action="?admin=envoyer" method="post">
            <div class="form-group">
                <label>Votre titre</label>
                <input class="form-control" name="titre" placeholder="Votre titre" required>
            </div>
            <div class="form-group">
                <label>Votre texte</label>
                <textarea id="wysiwyg" class="form-control" rows="30" name="contenu" placeholder="Votre texte" required >&nbsp;</textarea>
            </div>
            <button type="submit" class="btn btn-success">Envoyer</button>
        </form>
    </div>
</div>

