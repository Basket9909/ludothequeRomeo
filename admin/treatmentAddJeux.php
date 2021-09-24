<?php

session_start();

if(!isset($_SESSION['login']))
{
    header("LOCATION:index.php");
}

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

        $dossier = '../image/';
        $fichier = basename($_FILES['image']['name']);
        $taille_maxi = 2000000;
        $taille = filesize($_FILES['image']['tmp_name']);
        $extensions = array('.png','.jpg','.jpeg');
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
                $insert = $bdd->prepare("INSERT INTO jeux(nom,type,editeur,date,image) values(:nom,:type,:edi,:date,:im)");
                $insert->execute([
                    ":nom"=>$nom,
                    ":type"=>$type,
                    ":edi"=>$editeur,
                    ":date"=>$date,
                    ":im"=>$fichiercptl
                ]);
                $insert->closeCursor();

                if($extension==".png")
						{
							header("LOCATION:redimpng.php?image=".$fichiercptl);
						}
						else
						{
							header("LOCATION:redim.php?image=".$fichiercptl);
						}
            }else{
                header("LOCATION:addJeux.php?error=7&upload=echec");
            }

        }else{
            header("LOCATION:addJeux.php?error=7&fich=".$erreur);
        }
    }else{
        header("LOCATION:addJeux.php?error=".$err);
    }
}else{
    header("LOCATION:addJeux.php");
}

?>