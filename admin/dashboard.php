<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("LOCATION:index.php");
}

if(isset($_GET['deco']))
{
    session_destroy();
    header("LOCATION:index.php");
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body>
    <div class="container-fluid">
        <h1 class="text-center my-3">Dashboard</h1>
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-between">
                <a class="btn btn-secondary my-3" href="../index.php" target="_BLANK">Retour au site</a>
               <a class="btn btn-warning my-3" href="dashboard.php?deco=ok">Deconnexion</a>
                <a class="btn btn-primary my-3" href="gestionJeux.php">Gestion du site</a>
            </div>
        </div>
    </div>
</body>
</html>