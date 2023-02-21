<?php if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../index.php");
}

$prenom = $_POST["new-surname1"];
$nom = $_POST["new-name1"];
$mail = $_POST["new-mail1"];
$type = $_POST["new-type1"];

$edit = $pdo->prepare('UPDATE Utilisateurs  set Prenom=:varprenom, Nom=:varnom, Email=:varmail, Type_user=:vartype where ID_User = :varId');


$edit->execute(
[
    'varprenom'=>$prenom,
    'varnom'=>$nom,
    'varId' =>$_GET["id"],
    'varmail'=>$mail,
    'vartype'=>$type,
]
);


header("Location: /dashb-admin-utilisateurs");  
        
?>