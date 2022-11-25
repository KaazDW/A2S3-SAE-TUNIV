<?php session_start();
if (empty($_SESSION["admin"])) {
    $_SESSION["admin"] = false;
}

if ($_SESSION["admin"]) {

}else{
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include '../modules/head.php'; ?>
</head>

<body>
        <?php include '../modules/header.php'; ?>
        <?php 
if ($_SESSION["admin"]) {
    echo (" 
    <section class='admin-header'>
                <ul>
                    <li><a href=''>DASHBOARD</a></li>|
                    <li><a href=''>STATISTIQUES</a></li>|
                    <li><a href=''>MATCH</a></li>
                </ul>
            </section>

    ");
} else {
    echo ("");
} 
?>
    <main class="main-informations">
        <h2 class="title">Statistiques</h2>
        <section class="stats-section">
            <?php include '../config/settings.php'; ?>
            <div class="file-counter">
                <h3>Nombre de fichier</h3>
                <div>
                    <p>PHP :</p>
                    <span><?php echo count_files('../','php',1); ?></span>
                    <p>CSS :</p>
                    <span><?php echo count_files('../','css',1); ?></span>
                    <p>IMG :</p>
                    <span><?php echo count_files('../','png',1) + count_files('../','jpg',1); ?></span>
                    <p>MD :</p>
                    <span><?php echo count_files('../','md',1); ?></span>
                    <p>DB :</p>
                    <span><?php echo count_files('../','db',1); ?></span>
                    <p>JS :</p>
                    <span><?php echo count_files('../','js',1); ?></span>
                </div>
                <p>Total : <?php echo $totalfile;?></p>
            </div>
            <div></div>
            <div></div>
        </section>
    </main>


    <footer>
        <!-- <h3>footer</h5> -->
        <a href="">©TUNIV</a>
    </footer>
    <script src="/app.js"></script>
</body>

</html>