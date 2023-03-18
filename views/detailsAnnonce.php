<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<div>
    <div>
        <img src="../assets/img/annonces/<?= $annonce->getAnnPhoto() ?>" alt="image de l'annonce">
    </div>
    <div>
        <?= $annonce->getAnnNom() ?>
    </div>
    <div>
        <?= $annonce->getAnnPrix() ?>
    </div>

    <div>
        <?php
        foreach ($categoriesAnnonce as $categoryAnnonce) {
            echo "<div>$categoryAnnonce</div>";
        }
        ?>
    </div>
    <div>
        <?= $annonce->getAnnDescription() ?>
    </div>
    <div>
        <label for="favori">Favori</label>
        <input type="checkbox" id="favori" name="favori" onchange="addOrRemoveFavori(<?= $annonce->getUseId() ?>)">
    </div>
    <!--todo le boutton doit s'afficher seulement si l'utilisateur n'a pas crée l'annonce-->
    <div>
        <button>contacter</button>
    </div>

</div>
<?php require 'footer.php' ?>
</body>
</html>
