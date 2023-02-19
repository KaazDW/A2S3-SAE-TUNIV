<?php 
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
    <main class="main-tournois">
        <h2 class="title">Tournois</h2>
        <div class="title-grid">
            <span>Sport</span>
            <span>Nom</span>
            <span>Début</span>
            <span>Fin</span>
        </div>
        <?php $tournois = $listeTournois->fetchAll();
            foreach($tournois as $tournoi):
        ?>

        <a href="match-tournois.php?id=<?= $tournoi['ID_Tournoi'] ?>" class="tournois-line">
            <span><?php echo(htmlspecialchars($tournoi['Sport'])); ?></span>
            <span><?php echo(htmlspecialchars($tournoi['Nom'])) ?></span>
            <span><?php echo(htmlspecialchars($tournoi['DateDebut'])) ?></span>
            <span><?php echo(htmlspecialchars($tournoi['DateFin'])) ?></span>
        </a>

        <?php endforeach; ?>
    </main>
    <?php include '../modules/footer.php'; ?>
</body>
</html>