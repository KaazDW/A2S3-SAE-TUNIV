<?php if ($_SESSION["type"]!="administrateur") {
    header("Location: ../../index.php");
}

$tournoi = $pdo->prepare('SELECT * FROM Tournoi WHERE ID_Tournoi =:varId');
$tournoi->execute(['varId' =>$_GET["id"]]);
$tournoi=$tournoi->fetchAll();

if ($tournoi[0]["Etape"]!=0){
    header("Location: ../pages/match-tournois.php?id=".$_GET["id"]);
}

// On construit une liste des équipes participant au tournoi
$listeEquipesSql = $pdo->prepare("SELECT ID_Equipe FROM Participer WHERE ID_Tournoi= :varTournoi;");
$listeEquipesSql->execute(['varTournoi' => $_GET["id"]]);
$listeEquipesSql = $listeEquipesSql->fetchAll();

$listeEquipes = [];
$nbEquipes = 0;

foreach ($listeEquipesSql as $equipe){
    $listeEquipes[$nbEquipes]=$equipe;
    $nbEquipes++;
}

// On récupère les informations du tournoi
$sport = $pdo->prepare("SELECT Sport FROM Tournoi WHERE ID_Tournoi = :varTournoi;");
$sport->execute(['varTournoi' => $_GET["id"]]);
$sport = $sport->fetch()[0];
$sport = $pdo->quote($sport);

$creerMatch = $pdo->prepare("INSERT INTO MatchTournoi VALUES(0, $sport, now(), now(), 'A_définir', 1, :varTournoi, 0);");

// On crée les matchs de poules entre toutes les équipes participantes
for ($i=0; $i<$nbEquipes; $i++) {
    for ($j=$i+1;$j<$nbEquipes; $j++){
        $creerMatch->execute(['varTournoi' => $_GET["id"]]);
        $numMatch = $pdo->query("SELECT max(ID_Match) FROM MatchTournoi;");
        $numMatch = $numMatch->fetch()[0];


        $creerParticiper = $pdo->query("INSERT INTO Jouer VALUES($numMatch," . $listeEquipes[$i][0] . ",0);");
        $creerParticiper = $pdo->query("INSERT INTO Jouer VALUES($numMatch," . $listeEquipes[$j][0] . ",0);");
    }
}

$changerStatut = $pdo->prepare("UPDATE Tournoi SET Etape = 1 WHERE ID_Tournoi = :varTournoi;");
$changerStatut->execute(['varTournoi' => $_GET["id"]]);

header("Location: ../pages/match-tournois.php?id=" . $_GET["id"]);