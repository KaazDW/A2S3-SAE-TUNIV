<?php session_start();
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../../index.php");
}

include '../../config/db.php';

$sql = "SELECT * FROM Tournoi;";
$listeTournois = $pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../../modules/head.php'; ?>
    <link href="../../assets/css/style.css" rel="stylesheet">
</head> 
<body>
    <?php include '../../modules/header.php'; ?>
    <main class="main-dashboard">
        <h2 class="title">Dashboard Admin</h2>
        <section class="dashadmin-section">
            <div class="dashadmin-topgrid">
                <div class="dashadmin-topgrid-card dashadmin-card">

                </div>
                <div class="dashadmin-topgrid-card dashadmin-card">

                </div>
                <div class="dashadmin-topgrid-card dashadmin-card">
                    
                </div>
            </div>
            <div class="dashadmin-topmid">
                <div class="display-tournaments dashadmin-card">
                    <?php $tournois = $listeTournois->fetchAll();
                        foreach($tournois as $tournoi):
                    ?>
                    <div class="tournois-line">
                        <span><?php echo($tournoi['Sport']) ?></span>
                        <span><?php echo($tournoi['Nom']) ?></span>
                        <div>
                            <a class="edit" href="dashb-admin-editform.php?id=<?= $tournoi['ID_Tournoi'] ?>">
                                <img src="../../assets/img/edit-blanc.png">
                            </a>
                            <a class="edit" href="../../config/config-suppr-tournoi.php?id=<?= $tournoi['ID_Tournoi'] ?>">
                                <img src="../../assets/img/delete-blanc.png">
                            </a>
                        </div>
                    </div>
                    <?php
                    endforeach;
                    ?>
                </div>
                <div class="init-tourn dashadmin-card">
                    <h3>tournois</h3>
                    <a id="tcreate">
                        <img src="../../assets/img/create.png">
                    </a>
                </div>
                <div id="tcreationmenu">
                    <header>
                        <a id="creationmenuclose">
                            <img src="../../assets/img/cross.png">
                        </a>
                    </header>
                </div>
            </div>
        </section>


    </main>
    <?php include '../../modules/footer.php'; ?>
</body>
</html>