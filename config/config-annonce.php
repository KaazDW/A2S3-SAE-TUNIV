<?php session_start();

if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if (!$_SESSION["type"]=="administrateur") {
    header("Location: ../../index.php");
}

include("db.php");

if (!empty($_SESSION["annonceErreur"])) {
    unset($_SESSION["annonceErreur"]);
}

if (empty($_POST["title"])){
    $_SESSION["annonceErreur"] = "Titre de l'annonce manquant";
    header("Location: ../pages/dashboard/form-annonce.php");
}
$title = $pdo->quote($_POST["title"]);

if (empty($_POST["author"])){
    $_SESSION["annonceErreur"] = "Nom de l'auteur manquant";
    header("Location: ../pages/dashboard/form-annonce.php");
}
$author = $pdo->quote($_POST["author"]);

if (empty($_POST["role"])){
    $_SESSION["annonceErreur"] = "Rôle de l'auteur manquant";
    header("Location: ../pages/dashboard/form-annonce.php");
}
$role = $pdo->quote($_POST["role"]);

if (empty($_POST["content"])){
    $_SESSION["annonceErreur"] = "Contenu de l'annonce manquant";
    header("Location: ../pages/dashboard/form-annonce.php");
}
$content = $pdo->quote($_POST["content"]);

if (($_FILES["img"]['size']==0)){
    $img = $pdo->quote('');
} else {
    $img = $pdo->quote("assets/img/" . basename($_FILES["img"]["name"]));
    move_uploaded_file($_FILES["img"]["tmp_name"], "../assets/img/" . basename($_FILES["img"]["name"]));
}

$sql = "INSERT INTO Annonces VALUES (0, $title, now(), $author, $role, $content, $img);";
$res = $pdo->exec($sql);
if (!$res) {
    $_SESSION["annonceErreur"] = "La création de l\'annonce a échoué, veuillez réessayer. Si l\'erreur persiste, contactez le support.";
    header("Location: ../pages/dashboard/form-annonce.php");
}
else {
    $sql = "SELECT count(*) FROM Annonces;";
    $res = $pdo->query($sql)->fetch()[0];
    if ($res>30){
        $sql = "CALL viderAnnonces();";
        $res = $pdo->exec($sql);
    }

    if (($_FILES["img"]['size']==0)) {
        $sql = "UPDATE Annonces SET Image=NULL WHERE Image='';";
        $res = $pdo->exec($sql);
    }

    header("Location: ../pages/dashboard/form-annonce.php");
}