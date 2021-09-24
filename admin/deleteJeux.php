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
    $id=htmlspecialchars($_GET['id']);
    require '../connexion.php';
    $req = $bdd->prepare("SELECT id,nom,type,editeur,DATE_FORMAT(date, '%d / %m / %y') AS mydate, image FROM jeux where id=?");
    $req->execute([$id]);
    if(!$don = $req->fetch())
    {
        header("LOCATION:gestionJeux.php");
    }
}

if(isset($_GET['delete']))
{
    unlink("../image/".$don['image']);
    unlink("../image/mini_".$don['image']);
    $del = $bdd->prepare("DELETE FROM jeux where id=?");
    $del->execute([$id]);
    $del->closeCursor();
    header("LOCATION:gestionJeux.php?delete=ok&id=".$id);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Supprimer le jeux : <?=$don['nom']?></title>
</head>
<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-left my-3">
        <img src="../image/mini_<?=$don['image']?>" alt="<?=$don['nom']?>" class="mx-3" >
        <div class="mx-3">
        <h3><strong>Nom : </strong><?=$don['nom']?></h3>
        <h3><strong>Type : </strong><?=$don['type']?></h3>
        <h3><strong>Editeur : </strong><?=$don['editeur']?></h3>
        <h3><strong>Date de sortie : </strong><?=$don['mydate']?></h3>
        <h2 class="my-3">Voulez vous vraiment supprimer ce jeux ?</h2>
        <a href="deleteJeux.php?delete=ok&id=<?=$id?>" class="btn btn-warning">Oui</a>
        <a href="gestionJeux.php" class="btn btn-danger">Non</a>
    </div>
    </div>

    </div>
</body>
</html>