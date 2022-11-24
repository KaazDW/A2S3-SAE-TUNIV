<?php if (empty($_SESSION["admin"])) {
    $_SESSION["admin"] = false;
}
?>

<a href="../index.php">
    <h1>🏆 TUNIV</h1>
    <a onClick="mobilemenu()" class="icon">
        <img src="../assets/img/menu-icon.png">
    </a>
</a>
<ul class="nav nonactive" id="nav">
    <li><a href="../pages/informations.php">Informations</a></li>
    <li><a href="../pages/apropos.php">A propos</a></li>
    <span>|</span>
    <li class="login-link"><a href="../pages/login.php"><img src=<?php if ($_SESSION["admin"]) {
                                                                        echo ("'/assets/img/pp-blanc2.png'");
                                                                    } else {
                                                                        echo ("'/assets/img/pp-blanc.png'");
                                                                    } ?>></a></li>
    <span>|</span>
    <li><a href="">JOUR</a></li>
    <!-- <li class="nav-element"><a href="/pages/blog.html">Blog</a>
        <ul>
            <li><a href="/pages/article1.html">Article 1</a></li>
            <li><a href="/pages/artcile2.html">Article 2</a></li>
            <li><a href="/pages/article3.html">Article 3</a></li> 
            <li><a href="/pages/article4.html">Article 4</a></li>
        </ul></li> -->
</ul>