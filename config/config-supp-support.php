<?php 
if ($_SESSION["type"]!="administrateur") {
    header("Location: /index");
}

// $suppr = $pdo->prepare('DELETE FROM support WHERE id IN (SELECT ID_Match FROM Jouer WHERE ID_Equipe = :varId);');
$suppr = $pdo->prepare('DELETE FROM support WHERE id = :suppID;');
$suppr->execute(['suppID' => $_GET["id"]]); 

header("Location: /log-support");