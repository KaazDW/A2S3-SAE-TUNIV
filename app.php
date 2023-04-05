<?php

session_start();

include_once 'config/db.php';

const APP = __DIR__ . '/';

$link = explode('?', $_SERVER["PATH_INFO"] ?? "/");
$path = $link[0];

switch ($path) {
    case "/":
        require_once APP . "index.php";
        break;
    // case "/hash":
    //     require_once APP . "/config/hash.php";
    //     break;
    case "/index":
        require_once APP . "index.php";
        break;

    case "/login":
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require_once APP . "/pages/login.php";
        } else {
            require_once APP . "/config/config-capcha.php";
        }
        break;
    case "/capcha":
        if ($_SERVER["REQUEST_METHOD"] == "GET" && $_SESSION["captcha"] ) {
            $login = $_POST['login'];
            $pswd = $_POST['password'];
            $_POST['login'] = $login;
            $_POST['password'] = $pswd;
            require_once APP . "/config/config-login.php";
        } else {  
            require_once APP . "/pages/login.php";
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
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require_once APP . "/pages/support.php";
        } else{
            require_once APP . "/config/config-support.php";
        }
        break;

    case "/match-tournois":
        require_once APP . "/pages/match-tournois.php";
        break;

    // Administrateur

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

    case "/config-reset-password":
        require_once APP . "/config/config-reset-password.php";
        break;

        // Gestion tournois administrateur

    case "/config-add-team-inscrit":
        require_once APP . "/config/config-add-team-inscrit.php";
        break;

    case "/config-delete-team-inscrit":
        require_once APP . "/config/config-delete-team-inscrit.php";
        break;

    case "/config-poules-tournoi":
        require_once APP . "/config/config-poules-tournoi.php";
        break;

    case "/config-bracket-tournoi":
        require_once APP . "/config/config-bracket-tournoi.php";
        break;

    case "/config-fin-tournoi":
        require_once APP . "/config/config-fin-tournoi.php";
        break;

    case "/config-changer-arbitre":
        require_once APP . "/config/config-changer-arbitre.php";
        break;

    // Dashboard Capitaine
    case "/dashb-cap":
        require_once APP . "/pages/dashb-cap.php";
        break;

    case "/dashb-cap-edit":
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require_once APP . "/pages/dashb-cap-edit.php";
        } else {
            require_once APP . "/config/config-cap-edit-joueur.php";
        }
        break;

    case "/config-suppr-joueur":
        require_once APP . "/config/config-suppr-joueur.php";
        break;

    case "/config-add-joueur":
        require_once APP . "/config/config-add-joueur.php";
        break;

    case "/config-cap-edit-team":
        require_once APP . "/config/config-cap-edit-team.php";
        break;
    
    // Arbitre
    case "/dashb-arbitre":
        require_once APP . "/pages/dashb-arbitre.php";
        break;

    case "/dashb-editform-match":
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require_once APP . "/pages/dashb-editform-match.php";
        } else {
            require_once APP . "/config/config-edit-match.php";
        }
        break;

    case "/config-verrouillage-match":
        require_once APP . "/config/config-verrouillage-match.php";
        break;

    case "/password":
        if ($_SERVER["REQUEST_METHOD"]=="GET") {
            require_once APP . "/pages/dashb-password.php";
        } else {
            require_once APP . "/config/config-dashb-password.php";
        }
        break;

    default:
        require_once APP . "/pages/error404.php";
    exit;
}
