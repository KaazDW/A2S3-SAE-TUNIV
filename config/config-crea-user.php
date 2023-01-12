<?php session_start();

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../../index.php");
}

include("db.php");

if (!empty($_SESSION["userErreur"])) {
    unset($_SESSION["userErreur"]);
}

if (empty($_POST["name"])){
    $_SESSION["userErreur"] = "Nom de l'utilisateur manquant";
    header("Location: ../pages/dashb-admin-utilisateurs.php");
}
$name = $pdo->quote($_POST["name"]);

if (empty($_POST["surname"])){
    $_SESSION["userErreur"] = "Prénom de l'utilisateur manquant";
    header("Location: ../pages/dashb-admin-utilisateurs.php");
}
$surname = $pdo->quote($_POST["surname"]);

if (empty($_POST["login"])){
    $_SESSION["userErreur"] = "Identifiant de l'utilisateur manquant";
    header("Location: ../pages/dashb-admin-utilisateurs.php");
}
$login = $pdo->quote($_POST["login"]);

if (empty($_POST["password"])){
    $_SESSION["userErreur"] = "Nom de l'utilisateur manquant";
    header("Location: ../pages/dashb-admin-utilisateurs.php");
}
$password = $pdo->quote($_POST["password"]);

if (empty($_POST["email"])){
    $_SESSION["userErreur"] = "Email de l'utilisateur manquant";
    header("Location: ../pages/dashb-admin-utilisateurs.php");
}
$email = $pdo->quote($_POST["email"]);

if (empty($_POST["role"])){
    $_SESSION["userErreur"] = "Rôle de l'utilisateur manquant";
    header("Location: ../pages/dashb-admin-utilisateurs.php");
}
$role = $pdo->quote($_POST["role"]);

$sql = "INSERT INTO Utilisateurs VALUES (0, $login, $password, $name, $surname, $email, $role);";
$res = $pdo->exec($sql);
if (!$res) {
    $_SESSION["userErreur"] = "La création de l'utilisateur a échoué, veuillez réessayer. Si l\'erreur persiste, contactez le support.";
    header("Location: ../pages/dashb-admin-utilisateurs.php");
} else {
    header("Location: ../pages/dashb-admin-utilisateurs.php");
}