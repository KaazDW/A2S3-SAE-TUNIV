<?php session_start();

if (!$_SESSION["type"]=="administrateur") {
    header("Location: ../../index.php");
}

include("db.php");

$sql = $pdo->prepare("DELETE FROM Annonces WHERE ID_Annonce=:varId");
$sql->execute(['varId' => $_GET['id']]);

header("Location: ../pages/dashboard/form-annonce.php");