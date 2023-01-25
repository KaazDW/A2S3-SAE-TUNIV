<?php session_start();
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if ($_SESSION["type"] != "arbitre") {
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
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-dashcap">
        <h2 class="title">Affichage de l'équipe</h2>
        <section class="dashcap-section">
            <div class="nomequipe">
                <h3>Mes matchs : </h3>
            </div>

            <section class="joueurs-liste-section">
                <div class="joueurs-liste-div">
                    <?php
                    $listematch = $pdo->prepare('SELECT * from MatchTournoi where ID_User=:varId;');
                    $listematch->execute(
                        [
                            // 'varId' => $_SESSION["userId"],
                            'varId' => 1,
                        ]
                    );
                    $equipe = $listematch->fetchAll();
                    foreach($equipe as $match): 
                    // $_SESSION["actuel"] = $equipe[1];
                    ?>
                        <a href='' class="joueur-line">
                            <span><?php echo ($match['Sport']) ?></span>
                            <span><?php echo ($match['DateDebut']) ?></span>
                            <span><?php echo ($match['DateFin']) ?></span>
                            <span><?php echo ($match['Stade']) ?></span>
                    </a>
                    
                    <?php
                    endforeach;
                    ?>

                </div>

            </section>


        </section>
    </main>
    <?php include '../modules/footer.php'; ?>
    <script>
        // DISPLAY JOUEURS EDIT MENU
        document.getElementById('joueur-edit').style.display = "none";

        function openeditjoueurs() {
            document.getElementById('joueur-edit').style.display = "block";
        }

        function closeeditjoueurs() {
            document.getElementById('joueur-edit').style.display = "none";
        }

        document.getElementById('closebtneditjoueurs').addEventListener("click", function() {
            document.getElementById('joueur-edit').style.display = "none";
        });
    </script>
</body>

</html>