<?php session_start();

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../index.php");
}

    include 'db.php';
    
 
        $suppr = $pdo->prepare('DELETE from Joueur where ID_Joueur = :varId');

        
        $suppr->execute(
            [

                'varId' =>$_GET["id"],
            ]
            );
        

            header("Location: ../pages/dashb-admin-editform-equipe.php?id=" . $_GET["id2"]);
          
        
        
?>