<?php if (empty($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if (empty($_SESSION["type"])) {
    $_SESSION["type"] = null;
}

?>
<header>
    <a href="/index">
        <h1>🏆 TUNIV</h1>
    </a>
    <a onClick="mobilemenu()" class="icon">
        <img src="../assets/img/menu-icon.png" alt="">
    </a>
    <div id="mobilenav">
        <a href="/tournois">Tournois</a>
        <a href="/a-propos">A propos</a>
        <a href="/login" class="login-link"><img alt="" src=<?php if ($_SESSION["loggedIn"]) {
                                                                echo ("'/assets/img/pp-blanc2.png'");
                                                            } else {
                                                                echo ("'/assets/img/pp-blanc.png'");
                                                            } ?>>
        </a>
    </div>
    <ul class="link" id="nav">
        <li><a href="/tournois">Tournois</a></li>
        <li><a href="/a-propos">A propos</a></li>
    </ul>
    <ul class="nav-icon">
        <li class="login-link"><a href="/login"><img alt="" src=<?php if ($_SESSION["loggedIn"]) {
                                                                    echo ("'/assets/img/pp-blanc2.png'");
                                                                } else {
                                                                    echo ("'/assets/img/pp-blanc.png'");
                                                                } ?>></a></li>
        <!-- <li><a onclick="theme()" id="themebutton">JOUR</a></li> -->
    </ul>
</header>

<?php
if ($_SESSION["type"] == "administrateur") {
    echo (" 
    <section class='admin-header'>
        <ul>
            <li><a href='/dashb-admin'>DASHBOARD</a></li>|
            <li><a href='/form-annonce'>ANNONCES</a></li>|
            <li><a href='/dashb-admin-utilisateurs'>UTILISATEURS</a></li>
            <li><a href='/password'>MOT DE PASSE</a></li>
        </ul>
    </section>
    ");
} else if (($_SESSION["type"] == "capitaine")) {
    echo ("    
    <section class='admin-header'>
        <ul>
            <li><a href='/dashb-cap'>MON EQUIPE</a></li>
            <li><a href='/password'>MOT DE PASSE</a></li>
        </ul>
    </section>
    ");
} else if (($_SESSION["type"] == "arbitre")) {
    echo ("    
    <section class='admin-header'>
        <ul>
            <li><a href='/dashb-arbitre'>MATCH</a></li>
            <li><a href='/password'>MOT DE PASSE</a></li>
        </ul>
    </section>
    ");
}
