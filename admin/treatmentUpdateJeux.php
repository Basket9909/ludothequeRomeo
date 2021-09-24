<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("LOCATION:index.php");
}

if(isset($_GET['id']) OR !empty($_GET['id']))
    {
        $id=htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:product.php");
    }

    require "../connexion.php";
    $req = $bdd->prepare("SELECT * FROM jeux WHERE id=?");
    $req->execute([$id]);
    if(!$don = $req->fetch())
    {
        $req->closeCursor();
        header("LOCATION:gestionJeux.php");
    }
    $req->closeCursor();

if(isset($_POST['nom']))
{
    $err = 0;

    if(empty($_POST['nom']))
    {
        $err = 2;
    }else{

        $nom = htmlspecialchars($_POST['nom']);
    }

    if(empty($_POST['type']))
    {
        $err=3;
    }else{

        $type = htmlspecialchars($_POST['type']);
    }

    if(empty($_POST['editeur']))
    {
        $err = 4;
    }else{

        $editeur = htmlspecialchars($_POST['editeur']);
    }

    if(empty($_POST['date']))
    {
        $err = 5;
    }else{

        $date = $_POST['date'];
    }

    if($err == 0)
    {
        if(empty($_FILES['image']['tmp_name']))
        {
            require '../connexion.php';
            $update = $bdd->prepare("UPDATE jeux set nom=:nom, type=:type, editeur=:editeur, date=:date where id=:id");
            $update->execute([
                ":nom"=>$nom,
                ":type"=>$type,
                ":editeur"=>$editeur,
                ":date"=>$date,
                ":id"=>$id
            ]);
            $update->closeCursor();
            header("LOCATION:gestionJeux.php?update=ok&id=".$id);
        }
        else{


            unlink("../image/".$don['image']);
            unlink("../image/mini_".$don['image']);

            $dossier = '../image/';
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 2000000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = array('.png','.jpg','.jpeg, jpe');
            $extension = strrchr($_FILES['image']['name'], '.');

            if(!in_array($extension , $extensions))
        {
            $erreur = 'Vous devez uploader un fichier de type png, jpg, jpeg'; 
        }
        if($taille>$taille_maxi)
        {
            $erreur = 'Le fichier dépasse la taille autorisée';
        }

        if(!isset($erreur))
        {
            $fichier = strtr($fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
            $fichiercptl=rand().$fichier;
            if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichiercptl))
            {
                require '../connexion.php';
                $update = $bdd->prepare("UPDATE jeux set nom=:nom, type=:type, editeur=:editeur, date=:date, image=:im where id=:id");
                $update->execute([
                    ":nom"=>$nom,
                    ":type"=>$type,
                    ":editeur"=>$editeur,
                    ":date"=>$date,
                    ":im"=>$fichiercptl,
                    ":id"=>$id
                ]);
                $update->closeCursor(); 

                if($extension==".png")
                            {
                                header("LOCATION:redimpng.php?update=".$id."&image=".$fichiercptl);
                            }
                            else
                            {
                                header("LOCATION:redim.php?update=".$id."&image=".$fichiercptl);
                            }
            }else{
                header("LOCATION:updateJeux.php?error=7&upload=echec");
            }

        }else{
            header("LOCATION:updateJeux.php?error=7&fich=".$erreur);
        }
        }

       

        
    }else{
        header("LOCATION:updateJeux.php?error=".$err);
    }
}else{
    header("LOCATION:updateJeux.php");
}

?>