<?php 
    if (empty($_SESSION["type"])) {
        $_SESSION["type"] = false;
    }

    if ($_SESSION["type"] != "administrateur") {
        header("Location: /index");
    }

    $sql = "SELECT * FROM Tournoi;";
    $listeTournois = $pdo->query($sql);

    $sql = "SELECT * FROM Equipe;";
    $listeEquipes = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
    <!-- <link href="../assets/css/style.css" rel="stylesheet"> -->
</head>
<body>
    <?php include '../modules/header.php'; ?>
    <main class="real-main-dashboard">
        <h2 class="title">DASHBOARD Administrateur</h2>
        <?php 
        if (!empty($_SESSION["tournoiErreur"])){
            echo("<div>" . $_SESSION["tournoiErreur"] . "</div>");
            unset($_SESSION["tournoiErreur"]);
        }
        
        if (!empty($_SESSION["equipeErreur"])){
            echo("<div>" . $_SESSION["equipeErreur"] . "</div>");
            unset($_SESSION["equipeErreur"]);
        }
        ?>
        
        <section class="dashadmin-section">
            <div class="form-tournois ffield">
                <h3>Créer un nouveau tournoi</h3>
                <form action="/config-crea-tournoi" method="POST">
                    <div class="form-button">
                        <button type="submit">Créer le tournoi</button>
                    </div>    
                    <div class="form">
                        <label for="name">Nom du tournoi</label>
                        <input name="name" type="text" id="name" maxlength=255 required="required">

                        <label for="sport">Sport</label>
                        <input name="sport" type="text" id="sport" maxlength=50 required="required">

                        <label for="dateDeb">Date de début du tournoi</label>
                        <input name="dateDeb" type="datetime-local" id="dateDeb" required="required">

                        <label for="dateFin">Date de fin du tournoi</label>
                        <input name="dateFin" type="datetime-local" id="dateFin" required="required">

                        <label for="teams">Nb° équipes max</label>
                        <input name="teams" type="integer" id="teams" required="required">
                    </div>
                </form>
            </div>
            <div class="form-equipe ffield">
                <h3>Créer une nouvelle équipe</h3>
                <form action="/config-admin-crea-equipe" method="POST">
                    <div class="form-button">
                        <button type="submit">Créer l'équipe</button>
                    </div>    
                    <div class="form">
                        <label for="name">Nom</label>
                        <input name="name" type="text" id="name" maxlength=255 required="required">

                        <label for="sport">Sport</label>
                        <input name="sport" type="text" id="sport" maxlength=50 required="required">

                        <label for="name-capitaine">Nom capitaine</label>
                        <input name="name-capitaine" type="name-capitaine" id="name-capitaine" required="required">

                        <label for="firstname-capitaine">Prenom Capitaine</label>
                        <input name="firstname-capitaine" type="firstname-capitaine" id="firstname-capitaine" required="required">
                    </div>
                </form>
            </div>
            <div class="display-t">
                    <h3>Tournois</h3>
                    <?php $tournois = $listeTournois->fetchAll();
                    foreach ($tournois as $tournoi) :
                    ?>
                        <div class="tournois-line">
                            <span><?php echo htmlspecialchars($tournoi['Sport']) ?></span>
                            <span><?php echo htmlspecialchars($tournoi['Nom']) ?></span>
                            <div>
                                <a class="edit" href="dashb-admin-editform-tournoi?id=<?= $tournoi['ID_Tournoi'] ?>">
                                    <img src="../assets/img/edit-blanc.png">
                                </a>
                                <a class="edit" href="/config-suppr-tournoi?id=<?= $tournoi['ID_Tournoi'] ?>">
                                    <img src="../assets/img/delete-blanc.png">
                                </a>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            <div class="display-t">
                    <h3>Équipes</h3>
                    <?php $equipes = $listeEquipes->fetchAll();
                    foreach ($equipes as $equipe) :
                    ?>
                        <div class="tournois-line">
                            <span><?php echo htmlspecialchars($equipe['Sport']) ?></span>
                            <span><?php echo htmlspecialchars($equipe['Nom']) ?></span>
                            <div>
                                <a class="edit" href="dashb-admin-editform-equipe?id=<?= $equipe['ID_Equipe'] ?>">
                                    <img src="../assets/img/edit-blanc.png">
                                </a>
                                <a class="edit" href="/config-suppr-equipe?id=<?= $equipe['ID_Equipe'] ?>">
                                    <img src="../assets/img/delete-blanc.png">
                                </a>
                            </div>
                        </div>
                    <?php
                        endforeach;
                    ?>
                </div>
        </section>
    </main>
    <?php include '../modules/footer.php'; ?>
    <script>
        // DISPLAY TOURNAMENT CREATION MENU
        document.getElementById('tcreationmenu').style.display = "none";
        document.getElementById('tcreate').addEventListener("click", function() {
            document.getElementById('tcreationmenu').style.display = "block";
        });
        document.getElementById('creationmenuclose').addEventListener("click", function() {
            document.getElementById('tcreationmenu').style.display = "none";
        });
    </script>
</body>

</html>