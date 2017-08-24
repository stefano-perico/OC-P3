<div class="container bg-3">
    <div class="col-sm-12">
        <h3>Page de création des articles</h3>
        <br>
        <form role="form" action="?action=envoyer" method="post">
            <div class="form-group">
                <input class="form-control" name="titre" placeholder="Votre titre" required>
            </div>
            <div class="form-group">
                <textarea class="form-control wysiwyg" rows="30" name="article" placeholder="Votre text" required ></textarea>
            </div>
            <button type="submit" class="btn btn-success">Envoyer</button>
        </form>
    </div>
</div>
