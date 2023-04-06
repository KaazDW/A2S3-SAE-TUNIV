<?php
if ($_SESSION["loggedIn"] != true) {
    header("Location: /index");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php 
        include '../modules/head.php';
        include '../modules/header.php';
    ?>
</head>
<body>
    <main class="main-editpass">
        <h2 class="title">Gestion du mot de passe</h2>
        <?php if (isset($_SESSION["passwordMessage"])){
                echo ($_SESSION["passwordMessage"]);
                unset($_SESSION["passwordMessage"]);
            }
        ?>
        <section class="edit-password-cap-section">
            <h3>Modifier votre mot de passe</h3>
            <p>Pour des questions de sécurité ou suite à une réinitialisation de votre mot de passe</p>
            <form method="POST" enctype="multipart/form-data">
                <input name="oldpass" placeholder="Ancien mot de passe">    
                <input name="newpass" placeholder="Nouveau mot de passe">
                <input name="confirmnewpass" placeholder="Confirmez le nouveau mot de passe">
                <button type="submit">Valider</button>
            </form>
        </section>
    </main>
    <?php include '../modules/footer.php'; ?>
</body>

</html>