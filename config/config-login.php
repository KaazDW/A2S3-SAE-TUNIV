<?php session_start();

if ($_SESSION["loggedIn"]) {

    header("Location: /index.php");

}



include '../config/db.php';



$login = $_POST["login"];
$password = $_POST["password"];
$statement = $pdo->prepare("SELECT count(*) FROM Utilisateurs WHERE Identifiant =:varLogin");
$statement->execute(
    // On exécute la requête préparée

    [
        'varLogin' => "$login"

    ]

);



$res = $statement->fetch();



if ($res[0] == 1) { // On vérifie qu'il existe un utilisateur avec l'identifiant donné

    $statement = $pdo->prepare("SELECT Mot_de_passe FROM Utilisateurs WHERE Identifiant=:varLogin");

    $statement->execute(
        [
            'varLogin' => "$login",
        ]

    );

    $res = $statement->fetch();

    if ($res[0] == $password) { // Si oui, on vérifie que le mot de passe donné correspond à celui de l'utilisateur
        $statement = $pdo->prepare("SELECT Type_user FROM Utilisateurs WHERE Identifiant=:varLogin");
        $statement->execute(
            [
                'varLogin' => "$login"

            ]

        );

        $type = $statement->fetch()[0];
        if ($type == 0) {
            $_SESSION["loggedIn"] = true;
            $statement = $pdo->prepare("SELECT ID_User FROM Utilisateurs WHERE Identifiant=:varLogin AND Mot_de_passe=:varPassword");
            $statement->execute(['varLogin' => "$login", 'varPassword' => "$password"]);
            $res = $statement->fetch();
            $_SESSION["userId"] = $res[0];
            $_SESSION["type"] = "administrateur";
            header("Location: /index.php");

        } else if ($type == 1) {

            $_SESSION["loggedIn"] = true;
            $statement = $pdo->prepare("SELECT ID_User FROM Utilisateurs WHERE Identifiant=:varLogin AND Mot_de_passe=:varPassword");
            $statement->execute(['varLogin' => "$login", 'varPassword' => "$password"]);
            $res = $statement->fetch();
            $_SESSION["userId"] = $res[0];
            $_SESSION["type"] = "arbitre";
            header("Location: /index.php");

        } else {

            $_SESSION["loggedIn"] = true;
            $statement = $pdo->prepare("SELECT ID_User FROM Utilisateurs WHERE Identifiant=:varLogin AND Mot_de_passe=:varPassword");
            $statement->execute(['varLogin' => "$login", 'varPassword' => "$password"]);
            $res = $statement->fetch();
            $_SESSION["userId"] = $res[0];
            $_SESSION["type"] = "capitaine";
            header("Location: /index.php");
        }



    } else {

        // Si le mot de passe n'est pas bon, on le renvoie vers la page de connexion avec un message d'erreur

        $_SESSION["errorMessage"] = "Mot de passe incorrect";

        header("Location: /pages/login.php");

    }

} else {

    // Si l'utilisateur n'existe pas, on le renvoie vers la page de connexion avec un message d'erreur

    $_SESSION["errorMessage"] = "L'utilisateur n'existe pas.";

    header("Location: /pages/login.php");

}