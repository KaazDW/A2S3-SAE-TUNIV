<?php session_start();

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../../index.php");
}

    include 'db.php';

    $name = $_POST["selectid"];




    $idequipe = $pdo->prepare('SELECT ID_Equipe from  Equipe where Nom =:varnom');


    $idequipe->execute(
        [

            'varnom' =>  $name,
        ]
    );
    $id = $idequipe->fetch();


// echo $id[0];
// echo $_GET["id"];



 
    $edit = $pdo->prepare('INSERT into Participer Values(:varidt,:varide )');

        
    $edit->execute(
    [
                 'varidt'=>$_GET["id"],
                 'varide'=>$id[0],

    ]
    );
        

            header("Location: /../pages/match-tournois.php");
    
