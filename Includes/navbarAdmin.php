<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        <?php
        if (isset($_SESSION['admin']))
        {
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="index.php?admin">Accueil admin</a> </li>

            </ul>

            <a class="btn btn-danger" href="index.php?deconnexion">Déconnexion</a>
            <?php
        }
        ?>

    </div>
</div>
