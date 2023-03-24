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
                            <div class="card-title">

                                <h5><?= $annonce->getAnnNom() ?></h5>
                                <h5><?= $annonce->getAnnPrix() ?> €</h5>
                            </div>

                            <p class="card-text">
                                <?= $annonce->getAnnDescription() ?>
                            </p>
                        </div>

                        <div class="card-footer">
                            <!--Détails annonce-->
                            <a href="detailsAnnonce.php?idAnnonce=<?= $annonce->getAnnId() ?>"
                               class="btn btn-primary shadow-0 me-1">Détails</a>
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