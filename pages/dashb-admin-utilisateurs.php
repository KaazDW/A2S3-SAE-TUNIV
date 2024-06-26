<?php 
    if (empty($_SESSION["type"])) {
        $_SESSION["type"] = false;
    }

    if ($_SESSION["type"]!="administrateur") {
        header("Location: /index");
    }

    $sql = "SELECT * FROM Utilisateurs;";
    $listeUtilisateurs = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
    <!-- <link href="../assets/css/style.css" rel="stylesheet"> -->
</head> 
<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-dashboard user-dash-main">
        <h2 class="title">Utilisateurs</h2>
        <?php 
            if (!empty($_SESSION["userErreur"])){
                echo("<div>" . $_SESSION["userErreur"] . "</div>");
                unset($_SESSION["userErreur"]);
            }
        ?>
        <section class="dashadmin-section users-resp">
            <div class="dashadmin-topmid">
                <div class="display-tournaments dashadmin-card">
                    <?php $utilisateurs = $listeUtilisateurs->fetchAll();
                        foreach($utilisateurs as $utilisateur):
                    ?>
                    <div class="tournois-line-user">
                        <span><?php echo(htmlspecialchars($utilisateur['Prenom'])) ?></span>
                        <span><?php echo(htmlspecialchars($utilisateur['Nom'])) ?></span>
                        <span><?php if ($utilisateur['Type_user']==0) {echo('Administrateur');}
                                    else if ($utilisateur['Type_user']==1) {echo('Arbitre');}
                                    else {echo('Capitaine');}
                                ?></span>
                        <span><?php echo(htmlspecialchars($utilisateur['Email'])) ?></span>
                        <div>
                            <a class="edit" href="dashb-admin-editform-user?id=<?= $utilisateur['ID_User'] ?>">
                                <img  alt="" src="../assets/img/edit-blanc.png">
                            </a>
                            <a class="edit" href="/config-suppr-user?id=<?= $utilisateur['ID_User'] ?>">
                                <img  alt="" src="../assets/img/delete-blanc.png">
                            </a>
                            <a class="password" href="/config-reset-password?id=<?=$utilisateur['ID_User']?>">
                                <img  alt="" src="../assets/img/password.png">
                            </a>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    ?>
                </div>
                <div class="init-tourn dashadmin-card">
                    <h3>Utilisateur</h3>
                    <a id="tcreate">
                        <img  alt="" src="../assets/img/create.png">
                    </a>
                </div>
                <div id="tcreationmenu">
                    <header>
                        <a id="creationmenuclose">
                            <img  alt="" src="../assets/img/cross.png">
                        </a>
                    </header>
                    <h3>Créer un nouvel utilisateur</h3>
                    <form method="POST">
                        <div class="form">
                            <label for="name">Nom</label>
                            <input name="name" type="text" id="name" maxlength=25 required="required">

                            <label for="surname">Prénom</label>
                            <input name="surname" type="text" id="surname" maxlength=25 required="required">

                            <label for="login">Identifiant</label>
                            <input name="login" type="text" id="login" maxlength=25 required="required">

                            <label for="password">Mot de passe</label>
                            <input name="password" type="password" id="password" maxlength=25 required="required">

                            <label for="passwordConfirm">Confirmer le mot de passe</label>
                            <input name="passwordConfirm" type="password" id="passwordConfirm" maxlength=25 required="required">

                            <label for="email">Email</label>
                            <input name="email" type="email" id="email" maxlength=50 required="required">

                            <label for='role'>Choisir un role</label>
                            <select name='role' id='role' >;
                                <option value="0">Administrateur</option>
                                <option value="1">Capitaine</option>
                                <option value="2">Arbitre</option>
                            </select>
                        </div>
                        <div class="form-button">
                            <button type="submit">Créer l'utilisateur</button>
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