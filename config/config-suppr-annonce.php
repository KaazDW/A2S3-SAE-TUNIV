<?php if ($_SESSION["type"]!="administrateur") {
    header("Location: ../index.php");
}

$sql = $pdo->prepare("DELETE FROM Annonces WHERE ID_Annonce=:varId");
$sql->execute(['varId' => $_GET['id']]);

header("Location: ../pages/form-annonce.php");