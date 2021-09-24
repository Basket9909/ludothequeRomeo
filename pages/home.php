<h1 class="titre">Ludotheque Romeo</h1>
<div class="container">
    <?php
    
    $req = $bdd->query("SELECT nom,image,id FROM jeux ORDER BY id DESC");
    while($don = $req->fetch())
    {
        echo '
        <a class="lienproduit" href="index.php?action=jeux&id='.$don['id'].'">
        <div class="carte">
        <div class="photo">
        <img src="image/mini_'.$don['image'].'">
        </div>
        <h3 class="titreJeux">'.$don['nom'].'</h3>
        </div>
        </a>';
    
    }

    ?>
</div>