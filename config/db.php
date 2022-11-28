<?php

// UTILISEZ LES COMMENTAIRES POUR APPELER LA BASE DE DONNÉE CORRESPONDANT AU SUPPORT UTILISÉ.
    
    DBconnectJF();
    // DBconnectIUT();

    function DBconnectJF(){
        try {
            $pdo = new PDO("mysql:dbname=tuniv_db;host=localhost", "root", "", [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $e) {
            die();
            // echo "DB failed to connect";
            // echo $e->getMessage(); 
        }
    }
    function DBconnectIUT(){
        try{
            $db = new PDO ("sqlite:database.db");//mettez ça à jour
            // echo "DB correctly connected.<br>";
        }catch(Exception $e){
            die();
            // echo "DB failed to connect";
            // echo $e->getMessage(); 
        }
    }

    // $sql = "SELECT * FROM tuniv_db.utilisateurs;";
    // $db->exec($sql);
    //var_dump($db);


