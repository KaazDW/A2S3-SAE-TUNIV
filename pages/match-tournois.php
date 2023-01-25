<?php session_start();
if (empty($_SESSION["admin"])) {
    $_SESSION["admin"] = false; 
}

include_once '../config/db.php';

$listematch = $pdo->prepare('SELECT * FROM MatchTournoi where ID_Tournoi =:varId');

$listematch->execute(['varId' =>$_GET["id"]]);
$matchs=$listematch->fetchAll();

$tournoi = $pdo->prepare('SELECT * FROM Tournoi WHERE ID_Tournoi =:varId');
$tournoi->execute(['varId' =>$_GET["id"]]);
$tournoi=$tournoi->fetchAll();

$listeequipe = $pdo->prepare('SELECT Nom, ID_Equipe FROM Participer natural join Equipe WHERE ID_Tournoi =:varId');
$listeequipe->execute(['varId' =>$_GET["id"]]);
$equipes=$listeequipe->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include '../modules/head.php'; ?>

</head>
<body>
    <?php include '../modules/header.php'; ?>

    <main class="main-matchtournois">
        <!-- <div id="loaderdiv">
            <div class="loader"></div>  
        </div> -->
        <section id="el1" class="topsec">
                <h2 class="title">
                    <?php $nom = $tournoi[0]["Nom"];
                    echo($nom);?>
                </h2>
                <span class="sub"><?php $etape = $tournoi[0]["Etape"];
                    if ($etape==0){
                        echo("Ce tournoi n'a pas encore commencé.");
                    }
                    else if ($etape==1){
                        echo("Ce tournoi est en cours.");
                    }
                    else {
                        echo("Ce tournoi est terminé.");
                    }
                    ?>
                </span>
            <div class="grid">

                    <h3>Sport :</h3><span><?php $sport = $tournoi[0]["Sport"]; echo $sport;?></span>
                    <h3>Date de début :</h3><span><?php $dateDeb = $tournoi[0]["DateDebut"]; echo $dateDeb;?></span>
                    <h3>Date de fin :</h3><span><?php $dateFin = $tournoi[0]["DateFin"]; echo $dateFin;?></span>
                    <h3>Equipes inscrites :</h3> 
                        <span>
                            <?php $sql = $pdo->prepare('SELECT COUNT(DISTINCT ID_Equipe) FROM Participer WHERE ID_Tournoi =:varId');
                            $sql->execute(['varId' =>$_GET["id"]]);
                            echo($sql->fetch()[0]);
                            ?>/<?php $nbMax = $tournoi[0]["Nb_Equipe"]; echo($nbMax);?>
                        </span>
            </div>
            <?php if ($_SESSION["type"] == "administrateur") {
                    echo (" 
                    <section class='bottom-top'>
                        <div class='addt'>
                            <label for='pet-select'>Ajouter une équipe</label>
                            <div>
                                <select name='pets' id='pet-select'>
                                    <option value=''>--Please choose an option--</option>
                                    <option value='dog'>Dog</option>
                                    <option value='cat'>Cat</option>
                                    <option value='hamster'>Hamster</option>
                                    <option value='parrot'>Parrot</option>
                                    <option value='spider'>Spider</option>
                                    <option value='goldfish'>Goldfish</option>
                                </select>
                                <a href=''>Ajouter</a> 
                            </div>
                        </div>
                        <div class='generationdiv'>
                            <a href='../config/config-poules-tournoi.php?id=". $_GET['id'] . "'><img src='../assets/img/reload.png'>Generer les poules</a>
                        </div>
                    </section>    
                    ");
                };
                ?> 
        </section>

        <!-- Affichage Equipe inscrites -->
        <h2 id="el2" class="title">Equipes Inscrites</h2>
        <section id="el3" class="forequipesection">
            <?php   
            foreach($equipes as $equipe):
            ?>

                <div class="forequipediv">
                    <div>
                        <?php $nomCapitaine = $pdo->prepare("SELECT Prenom, Nom FROM Utilisateurs WHERE ID_User = (SELECT ID_Capitaine FROM Equipe WHERE ID_Equipe = :varEquipe);");
                        $nomCapitaine->execute(['varEquipe' => $equipe['ID_Equipe']]);
                        $nomCapitaine = $nomCapitaine->fetch();
                        ?>
                        <article>
                            <h3><?php echo($equipe['Nom']);?></h3>
                            <span><?php echo ($nomCapitaine["Prenom"]); echo " ", $nomCapitaine["Nom"] ?></span>
                        </article>
                        <?php if ($_SESSION["type"] == "administrateur") {
                            echo (" <a  href='../config/config-delete-team-inscrit.php?idEquipe=" .  $equipe['ID_Equipe'] . "&amp;idTournoi=" . $_GET['id'] . "'>
                                    <img src='../assets/img/delete-blanc.png'>
                                </a>");
                        };
                        ?> 
                    </div> 
                    
                </div>

            <?php
            endforeach;
            ?>
        </section>
        <!-- Fin -->

        <h2 id="el4" class="title">Matchs</h2>
        <section id="el5" class="display-poule">
            <?php foreach($matchs as $match): ?>
                <div class="line-poule">
                    <h3>
                        <span>
                        <?php $idEquipes = $pdo->prepare("SELECT ID_Equipe FROM Jouer WHERE ID_Match= :varMatch;");
                        $idEquipes->execute(['varMatch' => $match['ID_Match']]);
                        $idEquipes = $idEquipes->fetchAll();

                        $nomsEquipes = $pdo->prepare("SELECT Nom FROM Equipe WHERE ID_Equipe = :varEquipe");

                        $nomsEquipes->execute(['varEquipe' => $idEquipes[0][0]]);
                        $nomEquipe1 = $nomsEquipes->fetch();
                        
                        $nomsEquipes->execute(['varEquipe' => $idEquipes[1][0]]);
                        $nomEquipe2 = $nomsEquipes->fetch();

                        echo($nomEquipe1[0] ." contre ". $nomEquipe2[0] . " Début à " . $match['DateDebut'] ." Fin à ". $match['DateFin']." Stade : ".$match['Stade']   ) ?>
                        </span>
                    </h3>
                </div>
            <?php endforeach; ?>

        </section>
    </main> 
    <?php include '../modules/footer.php'; ?>
    <script>
        // console.log('ahahahahaha');
        // el1 = document.getElementById('el1')
        // el2 = document.getElementById('el2')
        // el3 = document.getElementById('el3')
        // el4 = document.getElementById('el4')
        // el5 = document.getElementById('el5')
        // load = document.getElementById('loaderdiv')
        // load.style.display = 'flex'
        // el1.style.display = 'none'
        // el2.style.display = 'none'
        // el3.style.display = 'none'
        // el4.style.display = 'none'
        // el5.style.display = 'none'
        // setTimeout(() => { 
        //     load.style.display = 'none'
        //     el1.style.display = 'block'
        //     el2.style.display = 'block'
        //     el3.style.display = 'block'
        //     el4.style.display = 'block'
        //     el5.style.display = 'block'
        // }, 1000);
    </script>
</body>
</html>