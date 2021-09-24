<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("LOCATION:index.php");
}

if(!isset($_GET['id']))
{
    header("LOCATION:gestionJeux.php");
}else{
    $id = htmlspecialchars($_GET['id']);
    require '../connexion.php';
    $req = $bdd->prepare("SELECT * FROM jeux where id=?");
    $req->execute([$id]);
    if(!$don = $req->fetch())
    {
        $req->closeCursor();
        header("LOCATION:index.php");
    }$req->closeCursor();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Modifier le jeu : <?=$don['nom']?></title>
</head>
<body>
    <div class="container-fluid">
        <div class="col-6 offset-3">
            <h1 class="text-center my-3">Modifier le jeu : <?=$don['nom']?></h1>
            <form action="treatmentUpdateJeux.php?id=<?= $don['id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nom">Nom : </label>
                <input type="text" name="nom" id="nom" class="form-control my-3" value="<?=$don['nom']?>">
            </div>
            <div class="form-group">
                <label for="type">Type : </label>
                <input type="text" name="type" id="type" class="form-control my-3" value="<?=$don['type']?>">
            </div>
            <div class="form-group">
                <label for="editeur">Editeur : </label>
                <input type="text" name="editeur" id="editeur" class="form-control my-3" value="<?=$don['editeur']?>">
            </div>
            <div class="form-group">
                <label for="date">Date de sortie : </label>
                <input type="date" name="date" id="date" class="form-control my-3" value="<?=$don['date']?>">
            </div>
            <div class="row">
                    <div class="col-3">
                        <img src="../image/mini_<?= $don['image'] ?>" alt="image de <?= $don['nom'] ?>" class="img-fluid">
                    </div>
                </div>
            <div class="form-group">
                    <label for="image">Modifier l'image de couverture: </label>
                    <input type="file" name="image" id="image" class="form-control my-3">
                </div>   
                <div class="form-group">
                    <input type="submit" value="Modifier" class="btn btn-success my-2">
                </div>
            </form>
        </div>
    </div>
</body>
</html>