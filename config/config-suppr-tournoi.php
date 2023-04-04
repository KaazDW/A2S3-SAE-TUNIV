<?php 
if ($_SESSION["type"]!="administrateur") {
    header("Location: /index");
}

$suppr = $pdo->prepare('DELETE from Tournoi where ID_Tournoi = :varId');
$suppr->execute(['varId' =>$_GET["id"]]);

header("Location: /dashb-admin");