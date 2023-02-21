<?php if ($_SESSION["type"]!="capitaine") {
    header("Location: /index");
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

            header("Location: /dashb-cap");
