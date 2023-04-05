<?php
if ($_SESSION["type"]!="administrateur") {
    header("Location: /index");
} else {
    $nouveau_mdp = password_hash("12345678",PASSWORD_BCRYPT);
    $reset = $pdo->prepare("UPDATE Utilisateurs SET Mot_de_passe=:mdp WHERE ID_User=:varId;");
    $reset->execute(['mdp' => $nouveau_mdp, 'varId' => $_GET["id"]]);
    header("Location: /dashb-admin-utilisateurs");
}