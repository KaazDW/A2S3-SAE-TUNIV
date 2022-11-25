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
        <?php include '../modules/header.php'; ?>

    <main class="main-login">

        <?php
            if ($_SESSION["admin"]) {
                echo("

                    <div class='logout-div'>
                        <div>
                            <p>Connecté en temps que : [...]</p>
                            <a href='../config/config-logout.php' class='logout-button'>Se déconnecter</a>
                        </div>
                    </div>
                ");
            } else {
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
    </main>
    <?php include '../modules/footer.php'; ?>

    <script src="/app.js"></script>
</body>

</html>