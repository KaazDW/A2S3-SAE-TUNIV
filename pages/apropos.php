<?php session_start();
    if (empty($_SESSION["loggedIn"])) {
        $_SESSION["loggedIn"] = false;
    }

    include '../config/db.php';

    $sql = $pdo->prepare("SELECT COUNT(DISTINCT ID_Tournoi) FROM Tournoi;");
    $sql->execute();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
</head>
<body>
    <?php include '../modules/header.php'; ?>
    <main class="main-apropos">
        <h2 class="title">A propos</h2>
        <section class="apropos-content">
            <div class="apropos-title">
                <h1>T</h1>
                <h1>U</h1>
                <h1>N</h1>
                <h1>I</h1>
                <h1>V</h1>
                <h1>.</h1>
            </div>    
        <!-- <h1>TUNIV.</h1> -->
            <p>TUNIV est une application WEB développée par 3 étudiants dans le cadre de leur deuxième année de BUT informatique :</p>
            <div class="card">
                <div class="apropos-personnalcard">
                    <img src="../assets/img/account.png">
                    <a href="" target="_blank">Gael JOURNET</a>
                </div>
                <div class="apropos-personnalcard">
                    <img src="../assets/img/account.png">
                    <a href="http://github.com/kaazdw" target="_blank">Jean-François MARCOURT</a>
                </div>
                <div class="apropos-personnalcard">
                    <img src="../assets/img/account.png">
                    <a href="https://www.linkedin.com/in/nathan-ozimek/" target="_blank">Nathan Ozimek</a>
                </div>
            </div>
            <p>L'objectif de l'application est de centraliser les différents tournois sportifs universitaires à l'aide d'un outil développé par des étudiants, pour des étudiants.</p>
            <p>Tuniv a déjà hébergé <span><?php echo($sql->fetch()[0]);?></span> tournois depuis son déployement le <span>00.00.2022</span>.</p>
            <div class="navcompa">
                <p>Tuniv est une web app développée pour être compatible avec les dernières versions des navigateurs en date :</p>
                <div class="table">
                    <span>Navigateur</span>
                    <span>Version</span>
                    <span class="name">OpéraGX</span>
                    <span class="version">LVL 4 (core: 93.0.4585.72)</span>
                    <span class="name">Firefox</span>
                    <span class="version">108.0.1</span>
                    <span class="name">Chrome</span>
                    <span class="version">Version 108.0.5359.125</span>
                    <span class="name">Safari</span>
                    <span class="version">N/A</span>
                </div>
            </div>
        </section>
    </main> 
    <?php include '../modules/footer.php'; ?>
</body>
</html>