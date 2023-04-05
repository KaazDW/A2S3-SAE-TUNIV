<?php 

$mdp_actuel = $pdo->prepare("SELECT Mot_de_passe FROM Utilisateurs WHERE ID_User=:varId;");
$mdp_actuel->execute(['varId' => $_SESSION["userId"]]);
$mdp_actuel = $mdp_actuel->fetch()[0];
if (!password_verify($_POST["oldpass"],$mdp_actuel)) {
    $_SESSION["passwordMessage"] = "L'ancien mot de passe que vous avez entré n'est pas le bon.";
    header("Location: /password");
} else if ($_POST["newpass"]!=$_POST["confirmnewpass"]) {
    $_SESSION["passwordMessage"] = "Le nouveau mot de passe et sa confirmation ne correspondent pas.";
    header("Location: /password");
}

$nouveau_mdp = password_hash($_POST["newpass"],PASSWORD_BCRYPT);

$changement = $pdo->prepare("UPDATE Utilisateurs SET Mot_de_passe=:Mdp WHERE ID_User=:varId;");
$changement->execute(['Mdp' => $nouveau_mdp, 'varId' => $_SESSION["userId"]]);

$_SESSION["passwordMessage"] = "Votre mot de passe a bien été modifié.";
header("Location: /password");