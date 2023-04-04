<?php

// Connection à la base de donnée
// UTILISEZ LES COMMENTAIRES POUR APPELER LA BASE DE DONNÉE CORRESPONDANT AU SUPPORT UTILISÉ.

// // DB connection JF(machine personnelle)
try {
    $pdo = new PDO("mysql:dbname=db_tuniv;host=localhost", "root", "", [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die();
}

// DB connection Gael (IUT)
// try{
//     $pdo = new PDO ("mysql:dbname=p2106013;host=iutbg-lamp.univ-lyon1.fr", "p2106013", "12106013", [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
// }catch(Exception $e){
//     die();
// }

// DB connection Nathan (IUT)
// try {
//     $pdo = new PDO("mysql:dbname=p2106229;host=iutbg-lamp.univ-lyon1.fr", "p2106229", "12106229", [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
// } catch (Exception $e) {
//     die();
// }

