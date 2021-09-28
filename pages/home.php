<h1 class="titre">Ludotheque Romeo</h1>
<form action="index.php?action=home" method="GET" >
    <div class="form-group">
        <input type="text"  
        
        <?php
        
        if(isset($_GET['search']))
        {
            ?>
            value="<?=$_GET['search']?>"
            <?php
        }else{
            ?>
            placeholder="Rechercher un jeu"
            <?php
        }

        ?>
        
        name="search">
        <input type="submit" value="Rechercher" id="search" >
    </div>
</form>

<?php

if(isset($_GET['search']))
{
    echo '<a href="home"><button>Home</button></a>';
}

?>
<div class="container">
    <?php
    $reqcount = $bdd->query("SELECT * FROM jeux");
    $count = $reqcount->rowCount();
    $nbpage=ceil($count/6);

    if(isset($_GET['page']))
    {
        $pg = $_GET['page'];

    }else{

        $pg = 1;
    }
    $offset = ($pg-1)*6;
    if(isset($_GET['search'])){
        $search = htmlspecialchars($_GET['search']);
        $req = $bdd->prepare("SELECT nom,image,id FROM jeux where nom LIKE :mysearch ORDER BY id DESC");
        $req->execute([
            ':mysearch'=>'%'.$search.'%'
        ]);
        while($don = $req->fetch())
        {
            echo '
            <a class="lienproduit" href="jeux-'.$don['id'].'">
            <div class="carte">
            <div class="photo">
            <img src="image/mini_'.$don['image'].'">
            </div>
            <h3 class="titreJeux">'.$don['nom'].'</h3>
            </div>
            </a>';
        
        }$req->closeCursor();
    }else{

    
    $req = $bdd->prepare("SELECT nom,image,id FROM jeux ORDER BY id DESC LIMIT :offset,6");
    $req->bindParam(':offset',$offset, PDO::PARAM_INT);
    $req->execute();
    while($don = $req->fetch())
    {
        echo '
        <a class="lienproduit" href="jeux-'.$don['id'].'">
        <div class="carte">
        <div class="photo">
        <img src="image/mini_'.$don['image'].'">
        </div>
        <h3 class="titreJeux">'.$don['nom'].'</h3>
        </div>
        </a>';
    
    }$req->closeCursor();
    

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
    }
?>