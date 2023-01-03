<?php session_start();

if ($_SESSION["type"]!="administrateur") {
    header("Location: ../../index.php");
}

    include 'db.php';

        $sport = $_POST["sport"];
        $nom = $_POST["nom"];
        $date_debut = $_POST["date-debut"];
        $date_fin = $_POST["date-fin"];
 
        $edit = $pdo->prepare('UPDATE Tournoi  set Sport=:varsport, Nom=:varnom, DateDebut=:vardatedebut, DateFin=:vardatefin where ID_Tournoi = :varId');

        
        $edit->execute(
            [
                'varsport'=>$sport,
                'varnom'=>$nom,
                'vardatedebut'=>$date_debut,
                'vardatefin'=>$date_fin,
                'varId' =>$_GET["id"],
            ]
            );
        

            header("Location: /../pages/dashb-admin.php");
        
        
?>