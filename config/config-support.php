<?php
include_once 'db.php';

if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == 0)
{
        $fileInfo = pathinfo($_FILES['screenshot']['name']);
        $extension = $fileInfo['extension'];
        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'pdf', 'PNG', 'JPG'];
        if (in_array($extension, $allowedExtensions))
        {
                if ($_FILES['screenshot']['size'] <= 1000000)
                {
                        move_uploaded_file($_FILES['screenshot']['tmp_name'], '../webroot/uploadsupport/' . basename($_FILES['screenshot']['name']));
                        $fname = $pdo->quote($_POST["firstname"]);
                        $lname = $pdo->quote($_POST["lastname"]);
                        $email = $pdo->quote($_POST["email"]);
                        $descr = $pdo->quote($_POST["content"]);    
                        $screen = $pdo->quote($_FILES['screenshot']['name'])  ;  
                        // var_dump($screen);   
                        $sql = "INSERT INTO support VALUES (0, $email, $fname, $lname, $descr, $screen);";
                        $res = $pdo->exec($sql);

                        echo "L'envoi a bien été effectué ! Merci de votre prise de contact, l'administrateur vous recontactera au plus vite";

                } else {
                        echo "Votre capture d'écran est trop volumineuse. La taille maximal accepté est de 1Mo. Veuillez corriger ceci et recommencer";
                }
        } else { 
                echo "Le fichier que vous essayez d'envoyer n'est pas une image. Veuillez corriger ceci et recommencer.  ";
        }
} else{
        echo "Fichier capture d'écran non trouvé. Veuillez recommencer.";
};
?>

