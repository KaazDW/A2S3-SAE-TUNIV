<?php session_start();

if ($_SESSION["type"] != "administrateur") {
    header("Location: ../../index.php");
}

include 'db.php';

$nom = $_POST["name"];
$sport = $_POST["sport"];
$nom_cap = $_POST["name-capitaine"];
$prenom_cap = $_POST["firstname-capitaine"];


$users = $pdo->prepare('SELECT ID_User from Utilisateurs where Nom =:varnom and Prenom=:varprenom');


$users->execute(
    [
        'varnom' => $nom_cap,
        'varprenom' => $prenom_cap,

    ]
);
$user = $users->fetch();
$id_user = $user[0];


$add = $pdo->prepare('INSERT into Equipe Values(0,:varnom, :varsport, :varid);');


$add->execute(
    [
        'varnom' => $nom,
        'varsport' => $sport,
        'varid' => $id_user

    ]
);


header("Location: /../pages/dashb-admin.php");
