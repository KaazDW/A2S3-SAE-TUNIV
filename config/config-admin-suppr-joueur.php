<?php if ($_SESSION["type"]!="administrateur") {
    header("Location: /index.php");
}

$suppr = $pdo->prepare('DELETE from Joueur where ID_Joueur = :varId');

$suppr->execute(
[
    'varId' =>$_GET["id"],
]
);

header("Location: /dashb-admin-editform-equipe?id=" . $_GET["id2"]);
?>