<?php if ($_SESSION["type"]!="administrateur") {
    header("Location: /index");
}

$id = $_POST["selectid"];

$edit = $pdo->prepare('INSERT into Participer Values(:varidt,:varide,0)');
    
$edit->execute(['varidt'=>$_GET["id"],'varide'=>$id[0]]);
header("Location: /match-tournois?id=" . $_GET["id"]);

