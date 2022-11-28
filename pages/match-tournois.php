<?php session_start();
if (empty($_SESSION["admin"])) {
    $_SESSION["admin"] = false;
}

try {
    $pdo = new PDO("mysql:dbname=p2106229;host=iutbg-lamp.univ-lyon1.fr", "p2106229", "12106229", [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}


$sql = 'SELECT * FROM MatchTournoi where ' . $_GET["id"];
$listeMatchs = $pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
</head>
<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-matchtournois">
        <h2 class="title">Match</h2>
        <?php
        $matchs = $listeMatchs->fetchAll();
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