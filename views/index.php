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
        <!--        <table id="annonce-tab">-->
        <!--            <tr>-->
        <!--                <th>Photo</th>-->
        <!--                <th>Titre</th>-->
        <!--                <th>Prix</th>-->
        <!--                <th>Description</th>-->
        <!--            </tr>-->
        <!---->
        <!--            --><?php
        //            foreach ($annonces as $annonce) {
        //                ?>
        <!--                <tr>-->
        <!--                    <td>-->
        <!--                        <img src="../assets/img/annonces/-->
        <?php //= $annonce->getAnnPhoto() ?><!--" alt="image de l'annonce">-->
        <!--                    </td>-->
        <!--                    <td>--><?php //= $annonce->getAnnNom() ?><!--</td>-->
        <!--                    <td>--><?php //= $annonce->getAnnPrix() ?><!--</td>-->
        <!--                    <td>--><?php //= $annonce->getAnnDescription() ?><!--</td>-->
        <!--                </tr>-->
        <!--                --><?php
        //            }
        //            ?>
        <!--        </table>-->

        <div class="row row-cols-1 row-cols-md-3 g-4" id="annonce-cards-grid">
            <?php foreach ($annonces as $annonce) { ?>

                <div class="col">
                    <div class="card h-100">
                        <img src="../assets/img/annonces/<?= $annonce->getAnnPhoto() ?>" class="card-img-top"
                             alt="Skyscrapers"/>

                        <div class="card-body">

                            <h5 class="card-title"><?= $annonce->getAnnNom() ?></h5>

                            <p class="card-text">
                                <?= $annonce->getAnnDescription() ?>
                            </p>
                        </div>

                        <div class="card-footer">
                            <!--Détails annonce-->
                            <a href="detailsAnnonce.php?idAnnonce=<?= $annonce->getAnnId() ?>"
                               class="btn btn-light icon-hover px-2 pt-2"><i class="fa-sharp fa-solid fa-info"></i></a>

                            <!--Détails Favorie-->
                            <input type="checkbox" id="favori" name="favori" aria-label="favoris"
                                   onchange="addOrRemoveFavori(<?= $annonce->getAnnId() ?>)">
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
<script>
</script>
</body>
</html>