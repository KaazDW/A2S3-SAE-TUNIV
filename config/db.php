<?php

// UTILISEZ LES COMMENTAIRES POUR APPELER LA BASE DE DONNÉE CORRESPONDANT AU SUPPORT UTILISÉ.

// // DB connection JF()
    try {
        $pdo = new PDO("mysql:dbname=tuniv_db_rework;host=localhost", "root", "", [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
    } catch (PDOException $e) {
        // die();
    }
    
// DB connection IUT
    // try{
    //     $pdo = new PDO ("mysql:dbname=p2106229;host=iutbg-lamp.univ-lyon1.fr", "p2106229", "12106229", [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
    // }catch(Exception $e){
    //     die();
    // }
    
// DB connection IUT
    try{
        $pdo = new PDO ("mysql:dbname=p2106229;host=iutbg-lamp.univ-lyon1.fr", "p2106229", "12106229", [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
    }catch(Exception $e){
        die();
    }

    // $sql = "SELECT * FROM tuniv_db.utilisateurs;";
    // $db->exec($sql);
    // var_dump($db);

