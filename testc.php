<?php
//envoie de mail avec entête
$expediteur = "admin@domain.com";
date("D, j M Y H:i:s"); //date
$entete = "From: jean-francois.marcourt@etu.univ-lyon1.fr"; // expéditeur
$entete .= "Cc: n";
$entete .= "Reply-To: $expediteur n"; // Adresse de retour, retour à l'envoyeur en cas d'erreur
$entete .= "X-Mailer: PHP/" . phpversion() . "n" ; //version
$entete .= "Date: ". date("D, j M Y H:i:s"); //date;
mail( "tout@domain.com", "Communication", "Nous vous communiquons que le département sera fermé tous les mardi après midi.", $entete);
