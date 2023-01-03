<?php session_start();
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../index.php");
}

include '../config/db.php';

$listetournoi = $pdo->prepare('SELECT * FROM Tournoi where ID_Tournoi =:varId');

$listetournoi->execute(
    [
        'varId' =>$_GET["id"],
    ]
    );
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
    <link href="../assets/css/style.css" rel="stylesheet">
</head> 
<body>
    <?php include '../modules/header.php';?>
    <main class="main-editform-dashbadmin">
        <h2 class="title">Edit form</h2>
        <section class="edit-form-section">
        <?php $tournois = $listetournoi->fetchAll();
            foreach($tournois as $tournoi):
        ?>
        
        <form action="../config/config-editform.php?id=<?= $tournoi['ID_Tournoi'] ?>" method="POST" enctype="multipart/form-data">
                <!-- Champ Sport -->
                <label for="sport">Sport</label>
                <input name="sport" type="text" id="sport" value="<?php echo($tournoi['Sport']) ?>" required="required">

                <!-- Nom Tournoi -->
                <label for="nom">Nom Tournoi</label>
                <input name="nom" type="text" id="nom" value="<?php echo($tournoi['Nom']) ?>"required="required">

                <!-- Date début -->
                <label for="date-debut">Date Debut</label>
                <input name="date-debut" type="text" id="date-debut" value="<?php echo($tournoi['DateDebut']) ?>" required="required" placeholder="AAAA-MM-JJ HH:MM:SS>

                <!-- Date fin -->
                <label for="date-fin">Date Fin</label>
                <input name="date-fin" type="text" id="date-fin" value="<?php echo($tournoi['DateFin']) ?>" required="required" placeholder="AAAA-MM-JJ HH:MM:SS">


                <button type="submit">Modifier</button>
        </form>
        

        <?php
        endforeach;
        ?>

        </section>
    </main>
    <?php include '../modules/footer.php'; ?>
</body>
</html>