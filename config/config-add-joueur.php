<?php session_start();

if ($_SESSION["type"]!="capitaine") {
    header("Location: ../index.php");
}

    include 'db.php';

        $prenom = $_POST["new-surname2"];
        $nom = $_POST["new-name2"];
        $actuel = $_SESSION["actuel"];
        
        

 
        $add = $pdo->prepare('INSERT INTO Joueur  VALUES (0,:varprenom, :varnom, :varequipe);');

        
        $add->execute(
            [
                'varprenom'=>$prenom,
                'varnom'=>$nom,
                'varequipe'=>$actuel,
                
            ]
            );

            header("Location: ../pages/dashb-cap.php");
        
        
?>