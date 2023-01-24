<?php session_start();
if (empty($_SESSION["type"])) {
    $_SESSION["type"] = false;
}

if ($_SESSION["type"] != "administrateur") {
    header("Location: ../index.php");
}

include '../config/db.php';

$user = $pdo->prepare('SELECT * FROM Utilisateurs where ID_User =:varId');

$user->execute(['varId' => $_GET["id"]]);
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
        <h2 class="title">Modifier l'utilisateur</h2>
        <section class="dashcap-section">

            <section class="joueurs-liste-section">
                <div class="joueurs-liste-div">

                    <!-- Problème foreach et form -->
                    <?php
                    $utilisateur = $pdo->prepare('SELECT Nom,Prenom, Email, Type_user from Utilisateurs  where ID_User=:varId;');
                    $utilisateur->execute(['varId' => $_GET["id"]]);
                    $joueurs = $utilisateur->fetch();
                    $nom= $joueurs[0];
                    $prenom= $joueurs[1];
                    $mail= $joueurs[2];
                    $type= $joueurs[3];
                    ?>

                    <div class="ajout-joueurs">
                        <form action="../config/config-admin-edit-user.php?id=<?php echo ($_GET["id"]) ?>" method='POST' enctype='multipart/form-data'>
                            <h3>Modifier l'utilisateur</h3>
                            <div>
                                <label for="new-surname1">Prénom</label>
                                <input name="new-surname1" value=<?php echo($prenom) ?> id="new-surname1">
                            </div>
                            <div>
                                <label for="new-name1">Nom</label>
                                <input name="new-name1" value=<?php echo($nom) ?> id="new-name1">
                            </div>
                            <div>
                                <label for="new-mail1">Mail</label>
                                <input name="new-mail1" value=<?php echo($mail) ?> id="new-mail1">
                            </div>
                            <div>
                                <label for="new-type1">Type</label>
                                <input name="new-type1" value=<?php echo($type) ?> id="new-type1">
                            </div>
                            <button>Valider</button>
                        </form>
                    </div>



                </div>

            </section>
            <section id="joueur-edit">
                <header>
                    <button onclick="closeeditjoueurs()">Annuler</button>
                </header>
                <div class="content">
                    <!-- CONTENU DU MENU D'EDITION D'UN JOUEURS -->
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