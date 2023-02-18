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
    case "/todo-list":
        require_once APP . "todo-list.php";
        break;
    case "/form-edit":
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            require_once APP . "form-edit.php";
            break;
        } else {
            require_once APP . "traitement-form-add-ticket.php";
        }

    default:
        header('HTTP/1.0 404 Not Found');
        exit;
}
