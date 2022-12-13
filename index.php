<?php session_start();

include 'config/db.php';

$sql = "SELECT * FROM Annonces LIMIT 30;";
$listeAnnonces = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include 'modules/head.php'; ?>
</head>

<body>
        <?php include 'modules/header.php'; ?>
    <main class="main-home">
        <section class="main-content">
            <h1>TUNIV.</h1>
            <a href="/pages/tournois.php">Accéder aux tournois</a>
        </section>

        <section class="index-actu">
            <h2>Annonces</h2>

            <?php $annonces = $listeAnnonces->fetchAll();
            foreach($annonces as $annonce):?>

            <div class=bloc-annonce>
                <h3><?php echo($annonce['Titre'])?></h3>
                <img src=<?php if($annonce['Image']!=NULL) {echo($annonce['Image']);} else {echo("assets/img/pp-blanc.png");}?> alt="logo de l'annonce" >
                <div class=date-annonce><?php echo($annonce['Date_annonce']) ?></div>
                <div class=auteur-role-annonce><?php echo($annonce['Auteur']) ?>, <?php echo($annonce['Role'])?></div>
                <div class=contenu-annonce><?php echo($annonce['Contenu'])?></div>
            </div>

            <?php endforeach;?>
        </section>

            

    </main>
    <?php include 'modules/footer.php'; ?>
</body>
</html>