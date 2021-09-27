
<h1 class="titre">Jeux de gestion</h1>
<div class="container">
    <?php
    $reqcount = $bdd->query("SELECT * FROM jeux where type='gestion'");
    $count = $reqcount->rowCount();
    $nbpage=ceil($count/6);

    if(isset($_GET['page']))
    {
        $pg = $_GET['page'];

    }else{

        $pg = 1;
    }
    $offset = ($pg-1)*6;
    
    $gestion = $bdd->prepare("SELECT nom,image,id FROM jeux where type='gestion' ORDER BY id DESC LIMIT :offset,6");
    $gestion->bindParam(':offset',$offset, PDO::PARAM_INT);
    $gestion->execute();
    while($dongestion = $gestion->fetch())
    {
        echo '
        <a class="lienproduit" href="index.php?action=jeux&id='.$dongestion['id'].'">
        <div class="carte">
        <div class="photo">
        <img src="image/mini_'.$dongestion['image'].'">
        </div>
        <h3 class="titreJeux">'.$dongestion['nom'].'</h3>
        </div>
        </a>';
    
    }$gestion->closeCursor();
    

    ?>
</div>
<?php

echo "<div class='pagination'>";
    if($pg>1)
    {
    echo "<a class='textPage' href='index.php?action=home&page=".($pg-1)."' title='Page précédente'>< Précédente</a>&nbsp;";
    }
    echo '<h1 class="numPage">Page '.$pg.'</h1>';
    if($pg!=$nbpage)
    {
    echo " <a class='textPage' href='index.php?action=home&page=".($pg+1)."' title='Page suivante'>Suivante ></a>";
    }            
 echo "</div>";
?>