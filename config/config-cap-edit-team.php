<?php if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if ($_SESSION["type"] != "capitaine") {
    header("Location: ../index.php");
}

$equipe = $_POST["new-name-team"];


$edit = $pdo->prepare('UPDATE Equipe  set Nom=:varnom where ID_Equipe=:idequipe');


$edit->execute(
    [
        'varnom' => $equipe,
        'idequipe' => $_SESSION["actuel"],
    ]
);


header("Location: ../pages/dashb-cap.php");
