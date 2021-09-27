<?php

require 'connexion.php';
if(isset($_GET['action']))
{
    $menu = [
        "home" => "home.php",
        "jeux"=>"jeux.php",
        "simu"=>"simulation.php",
        "gestion"=>"gestion.php",
        "rpg"=>"rpg.php",
        "autre"=>"autre.php"
    ];

    if(array_key_exists($_GET['action'],$menu))
    {
        if($_GET['action']=="jeux")
        {
            if(isset($_GET['id']) AND !empty($_GET['id']))
            {
                $id=htmlspecialchars($_GET['id']);
                $jeux = $bdd->prepare("SELECT id,nom,type,editeur,DATE_FORMAT(date, '%d / %m / %y') as myDate,image from jeux where id=?");
                $jeux->execute([$id]);
                if(!$donjeux = $jeux->fetch())
                {
                header("HTTP/1.1 404 Not Found");
                $action = "404.php"; 
                }else{
                    $action = $menu['jeux'];
                }
                $jeux->closeCursor();
            }else{
                header("HTTP/1.1 404 Not Found");
                $action = "404.php"; 
            }
        }elseif($_GET['action']=="simu")
        {
           $action = $menu['simu'];
        }elseif($_GET['action']=="rpg")
        {
           $action = $menu['rpg'];
        }elseif($_GET['action']=="gestion")
        {
            $action = $menu['gestion'];
        }
        
        else{
            $action = $menu[$_GET['action']]; 
        }
    }else{
            header("HTTP/1.1 404 Not Found");
            $action = "404.php";
        }
}else{
    $action = "home.php";
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ludotheque Romeo</title>
</head>
<body>
    <nav>
        <ul>
            <li class="grandLi"><h2>Romeo's ludotheque</h2></li>
            <li><a href="index.php?action=home">Home</a></li>
            <li><a href="index.php?action=simu">Simulation</a></li>
            <li><a href="index.php?action=gestion">Gestion</a></li>
            <li><a href="index.php?action=rpg">RPG</a></li>
        </ul>
    </nav>
<div class="contGlobal">
    <?php
    
    include("pages/".$action);
    
    ?>
    </div>
    <footer>&copyromeo</footer>
</body>
</html>