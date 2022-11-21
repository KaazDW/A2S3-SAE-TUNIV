<header>
    <h1><a href="../index.php">TUNIV</a></h1>
    <ul class="nav">
        <li><a href="../pages/informations.php">Informations</a></li>
        <li><a href="">A propos</a></li>
            <p style="color: grey;">|</p>
        <li><a href="../pages/login-page.php">LOGIN</a></li>
        <li><a href="../config/logout.php">LOGOUT</a></li>
        
        <li>          <?php
          if ($_SESSION["admin"]) {
            echo ("<a class ='nav-link' href='../config/logout.php'>Bienvenue, " . $_SESSION["user"] . ". Cliquez ici pour vous déconnecter.</a>");
          } else {
            echo ("<a class='nav-link' href='/login.php'>Connexion</a>");
          }
          ?></li>
        
    </ul>
    <div class="mobile-menu">
        <input type="checkbox" id="mobile-menu-id" onclick="MobileMenu()">
        <label for="mobile-menu-id">
            <img src="../assets/img/menu-icon.png">
        </label>
    </div>
    <div class="mobilemenu-closed">
        <ul>
            <li>test</li>
            <li>test</li>
            <li>test</li>
            <li>test</li>
        </ul>
    </div>
</header>