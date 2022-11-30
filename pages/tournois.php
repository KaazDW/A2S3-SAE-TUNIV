<?php session_start();

include '../config/db.php';

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
        <?php $tournois = $listeTournois->fetchAll();
            foreach($tournois as $tournoi):
        ?>
        <h3>
            <a href="match-tournois.php?id=<?= $tournoi['ID_Tournoi'] ?>">
            <?php echo($tournoi['Sport'] ." ". $tournoi['Nom'] . $tournoi['DateDebut'] . $tournoi['DateFin']) ?>
            </a>
        </h3>
        <table class="tournois-encours">
            <caption>Listes des tournois</caption>
            <tr class="table-title">
                <td>SPORT</td>
                <td>VALUE</td>
                <td>VALUE</td>
                <td>VALUE</td>
                <td>LINK</td>
            </tr>
            <tr>
                <th>
                    <?php echo($tournoi['Sport']) ?>
                </th>
                <th>
                    <?php echo($tournoi['Nom']) ?>
                </th>
                <th scope="col">
                    <?php echo($tournoi['DateDebut']) ?>
                </th>
                <th scope="col">
                    <?php echo($tournoi['DateFin']) ?>
                </th>
                <th scope="col">
                    <!-- <?php echo($tournoi['Sport']) ?> -->
                </th>
            </tr>

            <tr>
                <th scope="row">Khiresh Odo</th>
                <td>7</td>
                <td>7,223</td>
            </tr>
            <tr>
                <th scope="row">Mia Oolong</th>
                <td>9</td>
                <td>6,219</td>
            </tr>
        </table>

        <?php
        endforeach;
        ?>
    </main>
    <?php include '../modules/footer.php'; ?>
</body>
</html>