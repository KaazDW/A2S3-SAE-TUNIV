<?php if ($_SESSION["type"]!="administrateur") {
    header("Location: ../../index.php");
}

    include 'db.php';

    $id = $_POST["selectid"];




// echo $id[0];
// echo $_GET["id"];



 
    $edit = $pdo->prepare('INSERT into Participer Values(:varidt,:varide,0)');

        
    $edit->execute(
    [
                 'varidt'=>$_GET["id"],
                 'varide'=>$id[0],

    ]
    );
        

            header("Location: /../pages/match-tournois.php?id=" . $_GET["id"]);
    
