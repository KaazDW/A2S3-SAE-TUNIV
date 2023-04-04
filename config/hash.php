<?php 

$sql = "SELECT ID_User, Mot_de_passe FROM Utilisateurs;";
$users = $pdo->query($sql);
$users = $users->fetchAll();

foreach($users as $user){
    set_time_limit(100);
    $id = $user["ID_User"];
    $mdp = $user["Mot_de_passe"];
    $mdpHash = password_hash($mdp,PASSWORD_BCRYPT);
    $maj = $pdo->prepare("UPDATE Utilisateurs SET Mot_de_passe=:varHash WHERE ID_User=:varId");
    $maj->execute(['varHash' => $mdpHash, 'varId' => $id]);
}

header("Location: /index");