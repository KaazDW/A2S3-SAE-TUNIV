<?php

    // $db = new PDO ("sqlite:database.db");

    
    // Connection à une base de donnée hebergé localement sur port 80
    try{
        $db = new PDO ("sqlite:database.db");
        echo "DB correctly connected.<br>";
    }catch(Exception $e){
        echo "DB failed to connect";
        echo $e->getMessage(); 
    }

    $sql = "SELECT * FROM tuniv_db.utilisateurs;";
    $db->exec($sql);
    //var_dump($db);





    // Connection à une base de donnée hebergé localement sur port 80
    // try{
    //     $db= new PDO('mysql:host=127.0.0.1;dbname=tuniv_db','root','');
    //     $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //     $db->exec('SET NAMES utf8');
    //     echo "DB correctly connected.<br>";
    // }catch(Exception $e){
    //     echo "DB failed to connect";
    //     echo $e->getMessage(); 
    // }
    