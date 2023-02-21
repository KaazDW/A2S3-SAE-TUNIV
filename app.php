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
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require_once APP . "/pages/support.php";
        } else{
            require_once APP . "/config/config-support.php";
        }
        break;

    case "/match-tournois":
        $_SESSION["idTournoi"] = preg_replace("/id=/", $_SERVER["QUERY_STRING"], "");
        require_once APP . "/pages/match-tournois.php";
        break;

    case "/dashb-admin":
        require_once APP . "/pages/dashb-admin.php";
        break;

    case "/form-annonce":
        require_once APP . "/pages/form-annonce.php";
        break;

    case "/dashb-admin-utilisateurs":
        require_once APP . "/pages/dashb-admin-utilisateurs.php";
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        exit;
}
