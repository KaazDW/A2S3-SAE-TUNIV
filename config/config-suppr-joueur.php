<?php if ($_SESSION["type"] != "capitaine") {
    header("Location: ../index.php");
}

$suppr = $pdo->prepare('DELETE from Joueur where ID_Joueur = :varId');

$suppr->execute(
    [

        'varId' => $_GET["id"],
    ]
);

header("Location: /dashb-cap");
