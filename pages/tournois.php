<?php session_start();

try {
    $pdo = new PDO("mysql:dbname=p2106229;host=iutbg-lamp.univ-lyon1.fr", "p2106229", "12106229", [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

$sql = "SELECT Sport, Nom, DateDebut, DateFin FROM Tournoi;";
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
            <h3>
                <?php $tournoi = $listeTournois->fetch();
                echo($tournoi[0] . " " . $tournoi[1] . $tournoi[2] . $tournoi[3]); ?>
            </h3>

    </main>

    <footer>
        <!-- <h3>footer</h5> -->
        <a href="">©TUNIV</a>
    </footer>
    <script src="/app.js"></script>
</body>

</html>