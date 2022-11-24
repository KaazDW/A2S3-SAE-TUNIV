<?php session_start();
if (empty($_SESSION["admin"])) {
    $_SESSION["admin"] = false;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include '../modules/head.php'; ?>
</head>

<body>
    <header>
        <?php include '../modules/header.php'; ?>
    </header>

    <main class="main-informations">
        <h2>A propos</h2>

    </main>


    <footer>
        <!-- <h3>footer</h5> -->
        <a href="">©TUNIV</a>
    </footer>
    <script src="/app.js"></script>
</body>

</html>