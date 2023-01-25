<?php session_start();
if (empty($_SESSION["admin"])) {
    $_SESSION["admin"] = false; 
}

include_once '../config/db.php';

$listematch = $pdo->prepare('SELECT * FROM MatchTournoi where ID_Tournoi =:varId');

$listematch->execute(['varId' =>$_GET["id"]]);
$matchs=$listematch->fetchAll();

$tournoi = $pdo->prepare('SELECT * FROM Tournoi WHERE ID_Tournoi =:varId');
$tournoi->execute(['varId' =>$_GET["id"]]);
$tournoi=$tournoi->fetchAll();

$listeequipe = $pdo->prepare('SELECT Nom, ID_Equipe FROM Participer natural join Equipe WHERE ID_Tournoi =:varId');
$listeequipe->execute(['varId' =>$_GET["id"]]);
$equipes=$listeequipe->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
</head>
<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-matchtournois">
        <section class="topsec">
                <h2 class="title">
                    <?php $nom = $tournoi[0]["Nom"];
                    echo($nom);?>
                </h2>
                <span class="sub"><?php $etape = $tournoi[0]["Etape"];
                    if ($etape==0){
                        echo("Ce tournoi n'a pas encore commencé.");
                    }
                    else if ($etape==1){
                        echo("Ce tournoi est en cours.");
                    }
                    else {
                        echo("Ce tournoi est terminé.");
                    }
                    ?>
                </span>
            <div class="grid">

                    <h3>Sport :</h3><span><?php $sport = $tournoi[0]["Sport"]; echo $sport;?></span>
                    <h3>Date de début :</h3><span><?php $dateDeb = $tournoi[0]["DateDebut"]; echo $dateDeb;?></span>
                    <h3>Date de fin :</h3><span><?php $dateFin = $tournoi[0]["DateFin"]; echo $dateFin;?></span>
                    <h3>Equipes inscrites :</h3> 
                        <span>
                            <?php $sql = $pdo->prepare('SELECT COUNT(DISTINCT ID_Equipe) FROM Participer WHERE ID_Tournoi =:varId');
                            $sql->execute(['varId' =>$_GET["id"]]);
                            echo($sql->fetch()[0]);
                            ?>/<?php $nbMax = $tournoi[0]["Nb_Equipe"]; echo($nbMax);?>
                        </span>
            </div>
            <?php 
            $reponse = $pdo->query('SELECT Nom FROM Equipe;');
            $reponses=$reponse->fetchAll();


                if ($_SESSION["type"] == "administrateur") {

                    echo (" 
                    <section class='bottom-top'>
                        <div class='addt'>
                            <label for='pet-select'>Ajouter une équipe</label>
                            <div>
                                 <form name='store' id='store' method='POST' action='../config/config-add-team-inscrit.php?id=". $_GET['id'] . "'>
                                    <select name='selectid' id='selectid' >");
                                    foreach($reponses as $value):
                                        echo "<option value=" . $value['Nom'] . ">" . $value['Nom'] . " </option>";
                                    endforeach;
                                echo ("</select>
                                <button>Ajouter</button>
                               </form>

                            </div>
                        </div>
                        <div class='generationdiv'>
                            <a href='../config/config-poules-tournoi.php?id=". $_GET['id'] . "'><img src='../assets/img/reload.png'>Generer les poules</a>
                        </div>
                    </section>    
                        ");
                };
                
                ?> 
        </section>

        <!-- Affichage Equipe inscrites -->
        <h2 class="title">Equipes Inscrites</h2>
        <?php   
        foreach($equipes as $equipe):
        ?>

            <div class="forequipediv">
                <h3>
                    <?php echo($equipe['Nom']) ?>
                </h3> 
                <?php if ($_SESSION["type"] == "administrateur") {
                    echo (" 
                        <a  href='../config/config-delete-team-inscrit.php?id=" .  $equipe['ID_Equipe'] .  "'>
                            <img src='../assets/img/delete-blanc.png'>
                        </a>
                    ");
                };
                ?> 
            </div>

        <?php
        endforeach;
        ?>
        <!-- Fin -->

        <h2 class="title">Matchs</h2>
        <?php

        foreach($matchs as $match):
            ?>
            <h3>
                <span>
                <?php 
                echo($match['Sport'] ." ". $match['DateDebut'] ."  ". $match['DateFin']." ".$match['Stade']   ) ?>
                </span>
            </h3>

            <?php
            endforeach;
            ?>
            


    </main> 
    <?php include '../modules/footer.php'; ?>
</body>
</html>