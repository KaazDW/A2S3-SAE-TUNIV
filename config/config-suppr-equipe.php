<?php 
if ($_SESSION["type"]!="administrateur") {
    header("Location: ../index.php");
}

$suppr = $pdo->prepare('DELETE FROM MatchTournoi WHERE ID_Match IN (SELECT ID_Match FROM Jouer WHERE ID_Equipe = :varId);');
$suppr->execute(['varId' => $_GET["id"]]); 

$suppr = $pdo->prepare('DELETE from Equipe where ID_Equipe = :varId;');
$suppr->execute(['varId' =>$_GET["id"],]);

header("Location: /../pages/dashb-admin.php");