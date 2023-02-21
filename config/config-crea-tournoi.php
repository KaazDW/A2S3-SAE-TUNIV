<?php if ($_SESSION["type"]!="administrateur") {
    header("Location: /index");
}

if (!empty($_SESSION["tournoiErreur"])) {
    unset($_SESSION["tournoiErreur"]);
}

if (empty($_POST["name"])){
    $_SESSION["tournoiErreur"] = "Nom du tournoi manquant";
    header("Location: /dashb-admin");
}
$name = $pdo->quote($_POST["name"]);

if (empty($_POST["sport"])){
    $_SESSION["tournoiErreur"] = "Sport du tournoi manquant";
    header("Location: /dashb-admin");
}
$sport = $pdo->quote($_POST["sport"]);

if (empty($_POST["dateDeb"])){
    $_SESSION["tournoiErreur"] = "Date de début manquante";
    header("Location: /dashb-admin");
}
$dateDeb = $pdo->quote($_POST["dateDeb"]);

if (empty($_POST["dateFin"])){
    $_SESSION["tournoiErreur"] = "Date de fin manquante";
    header("Location: /dashb-admin");
}
$dateFin = $pdo->quote($_POST["dateFin"]);

if (empty($_POST["teams"])){
    $_SESSION["tournoiErreur"] = "Nombre maximum d'équipes manquant";
    header("Location: /dashb-admin");
}
$teams = $pdo->quote($_POST["teams"]);

$sql = "INSERT INTO Tournoi VALUES (0, $sport, $name, $dateDeb, $dateFin, $teams, 0);";
$res = $pdo->exec($sql);
if (!$res) {
    $_SESSION["tournoiErreur"] = "La création du tournoi a échoué, veuillez réessayer. Si l'erreur persiste, contactez le support.";
    header("Location: /dashb-admin.php");
} else {
    $sql = "SELECT max(ID_Tournoi) FROM Tournoi;";
    $id = $pdo->query(($sql))->fetch()[0];
    
    header("Location: /match-tournois?id=$id");
}