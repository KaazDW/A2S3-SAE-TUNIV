<?php $sql = "SELECT * FROM Annonces ORDER BY ID_Annonce DESC LIMIT 30;";
$listeAnnonces = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'modules/head.php'; ?>
</head>
<body>
    <?php include 'modules/header.php'; ?>
    <main>
        <section class="main-home">
            <section class="main-content">
                <h1>TUNIV.</h1>
                <a href="/tournois">Accéder aux tournois</a>
            </section>
        </section>
        <section class="index-actu">
            <h2>Actualités</h2>
            <?php $annonces = $listeAnnonces->fetchAll();
            foreach($annonces as $annonce):?>
                <div class="annonce-card">
                    <img src=<?php if($annonce['Image']!=NULL) {echo($annonce['Image']);} else {echo("assets/img/annonce.png");}?> alt="logo de l'annonce" >
                    <div class="text-field">
                        <h3><?php echo(htmlspecialchars($annonce['Titre'])) ?></h3>
                        <p class="date"><?php echo(htmlspecialchars($annonce['Date_annonce'])) ?></p>
                        <p><?php echo(htmlspecialchars($annonce['Auteur'])) ?>, <span class="role"><?php echo(htmlspecialchars($annonce['Role'])) ?></span></p>
                        <p><?php echo(htmlspecialchars($annonce['Contenu'])) ?></p>
                    </div>
                </div>
            <?php endforeach;?> 
        </section>
    </main>
    <?php include 'modules/footer.php'; ?>
</body>
</html>