
<h1 class="titre">Jeux de simulation</h1>
<div class="container">
    <?php
    $reqcount = $bdd->query("SELECT * FROM jeux where type='simulation'");
    $count = $reqcount->rowCount();
    $nbpage=ceil($count/6);

    if(isset($_GET['page']))
    {
        $pg = $_GET['page'];

    }else{

        $pg = 1;
    }
    $offset = ($pg-1)*6;
    
    $simu = $bdd->prepare("SELECT nom,image,id FROM jeux where type='simulation' ORDER BY id DESC LIMIT :offset,6");
    $simu->bindParam(':offset',$offset, PDO::PARAM_INT);
    $simu->execute();
    while($donsimu = $simu->fetch())
    {
        echo '
        <a class="lienproduit" href="jeux-'.$donsimu['id'].'">
        <div class="carte">
        <div class="photo">
        <img src="image/mini_'.$donsimu['image'].'">
        </div>
        <h3 class="titreJeux">'.$donsimu['nom'].'</h3>
        </div>
        </a>';
    
    }$simu->closeCursor();
    

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