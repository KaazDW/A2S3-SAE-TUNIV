<?php session_start();
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if ($_SESSION["type"] != "arbitre") {
    header("Location: ../index.php");
}



include '../config/db.php';

$sql = "SELECT * FROM Tournoi;";
$listeTournois = $pdo->query($sql);




?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include '../modules/head.php'; ?>
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-dashcap">
        <h2 class="title">Affichage de l'équipe</h2>
        <section class="dashcap-section">
            <div class="nomequipe">
                <h3>Mes matchs : </h3>
            </div>

            <section class="joueurs-liste-section">
                <div class="joueurs-liste-div">
                    <?php
                    $listematch = $pdo->prepare('SELECT * from MatchTournoi where ID_User=:varId;');
                    $listematch->execute(
                        [
                            'varId' => $_SESSION["userId"],
                            
                        ]
                    );
                    $matchs = $listematch->fetchAll();?>
                    <section id="el5" class="display-poule">
                        <?php foreach($matchs as $match): ?>
                            <a  href='dashb-editform-match.php?id=<?=$match['ID_Match']?>'>
                            <div class="line-poule">
                                <?php $idEquipes = $pdo->prepare("SELECT ID_Equipe FROM Jouer WHERE ID_Match= :varMatch;");
                                $idEquipes->execute(['varMatch' => $match['ID_Match']]);
                                $idEquipes = $idEquipes->fetchAll();
            
                                $nomsEquipes = $pdo->prepare("SELECT Nom FROM Equipe WHERE ID_Equipe = :varEquipe");
                                $scoresEquipes = $pdo->prepare("SELECT Score FROM Jouer WHERE ID_Match = :varMatch AND ID_Equipe=:varEquipe;");
            
                                $nomsEquipes->execute(['varEquipe' => $idEquipes[0][0]]);
                                $nomEquipe1 = $nomsEquipes->fetch();
                                $scoresEquipes->execute(['varEquipe' => $idEquipes[0][0], 'varMatch' => $match['ID_Match']]);
                                $scoreEquipe1 = $scoresEquipes->fetch();
                                
                                $nomsEquipes->execute(['varEquipe' => $idEquipes[1][0]]);
                                $nomEquipe2 = $nomsEquipes->fetch();
                                $scoresEquipes->execute(['varEquipe' => $idEquipes[1][0], 'varMatch' => $match['ID_Match']]);
                                $scoreEquipe2 = $scoresEquipes->fetch();
                            ?>
                            <h3>
                                <?php echo $nomEquipe1[0]; echo(" "); echo $scoreEquipe1[0]; ?><span> VS </span> <?php echo $scoreEquipe2[0]; echo(" "); echo $nomEquipe2[0];?>
                            </h3>
                            <p><?php echo "<span>> Fin : </span>" . $match['DateDebut'];?></p>
                            <p><?php echo "<span>> Debut : </span>" . $match['DateFin'];?></p>
                            <p><?php echo "<span>> Stade : </span>" . $match['Stade'];?></p>
                            <p><?php echo "<br>"?></p>
                        </a>

                </div>
                <?php endforeach; ?>

            </section>


        </section>
    </main>
    <?php include '../modules/footer.php'; ?>
    <script>
        // DISPLAY JOUEURS EDIT MENU
        document.getElementById('joueur-edit').style.display = "none";

        function openeditjoueurs() {
            document.getElementById('joueur-edit').style.display = "block";
        }

        function closeeditjoueurs() {
            document.getElementById('joueur-edit').style.display = "none";
        }

        document.getElementById('closebtneditjoueurs').addEventListener("click", function() {
            document.getElementById('joueur-edit').style.display = "none";
        });
    </script>
</body>

</html>