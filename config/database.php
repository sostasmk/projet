<?php
//parametre de la base de donne
    $host="localhost";
    $dbname="gesblio";
    $user="root";
    $password=" ";
    try{
        $pdo=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8,$user,$password");//la chaine qui nous amène vers la base de donnee
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//configure le mode d'erreur de connexion
    }
    catch(PDOException $e ){
die("Erreur de connexion");
    }
?>