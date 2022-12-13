<?php session_start();
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if (!$_SESSION["type"]=="administrateur") {
    header("Location: ../../index.php");
}



include '../../config/db.php';

$sql = "SELECT * FROM Tournoi;";
$listeTournois = $pdo->query($sql);




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
        <h2 class="title"><?php  
            $listematch = $pdo->prepare('SELECT Nom from Equipe where ID_Capitaine=:varId;');
            $listematch->execute(
                [
                    'varId' =>$_SESSION["userId"],
                ]
                );
            $equipe=$listematch->fetch();
            echo $equipe[0]
            ?></h2>
        <section class="stats-section">

            <div class="title-grid">
                <span>Prenom</span>
                <span>Nom</span>
            </div>
             
            <?php
                $listejoueur = $pdo->prepare('SELECT Joueur.Prenom, Joueur.Nom from Joueur inner join Equipe on Joueur.ID_Equipe=Equipe.ID_Equipe where Equipe.ID_Capitaine=:varId;');
                $listejoueur->execute(
                    [
                        'varId' =>$_SESSION["userId"],
                    ]
                    );
                $joueurs=$listejoueur->fetchAll();
                foreach($joueurs as $joueur):    
            ?>

            
            <a href="match-tournois.php" class="tournois-line">
                <span><?php echo($joueur['Prenom']) ?></span>
                <span><?php echo($joueur['Nom']) ?></span>
            </a>

            <?php
            endforeach;
            ?>
            


        </section>
    </main>
    <?php include '../../modules/footer.php'; ?>
</body>
</html>