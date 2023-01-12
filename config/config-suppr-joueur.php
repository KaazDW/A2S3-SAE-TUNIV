<?php session_start();

if ($_SESSION["type"]!="capitaine") {
    header("Location: ../index.php");
}

    include 'db.php';

 
        $suppr = $pdo->prepare('DELETE from Joueur where ID_Joueur = :varId');

        
        $suppr->execute(
            [

                'varId' =>$_GET["id"],
            ]
            );
        

            header("Location: ../pages/dashb-cap.php");
        
        
?>