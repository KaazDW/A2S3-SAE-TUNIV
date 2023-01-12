
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
    <link href="../assets/css/style.css" rel="stylesheet">
    <?php include '../modules/header.php'; 
    include '../config/db.php';?>
</head> 
<body>
    <main class="main-editform-dashbadmin">
        <h2 class="title">Edit form</h2>
        <section class="edit-form-section">
        <?php  
            $player = $pdo->prepare('SELECT Nom, Prenom, ID_Joueur from Joueur where ID_Joueur=:varId;');
            $player->execute(
                                [
                                    'varId' => $_GET["id"],
                                ]
                                );
                            $play=$player->fetch();
                            
        ?>

    <section id="joueur-edit">
                        <div class="content">
                            <form action="../config/config-cap-edit-joueur.php?id=<?=$play[2]?>" method="POST" enctype="multipart/form-data">
                                    <div>
                                        <label for="new-surname">Prénom</label>
                                        <input name="new-surname" id="new-surname" value=<?php echo $play[1]; ?>>
                                    </div>
                                    <div>
                                        <label for="new-name">Nom</label>
                                        <input name="new-name" id="new-name" value=<?php echo $play[0]; ?>>
                                    </div>
                                    <div class="form-button">
                                    <button type="submit">Valider</button>
                                    </div>  
                                
                            </form>
                        </div>
    </section>

    <?php include '../modules/footer.php'; ?>

</body>
</html>

