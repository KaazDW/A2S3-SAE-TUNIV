<?php session_start();
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if (!$_SESSION["type"]=="administrateur") {
    header("Location: ../../index.php");
}

include '../../config/db.php';

$sql = "SELECT * FROM Annonces ORDER BY ID_Annonce DESC LIMIT 30;";
$listeAnnonces = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../../modules/head.php'; ?>
    <link href="../../assets/css/style.css" rel="stylesheet">
</head> 
<body>
        <?php include '../../modules/header.php';?>

    <main class="main-admin-annonce-form">
        <h2 class="title">Créer une nouvelle annonce</h2>
        <section>
            <form action="../../config/config-annonce.php" method="POST" enctype="multipart/form-data">
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
                            <textarea placeholder="255 caractères maximum" name="content" id="content" cols="30" rows="8" maxlength="255"></textarea>
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

            <div class=bloc-annonce>
                <h3><?php echo($annonce['Titre'])?></h3>
                <img src=<?php if($annonce['Image']!=NULL) {echo("../../" . $annonce['Image']);} else {echo("../../assets/img/pp-blanc.png");}?> alt="logo de l'annonce" >
                <div class=date-annonce><?php echo($annonce['Date_annonce']) ?></div>
                <div class=auteur-role-annonce><?php echo($annonce['Auteur']) ?>, <?php echo($annonce['Role'])?></div>
                <div class=contenu-annonce><?php echo($annonce['Contenu'])?></div>
                <a class="edit" href="../../config/config-suppr-annonce.php?id=<?php echo($annonce['ID_Annonce']) ?>"><img src='../../assets/img/delete-blanc.png' alt='logo suppression'></a>
            </div>

            <?php endforeach;?>
        </section>

    </main>
    <?php include '../../modules/footer.php'; ?>
</body>
</html>