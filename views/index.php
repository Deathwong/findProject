<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<?php require 'menu.php' ?>
<div class="container">
    <div>
        <h1>Liste Annonces</h1>
        <table id="annonce-tab">
            <tr>
                <th>Photo</th>
                <th>Titre</th>
                <th>Prix</th>
                <th>Description</th>
            </tr>

            <?php
            foreach ($annonces as $annonce) {
                ?>
                <tr>
                    <td>
                        <img src="../assets/img/annonces/<?= $annonce->getAnnPhoto() ?>" alt="image de l'annonce">
                    </td>
                    <td><?= $annonce->getAnnNom() ?></td>
                    <td><?= $annonce->getAnnPrix() ?></td>
                    <td><?= $annonce->getAnnDescription() ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
<!--<div>-->
<!--    <div>--><?php //= $user->getUseId() ?><!--</div>-->
<!--    <div>--><?php //= $user->getUseEmail() ?><!--</div>-->
<!--    <div>--><?php //= $user->getUsePassword() ?><!--</div>-->
<!--</div>-->
<!--<div>-->
<!--    <form action="">-->
<!--        <div>-->
<!--            <label for="nom">nom</label>-->
<!--            <input type="text" id="nom" name="nom">-->
<!--        </div>-->
<!--        <div>-->
<!--            <label for="prix_min">Prix min</label>-->
<!--            <input type="text" id="prix_min" name="prix_min">-->
<!--        </div>-->
<!--        <div>-->
<!--            <label for="prix_max">Prix max</label>-->
<!--            <input type="text" id="prix_max" name="prix_max">-->
<!--        </div>-->
<!--        <div>-->
<!--            <label for="categorie_id"></label>-->
<!--            <select name="categorieId" id="categorie_id">-->
<!--                <option>---Catégories---</option>-->
<!--                --><?php
//                foreach ($categories as $category) {
//                    $categoryLibelle = $category->getCatLibelle();
//                    $categoryId = $category->getCatId();
//                    ?>
<!--                    <option value="--><?php //= $categoryId ?><!--">--><?php //= $categoryLibelle ?><!--</option>-->
<!--                    --><?php
//                }
//                ?>
<!--            </select>-->
<!--        </div>-->
<!--    </form>-->
<!--    <button onclick="rechercheAjax()">Rechercher</button>-->
<!--</div>-->
<!---->

<?php require 'footer.php' ?>
</body>
</html>