<?php session_start();

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../index.php");
}

include '../config/db.php';

$inscrit = $pdo->prepare('DELETE from Participer where ID_Equipe = :varEquipe AND ID_Tournoi= :varTournoi');
$inscrit->execute(['varEquipe' =>$_GET["idEquipe"], 'varTournoi' => $_GET['idTournoi']]);    

$inscrit = $pdo->prepare('DELETE FROM MatchTournoi WHERE ID_Match in (SELECT ID_Match FROM MatchTournoi WHERE ID_Tournoi = :varTournoi) AND ');

header("Location: ../pages/match-tournois.php?id=" . $_GET['idTournoi']);
     
?>