<?php

session_start();

include_once 'config/db.php';

const APP = __DIR__ . '/';

$link = explode('?', $_SERVER["PATH_INFO"] ?? "/");
$path = $link[0];

$listeTournois = $pdo->prepare("SELECT ID_Tournoi FROM Tournoi");
$listeTournois->execute();
$listeTournois = $listeTournois->fetchAll();

if (!isset($_SERVER["QUERY_STRING"])){
    $_SERVER["QUERY_STRING"]="vide";
}

// var_dump($_SERVER);

switch ($path) {
    case "/":
        require_once APP . "index.php";
        break;
    case "/index":
        require_once APP . "index.php";
        break;
    case "/login":
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require_once APP . "/pages/login.php";
        } else {
            require_once APP . "/config/config-login.php";
        }
        break;
    case "/logout":
        $_SESSION = [];
        unset($_SESSION);
        header("Location: /login");
        break;
    case "/tournois":
        require_once APP . "/pages/tournois.php";
        break;
    case "/a-propos":
        require_once APP . "/pages/apropos.php";
        break;

    case "/support":
        require_once APP . "/pages/support.php";
        break;

    case "/match-tournois":
        $_SESSION["idTournoi"] = preg_replace("/id=/", $_SERVER["QUERY_STRING"], "");
        require_once APP . "/pages/match-tournois.php";
        break;

    // Dashboard Administrateur

    case "/dashb-admin":
        require_once APP . "/pages/dashb-admin.php";
        break;

        // Dashboard Administrateur Annonces

    case "/form-annonce":
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require_once APP . "/pages/form-annonce.php";
        } else {
            require_once APP . "/config/config-annonce.php";
        }
        break;

    case "/config-suppr-annonce":
        require_once APP . "/config/config-suppr-annonce.php";
        break;

        // Dashboard Administrateur Tournois

    case "/config-crea-tournoi":
        require_once APP . "/config/config-crea-tournoi.php";
        break;

    case "/dashb-admin-editform-tournoi":
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require_once APP . "/pages/dashb-admin-editform-tournoi.php";
        } else {
            require_once APP . "/config/config-editform-tournoi.php";
        }
        
        break;

    case "/config-suppr-tournoi":
        require_once APP . "/config/config-suppr-tournoi.php";
        break;

        // Dashboard Administrateur Équipes

    case "/config-admin-crea-equipe":
        require_once APP . "/config/config-admin-crea-equipe.php";
        break;

    case "/dashb-admin-editform-equipe":
        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            require_once APP . "/pages/dashb-admin-editform-equipe.php";
        } else {
            require_once APP . "/config/config-add-joueur-admin.php";
        }
        break;

    case "/config-admin-suppr-joueur":
        require_once APP . "/config/config-admin-suppr-joueur.php";
        break;

    case "/config-suppr-equipe":
        require_once APP . "/config/config-suppr-equipe.php";
        break;

        // Dashboard Administrateur Utilisateurs

    case "/dashb-admin-utilisateurs":
        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            require_once APP . "/pages/dashb-admin-utilisateurs.php";
        } else {
            require_once APP . "/config/config-crea-user.php";
        }
        break;

    case "/dashb-admin-editform-user":
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require_once APP . "/pages/dashb-admin-editform-user.php";
        } else {
            require_once APP . "/config/config-admin-edit-user.php";
        }
        break;

    case "/config-suppr-user":
        require_once APP . "/config/config-suppr-user.php";
        break;

    case "/dashb-cap":
        require_once APP . "/pages/dashb-cap.php";
        break;

    case "/dashb-arbitre":
        require_once APP . "/pages/dashb-arbitre.php";
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        exit;
}
