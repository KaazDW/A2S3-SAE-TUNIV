<?php
include_once __DIR__ . '/db.php';


if ($_POST["login"] == USERID && $_POST["password"] == USERPSWD) {
    session_start();
    $_SESSION['admin'] = true;
    // if (!empty($_POST["stay-connect"])) {
    //     if ($_POST["stay-connect"]) {
    //         setcookie("LoginCookie", USERID + " " + USERPSWD, time() + 86400, '/');
    //     }
    // }
    header("Location: ../pages/connection_done.php");
} else {
    header("Location: ../index.php");
}