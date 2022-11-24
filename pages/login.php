<?php session_start();
if (empty($_SESSION["admin"])) {
    $_SESSION["admin"] = false;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include '../modules/head.php'; ?>
</head>

<body>
    <header>
        <?php include '../modules/header.php'; ?>
    </header>

    <main class="main-login">

        <?php
        if ($_SESSION["admin"]) {
            echo ("<h2>LOGIN PAGE</h2>
            <form class='center' action='../config/config-login.php' method='POST'>
                <!-- <div> -->
                <label for='login-input'>Login</label>
                <input type='text' name='login' id='login-input'>
                <!-- </div> -->
                <!-- <div> -->
                <label for='mot-de-passe-input'>Password</label>
                <input type='password' name='password' id='password-input'>
                <!-- </div> -->
                <button type='submit'>Se Connecter</button>
            </form>");
        }

        ?>

        <a href="">test</a>

    </main>


    <footer>
        <!-- <h3>footer</h5> -->
        <a href="">©TUNIV</a>
    </footer>
    <script src="/app.js"></script>
</body>

</html>