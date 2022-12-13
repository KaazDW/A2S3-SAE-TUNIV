<?php session_start();

    include 'db.php';

 
        $suppr = $pdo->prepare('DELETE from Tournoi where ID_Tournoi = :varId');

        
        $suppr->execute(
            [

                'varId' =>$_GET["id"],
            ]
            );
        

            header("Location: /../pages/dashboard/dashb-admin.php");
        
        
?>