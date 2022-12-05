<?php session_start(); ?>
<?php include_once '../config/db.php';?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include '../modules/head.php'; ?>
</head>

<body>
        <?php include '../modules/header.php'; ?>
    <main class="main-home">
        <section class="main-content">
            <h1><?php 
            

            $listematch = $pdo->prepare('SELECT * FROM MatchTournoi where ID_Tournoi =:varId');
            
            $listematch->execute(
                [
                    'varId' =>$_GET["id"],
                ]
                );
            $matchs=$listematch->fetchAll();
            
            
            
            
            
            
            ?>.</h1>
            <a href="/tournois.php">Accéder aux tournois</a>
        </section>
        <section class="index-actu">

        </section>
    </main>
    <?php include '../modules/footer.php'; ?>
</body>
</html>