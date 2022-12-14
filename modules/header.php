<?php if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if (empty($_SESSION["type"])) {
    $_SESSION["type"] = null;
}

?>
<header>
    <a href="/index.php">
        <h1>🏆 TUNIV</h1>
    </a>
    <a onClick="mobilemenu()" class="icon">
        <img src="../assets/img/menu-icon.png">
    </a>
    <div id="mobilenav">
        <a href="/pages/tournois.php">Tournois</a>
        <a href="/pages/apropos.php">A propos</a>
        <a href="/pages/login.php" class="login-link"><img src=<?php if ($_SESSION["loggedIn"]) {
                                                                            echo ("'/assets/img/pp-blanc2.png'");
                                                                        } else {
                                                                            echo ("'/assets/img/pp-blanc.png'");
                                                                        } ?>>
                                                                        </a>
    </div>
    <ul class="link" id="nav">
        <li><a href="/pages/tournois.php">Tournois</a></li>
        <li><a href="/pages/apropos.php">A propos</a></li>
    </ul>
    <ul class="nav-icon">
        <li class="login-link"><a href="/pages/login.php"><img src=<?php if ($_SESSION["loggedIn"]) {
                                                                            echo ("'/assets/img/pp-blanc2.png'");
                                                                        } else {
                                                                            echo ("'/assets/img/pp-blanc.png'");
                                                                        } ?>></a></li>
        <li><a onclick="theme()" id="themebutton">JOUR</a></li>
    </ul>
</header>

<?php 
if ($_SESSION["type"]=="administrateur") {
    echo (" 
    <section class='admin-header'>
                <ul>
                    <li><a href='/pages/dashb-admin.php'>DASHBOARD</a></li>|
                    <li><a href='/pages/form-annonce.php'>ANNONCES</a></li>
                </ul>
            </section>

    ");
} else if(($_SESSION["type"]=="capitaine")){
    echo ("    
    <section class='admin-header'>
                <ul>
                    <li><a href='/pages/dashb-cap.php'>MON EQUIPE</a></li>
                </ul>
            </section>");
} 