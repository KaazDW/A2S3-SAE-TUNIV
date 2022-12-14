<?php session_start();

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../../index.php");
}

include("db.php");

if (!empty($_SESSION["tournoiErreur"])) {
    unset($_SESSION["tournoiErreur"]);
}

if (empty($_POST["name"])){
    $_SESSION["tournoiErreur"] = "Nom du tournoi manquant";
    header("Location: ../pages/dashb-admin.php");
}
$name = $pdo->quote($_POST["name"]);

if (empty($_POST["sport"])){
    $_SESSION["tournoiErreur"] = "Sport du tournoi manquant";
    header("Location: ../pages/dashb-admin.php");
}
$sport = $pdo->quote($_POST["sport"]);

if (empty($_POST["dateDeb"])){
    $_SESSION["tournoiErreur"] = "Date de début manquante";
    header("Location: ../pages/dashb-admin.php");
}
$dateDeb = $pdo->quote($_POST["dateDeb"]);

if (empty($_POST["dateFin"])){
    $_SESSION["tournoiErreur"] = "Date de fin manquante";
    header("Location: ../pages/dashb-admin.php");
}
$dateFin = $pdo->quote($_POST["dateFin"]);

$sql = "INSERT INTO Tournoi VALUES (0, $sport, $name, $dateDeb, $dateFin);";
$res = $pdo->exec($sql);
if (!$res) {
    $_SESSION["tournoiErreur"] = "La création du tournoi a échoué, veuillez réessayer. Si l\'erreur persiste, contactez le support.";
    header("Location: ../pages/dashb-admin.php");
} else {
    header("Location: ../pages/dashb-admin.php");
}