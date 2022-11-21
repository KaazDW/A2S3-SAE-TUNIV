<?php session_start(); 

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
    <main class="main-login">

        <!-- <h1>LOGIN-PAGE</h1> -->
        <form class="center" action="../config/login.php" method="POST">
            <!-- <div> -->
                <label for="login-input">Login</label>
                <input type="text" name="login" id="login-input">
            <!-- </div> -->
            <!-- <div> -->
                <label for="mot-de-passe-input">Password</label>
                <input type="password" name="password" id="password-input">
            <!-- </div> -->
            <button type="submit">Envoyer</button>
        </form>
    </main>
</body>
<script src="../app.js"></script>
</html>