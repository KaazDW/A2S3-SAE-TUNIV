<?php if (empty($_SESSION["admin"])) {
    $_SESSION["admin"] = false;
}

// $_GET["id"]=$_SESSION["idTournoi"];
// unset($_SESSION["idTournoi"]);

$listematch = $pdo->prepare('SELECT * FROM MatchTournoi where ID_Tournoi =:varId');

$listematch->execute(['varId' => $_GET["id"]]);
$matchs = $listematch->fetchAll();

$tournoi = $pdo->prepare('SELECT * FROM Tournoi WHERE ID_Tournoi =:varId');
$tournoi->execute(['varId' => $_GET["id"]]);
$tournoi = $tournoi->fetchAll();

$listeequipe = $pdo->prepare('SELECT Nom, ID_Equipe, Score FROM Participer natural join Equipe WHERE ID_Tournoi =:varId ORDER BY Score DESC');
$listeequipe->execute(['varId' => $_GET["id"]]);
$equipes = $listeequipe->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include '../modules/head.php'; ?>
</head>

<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-matchtournois">
        <!-- <div id="loaderdiv">
            <div class="loader"></div>  
        </div> -->
        <section class="topsec">
            <h2 class="title">
                <?php $nom = $tournoi[0]["Nom"];
                echo ($nom); ?>
            </h2>
            <span class="sub"><?php $etape = $tournoi[0]["Etape"];
                                if ($etape == 0) {
                                    echo ("Ce tournoi n'a pas encore commencé.");
                                } else if ($etape == 1) {
                                    echo ("Ce tournoi est en cours.");
                                } else if ($etape == 2) {
                                    echo ("Ce tournoi est en phase finale.");
                                } else {
                                    echo ("Ce tournoi est terminé.");
                                }
                                ?>
            </span>
            <div class="grid">

                <h3>Sport :</h3><span><?php $sport = $tournoi[0]["Sport"];
                                        echo $sport; ?></span>
                <h3>Date de début :</h3><span><?php $dateDeb = $tournoi[0]["DateDebut"];
                                                echo $dateDeb; ?></span>
                <h3>Date de fin :</h3><span><?php $dateFin = $tournoi[0]["DateFin"];
                                            echo $dateFin; ?></span>
                <h3>Equipes inscrites :</h3>
                <span>
                    <?php $sql = $pdo->prepare('SELECT COUNT(DISTINCT ID_Equipe) FROM Participer WHERE ID_Tournoi =:varId');
                    $sql->execute(['varId' => $_GET["id"]]);
                    echo ($sql->fetch()[0]);
                    ?>/<?php $nbMax = $tournoi[0]["Nb_Equipe"];
                                echo ($nbMax); ?>
                </span>
            </div>
            <?php
            $reponse = $pdo->prepare('SELECT Nom, ID_Equipe FROM Equipe WHERE ID_Equipe NOT IN (SELECT ID_Equipe FROM Participer WHERE ID_Tournoi = :varId);');
            $reponse->execute(['varId' => $_GET["id"]]);
            $reponses = $reponse->fetchAll();


            if ($_SESSION["type"] == "administrateur" && $tournoi[0]["Etape"] == 0) {

                echo (" 
                    <section class='bottom-top'>
                        <div class='addt'>
                            <label for='pet-select'>Ajouter une équipe</label>
                            <div>
                                 <form name='store' id='store' method='POST' action='../config/config-add-team-inscrit.php?id=" . $_GET['id'] . "'>
                                    <select name='selectid' id='selectid' >");
                foreach ($reponses as $value) :
                    echo "<option value=" . htmlspecialchars($value['ID_Equipe']) . ">" . htmlspecialchars($value['Nom']) . " </option>";
                endforeach;
                echo ("</select>
                                <button>Ajouter</button>
                               </form>
                            </div>
                        </div>
                        <div class='generationdiv'>
                            <a href='../config/config-poules-tournoi.php?id=" . $_GET['id'] . "'><img src='../assets/img/reload.png'>Generer les poules</a>
                        </div>
                    </section>    
                        ");
            } else if ($_SESSION["type"] == "administrateur" && $tournoi[0]["Etape"] == 1) {
                echo ("<section class='bottom-top'>
                        <div class='generationdiv'>
                            <a href='../config/config-bracket-tournoi.php?id=" . $_GET['id'] . "'><img src='../assets/img/reload.png'>Generer l'arbre final</a>
                        </div>
                        </section>");
            } else if ($_SESSION["type"] == "administrateur" && $tournoi[0]["Etape"] == 2) {
                echo ("<section class='bottom-top'>
                    <div class='generationdiv'>
                        <a href='../config/config-fin-tournoi.php?id=" . $_GET['id'] . "'><img src='../assets/img/reload.png'>Mettre fin au tournoi</a>
                    </div>
                    </section>");
            }

            ?>
        </section>

        <!-- Affichage Equipe inscrites -->
        <h2 class="title">Equipes Inscrites</h2>
        <section class="forequipesection">
            <?php
            foreach ($equipes as $equipe) :
            ?>
                <div class="forequipediv">
                    <div>
                        <?php $nomCapitaine = $pdo->prepare("SELECT Prenom, Nom FROM Utilisateurs WHERE ID_User = (SELECT ID_Capitaine FROM Equipe WHERE ID_Equipe = :varEquipe);");
                        $nomCapitaine->execute(['varEquipe' => $equipe['ID_Equipe']]);
                        $nomCapitaine = $nomCapitaine->fetch();
                        ?>
                        <article>
                            <h3><?php echo (htmlspecialchars($equipe['Nom'])); ?></h3>
                            <span><?php echo (htmlspecialchars($nomCapitaine["Prenom"]));
                                    echo " ", htmlspecialchars($nomCapitaine["Nom"]) ?></span>
                            <span class="score"><?php echo (htmlspecialchars($equipe["Score"])) ?></span>
                        </article>
                        <?php if ($_SESSION["type"] == "administrateur" && $tournoi[0]["Etape"] == 0) {
                            echo (" <a  href='../config/config-delete-team-inscrit.php?idEquipe=" .  htmlspecialchars($equipe['ID_Equipe']) . "&amp;idTournoi=" . $_GET['id'] . "'>
                                    <img src='../assets/img/delete-blanc.png'>
                                </a>");
                        };
                        ?>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </section>
        <!-- Fin -->

        <h2 id="el4" class="title">Matchs</h2>
        <section id="el5" class="display-poule">
            <?php foreach ($matchs as $match) : ?>
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
                        <?php echo htmlspecialchars($nomEquipe1[0]);
                        echo (" ");
                        echo htmlspecialchars($scoreEquipe1[0]); ?><span> VS </span> <?php echo htmlspecialchars($scoreEquipe2[0]);
                                                                                                                                                echo (" ");
                                                                                                                                                echo htmlspecialchars($nomEquipe2[0]); ?>
                    </h3>
                    <p><?php echo "<span>> Fin : </span>" . htmlspecialchars($match['DateDebut']); ?></p>
                    <p><?php echo "<span>> Debut : </span>" . htmlspecialchars($match['DateFin']); ?></p>
                    <p><?php echo "<span>> Stade : </span>" . htmlspecialchars($match['Stade']); ?></p>
                    <?php if (($_SESSION["type"] == "administrateur" || ($_SESSION["type"] == "arbitre" && $match["ID_User"] == $_SESSION["userId"])) && $match["Etat"] == 0) {
                        echo (" <a href='dashb-editform-match?id=" . htmlspecialchars($match['ID_Match']) . "'>
                                            <img src='../assets/img/edit-blanc.png'>
                                        </a>"
                        );
                    };
                    ?>
                    <?php
                    // echo($nomEquipe1[0] ." contre ". $nomEquipe2[0] . " Début à " . $match['DateDebut'] ." Fin à ". $match['DateFin']." Stade : ".$match['Stade']   ) 
                    ?>
                </div>
            <?php endforeach; ?>

        </section>
    </main>
    <?php include '../modules/footer.php'; ?>
</body>

</html>