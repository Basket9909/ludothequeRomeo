
<h1 class="titre">Jeux de RPG</h1>
<div class="container">
    <?php
    $reqcount = $bdd->query("SELECT * FROM jeux where type='rpg'");
    $count = $reqcount->rowCount();
    $nbpage=ceil($count/6);

    if(isset($_GET['page']))
    {
        $pg = $_GET['page'];

    }else{

        $pg = 1;
    }
    $offset = ($pg-1)*6;
    
    $rpg = $bdd->prepare("SELECT nom,image,id FROM jeux where type='rpg' ORDER BY id DESC LIMIT :offset,6");
    $rpg->bindParam(':offset',$offset, PDO::PARAM_INT);
    $rpg->execute();
    while($donrpg = $rpg->fetch())
    {
        echo '
        <a class="lienproduit" href="jeux-'.$donrpg['id'].'">
        <div class="carte">
        <div class="photo">
        <img src="image/mini_'.$donrpg['image'].'">
        </div>
        <h3 class="titreJeux">'.$donrpg['nom'].'</h3>
        </div>
        </a>';
    
    }$rpg->closeCursor();
    

    ?>
</div>
<?php

echo "<div class='pagination'>";
    if($pg>1)
    {
    echo "<a class='textPage' href='index.php?action=rpg&page=".($pg-1)."' title='Page précédente'>< Précédente</a>&nbsp;";
    }
    echo '<h1 class="numPage">Page '.$pg.'</h1>';
    if($pg!=$nbpage)
    {
    echo " <a class='textPage' href='index.php?action=rpg&page=".($pg+1)."' title='Page suivante'>Suivante ></a>";
    }            
 echo "</div>";
?>