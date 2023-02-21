<?php if ($_SESSION["type"]!="administrateur") {
    header("Location: /index");
}

if (!empty($_SESSION["userErreur"])) {
    unset($_SESSION["userErreur"]);
}

if (empty($_POST["name"])){
    $_SESSION["userErreur"] = "Nom de l'utilisateur manquant";
    header("Location: /dashb-admin-utilisateurs");
}

else if (empty($_POST["surname"])){
    $_SESSION["userErreur"] = "Prénom de l'utilisateur manquant";
    header("Location: /dashb-admin-utilisateurs");
}

else if (empty($_POST["login"])){
    $_SESSION["userErreur"] = "Identifiant de l'utilisateur manquant";
    header("Location: /dashb-admin-utilisateurs");
}

else if (empty($_POST["password"])){
    $_SESSION["userErreur"] = "Mot de passe de l'utilisateur manquant";
    header("Location: /dashb-admin-utilisateurs");
}
else if (empty($_POST["passwordConfirm"])){
    $_SESSION["userErreur"] = "Confirmation du mot de passe de l'utilisateur manquante";
    header("Location: /dashb-admin-utilisateurs");
}
else if ($_POST["password"]!=$_POST["passwordConfirm"]){
    $_SESSION["userErreur"] = "Mot de passe et confirmation différents";
    header("Location: /dashb-admin-utilisateurs");
}

else if (empty($_POST["email"])){
    $_SESSION["userErreur"] = "Email de l'utilisateur manquant";
    header("Location: /dashb-admin-utilisateurs");
}

else if (empty($_POST["role"])){
    $_SESSION["userErreur"] = "Rôle de l'utilisateur manquant";
    header("Location: /dashb-admin-utilisateurs");
}

else {
    $name = $pdo->quote($_POST["name"]);
    $surname = $pdo->quote($_POST["surname"]);
    $login = $pdo->quote($_POST["login"]);
    $password = $pdo->quote($_POST["password"]);
    $email = $pdo->quote($_POST["email"]);
    $role = $pdo->quote($_POST["role"]);
    
    $sql = "INSERT INTO Utilisateurs VALUES (0, $login, $password, $name, $surname, $email, $role);";
    $res = $pdo->exec($sql);
    if (!$res) {
        $_SESSION["userErreur"] = "La création de l'utilisateur a échoué, veuillez réessayer. Si l\'erreur persiste, contactez le support.";
        header("Location: /dashb-admin-utilisateurs");
    } else {
        header("Location: /dashb-admin-utilisateurs");
    }
}

