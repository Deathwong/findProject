<?php
require '../Controller/AppController.php';
controller();
?>

<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
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
</body>
</html>