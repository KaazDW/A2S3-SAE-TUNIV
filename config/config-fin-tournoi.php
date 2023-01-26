<?php session_start();

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../../index.php");
}

include("db.php");

$tournoi = $pdo->prepare('SELECT * FROM Tournoi WHERE ID_Tournoi =:varId');
$tournoi->execute(['varId' =>$_GET["id"]]);
$tournoi=$tournoi->fetchAll();

if ($tournoi[0]["Etape"]!=2){
    header("Location: ../pages/match-tournois.php?id=".$_GET["id"]);
}

$changerEtape = $pdo->prepare("UPDATE Tournoi SET Etape=3 WHERE ID_Tournoi = :varId;");
$changerEtape->execute(['varId'=> $_GET["id"]]);

$changerEtat = $pdo->prepare("UPDATE MatchTournoi SET Etat=1 WHERE ID_Tournoi = :varId;");
$changerEtat->execute(['varId' => $_GET["id"]]);

header("Location: ../pages/match-tournois.php?id=" . $_GET["id"]);