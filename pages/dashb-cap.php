<?php
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if ($_SESSION["type"] != "capitaine") {
    header("Location: /index");
}

$sql = "SELECT * FROM Tournoi;";
$listeTournois = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include '../modules/head.php'; ?>
    <!-- <link href="../assets/css/style.css" rel="stylesheet"> -->
</head>

<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-dashcap">
        <h2 class="title">Affichage de l'équipe</h2>
        <section class="dashcap-section">
            <div class="nomequipe">
                <h3>Nom de l'équipe : </h3>
                <p>
                    <?php
                    $listematch = $pdo->prepare('SELECT Nom, ID_Equipe from Equipe where ID_Capitaine=:varId;');
                    $listematch->execute(['varId' => $_SESSION["userId"],]);
                    $equipe = $listematch->fetch();
                    $_SESSION["actuel"] = $equipe[1];
                    ?>
                <form action="/config-cap-edit-team" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="new-name-team"></label>
                        <input name="new-name-team" type='text' value="<?php echo $equipe[0] ?>" id="new-name-team" required="required">
                    </div>
                    <button type='submit'>Valider</button>
                </form>
                </p>
            </div>

            <section class="joueurs-liste-section">
                <div class="joueurs-liste-div">
                    <div class="joueur-line title">
                        <span>Prénom</span>
                        <span>Nom</span>
                    </div>
                    <?php
                    $listejoueur = $pdo->prepare('SELECT Joueur.Prenom, Joueur.Nom, Joueur.ID_Joueur from Joueur inner join Equipe on Joueur.ID_Equipe=Equipe.ID_Equipe where Equipe.ID_Capitaine=:varId;');
                    $listejoueur->execute(['varId' => $_SESSION["userId"],]);
                    $joueurs = $listejoueur->fetchAll();
                    foreach ($joueurs as $joueur) :
                    ?>

                        <div class="joueur-line">
                            <span><?php echo htmlspecialchars($joueur['Prenom']) ?></span>
                            <span><?php echo htmlspecialchars($joueur['Nom']) ?></span>
                            <div>
                                <a class="edit" href="/dashb-cap-edit?id=<?= $joueur['ID_Joueur'] ?>"><img src="/assets/img/edit-blanc.png"></a>
                                <a class="edit" href="/config-suppr-joueur?id=<?= $joueur['ID_Joueur'] ?>"><img src="/assets/img/delete-blanc.png"></a>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
                <div class="ajout-joueurs">
                    <form action="/config-add-joueur" method="POST" enctype="multipart/form-data">
                        <h3>Ajouter un Joueur</h3>
                        <div>
                            <label for="new-surname2">Prénom</label>
                            <input name="new-surname2" type='text' id="new-surname2" required="required">
                        </div>
                        <div>
                            <label for="new-name2">Nom</label>
                            <input name="new-name2" type='text' id="new-name2" required="required">
                        </div>
                        <button type='submit'>Valider</button>
                    </form>
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