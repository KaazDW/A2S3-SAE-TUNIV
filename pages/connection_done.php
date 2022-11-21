<?php session_start(); 
        if ($_SESSION["admin"] == false) {
            header("../index.php");
        }
        if (empty($_SESSION["admin"])) {
            $_SESSION["admin"] = false;
          };
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>
</head>
<body>
    <!-- HEADER IMPORT MODULE -->
    <?php include '../modules/header.php'; ?>
    
    <div class="margin-header"></div> <!-- issu with margin-top under the fixed header -->
    <main class="main-index">
    <?php
        if ($_SESSION["admin"]) {
            echo ("<h1 style='color:red;'>CONNECTER</h1>");
        } else {
            echo ("<p>non connecter");
        }
    ?>
        <h1>CONNECTED-PAGE</h1>
        
    </main>
</body>
<script src="../app.js"></script>
</html>