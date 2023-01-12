<?php session_start();

if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if ($_SESSION["type"]!="capitaine") {
    header("Location: ../index.php");
}

    include 'db.php';

        $prenom = $_POST["new-surname"];
        $nom = $_POST["new-name"];

        $edit = $pdo->prepare('UPDATE Joueur  set Prenom=:varprenom, Nom=:varnom where ID_Joueur = :varId');

        
        $edit->execute(
            [
                'varprenom'=>$prenom,
                'varnom'=>$nom,
                'varId' =>$_GET["id"],
            ]
            );
        

            header("Location: ../pages/dashb-cap.php");  
        
?>