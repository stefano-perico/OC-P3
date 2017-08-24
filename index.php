<?php
// contrôleur frontal
session_start();


require_once('Autoloader.php');

$routeur = new Routeur();
$routeurAdmin = new RouteurAdmin();

if (isset($_GET['deconnexion']))
{
    // On récupère le nom (la session a peut-être été initialisée dans une autre page)
    $session_name = isset($_COOKIE[session_name()]) ? session_name() : '';
    // Destruction des globales de session
    foreach($_SESSION as $key => $value) { unset($_SESSION[$key]); }
    // Destruction du cookie (il n'a peut-être pas encore été créé)
    if (!empty($session_name))
    {
        setcookie(session_name(), '', time()-42000, '/');
    }
    // Destruction de la session
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}
elseif(isset($_GET['admin']))
{
    $routeurAdmin->loginAdmin();
}
else

{
    $routeur->routerRequete();
}





