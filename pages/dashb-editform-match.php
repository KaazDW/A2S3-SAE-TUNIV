<?php session_start();

include '../config/db.php';

$idArbitre = $pdo->prepare("SELECT ID_User FROM MatchTournoi WHERE ID_Match = :varId;");
$idArbitre->execute(['varId' => $_GET['id']]);
$idArbitre = $idArbitre->fetch()[0];

if ($_SESSION["type"]!="administrateur") {
    if ($_SESSION["type"]=="arbitre" && $_SESSION["userId"]!=$idArbitre) {
        header("Location: ../../index.php");
    }
}

$matchFini = $pdo->prepare("SELECT Etat FROM MatchTournoi WHERE ID_Match = :varId");
$matchFini->execute(['varId' => $_GET["id"]]);
$matchFini = $matchFini->fetch()[0];

if ($matchFini==1) {
    $tournoi = $pdo->prepare("SELECT ID_Tournoi FROM MatchTournoi WHERE ID_Match = :varId");
    $tournoi->execute(['varId' => $_GET["id"]]);
    $tournoi = $tournoi->fetch()[0];
    header("Location: ../pages/match-tournois.php?id=" . $tournoi);
}

$dateDebut = $pdo->prepare("SELECT DateDebut FROM MatchTournoi WHERE ID_Match = :varId;");
$dateDebut->execute(['varId' => $_GET['id']]);
$dateDebut = $dateDebut->fetch()[0];

$dateFin = $pdo->prepare("SELECT DateFin FROM MatchTournoi WHERE ID_Match = :varId;");
$dateFin->execute(['varId' => $_GET['id']]);
$dateFin = $dateFin->fetch()[0];

$stade = $pdo->prepare("SELECT Stade FROM MatchTournoi WHERE ID_Match = :varId;");
$stade->execute(['varId' => $_GET['id']]);
$stade = $stade->fetch()[0];

$idArbitre = $pdo->prepare("SELECT ID_User FROM MatchTournoi WHERE ID_Match = :varId;");
$idArbitre->execute(['varId' => $_GET['id']]);
$idArbitre = $idArbitre->fetch()[0];

$prenomArbitre = $pdo->prepare("SELECT Prenom FROM Utilisateurs WHERE ID_User = :varId;");
$prenomArbitre->execute(['varId' => $idArbitre]);
$prenomArbitre = $prenomArbitre->fetch()[0];

$nomArbitre = $pdo->prepare("SELECT Nom FROM Utilisateurs WHERE ID_User = :varId;");
$nomArbitre->execute(['varId' => $idArbitre]);
$nomArbitre = $nomArbitre->fetch()[0];

$idsEquipes = $pdo->prepare("SELECT ID_Equipe FROM Jouer WHERE ID_Match = :varId;");
$idsEquipes->execute(['varId' => $_GET['id']]);
$idsEquipes = $idsEquipes->fetchAll();
$listeIds = [];

$i = 0;
foreach($idsEquipes as $idEquipe){
    $listeIds[$i] = $idEquipe["ID_Equipe"];
    $i++;
}

$nomsEquipes = $pdo->prepare("SELECT Nom FROM Equipe WHERE ID_Equipe = :varId");
$nomsEquipes->execute(['varId' => $listeIds[0]]);
$nomEquipe1 = $nomsEquipes->fetch()[0];
$nomsEquipes->execute(['varId' => $listeIds[1]]);
$nomEquipe2 = $nomsEquipes->fetch()[0];

$scoresEquipes = $pdo->prepare("SELECT Score FROM Jouer WHERE ID_Equipe = :varId");
$scoresEquipes->execute(['varId' => $listeIds[0]]);
$scoreEquipe1 = $scoresEquipes->fetch()[0];
$scoresEquipes->execute(['varId' => $listeIds[1]]);
$scoreEquipe2 = $scoresEquipes->fetch()[0];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include '../modules/head.php'; ?>
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-dash-editform-match">
        <h2 class="title">Modifier le match <?php echo ($nomEquipe1 . " VS " . $nomEquipe2)?></h2>
        <section>
            <div>
                <h3>Modifier le match</h3>
                <form action="../config/config-edit-match.php?id=<?php echo ($_GET["id"]) ?>" method="POST" enctype="multipart/form-data">
                    <label for="new-date-debut">Date de début</label>
                    <input name="new-date-debut" value="<?php echo $dateDebut ?>" id="new-date-debut">

                    <label for="new-date-fin">Date de fin</label>
                    <input name="new-date-fin" value="<?php echo $dateFin ?>" id="new-date-fin">

                    <label for="new-stade">Stade</label>
                    <input name="new-stade" value="<?php echo $stade ?>" id="new-stade">

                    <label for="new-score-equipe1">Score <?php echo $nomEquipe1 ?></label>
                    <input name="new-score-equipe1" value="<?php echo $scoreEquipe1 ?>" id="new-score-equipe1">
                    
                    <label for="new-score-equipe2">Score <?php echo $nomEquipe2 ?></label>
                    <input name="new-score-equipe2" value="<?php echo $scoreEquipe2 ?>" id="new-score-equipe2">
                    <button>Valider</button>
                </form>

                <a style="background-color: var(--blue)" href="../config/config-verrouillage-match.php?id=<?php echo($_GET["id"]);?>">VEROUILLER LE MATCH</a>
            </div>
            
            <?php 
                if ($_SESSION["type"] == "administrateur") {
                    echo ("<h3>Modifier l'arbitre du match (arbitre actuel : " . $prenomArbitre . " " . $nomArbitre . ") </h3>");
                    $reponse = $pdo->query('SELECT Prenom, Nom, ID_User FROM Utilisateurs WHERE Type_user<=1;');
                    $reponses=$reponse->fetchAll();

                    echo (" 
                        <div class='addt'>
                            <label for='pet-select'>Modifier l'arbitre du match</label>
                            <div>
                                <form name='store' id='store' method='POST' action='../config/config-changer-arbitre.php?id=". $_GET['id'] . "'>
                                    <select name='selectid' id='selectid' >");
                                    foreach($reponses as $value):
                                        echo "<option value=" . $value['ID_User'] . ">" . $value['Prenom'] . " " . $value['Nom'] . " </option>";
                                    endforeach;
                                    echo ("</select>
                                    <button>Ajouter</button>
                                </form>
                            </div>
                        </div>
                        ");
                };  
            ?> 

        </section>
    </main>
</body>