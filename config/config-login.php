<?php session_start();

$id = $_POST["login"];
$password = $_POST["password"];
if ($id == "admin" && $password == "admin") {
    $_SESSION["admin"] = true;
}

header("Location : ../index.php");
