<?php if ($_SESSION["type"] != "administrateur") {
    header("Location: /index");
}

$sport = $_POST["new-sport"];
$nom = $_POST["new-name"];
$date_debut = $_POST["new-date-debut"];
$date_fin = $_POST["new-date-fin"];
$nb_equipe = $_POST["new-nb-equipe"];
$etape = $_POST["new-etape"];

$edit = $pdo->prepare('UPDATE Tournoi  set Sport=:varsport, Nom=:varnom, DateDebut=:vardatedebut, DateFin=:vardatefin, Nb_Equipe=:varnb, Etape=:varetape where ID_Tournoi = :varId');


$edit->execute(
    [
        'varsport' => $sport,
        'varnom' => $nom,
        'vardatedebut' => $date_debut,
        'vardatefin' => $date_fin,
        'varnb' => $nb_equipe,
        'varetape' => $etape,
        'varId' => $_GET["id"],
    ]
);

header("Location: /pages/dashb-admin");