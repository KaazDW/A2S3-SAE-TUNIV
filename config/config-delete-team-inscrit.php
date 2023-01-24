<?php session_start();
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../index.php");
}

include '../config/db.php';



 
        $inscrit = $pdo->prepare('DELETE from Participer where ID_Equipe = :varId');

        
        $inscrit->execute(
            [

                'varId' =>$_GET["id"],
            ]
            );
        

             header("Location: ../pages/match-tournois.php");
        
        
?>