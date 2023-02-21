<?php
    if (empty($_SESSION["loggedIn"])) {
        $_SESSION["loggedIn"] = false;
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
</head>
<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-support">
        <h2 class="title">Contactez le support</h2>
        <section class="support-content">
            <form method="POST" enctype="multipart/form-data"> <!-- reste à faire l'action="traitement-support.php" dans le router (jf)-->
                <div>
                    <label for="screenshot" class="form-label">Joindre une capture d'écran</label>
                    <input type="file" id="screenshot" name="screenshot" />
                </div>
                <button type="submit">Envoyer</button>
            </form>
        </section>
    </main> 
    <?php include '../modules/footer.php'; ?>
</body>
</html>