<?php session_start();

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../../index.php");
}

include 'db.php';

$id = $_POST["selectid"];

$edit = $pdo->prepare('UPDATE MatchTournoi SET ID_User = :varArbitre WHERE ID_Match = :varId');
$edit->execute(['varArbitre' => $id, 'varId' => $_GET['id']]);

header("Location: /../pages/dashb-editform-match.php?id=" . $_GET["id"]);