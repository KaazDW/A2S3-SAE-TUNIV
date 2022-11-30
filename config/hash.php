<?php 

/* Script de chiffrement des mot de passes
$sql = "SELECT password FROM users;";
$listeMdp = $pdo->query($sql);
$compteur = 0;

foreach ($listeMdp as $mdp) {
    set_time_limit(100);
    $mdp = $listeMdp->fetch()[0];
    $mdpHash = $pdo->quote(password_hash($mdp, PASSWORD_BCRYPT));
    $sql = "UPDATE TABLE users SET password=$mdpHash WHERE id=$compteur;";
    $pdo->exec($sql);
    $compteur++;
}
*/  