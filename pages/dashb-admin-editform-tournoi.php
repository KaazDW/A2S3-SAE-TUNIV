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
    <main class="main-edit-tournois">
        <h2 class="title">Modifier le tournoi</h2>
        <section class="dashcap-section">
            <div class="ajout-joueurs">
                <pre>
                <?php
                $listetournoi = $pdo->prepare('SELECT *  FROM Tournoi where ID_Tournoi =:varId');


                $listetournoi->execute(
                    [

                        'varId' => $_GET["id"],
                    ]
                );
                $tournoi = $listetournoi->fetch();

                ?>
                </pre>
                <h3>Modifier un tournoi</h3>
                <form action="../config/config-editform-tournoi.php?id=<?php echo ($_GET["id"]) ?>" method="POST" enctype="multipart/form-data">
                    <label for="new-sport">Sport</label>
                    <input name="new-sport" value="<?php echo $tournoi['Sport'] ?>" id="new-sport">
                    <label for="new-name">Nom</label>
                    <input name="new-name" value="<?php echo $tournoi['Nom'] ?>" id="new-name">
                    <label for="new-date-debut">Date-Début</label>
                    <input name="new-date-debut" value="<?php echo $tournoi['DateDebut'] ?>" id="new-date-debut">
                    <label for="new-date-fin">Date-Fin</label>
                    <input name="new-date-fin" value="<?php echo $tournoi['DateFin'] ?>" id="new-date-fin">
                    <label for="new-nb-equipe">Nombres Equipes</label>
                    <input name="new-nb-equipe" value="<?php echo $tournoi['Nb_Equipe'] ?>" id="new-nb-equipe">
                    <label for="new-etape">Etape</label>
                    <input name="new-etape" value="<?php echo $tournoi['Etape'] ?>" id="new-etape">
                    <span></span>
                    <button>Valider</button>
                </form>
            </div>
            <div class="equinscr">
                <h2 class="title">Equipes Inscrites</h2>
                <?php   
                foreach($equipes as $equipe):
                ?> 
                <p>
                    <?php echo($equipe['Nom']) ?>
                </p>    
                <?php
                endforeach;
                ?>
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