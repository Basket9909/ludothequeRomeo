<?php

session_start();

if(isset($_SESSION['login']))
{
    header("LOCATION:dashboard.php");
}

if(isset($_POST['username']))
{
    if(empty($_POST['username']) OR empty($_POST['password']))
    {
        $err = "Veuillez remplir correctement le formulaire";
    }else{
        require "../connexion.php";
        $login = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];
        $req = $bdd->prepare("SELECT * FROM admin where login=?");
        $req->execute([$login]);
        if(!$don = $req->fetch())
        {
            $err = "Login incorrect";
        }else{
            if(Password_verify($password,$don['password']))
            {
                $_SESSION['login'] = $_POST['username'];
                header("LOCATION:dashboard.php");
            }else{
                $err = "Mot de passe incorrect";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Connexion admin ludotheque</title>
</head>
<body>
    <h1 class="text-center my-3">Connexion admin ludotheque</h1>
    <div class="container col-4 offset-4">
        <div class="row">
            <form action="index.php" method="POST">
            <div class="username">
                <label for="username">Login</label>
                <input type="text" name="username" id="username" class="form-control mb-3">
            </div>
            <div class="password">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control mb-3">
            </div>
            <div class="submit">
                <input type="submit" name="submit" value="Se connecter" id="submit" class="form-control btn btn-primary my-3">
            </div>
        </form>
        <?php
        
        if(isset($err)){

            echo '<div class="alert alert-danger"><h3 class="text-center">'.$err.'</h3></div>';
        }
        
        ?>
        </div>
    </div>
    
</body>
</html>