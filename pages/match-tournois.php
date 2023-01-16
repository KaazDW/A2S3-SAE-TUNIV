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

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
</head>
<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-matchtournois">

        <h2 class="title">
            <?php $nom = $tournoi->fetch()["Nom"];
            echo($nom);?>
        </h2>
        <h3>Sport :</h3><span><?php $sport = $tournoi->fetch()["Sport"]; var_dump($sport); echo $sport;?></span>

        <h2 class="title">Match</h2>
        <?php

        foreach($matchs as $match):
            ?>
            <h3>
                <a href="match-tournois.php?id=<?= $match['ID_Match'] ?>">
                <?php 
                echo($match['Sport'] ." ". $match['DateDebut'] ."  ". $match['DateFin']." ".$match['Stade']." ". $match['ScoreEquipe1']." - ". $match['ScoreEquipe2']   ) ?>
                </a>
            </h3>

            <?php
            endforeach;
            ?>


    </main> 
    <?php include '../modules/footer.php'; ?>
</body>
</html>