<?php session_start();
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if ($_SESSION["type"] != "administrateur") {
    header("Location: ../index.php");
}

include '../config/db.php';

$listeequipe = $pdo->prepare('SELECT Nom FROM Participer natural join Equipe WHERE ID_Tournoi =:varId');
$listeequipe->execute(['varId' =>$_GET["id"]]);
$equipes=$listeequipe->fetchAll();


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
        <h2 class="title">Modifier le tournoi</h2>
        <section class="dashcap-section">
            <div class="ajout-joueurs">
                <p>
                    <?php
                    $listetournoi = $pdo->prepare('SELECT *  FROM Tournoi where ID_Tournoi =:varId');


                    $listetournoi->execute(
                        [

                            'varId' => $_GET["id"],
                        ]
                    );
                    $tournoi = $listetournoi->fetch();
                    ?>
                </p>
                <form action="../config/config-editform-tournoi.php?id=<?php echo ($_GET["id"]) ?>" method="POST" enctype="multipart/form-data">
                    <h3>Modifier un tournoi</h3>
                    <div>
                        <label for="new-sport">Sport</label>
                        <input name="new-sport" value=<?php echo $tournoi[1] ?> id="new-sport">
                    </div>
                    <div>
                        <label for="new-name">Nom</label>
                        <input name="new-name" value=<?php echo $tournoi[2] ?> id="new-name">
                    </div>
                    <div>
                        <label for="new-date-debut">Date-Début</label>
                        <input name="new-date-debut" value=<?php echo $tournoi[3] ?> id="new-date-debut">
                    </div>
                    <div>
                        <label for="new-date-fin">Date-Fin</label>
                        <input name="new-date-fin" value=<?php echo $tournoi[4] ?> id="new-date-fin">
                    </div>
                    <div>
                        <label for="new-nb-equipe">Nombres Equipes</label>
                        <input name="new-nb-equipe" value=<?php echo $tournoi[5] ?> id="new-nb-equipe">
                    </div>
                    <div>
                        <label for="new-etape">Etape</label>
                        <input name="new-etape" value=<?php echo $tournoi[6] ?> id="new-etape">
                    </div>

                    <button>Valider</button>
                </form>
                    <!-- input select  -->

            </div>
            <h2 class="title">Equipes Inscrites</h2>
            <?php   
            foreach($equipes as $equipe):
            ?> 
            <h3>
                <?php echo($equipe['Nom']) ?>
            </h3>    
            <?php
            endforeach;
            ?>
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