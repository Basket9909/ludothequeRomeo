<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("LOCATION:index.php");
}
require '../connexion.php';



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Gestion des jeux</title>
</head>
<body>
    <div class="container-fluid">
        <h1 class="text-center my-3">Gestion des jeux</h1>
        <a href="../index.php" class="btn btn-secondary my-3 me-3" target="_BLANK">Retour au site</a>
        <a class="btn btn-warning my-3 mx-3" href="dashboard.php?deco=ok">Deconnexion</a>
        <a class="btn btn-primary my-3 mx-3" href="addJeux.php">Ajouter un jeux</a>

        <?php
            if(isset($_GET['add']))
            {
                echo "<div class='alert alert-success'>Votre produit a bien été ajouté</div>";
            }

            if(isset($_GET['update']))
            {
                echo "<div class='alert alert-warning'>le produit n°".$_GET['id']." a bien été modifié</div>";
            }

            if(isset($_GET['delete']))
            {
                echo "<div class='alert alert-danger'>le produit n°".$_GET['id']." a bien été supprimé</div>";
            }

        ?>


        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Editeur</th>
                    <th>Date de sortie</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
           <?php
           
            $req = $bdd->query("SELECT id,nom,type,editeur,DATE_FORMAT(date, '%d / %m / %y') AS myDate FROM jeux");
            while($don = $req->fetch())
            {
                echo "<tr>";
                echo "<td>".$don['id']."</td>";
                echo "<td>".$don['nom']."</td>";
                echo "<td>".$don['type']."</td>";
                echo "<td>".$don['editeur']."</td>";
                echo "<td>".$don['myDate']."</td>";
                echo "<td class='text-center'>";
                    echo "<a href='updateJeux.php?id=".$don['id']."' class='btn btn-warning mx-2'>Modifier</a>";
                    echo "<a href='deleteJeux.php?id=".$don['id']."' class='btn btn-danger mx-2'>Supprimer</a>";
                echo "</td>";
            echo "</tr>";      
            }
           
           ?>
           </tbody>
        </table>
    </div>
</body>
</html>