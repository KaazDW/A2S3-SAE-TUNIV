<?php 
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

                echo("      <a href='/logout' class='logout-button'>Se déconnecter</a>
                        </div>
                    </div>
                ");
            } else {
                if (isset($_SERVER["errorMessage"])){
                    echo($_SESSION["errorMessage"]);
                    unset($_SESSION["errorMessage"]);
                }
                echo ("<h2>LOGIN PAGE</h2>
                <form class='center' method='POST' id='form'>
                    <!-- <div> -->
                    <label for='login-input'>Login</label>
                    <input type='text' name='login' id='login-input'>
                    <!-- </div> -->
                    <!-- <div> -->
                    <label for='mot-de-passe-input'>Password</label>
                    <input type='password' name='password' id='password-input'>
                    <!-- </div> -->
                    <button type='submit'>Se Connecter</button>
                    <div class='cf-turnstile' data-sitekey='0x4AAAAAAADR2zXo9bNOJV2W' data-callback='javascriptCallback'></div>
                    <a href='/support'>mot de passe oublié ?</a>
                    <p>Rédigez votre demande de reinitialisation de votre mot de passe dans le 'formulaire de contact d'un administrateur'. Celui-ci vous recontactera au plus vite.</p>
                </form>");
            }
        ?>
    </main>
    <?php include '../modules/footer.php'; ?>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</body>
</html>