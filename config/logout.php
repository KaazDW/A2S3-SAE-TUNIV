<?php session_start();
$_SESSION['admin'] = false;
$_SESSION = array();
session_destroy();
header("Location: /index.php");
