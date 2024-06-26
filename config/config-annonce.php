<?php 
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}
if ($_SESSION["type"]!="administrateur") {
    header("Location: /index");
}
if (!empty($_SESSION["annonceErreur"])) {
    unset($_SESSION["annonceErreur"]);
}

//Verification du formulaire 
if (empty($_POST["title"])){
    $_SESSION["annonceErreur"] = "Titre de l'annonce manquant";
    header("Location: /form-annonce");
}
if (empty($_POST["author"])){
    $_SESSION["annonceErreur"] = "Nom de l'auteur manquant";
    header("Location: /form-annonce");
}
if (empty($_POST["role"])){
    $_SESSION["annonceErreur"] = "Rôle de l'auteur manquant";
    header("Location: /form-annonce");
}
if (empty($_POST["content"])){
    $_SESSION["annonceErreur"] = "Contenu de l'annonce manquant";
    header("Location: /form-annonce");
}
if (($_FILES["img"]['size']==0)){
    $img = $pdo->quote('');
} else {
    $img = $pdo->quote("assets/img/" . basename($_FILES["img"]["name"]));
    move_uploaded_file($_FILES["img"]["tmp_name"], "../webroot/assets/img/" . basename($_FILES["img"]["name"]));
}

//initiation et envoie de la requete
$title = $pdo->quote($_POST["title"]);
$author = $pdo->quote($_POST["author"]);
$role = $pdo->quote($_POST["role"]);
$content = $pdo->quote($_POST["content"]);

$sql = "INSERT INTO Annonces VALUES (0, $title, now(), $author, $role, $content, $img);";
$res = $pdo->exec($sql);

// verification de la quantité d'annonce stockée
if (!$res) {
    $_SESSION["annonceErreur"] = "La création de l\'annonce a échoué, veuillez réessayer. Si l\'erreur persiste, contactez le support.";
    header("Location: /form-annonce");
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

    header("Location: /form-annonce");
}