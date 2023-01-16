<?php session_start();

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../index.php");
}

include 'db.php';

 
$suppr = $pdo->prepare('DELETE from Utilisateurs where ID_User = :varId');

        
$suppr->execute(['varId' =>$_GET["id"],]);
        

header("Location: /../pages/dashb-admin-utilisateurs.php");
        
        
?>