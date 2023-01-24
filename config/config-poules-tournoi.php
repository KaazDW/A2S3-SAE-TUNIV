<?php session_start();

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../../index.php");
}

include("db.php");

// On construit une liste des équipes participant au tournoi
$listeEquipesSql = $pdo->prepare("SELECT ID_Equipe FROM Participer WHERE ID_Tournoi= :varTournoi;");
$listeEquipesSql->execute(['varTournoi' => $_GET["id"]]);
$listeEquipesSql = $listeEquipesSql->fetchAll();

$listeEquipes = [];
$i = 0;

foreach ($listeEquipesSql as $equipe){
    $listeEquipes[$i]=$equipe;
    $i++;
}

// On récupère les informations du tournoi
$sport = $pdo->prepare("SELECT Sport FROM Tournoi WHERE ID_Tournoi = :varTournoi;");
$sport->execute(['varTournoi' => $_GET["id"]]);
$sport = $sport->fetch()[0];
$sport = $pdo->quote($sport);

$creerMatch = $pdo->prepare("INSERT INTO MatchTournoi VALUES(0, $sport, now(), now(), 'A_définir', 1, :varTournoi);");

// On crée les matchs de poules entre toutes les équipes participantes
for ($j=1; $j<$i; $j++) {
    for ($k=$j+1;$k<=$i; $k++){
        $creerMatch->execute(['varTournoi' => $_GET["id"]]);
        $numMatch = $pdo->query("SELECT max(ID_Match) FROM MatchTournoi;");
        $numMatch = $numMatch->fetch()[0];

        $creerParticiper = $pdo->query("INSERT INTO Jouer VALUES($numMatch, $j,0);");
        $creerParticiper = $pdo->query("INSERT INTO Jouer VALUES($numMatch, $k,0);");
    }
}

$changerStatut = $pdo->prepare("UPDATE Tournoi SET Etape = 1 WHERE ID_Tournoi = :varTournoi;");
$changerStatut->execute(['varTournoi' => $_GET["id"]]);

$id = $_GET["id"];

header("Location: ../pages/match-tournois.php?id=$id");