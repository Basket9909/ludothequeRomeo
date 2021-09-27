<h1 class="titre"><?=$donjeux['nom']?></h1>
<a href="index.php?action=home"><button>Retour</button></a>
<div class="presentation">
    <img src="image/mini_<?=$donjeux['image']?>" alt="<?=$donjeux['nom']?>">
    <h2 class="editeurJeux"><?=$donjeux['editeur']?></h2>
    <h3 class="editeurJeux autreJeux"><?=$donjeux['type']?></h3>
    <h3 class="editeurJeux autreJeux">Date de sortie : <?=$donjeux['myDate']?></h3>
</div>