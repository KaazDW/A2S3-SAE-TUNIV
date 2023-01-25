<?php session_start();

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../../index.php");
}

include("db.php");

// Calcul du nombre d'équipes restantes
$nbEquipes = $pdo->prepare("SELECT count(*) FROM Participer WHERE ID_Tournoi = :varId");
$nbEquipes->execute(['varId' => $_GET['id']]);
$nbEquipes = $nbEquipes->fetch()[0];

$nbFinalistes = 2;
while ($nbFinalistes*2<$nbEquipes){
    $nbFinalistes = $nbFinalistes*2;
}

// Construction du tableau des équipes présentes dans le bracket

$listeFinalistes = $pdo->prepare("SELECT ID_Equipe, Score FROM Participer WHERE ID_Tournoi = :varId ORDER BY Score DESC");
$listeFinalistes->execute(['varId' => $_GET['id']]);
$listeFinalistes = $listeFinalistes->fetchAll();

$tabFinalistes = [];

$scoreTotal = $pdo->prepare("SELECT sum(Score) FROM Jouer WHERE ID_Equipe = :varEquipe AND ID_Match IN (SELECT ID_Match FROM MatchTournoi WHERE ID_Tournoi = :varTournoi);");
$tabScores = [];
$index = 0;

foreach ($listeFinalistes as $finaliste){
    $scoreTotal->execute(['varTournoi' => $_GET['id'], 'varEquipe' => $finaliste[0]]);
    $scoreTotal = $scoreTotal->fetch()[0];
    $tabScores[$index] = $scoreTotal;
    $index++;
}

var_dump($tabScores);

for ($i=0; $i<$nbFinalistes; $i++){
    if ($listeFinalistes[$i][1]>$listeFinalistes[$i+1][1]){
        $tabFinalistes[$i] = $listeFinalistes[$i];
    }
    else {
        $scoreTotal->execute(['varTournoi' => $_GET['id'], 'varEquipe' => $listeFinalistes[$i][0]]);
        $scoreT1 = $scoreTotal->fetch()[0];
        $scoreTotal->execute(['varTournoi' => $_GET['id'], 'varEquipe' => $listeFinalistes[$i+1][0]]);
        $scoreT2 = $scoreTotal->fetch()[0];

        if ($scoreT1>=$scoreT2){
            echo("T1>=T2");
            $tabFinalistes[$i] = $listeFinalistes[$i];
        }
        else {
            echo("T1<T2");
            $tabFinalistes[$i] = $listeFinalistes[$i+1][0];
            $listeFinalistes[$i+1]=$listeFinalistes[$i][0];
        }
    }
}
echo("Tableau final : \n");
var_dump($tabFinalistes);

// 