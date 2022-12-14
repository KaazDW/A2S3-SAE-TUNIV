<?php session_start();

if (empty($_SESSION["type"])) {
    $_SESSION["type"] = false;
}

if ($_SESSION["type"]!="administrateur") {
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
</head> 
<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-dashboard">
        <h2 class="title">Dashboard Admin</h2>
        <section class="dashadmin-section">
            <!-- <div class="dashadmin-topgrid">
                <div class="dashadmin-topgrid-card dashadmin-card">

                </div>
                <div class="dashadmin-topgrid-card dashadmin-card">

                </div>
                <div class="dashadmin-topgrid-card dashadmin-card">
                    
                </div>
            </div> -->
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
                                <img src="../assets/img/edit-blanc.png">
                            </a>
                            <a class="edit" href="../config/config-suppr-tournoi.php?id=<?= $tournoi['ID_Tournoi'] ?>">
                                <img src="../assets/img/delete-blanc.png">
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
                        <img src="../assets/img/create.png">
                    </a>
                </div>
                <div id="tcreationmenu">
                    <header>
                        <a id="creationmenuclose">
                            <img src="../assets/img/cross.png">
                        </a>
                    </header>

                    <h3>Cr??er un nouveau tournoi</h3>
                    <form action="../config/config-crea-tournoi.php" method="POST">
                        <div class="form">
                            <div class="form-parta">
                                <label for="name">Nom du tournoi</label>
                                <input name="name" type="text" id="name" maxlength=255 required="required">

                                <label for="sport">Sport</label>
                                <input name="sport" type="text" id="sport" maxlength=50 required="required">

                                <label for="dateDeb">Date de d??but du tournoi</label>
                                <input name="dateDeb" type="datetime-local" id="dateDeb" required="required">

                                <label for="dateFin">Date de fin du tournoi</label>
                                <input name="dateFin" type="datetime-local" id="dateFin" required="required">
                            </div>
                        </div>

                        <div class="form-button">
                            <button type="submit">Cr??er le tournoi</button>
                        </div>      
                    </form>

                </div>
            </div>
        </section>


    </main>
    <?php include '../modules/footer.php'; ?>
    <script>
        // DISPLAY TOURNAMENT CREATION MENU
        document.getElementById('tcreationmenu').style.display = "none";
        document.getElementById('tcreate').addEventListener("click", function(){
            document.getElementById('tcreationmenu').style.display = "block";
        });
        document.getElementById('creationmenuclose').addEventListener("click", function(){
            document.getElementById('tcreationmenu').style.display = "none";
        });
    </script>
</body>
</html>