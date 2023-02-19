<?php

session_start();

include 'config/db.php';

const APP = __DIR__ . '/';

$path = $_SERVER["PATH_INFO"] ?? "/";

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

    default:
        header('HTTP/1.0 404 Not Found');
        exit;
}
