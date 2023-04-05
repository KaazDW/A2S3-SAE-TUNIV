<?php
if ($_SESSION["type"] != "capitaine") {
    header("Location: /index");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php 
        include '../modules/head.php';
        include '../modules/header.php';
        include '../config/db.php'; 
    ?>
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
    <main class="main-editpass">
        <h2 class="title">Gestion du Mot de Passe</h2>
        <section class="edit-password-cap-section">
            <h3>Modifiez votre mots de passe</h3>
            <p>Pour des questions de sécurité ou suite à une réinitialisation de votre mot de passe</p>
            <form>
                <input name="oldpass" placeholder="Ancien Mot de Passe">    
                <input name="newpass" placeholder="Nouveau Mot de Passe">
                <input name="confirmnewpass" placeholder="Confirmer le nouveau Mot de Passe">
                <button>Valider</button>
            </form>
        </section>
    </main>
    <?php include '../modules/footer.php'; ?>
</body>

</html>