<?php session_start();

include("db.php");

$idArbitre = $pdo->prepare("SELECT ID_User FROM MatchTournoi WHERE ID_Match = :varId;");
$idArbitre->execute(['varId' => $_GET['id']]);
$idArbitre = $idArbitre->fetch()[0];

if ($_SESSION["type"]!="administrateur" || ($_SESSION["type"]=="arbitre" && $_SESSION["idUser"]!=$idArbitre)) {
    header("Location: ../../index.php");
}

$dateDebut = $_POST["new-date-debut"];
$dateFin = $_POST["new-date-fin"];
$stade = $_POST["new-stade"];
$score1 = $_POST["new-score-equipe1"];
$score2 = $_POST["new-score-equipe2"];

$edit = $pdo->prepare('UPDATE MatchTournoi  set DateDebut=:varDeb, DateFin=:varFin, Stade=:varStade where ID_Match = :varId');


$edit->execute(['varDeb'=>$dateDebut,'varFin'=>$dateFin,'varStade'=>$stade, 'varId' =>$_GET["id"]]);

$idsEquipes = $pdo->prepare("SELECT ID_Equipe FROM Jouer WHERE ID_Match = :varId;");
$idsEquipes->execute(['varId' => $_GET['id']]);
$idsEquipes = $idsEquipes->fetchAll();
$listeIds = [];

$i = 0;
foreach($idsEquipes as $idEquipe){
    $listeIds[$i] = $idEquipe["ID_Equipe"];
    $i++;
}

$changerScore = $pdo->prepare("UPDATE Jouer SET Score = :varScore WHERE ID_Equipe = :varEquipe AND ID_Match = :varMatch");
$changerScore->execute(['varScore' => $score1, 'varEquipe' => $listeIds[0], 'varMatch' => $_GET["id"]]);
$changerScore->execute(['varScore' => $score2, 'varEquipe' => $listeIds[1], 'varMatch' => $_GET["id"]]);

header("Location: /../pages/dashb-editform-match.php?id=" . $_GET["id"]);