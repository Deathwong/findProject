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
        <img src="../assets/img/annonces/<?= $annonce->getAnnPhoto() ?>">
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
</div>
<?php require 'footer.php' ?>
</body>
</html>
