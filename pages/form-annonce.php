<?php session_start();
    if (empty($_SESSION["loggedIn"])) {
        $_SESSION["loggedIn"] = false;
    }

    if ($_SESSION["type"]!="administrateur") {
        header("Location: ../index.php");
    }

    include '../config/db.php';

    // $sql = "SELECT Titre, Date_annonce, Auteur, Role, Contenu, Image FROM Annonces ORDER BY ID_Annonce DESC LIMIT 30;";
    $sql = "SELECT * FROM Annonces ORDER BY ID_Annonce DESC LIMIT 30;";
    $listeAnnonces = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
</head> 
<body>
    <?php include '../modules/header.php';?>
    <main class="main-admin-annonce-form">
        <h2 class="title">Créer une nouvelle annonce</h2>
        <?php 
        if (!empty($_SESSION["annonceErreur"])){
            echo("<div>" . $_SESSION["annonceErreur"] . "</div>");
            unset($_SESSION["annonceErreur"]);
        }
        ?>
        <section class="form-annonce-section">
            <form action="../config/config-annonce.php" method="POST" enctype="multipart/form-data">
                    <!-- Champ titre -->
                    <div class="form">
                        <div class="form-parta">
                            <label for="title">Titre de l'annonce</label>
                            <input name="title" type="text" id="title" required="required">

                            <!-- Champ auteur -->
                            <label for="author">Auteur de l'annonce</label>
                            <input name="author" type="text" id="author" required="required">

                            <!-- Champ rôle -->
                            <label for="role">Rôle de l'auteur</label>
                            <input name="role" type="text" id="role" required="required">
                            
                            <!-- Champ image -->
                            <label for="img">Image de l'annonce</label>
                            <input name="img" type="file" id="img" accept="image/png, image/jpeg, image/avif" id="img">
                        </div>

                        <!-- Champ contenu -->
                        <div class="textarea">
                            <label for="content">Contenu de l'annonce</label>
                            <textarea placeholder="400 caractères maximum" name="content" id="content" cols="30" rows="8" maxlength="400"></textarea>
                        </div>
                    </div>
                    <div class="form-button">
                        <button type="submit">Créer l'annonce</button>
                    </div>            
            </form>
            <?php if (!empty($_SESSION["annonceErreur"])) {
                echo ("<p>$_SESSION[annonceErreur]</p>");
                unset($_SESSION["annonceErreur"]);
            } ?>
        </section>

        <h2 class="title">Supprimer une annonce</h2>
        <section class="index-actu">
            <h2>Annonces</h2>

            <?php $annonces = $listeAnnonces->fetchAll();
            foreach($annonces as $annonce):?>

            <div class="annonce-card-admin">
                <img class="img-cover" src=<?php if($annonce['Image']!=NULL) {echo("../../" . $annonce['Image']);} else {echo("../../assets/img/annonce.png");}?> alt="logo de l'annonce" >
                <div class="text-field">
                    <h3><?php echo($annonce['Titre'])?></h3>
                    <p class="date"><?php echo($annonce['Date_annonce']) ?></p>
                    <p><?php echo($annonce['Auteur']) ?>, <span class="role"><?php echo($annonce['Role'])?></span></p>
                    <p><?php echo($annonce['Contenu'])?></p>
                </div>
                <a class="edit" href="../config/config-suppr-annonce.php?id=<?php echo($annonce['ID_Annonce']) ?>">
                    <img src='../assets/img/delete-blanc.png' alt='logo suppression'>
                </a>
            </div>

            <?php endforeach;?>
        </section>
    </main>
    <?php include '../modules/footer.php'; ?>
</body>
</html>