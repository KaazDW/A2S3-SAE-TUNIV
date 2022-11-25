<?php session_start();
if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if (empty($_SESSION["type"])) {
    $_SESSION["type"] = null;
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
            if ($_SESSION["loggedIn"]) {
                echo("
                    <div class='logout-div'>
                        <div>
                            <p>Connecté en tant "); 
                            
                if ($_SESSION["type"]=="administrateur"){
                    echo("qu'administrateur.</p>");
                }
                else if ($_SESSION["type"]=="arbitre"){
                    echo("qu'arbitre.</p>");
                }
                else {
                    echo("que capitaine.</p>");
                }

                echo("      <a href='../config/config-logout.php' class='logout-button'>Se déconnecter</a>
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