<?php session_start();
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../index.php");
}

include '../config/db.php';

$listeEquipe = $pdo->prepare('SELECT * FROM Equipe where ID_Equipe =:varId');

$listeEquipe->execute(['varId' =>$_GET["id"]]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
    <link href="../assets/css/style.css" rel="stylesheet">
</head> 
<body>
    <?php include '../modules/header.php';?>
    <main class="main-dashcap">
        <h2 class="title">Affichage de l'équipe</h2>
        <section class="dashcap-section">
            <div class="nomequipe">
                <h3>Nom de l'équipe : </h3>
                <p>
                <?php  
                    $noms = $pdo->prepare('SELECT Nom from Equipe where ID_Equipe=:varId;');
                    $noms->execute(['varId' =>$_GET["id"]]);
                    $equipe=$noms->fetch();
                    echo $equipe[0]
                ?></p>
            </div>
            
            <section class="joueurs-liste-section">
                <div class="joueurs-liste-div">
                    <div class="joueur-line title">
                        <span>Prénom</span>
                        <span>Nom</span>
                    </div>
                    <?php
                        $listejoueur = $pdo->prepare('SELECT Joueur.Prenom, Joueur.Nom from Joueur inner join Equipe on Joueur.ID_Equipe=Equipe.ID_Equipe where Equipe.ID_Equipe=:varId;');
                        $listejoueur->execute(['varId' =>$_GET["id"]]);
                        $joueurs=$listejoueur->fetchAll();
                        foreach($joueurs as $joueur):    
                    ?>

                    
                    <div class="joueur-line">
                        <span><?php echo($joueur['Prenom']) ?></span>
                        <span><?php echo($joueur['Nom']) ?></span>
                        <div>
                            <a onclick="openeditjoueurs()"><img src="/assets/img/edit-blanc.png"></a>
                            <a href=""><img src="/assets/img/delete-blanc.png"></a>
                        </div>
                    </div>

                    <?php
                    endforeach;
                    ?>
                </div>
                <div class="ajout-joueurs">
                    <form action="../config/config-add-joueur-admin.php?id=<?php echo ($_GET["id"])?>&new-surname=<?php  ?>">
                        <h3>Ajouter un joueur</h3>
                        <div>
                            <label for="new-surname">Prénom</label>
                            <input name="new-surname" id="new-surname">
                        </div>
                        <div>
                            <label for="new-name">Nom</label>
                            <input name="new-name" id="new-name">
                        </div>
                        <button>Valider</button>
                    </form>
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

        function openeditjoueurs(){
            document.getElementById('joueur-edit').style.display = "block";  
        }

        function closeeditjoueurs(){
            document.getElementById('joueur-edit').style.display = "none";
        }
        document.getElementById('closebtneditjoueurs').addEventListener("click", function(){
            document.getElementById('joueur-edit').style.display = "none";
        });

    </script>
</body>
</html>