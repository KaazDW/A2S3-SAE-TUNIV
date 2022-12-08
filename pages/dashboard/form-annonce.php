<?php session_start();
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if (!$_SESSION["type"]=="administrateur") {
    header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../../modules/head.php'; ?>
    <link href="../../assets/css/style.css" rel="stylesheet">
</head> 
<body>
        <?php include '../../modules/header.php';?>

    <main class="main-informations">
        <h2 class="title">Créer une annonce</h2>
        <section class="stats-section">

        <form action="../../config/config-annonce.php" method="POST" enctype="multipart/form-data">
                <!-- Champ titre -->
                <label for="title">Titre de l'annonce</label>
                <input name="title" type="text" id="title" required="required">
                <br>

                <!-- Champ auteur -->
                <label for="author">Auteur de l'annonce</label>
                <input name="author" type="text" id="author" required="required">
                <br>

                <!-- Champ rôle -->
                <label for="role">Rôle de l'auteur</label>
                <input name="role" type="text" id="role" required="required">
                <br>

                <!-- Champ contenu -->
                <label for="content">Contenu de l'annonce</label>
                <textarea placeholder="255 caractères maximum" name="content" id="content" cols="30" rows="8" maxlength="255"></textarea>
                <br>

                <!-- Champ image -->
                <label for="img">Image de l'annonce</label>
                <input name="img" type="file" id="img" accept="image/png, image/jpeg, image/avif" id="img">

                <button type="submit">Créer l'annonce</button>
        </form>

        <?php if (!empty($_SESSION["annonceErreur"])) {
            echo ("<p>$_SESSION[annonceErreur]</p>");
            unset($_SESSION["annonceErreur"]);
        } ?>

        </section>
    </main>
    <?php include '../../modules/footer.php'; ?>
</body>
</html>