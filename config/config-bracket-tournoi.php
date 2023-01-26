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

// Création du tableau des équipes finalistes
$listeFinalistes = $pdo->prepare("SELECT ID_Equipe FROM Participer WHERE ID_Tournoi = :varId ORDER BY Score DESC");
$listeFinalistes->execute(['varId' => $_GET['id']]);
$listeFinalistes = $listeFinalistes->fetchAll();

$tabFinalistes = [];

for ($i=0; $i<$nbFinalistes; $i++){
    $tabFinalistes[$i] = $listeFinalistes[$i];
}

//Création des matchs
$sport = $pdo->prepare("SELECT Sport FROM Tournoi WHERE ID_Tournoi = :varTournoi;");
$sport->execute(['varTournoi' => $_GET["id"]]);
$sport = $sport->fetch()[0];
$sport = $pdo->quote($sport);
$creerMatch = $pdo->prepare("INSERT INTO MatchTournoi VALUES(0, $sport, now(), now(), 'A_définir', 1, :varTournoi, 0);");

for ($i=0; $i<$nbFinalistes; $i++) {
    for ($j=$i+1;$j<$nbFinalistes; $j++){
        $creerMatch->execute(['varTournoi' => $_GET["id"]]);
        $numMatch = $pdo->query("SELECT max(ID_Match) FROM MatchTournoi;");
        $numMatch = $numMatch->fetch()[0];


        $creerParticiper = $pdo->query("INSERT INTO Jouer VALUES($numMatch," . $tabFinalistes[$i][0] . ",0);");
        $creerParticiper = $pdo->query("INSERT INTO Jouer VALUES($numMatch," . $tabFinalistes[$j][0] . ",0);");
    }
}

$changerStatut = $pdo->prepare("UPDATE Tournoi SET Etape = 2 WHERE ID_Tournoi = :varTournoi;");
$changerStatut->execute(['varTournoi' => $_GET["id"]]);

header("Location: ../pages/match-tournois.php?id=" . $_GET["id"]);