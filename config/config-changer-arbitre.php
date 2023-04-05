<?php 
if ($_SESSION["type"]!="administrateur") {
    header("Location: /index");
}

$id = $_POST["selectid"];

$edit = $pdo->prepare('UPDATE MatchTournoi SET ID_User = :varArbitre WHERE ID_Match = :varId');
$edit->execute(['varArbitre' => $id, 'varId' => $_GET['id']]);

header("Location: /dashb-editform-match?id=" . $_GET["id"]);