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
        <?php include '../../modules/header.php'; ?>
    <main class="main-informations">
        <h2 class="title">Annonce Pannel</h2>
        <section class="stats-section">

        </section>
    </main>
    <?php include '../../modules/footer.php'; ?>
</body>
</html>