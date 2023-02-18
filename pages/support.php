<?php session_start();
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
        <h2 class="title">Support</h2>
        <section class="support-content">
            
        </section>
    </main> 
    <?php include '../modules/footer.php'; ?>
</body>
</html>