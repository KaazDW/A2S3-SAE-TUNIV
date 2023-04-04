<?php 
if ($_SESSION["type"] != "administrateur") {
    header("Location: /index");
}

$prenom = $_POST["new-surname"];
$nom = $_POST["new-name"];
$actuel = $_GET["id"];

$add = $pdo->prepare('INSERT INTO Joueur  VALUES (0,:varprenom, :varnom, :varequipe);');
$add->execute(['varprenom' => $prenom, 'varnom' => $nom, 'varequipe' => $actuel]);
header("Location: /dashb-admin-editform-equipe?id=" . $_GET['id']);