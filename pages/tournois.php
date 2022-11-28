<?php session_start();

try {
    $pdo = new PDO("mysql:dbname=p2106229;host=iutbg-lamp.univ-lyon1.fr", "p2106229", "12106229", [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

$sql = "SELECT * FROM Tournoi;";
$listeTournois = $pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
</head>
<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-informations">
        <h2 class="title">Tournois</h2>
        <?php
        $tournois = $listeTournois->fetchAll();
        foreach($tournois as $tournoi):
            ?>
            <h3>
                <a href="match-tournois.php?id=<?= $tournoi['ID_Tournoi'] ?>">
                <?php 
                echo($tournoi['Sport'] ." ". $tournoi['Nom'] . $tournoi['DateDebut'] . $tournoi['DateFin']) ?>
                </a>
            </h3>

            <?php
            endforeach;
            ?>
    </main>
    <?php include '../modules/footer.php'; ?>
</body>
</html>