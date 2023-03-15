<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<div>ACCUEIL</div>
<!--<div>-->
<!--    <div>--><?php //= $user->getUseId() ?><!--</div>-->
<!--    <div>--><?php //= $user->getUseEmail() ?><!--</div>-->
<!--    <div>--><?php //= $user->getUsePassword() ?><!--</div>-->
<!--</div>-->
<div>
    <form action="">
        <div>
            <label for="nom">nom</label>
            <input type="text" id="nom" name="nom">
        </div>
        <div>
            <label for="prix_min">Prix min</label>
            <input type="text" id="prix_min" name="prix_min">
        </div>
        <div>
            <label for="prix_max">Prix max</label>
            <input type="text" id="prix_max" name="prix_max">
        </div>
        <div>
            <label for="categorie"></label>
            <select name="categorieId" id="categorie_id">
                <option>---Catégories---</option>
                <?php
                foreach ($categories as $category) {
                    $categoryLibelle = $category->getCatLibelle();
                    $categoryId = $category->getCatId();
                    ?>
                    <option value="<?= $categoryId ?>"><?= $categoryLibelle ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </form>
    <button onclick="rechercheAjax()">Rechercher</button>
</div>

<div>
    <h1>Liste Annonces</h1>
    <?php
    foreach ($annonces as $annonce) {
        ?>
        <div>
            <img src="../assets/img/annonces/<?= $annonce->getAnnPhoto() ?>" alt="image de l'annonce">
        </div>
        <div><?= $annonce->getAnnNom() ?></div>
        <div><?= $annonce->getAnnPrix() ?></div>
        <div><?= $annonce->getAnnDescription() ?></div>
        <div>--------------</div>
        <?php
    }
    ?>
</div>
<?php require 'footer.php' ?>
</body>
</html>