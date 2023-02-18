<?php if ($_SESSION["type"]!="administrateur") {
    header("Location: ../index.php");
}

$setNull = $pdo->prepare('UPDATE Equipe SET ID_Capitaine=1 WHERE ID_Capitaine = :varId');
$setNull->execute(['varId'=> $_GET["id"]]);

$suppr = $pdo->prepare('DELETE from Utilisateurs where ID_User = :varId');
$suppr->execute(['varId' => $_GET["id"]]);
        
header("Location: /../pages/dashb-admin-utilisateurs.php");